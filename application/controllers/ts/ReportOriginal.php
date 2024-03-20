<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;

class Report extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$this->m_security->tssec();
		$data = [
			'title' 	    => 'Lost Event Database Request',
			'dataorg'	    => $this->m_data->getdataorg(),

		];
		$this->load->view('ts/report_ticket', $data);
	}

	public function excel()
	{
		$this->m_security->tssec();
		$div = $this->session->userdata('id_div');
		if ($div == 1) {
			$mulai = $this->input->post('tgl_awal');
			$akhir = $this->input->post('tgl_akhir');
			//ambil data berkas
			$this->db->select('
			tb_ticket.id_ticket,
			tb_ticket.no_ticket,
			tb_ticket.create_ticket,
			tb_ticket.priority_ticket,
			tb_ticket.nama_ticket,
			tb_ticket.exe_time,
			tb_ticket.finish_ticket,
			tb_ticket.end_time,
			tb_ticket.tgl_kejadian,
			tb_ticket.jenis_transaksi,
			tb_ticket.desk_ticket,
			tb_ticket.durasi,
			tb_ticket.tempat_kejadian,
			tb_ticket.potensi_kerugian,
			tb_ticket.remark_ticket,
			tb_ticket.nominal,
			tb_ticket.pembebanan_kerugian,
			tb_ticket.pejabat_penyetuju,
			tb_ticket.sts_ticket,
				tb_location.nama_loc,
				tb_category.nama_cat,
				tb_user.nama_user,
				tb_department.nama_dept,
				tb_division.nama_div');

			$this->db->from('tb_ticket');
			$this->db->join('tb_division', 'tb_division.id_div = tb_ticket.id_div');
			$this->db->join('tb_location', 'tb_location.id_loc = tb_ticket.id_loc');
			$this->db->join('tb_department', 'tb_department.id_dept = tb_ticket.id_dept');
			$this->db->join('tb_category', 'tb_category.id_cat = tb_ticket.id_cat');
			$this->db->join('tb_user', 'tb_user.id_user = tb_ticket.id_user');
			$this->db->where('tb_ticket.create_ticket >=', $mulai);
			$this->db->where('tb_ticket.create_ticket <=', $akhir);
			$querydata = $this->db->get()->result();

			$spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();

			$styleJudul = [
				'font' => [
					'bold' => true,
					'size' => 15,
				],
				'alignment' => [
					'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
					'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
					'wrap' => true,
				],
			];
			$sheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
			$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
			$sheet->setCellValue('A1', 'Rekapitulasi Request');
			$sheet->mergeCells('A1:K2');
			$sheet->getStyle('A1')->applyFromArray($styleJudul);
			$sheet->setCellValue('A3', 'PERIODE ' . $mulai . ' sampai ' . $akhir . '');
			$sheet->mergeCells('A3:K3');
			$sheet->getStyle('A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

			$sheet->setCellValue('A5', 'No');
			$sheet->setCellValue('B5', 'Tgl Request');
			$sheet->setCellValue('C5', 'Klien');
			$sheet->setCellValue('D5', 'Department');
			$sheet->setCellValue('E5', 'Lokasi');
			$sheet->setCellValue('F5', 'Divisi');
			$sheet->setCellValue('G5', 'Kategori');
			$sheet->setCellValue('H5', 'Prioritas');
			$sheet->setCellValue('I5', 'Teknisi');
			$sheet->setCellValue('J5', 'Down Time');
			$sheet->setCellValue('K5', 'Status');
			$sheet->getStyle('A5:K5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
			$databerkas = $querydata;
			$no = 1;
			$rowx = 6;
			foreach ($databerkas as $rowberkas) {
				$now = new DateTime($rowberkas->finish_ticket . '' . $rowberkas->end_time, new DateTimeZone('Asia/Jakarta'));

				// Waktu yang Anda miliki
				$yourDateTime = new DateTime('' . $rowberkas->exe_time . '', new DateTimeZone('Asia/Jakarta'));

				// Hitung selisih waktu
				$interval = $now->diff($yourDateTime);

				// Mendapatkan perbedaan jam
				$hours = $interval->h;

				// Mendapatkan perbedaan hari
				$days = $interval->days;

				if ($days > 0) {
					// Jika lebih dari satu hari, tampilkan perbedaan dalam hari
					$downtime = $days . ' hari';
				} elseif ($hours > 0) {
					// Jika lebih dari satu jam, tampilkan perbedaan dalam jam
					$downtime = $hours . ' jam';
				} else {
					// Jika kurang dari satu jam, tampilkan perbedaan dalam menit
					$downtime = $interval->i . ' menit';
				}
				// Query user input

				if ($rowberkas->priority_ticket == '1') {
					$priority = 'Low';
				} elseif ($rowberkas->priority_ticket == '2') {
					$priority = 'Normal';
				} elseif ($rowberkas->priority_ticket == '3') {
					$priority = 'High';
				}

				if ($rowberkas->sts_ticket == '1') {
					$priority = 'Open';
				} elseif ($rowberkas->sts_ticket == '2') {
					$priority = 'Proses';
				} elseif ($rowberkas->sts_ticket == '3') {
					$priority = 'Selesai';
				}

				$sheet->setCellValue('A' . $rowx, $no++);
				$sheet->setCellValue('B' . $rowx, $rowberkas->create_ticket);
				$sheet->setCellValue('C' . $rowx, $rowberkas->nama_ticket);
				$sheet->setCellValue('D' . $rowx, $rowberkas->nama_dept);
				$sheet->setCellValue('E' . $rowx, $rowberkas->nama_loc);
				$sheet->setCellValue('F' . $rowx, $rowberkas->nama_div);
				$sheet->setCellValue('G' . $rowx, $rowberkas->nama_cat);
				$sheet->setCellValue('H' . $rowx, $priority);
				$sheet->setCellValue('I' . $rowx, $rowberkas->nama_user);
				$sheet->setCellValue('J' . $rowx, $downtime);
				$sheet->setCellValue('K' . $rowx, $priority);
				$rowx++;
			}
			$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
			$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(15);
			$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(40);
			$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(10);
			$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(10);
			$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(10);
			$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(15);
			$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(20);

			$writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
			$filename = "rekaprequest_" . time() . "_download";

			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
			header('Cache-Control: max-age=0');
			ob_end_clean();
			$writer->save('php://output');
		} else {
			$mulai = $this->input->post('tgl_awal');
			$akhir = $this->input->post('tgl_akhir');
			//ambil data berkas
			$this->db->select('
			tb_ticket.id_ticket,
			tb_ticket.no_ticket,
			tb_ticket.create_ticket,
			tb_ticket.priority_ticket,
			tb_ticket.nama_ticket,
			tb_ticket.exe_time,
			tb_ticket.finish_ticket,
			tb_ticket.end_time,
			tb_ticket.tgl_kejadian,
			tb_ticket.jenis_transaksi,
			tb_ticket.desk_ticket,
			tb_ticket.durasi,
			tb_ticket.tempat_kejadian,
			tb_ticket.potensi_kerugian,
			tb_ticket.remark_ticket,
			tb_ticket.nominal,
			tb_ticket.pembebanan_kerugian,
			tb_ticket.pejabat_penyetuju,
			tb_ticket.sts_ticket,
				tb_location.nama_loc,
				tb_category.nama_cat,
				tb_user.nama_user,
				tb_department.nama_dept,
				tb_division.nama_div');
			$this->db->from('tb_ticket');
			$this->db->join('tb_division', 'tb_division.id_div = tb_ticket.id_div');
			$this->db->join('tb_location', 'tb_location.id_loc = tb_ticket.id_loc');
			$this->db->join('tb_department', 'tb_department.id_dept = tb_ticket.id_dept');
			$this->db->join('tb_category', 'tb_category.id_cat = tb_ticket.id_cat');
			$this->db->join('tb_user', 'tb_user.id_user = tb_ticket.id_user');
			$this->db->where('tb_ticket.id_div >=', $div);
			$this->db->where('tb_ticket.create_ticket >=', $mulai);
			$this->db->where('tb_ticket.create_ticket <=', $akhir);
			$querydata = $this->db->get()->result();

			$spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();

			$styleJudul = [
				'font' => [
					'bold' => true,
					'size' => 15,
				],
				'alignment' => [
					'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
					'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
					'wrap' => true,
				],
			];
			$sheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
			$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
			$sheet->setCellValue('A1', 'Rekapitulasi Ticket');
			$sheet->mergeCells('A1:K2');
			$sheet->getStyle('A1')->applyFromArray($styleJudul);
			$sheet->setCellValue('A3', 'PERIODE ' . $mulai . ' sampai ' . $akhir . '');
			$sheet->mergeCells('A3:K3');
			$sheet->getStyle('A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

			$sheet->setCellValue('A5', 'No');
			$sheet->setCellValue('B5', 'Tgl Ticket');
			$sheet->setCellValue('C5', 'Klien');
			$sheet->setCellValue('D5', 'Department');
			$sheet->setCellValue('E5', 'Lokasi');
			$sheet->setCellValue('F5', 'Divisi');
			$sheet->setCellValue('G5', 'Kategori');
			$sheet->setCellValue('H5', 'Prioritas');
			$sheet->setCellValue('I5', 'Teknisi');
			$sheet->setCellValue('J5', 'Down Time');
			$sheet->setCellValue('K5', 'Status');
			$sheet->getStyle('A5:K5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
			$databerkas = $querydata;
			$no = 1;
			$rowx = 6;
			foreach ($databerkas as $rowberkas) {
				$now = new DateTime($rowberkas->finish_ticket . '' . $rowberkas->end_time, new DateTimeZone('Asia/Jakarta'));

				// Waktu yang Anda miliki
				$yourDateTime = new DateTime('' . $rowberkas->exe_time . '', new DateTimeZone('Asia/Jakarta'));

				// Hitung selisih waktu
				$interval = $now->diff($yourDateTime);

				// Mendapatkan perbedaan jam
				$hours = $interval->h;

				// Mendapatkan perbedaan hari
				$days = $interval->days;

				if ($days > 0) {
					// Jika lebih dari satu hari, tampilkan perbedaan dalam hari
					$downtime = $days . ' hari';
				} elseif ($hours > 0) {
					// Jika lebih dari satu jam, tampilkan perbedaan dalam jam
					$downtime = $hours . ' jam';
				} else {
					// Jika kurang dari satu jam, tampilkan perbedaan dalam menit
					$downtime = $interval->i . ' menit';
				}
				// Query user input

				if ($rowberkas->priority_ticket == '1') {
					$priority = 'Low';
				} elseif ($rowberkas->priority_ticket == '2') {
					$priority = 'Normal';
				} elseif ($rowberkas->priority_ticket == '3') {
					$priority = 'High';
				}

				if ($rowberkas->sts_ticket == '1') {
					$priority = 'Open';
				} elseif ($rowberkas->sts_ticket == '2') {
					$priority = 'Proses';
				} elseif ($rowberkas->sts_ticket == '3') {
					$priority = 'Selesai';
				}

				$sheet->setCellValue('A' . $rowx, $no++);
				$sheet->setCellValue('B' . $rowx, $rowberkas->create_ticket);
				$sheet->setCellValue('C' . $rowx, $rowberkas->nama_ticket);
				$sheet->setCellValue('D' . $rowx, $rowberkas->nama_dept);
				$sheet->setCellValue('E' . $rowx, $rowberkas->nama_loc);
				$sheet->setCellValue('F' . $rowx, $rowberkas->nama_div);
				$sheet->setCellValue('G' . $rowx, $rowberkas->nama_cat);
				$sheet->setCellValue('H' . $rowx, $priority);
				$sheet->setCellValue('I' . $rowx, $rowberkas->nama_user);
				$sheet->setCellValue('J' . $rowx, $downtime);
				$sheet->setCellValue('K' . $rowx, $priority);
				$rowx++;
			}
			$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
			$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(15);
			$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(40);
			$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(10);
			$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(10);
			$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(10);
			$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(15);
			$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(20);

			$writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
			$filename = "rekaprequest_" . time() . "_download";

			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
			header('Cache-Control: max-age=0');
			ob_end_clean();
			$writer->save('php://output');
		}
	}
}
