<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;

class Report extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		require_once APPPATH . 'third_party/dompdf/dompdf_config.inc.php';
	}

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
			'division'	    => $this->m_data->getdivision(),
			'category'	    => $this->m_data->getcategory(),
		];
		$this->load->view('ts/report_ticket', $data);
	}

	public function excel_old()
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
			tb_ticket.faktor_penyebab,
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
			$sheet->mergeCells('A1:S2');
			$sheet->getStyle('A1')->applyFromArray($styleJudul);
			$sheet->setCellValue('A3', 'PERIODE ' . $mulai . ' sampai ' . $akhir . '');
			$sheet->mergeCells('A3:S3');
			$sheet->getStyle('A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

			$sheet->setCellValue('A5', 'No');
			$sheet->setCellValue('B5', 'Tanggal Input');
			$sheet->setCellValue('C5', 'Tanggal Kejadian');
			$sheet->setCellValue('D5', 'Jenis Transaksi');
			$sheet->setCellValue('E5', 'Kronologi Kejadian');
			$sheet->setCellValue('F5', 'Jenis Resiko');
			$sheet->setCellValue('G5', 'Durasi Kejadian (dalam menit)');
			$sheet->setCellValue('H5', 'Tempat Kejadian');
			$sheet->setCellValue('I5', 'Faktor Penyebab Kejadian');
			$sheet->setCellValue('J5', 'Potensi Kerugian');
			$sheet->setCellValue('K5', 'Unit Kerja Penanggungjawab');
			$sheet->setCellValue('L5', 'Tanggal Penyelesaian');
			$sheet->setCellValue('M5', 'Jam dan Menit Penyelesaian');
			$sheet->setCellValue('N5', 'Deskripsi Penyelesaian');
			$sheet->setCellValue('O5', 'Nominal Potensi Kerugian');
			$sheet->setCellValue('P5', 'Pembebanan Kerugian');
			$sheet->setCellValue('Q5', 'Status Kejadian');
			$sheet->setCellValue('R5', 'Nama Penginput');
			$sheet->setCellValue('S5', 'Nama Approval');
			$sheet->getStyle('A5:S5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
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
				$sheet->setCellValue('C' . $rowx, $rowberkas->tgl_kejadian);
				$sheet->setCellValue('D' . $rowx, $rowberkas->jenis_transaksi);
				$sheet->setCellValue('E' . $rowx, $rowberkas->desk_ticket);
				$sheet->setCellValue('F' . $rowx, $rowberkas->nama_cat);
				$sheet->setCellValue('G' . $rowx, $rowberkas->durasi);
				$sheet->setCellValue('H' . $rowx, $rowberkas->tempat_kejadian);
				$sheet->setCellValue('I' . $rowx, $rowberkas->faktor_penyebab);
				$sheet->setCellValue('J' . $rowx, $rowberkas->potensi_kerugian);
				$sheet->setCellValue('K' . $rowx, $rowberkas->nama_div);
				$sheet->setCellValue('L' . $rowx, $rowberkas->finish_ticket);
				$sheet->setCellValue('M' . $rowx, $downtime);
				$sheet->setCellValue('N' . $rowx, $rowberkas->remark_ticket);
				$sheet->setCellValue('O' . $rowx, $rowberkas->nominal);
				$sheet->setCellValue('P' . $rowx, $rowberkas->pembebanan_kerugian);
				$sheet->setCellValue('Q' . $rowx, $priority);
				$sheet->setCellValue('R' . $rowx, $rowberkas->nama_user);
				$sheet->setCellValue('S' . $rowx, $rowberkas->pejabat_penyetuju);
				$rowx++;
			}
			$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
			$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(15);
			$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(40);
			$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(15);
			$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(30);
			$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(30);
			$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(35);
			$spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(30);
			$spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('R')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('S')->setWidth(20);

			$writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
			$filename = "ReportRequest_" . time() . "_Download";

			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
			header('Cache-Control: max-age=0');
			ob_end_clean();
			$writer->save('php://output');


			//wolcome to pdf file bos
			// Buat HTML dari data
			$html = $this->load->view('ts/pdf_view', ['data' => $databerkas], true);

			$this->generatePdf($html);
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
			tb_ticket.faktor_penyebab,
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
			$sheet->mergeCells('A1:S2');
			$sheet->getStyle('A1')->applyFromArray($styleJudul);
			$sheet->setCellValue('A3', 'PERIODE ' . $mulai . ' sampai ' . $akhir . '');
			$sheet->mergeCells('A3:S3');
			$sheet->getStyle('A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
			$sheet->setCellValue('A5', 'No');
			$sheet->setCellValue('B5', 'Tanggal Input');
			$sheet->setCellValue('C5', 'Tanggal Kejadian');
			$sheet->setCellValue('D5', 'Jenis Transaksi');
			$sheet->setCellValue('E5', 'Kronologi Kejadian');
			$sheet->setCellValue('F5', 'Jenis Resiko');
			$sheet->setCellValue('G5', 'Durasi Kejadian (dalam menit)');
			$sheet->setCellValue('H5', 'Tempat Kejadian');
			$sheet->setCellValue('I5', 'Faktor Penyebab Kejadian');
			$sheet->setCellValue('J5', 'Potensi Kerugian');
			$sheet->setCellValue('K5', 'Unit Kerja Penanggungjawab');
			$sheet->setCellValue('L5', 'Tanggal Penyelesaian');
			$sheet->setCellValue('M5', 'Jam dan Menit Penyelesaian');
			$sheet->setCellValue('N5', 'Deskripsi Penyelesaian');
			$sheet->setCellValue('O5', 'Nominal Potensi Kerugian');
			$sheet->setCellValue('P5', 'Pembebanan Kerugian');
			$sheet->setCellValue('Q5', 'Status Kejadian');
			$sheet->setCellValue('R5', 'Nama Penginput');
			$sheet->setCellValue('S5', 'Nama Approval');
			$sheet->getStyle('A5:S5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
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
				$sheet->setCellValue('C' . $rowx, $rowberkas->tgl_kejadian);
				$sheet->setCellValue('D' . $rowx, $rowberkas->jenis_transaksi);
				$sheet->setCellValue('E' . $rowx, $rowberkas->desk_ticket);
				$sheet->setCellValue('F' . $rowx, $rowberkas->nama_cat);
				$sheet->setCellValue('G' . $rowx, $rowberkas->durasi);
				$sheet->setCellValue('H' . $rowx, $rowberkas->tempat_kejadian);
				$sheet->setCellValue('I' . $rowx, $rowberkas->faktor_penyebab);
				$sheet->setCellValue('J' . $rowx, $rowberkas->potensi_kerugian);
				$sheet->setCellValue('K' . $rowx, $rowberkas->nama_div);
				$sheet->setCellValue('L' . $rowx, $rowberkas->finish_ticket);
				$sheet->setCellValue('M' . $rowx, $downtime);
				$sheet->setCellValue('N' . $rowx, $rowberkas->remark_ticket);
				$sheet->setCellValue('O' . $rowx, $rowberkas->nominal);
				$sheet->setCellValue('P' . $rowx, $rowberkas->pembebanan_kerugian);
				$sheet->setCellValue('Q' . $rowx, $priority);
				$sheet->setCellValue('R' . $rowx, $rowberkas->nama_user);
				$sheet->setCellValue('S' . $rowx, $rowberkas->pejabat_penyetuju);
				$rowx++;
			}
			$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
			$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(15);
			$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(40);
			$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(15);
			$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(30);
			$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(30);
			$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(35);
			$spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(30);
			$spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('R')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('S')->setWidth(20);
			$writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
			$filename = "ReportRequest_" . time() . "_Download";

			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
			header('Cache-Control: max-age=0');
			ob_end_clean();
			$writer->save('php://output');

			// welcome file pdf bos
			// Buat HTML dari data
			$html = $this->load->view('ts/pdf_view', ['data' => $databerkas], true);

			$this->generatePdf($html);
		}
	}

	public function generatePdf_old()
	{
		// Buat objek Dompdf
		$options = new Options();
		$options->set('isHtml5ParserEnabled', true);
		$options->set('isPhpEnabled', true);
		$dompdf = new Dompdf($options);

		// Load HTML ke dalam Dompdf
		$dompdf->loadHtml($html);

		// Render PDF (menggunakan format A4)
		$dompdf->setPaper('A4', 'landscape');
		$dompdf->render();

		// Simpan atau tampilkan file PDF
		$dompdf->stream('ReportRequest_' . time() . '_Download.pdf', array('Attachment' => 0));
	}

	//on progress
	public function excel()
	{
		$this->m_security->tssec();
		$div = $this->session->userdata('id_div');
		$mulai = $this->input->post('tgl_awal');
		$akhir = $this->input->post('tgl_akhir');

		$querydata = $this->getDataForExcel($div, $mulai, $akhir);

		$this->generateExcel($querydata, $mulai, $akhir);

		$this->generatePdf($querydata);
	}

	private function getDataForExcel($div, $mulai, $akhir)
	{
		$this->db->select(
			'
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
        tb_ticket.faktor_penyebab,
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
        tb_division.nama_div'
		);

		$this->db->from('tb_ticket');
		$this->db->join('tb_division', 'tb_division.id_div = tb_ticket.id_div');
		$this->db->join('tb_location', 'tb_location.id_loc = tb_ticket.id_loc');
		$this->db->join('tb_department', 'tb_department.id_dept = tb_ticket.id_dept');
		$this->db->join('tb_category', 'tb_category.id_cat = tb_ticket.id_cat');
		$this->db->join('tb_user', 'tb_user.id_user = tb_ticket.id_user');

		if ($div == 1) {
			// Kondisi jika divisi adalah 1
			$this->db->where('tb_ticket.create_ticket >=', $mulai);
			$this->db->where('tb_ticket.create_ticket <=', $akhir);
		} else {
			// Kondisi jika divisi bukan 1 (sesuaikan kondisi berdasarkan kebutuhan)
			$this->db->where('tb_ticket.id_div >=', $div);
			$this->db->where('tb_ticket.create_ticket >=', $mulai);
			$this->db->where('tb_ticket.create_ticket <=', $akhir);
		}
		return $this->db->get()->result();
	}


	private function generateExcel($querydata, $mulai, $akhir)
	{
		$spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		// ... (Kode untuk mengisi data Excel)

		$sheet->setCellValue('A1', 'Rekapitulasi Request');
		$sheet->mergeCells('A1:S2');

		$sheet->setCellValue('A3', 'PERIODE ' . $mulai . ' sampai ' . $akhir . '');
		$sheet->mergeCells('A3:S3');
		$sheet->getStyle('A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

		$sheet->setCellValue('A5', 'No');
		$sheet->setCellValue('B5', 'Tanggal Input');
		$sheet->setCellValue('C5', 'Tanggal Kejadian');
		$sheet->setCellValue('D5', 'Jenis Transaksi');
		$sheet->setCellValue('E5', 'Kronologi Kejadian');
		$sheet->setCellValue('F5', 'Jenis Resiko');
		$sheet->setCellValue('G5', 'Durasi Kejadian (dalam menit)');
		$sheet->setCellValue('H5', 'Tempat Kejadian');
		$sheet->setCellValue('I5', 'Faktor Penyebab Kejadian');
		$sheet->setCellValue('J5', 'Potensi Kerugian');
		$sheet->setCellValue('K5', 'Unit Kerja Penanggungjawab');
		$sheet->setCellValue('L5', 'Tanggal Penyelesaian');
		$sheet->setCellValue('M5', 'Jam dan Menit Penyelesaian');
		$sheet->setCellValue('N5', 'Deskripsi Penyelesaian');
		$sheet->setCellValue('O5', 'Nominal Potensi Kerugian');
		$sheet->setCellValue('P5', 'Pembebanan Kerugian');
		$sheet->setCellValue('Q5', 'Status Kejadian');
		$sheet->setCellValue('R5', 'Nama Penginput');
		$sheet->setCellValue('S5', 'Nama Approval');
		$sheet->getStyle('A5:S5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
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
			$sheet->setCellValue('C' . $rowx, $rowberkas->tgl_kejadian);
			$sheet->setCellValue('D' . $rowx, $rowberkas->jenis_transaksi);
			$sheet->setCellValue('E' . $rowx, $rowberkas->desk_ticket);
			$sheet->setCellValue('F' . $rowx, $rowberkas->nama_cat);
			$sheet->setCellValue('G' . $rowx, $rowberkas->durasi);
			$sheet->setCellValue('H' . $rowx, $rowberkas->tempat_kejadian);
			$sheet->setCellValue('I' . $rowx, $rowberkas->faktor_penyebab);
			$sheet->setCellValue('J' . $rowx, $rowberkas->potensi_kerugian);
			$sheet->setCellValue('K' . $rowx, $rowberkas->nama_div);
			$sheet->setCellValue('L' . $rowx, $rowberkas->finish_ticket);
			$sheet->setCellValue('M' . $rowx, $downtime);
			$sheet->setCellValue('N' . $rowx, $rowberkas->remark_ticket);
			$sheet->setCellValue('O' . $rowx, $rowberkas->nominal);
			$sheet->setCellValue('P' . $rowx, $rowberkas->pembebanan_kerugian);
			$sheet->setCellValue('Q' . $rowx, $priority);
			$sheet->setCellValue('R' . $rowx, $rowberkas->nama_user);
			$sheet->setCellValue('S' . $rowx, $rowberkas->pejabat_penyetuju);

			$rowx++;
		}

		$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(40);
		$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(30);
		$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(30);
		$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(35);
		$spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(30);
		$spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('R')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('S')->setWidth(20);
		$writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
		$filename = "ReportRequest_" . time() . "_Download";

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');
		ob_end_clean();
		$writer->save('php://output');
	}

	private function generatePdf($querydata)
	{


		// Buat objek Dompdf
		$options = new Options();
		$options->set('isHtml5ParserEnabled', true);
		$options->set('isPhpEnabled', true);
		$dompdf = new Dompdf($options);

		$html = $this->load->view('ts/view_pdf', ['data' => $querydata], true);

		// Load HTML ke dalam Dompdf
		$dompdf->loadHtml($html);

		// Render PDF (menggunakan format A4)
		$dompdf->setPaper('A4', 'landscape');
		$dompdf->render();

		// Simpan atau tampilkan file PDF
		$dompdf->stream('ReportRequest_' . time() . '_Download.pdf', array('Attachment' => 0));
	}

	public function cetak_laporan()
	{
		$dompdf = new Dompdf();

		// Memastikan user terotentikasi sebelum membuat laporan
		$this->m_security->tssec();

		// Mengambil data inputan dari form
		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_akhir = $this->input->post('tgl_akhir');
		$status = $this->input->post('status');
		$id_div = $this->input->post('id_div');
		$id_cat = $this->input->post('id_cat');

		// Menyiapkan data untuk dikirim ke view dan ke laporan PDF
		$data = [
			'title'      => 'LED | Report',
			'dataorg'    => $this->m_data->getdataorg(),
			'tgl_awal'   => $tgl_awal,
			'tgl_akhir'  => $tgl_akhir,
		];

		// Mengambil data dengan filter
		$data['ticket'] = $this->m_data->get_filtered_data($tgl_awal, $tgl_akhir, $status, $id_div, $id_cat);

		// Mengambil HTML dari view
		$html = $this->load->view('ts/view_pdf', $data, true);

		// Memuat HTML ke Dompdf
		$dompdf->load_html($html);
		$dompdf->set_paper('A4', 'landscape');

		// Set font size and type
		$dompdf->set_option('isHtml5ParserEnabled', true);
		$dompdf->set_option('isPhpEnabled', true);
		$dompdf->set_option('font-size', 12); // Set font size to 10pt

		// Melakukan rendering PDF
		$dompdf->render();

		// Menghasilkan dan menampilkan PDF
		$dompdf->stream('ReportRequest_' . time() . '_Download.pdf', array('Attachment' => false));
	}
}
