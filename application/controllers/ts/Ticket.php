<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ticket extends CI_Controller
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
			'title' 	    => 'Data Request Open',
			'dataorg'	    => $this->m_data->getdataorg(),

		];
		$data['ticket'] = $this->m_data->data_ticketopen()->result();
		$this->load->view('ts/ticket_open', $data);
	}

	public function proses()
	{
		$this->m_security->tssec();
		$data = [
			'title' 	    => 'Data Request Diproses',
			'dataorg'	    => $this->m_data->getdataorg(),

		];
		$data['ticket'] = $this->m_data->data_ticketproses()->result();
		$this->load->view('ts/ticket_proses', $data);
	}

	public function approve()
	{
		$this->m_security->tssec();
		$data = [
			'title' 	    => 'Data Approval',
			'dataorg'	    => $this->m_data->getdataorg(),

		];
		$data['ticket'] = $this->m_data->data_ticketproses()->result();
		$this->load->view('ts/ticket_approval', $data);
	}

	public function selesai()
	{
		$this->m_security->tssec();
		$data = [
			'title' 	    => 'Data Request Selesai',
			'dataorg'	    => $this->m_data->getdataorg(),

		];
		$data['ticket'] = $this->m_data->data_ticketselesai()->result();
		$this->load->view('ts/ticket_selesai', $data);
	}

	public function report()
	{
		$this->m_security->tssec();
		$data = [
			'title' 	    => 'Report LED',
			'dataorg'	    => $this->m_data->getdataorg(),

		];
		$data['ticket'] = $this->m_data->data_ticketreport()->result();
		$this->load->view('ts/report_ticket', $data);
	}

	public function execution()
	{
		$this->m_security->tssec();

		$config = array(
			array(
				'field' => 'id_user',
				'label' => 'Trobuleshoter',
				'rules' => 'required',
				'errors' => array(
					'required' => '%s tidak boleh kosong.',
				),
			),
			array(
				'field' => 'sts_ticket',
				'label' => 'Status Ticket',
				'rules' => 'required',
				'errors' => array(
					'required' => '%s tidak boleh kosong.',
				),
			)
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) {
			// Jika validasi gagal, tampilkan kembali form dengan pesan error
			$this->session->set_flashdata('message', 'Inputan anda tidak sesuai!');
			$this->session->set_flashdata('type', 'error');
			redirect('ts/ticket', 'refresh');
		} else {
			// Set zona waktu ke Asia/Jakarta
			date_default_timezone_set('Asia/Jakarta');
			$id         = $this->input->post('id_ticket');
			$noticket   = $this->input->post('no_ticket');
			$ket_notif = 'proses';
			$exetime    = date('Y-m-d H:i:s');
			$today 	= date('Y-m-d');
			$jam	= date('H:i:s');
			$ket_progress = "Request Anda telah ditangani";

			$ticket = array(
				'id_user' 					    => $this->input->post('id_user'),
				'sts_ticket' 					=> $this->input->post('sts_ticket'),
				'exe_time' 						=> $exetime,
			);

			$this->db->where('id_ticket', $id);
			$result = $this->db->update('tb_ticket', $ticket);
			if ($result) {
				$notif = array(
					'ket_notif' 		=> $ket_notif,
					'no_ticket' 		=> $noticket,
				);
				$this->db->insert('tb_notifemail_client', $notif);
				$this->db->insert('tb_notifwa_client', $notif);
				$this->db->insert('tb_notifwa_ts', $notif);
				//insert timeline progress
				$progress = array(
					'ket_progress' 		=> $ket_progress,
					'no_ticket' 		=> $noticket,
					'tgl_progress' 		=> $today,
					'jam_progress' 		=> $jam,
				);
				$this->db->insert('tb_progress', $progress);
				$this->session->set_flashdata('message', 'Request anda berhasil dieksekusi!');
				$this->session->set_flashdata('type', 'success');
			} else {
				$this->session->set_flashdata('message', 'Request anda gagal dieksekusi!');
				$this->session->set_flashdata('type', 'error');
			}
			redirect('ts/ticket/proses', 'refresh');
		}
	}

	public function ajax()
	{
		$this->m_security->tssec();
		$type = $this->input->get('type');
		if (empty($type)) {
			$this->session->set_flashdata('message', 'Akses tidak diizinkan');
			$this->session->set_flashdata('type', 'error');
			redirect('ts/ticket', 'refresh');
		} else {
			if ($type == 'detail') {
				$id_ticket = $this->input->post('ticket_id');
				$data['ticket'] = $this->m_data->dataticketopendetail($id_ticket)->row_array();
				$html = $this->load->view('ts/modals/mod_detailticket', $data);
				$reponse = [
					'html' => $html,
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash(),
					'success' => true
				];
			} elseif ($type == 'execution') {
				$id_ticket = $this->input->post('ticket_id');
				$data['ticket'] = $this->m_data->dataticketopen($id_ticket)->row_array();
				$html = $this->load->view('ts/modals/mod_exeticket', $data);
				$reponse = [
					'html' => $html,
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash(),
					'success' => true
				];
			} elseif ($type == 'priority') {
				$id_ticket = $this->input->post('ticket_id');
				$data['ticket'] = $this->m_data->dataticketopen($id_ticket)->row_array();
				$html = $this->load->view('ts/modals/mod_priorityticket', $data);
				$reponse = [
					'html' => $html,
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash(),
					'success' => true
				];
			} elseif ($type == 'finish') {
				$id_ticket = $this->input->post('ticket_id');
				$data['ticket'] = $this->m_data->dataticketopen($id_ticket)->row_array();
				$html = $this->load->view('ts/modals/mod_finishticket', $data);
				$reponse = [
					'html' => $html,
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash(),
					'success' => true
				];
			} elseif ($type == 'timeline') {
				$id_ticket = $this->input->post('ticket_id');
				$data['progress'] = $this->m_data->dataprogressticket($id_ticket)->result();
				$html = $this->load->view('ts/modals/mod_timelineticket', $data);
				$reponse = [
					'html' => $html,
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash(),
					'success' => true
				];
			} elseif ($type == 'approve') {
				$id_ticket = $this->input->post('ticket_id');
				$data['ticket'] = $this->m_data->dataticketopendetail($id_ticket)->row_array();
				$html = $this->load->view('ts/modals/mod_approve', $data);
				$reponse = [
					'html' => $html,
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash(),
					'success' => true
				];
			}
		}
	}

	public function priority()
	{
		$this->m_security->adminsec();
		$id_ticket = $this->input->post('id_ticket');
		$ticket = array(
			'priority_ticket' 						=> $this->input->post('priority_ticket'),
		);
		$this->db->where('id_ticket', $id_ticket);
		$result = $this->db->update('tb_ticket', $ticket);
		if ($result) {
			$this->session->set_flashdata('message', 'Aktivasi Lokasi berhasil diupdate!');
			$this->session->set_flashdata('type', 'success');
		} else {
			$this->session->set_flashdata('message', 'Data gagal disimpan!');
			$this->session->set_flashdata('type', 'error');
		}
		redirect('ts/ticket/proses', 'refresh');
	}

	public function finish()
	{
		$this->m_security->tssec();
		$waconfig 	=  $this->m_data->datawa();

		$config = array(
			array(
				'field' => 'id_user',
				'label' => 'PIC',
				'rules' => 'required',
				'errors' => array(
					'required' => '%s tidak boleh kosong.',
				),
			),
			array(
				'field' => 'sts_ticket',
				'label' => 'Status Request',
				'rules' => 'required',
				'errors' => array(
					'required' => '%s tidak boleh kosong.',
				),
			),
			array(
				'field' => 'remark_ticket',
				'label' => 'Catatan Penyelesaian',
				'rules' => 'required',
				'errors' => array(
					'required' => '%s tidak boleh kosong.',
				),
			),
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) {
			// Jika validasi gagal, tampilkan kembali form dengan pesan error
			$this->session->set_flashdata('message', 'Inputan anda tidak sesuai!');
			$this->session->set_flashdata('type', 'error');
			redirect('ts/ticket/selesai', 'refresh');
		} else {
			// Set zona waktu ke Asia/Jakarta
			date_default_timezone_set('Asia/Jakarta');
			$id         = $this->input->post('id_ticket');
			$noticket   = $this->input->post('no_ticket');
			$remark     = $this->input->post('remark_ticket');
			$nominal_fix     = $this->input->post('nominal_fix');
			$pembebanan_kerugian     = $this->input->post('pembebanan_kerugian');
			// $pejabat_penyetuju     = $this->input->post('pejabat_penyetuju');
			$ket_notif  = 'finish';
			$finishdate = date('Y-m-d');
			$finishtime = date('H:i:s');
			$ket_progress = 'Request anda telah diselesaikan. Catatan Unit Kerja Penanggung Jawab: ' . $remark . '';

			$approval_level = 0;
			$ticket = array(
				'id_user' 				=> $this->input->post('id_user'),
				'sts_ticket' 			=> $this->input->post('sts_ticket'),
				'finish_ticket' 		=> $finishdate,
				'end_time' 				=> $finishtime,
				'remark_ticket'         => $remark,
				'nominal_fix'           => $nominal_fix,
				'pembebanan_kerugian'	=> $pembebanan_kerugian,
				// 'pejabat_penyetuju'     => $pejabat_penyetuju,
				'approval_level'       	=> $approval_level,
			);

			$this->db->where('id_ticket', $id);
			$result = $this->db->update('tb_ticket', $ticket);
			if ($result) {
				$notif = array(
					'ket_notif' 		=> $ket_notif,
					'no_ticket' 		=> $noticket,
				);
				$this->db->insert('tb_notifemail_client', $notif);
				$this->db->insert('tb_notifemail_ts', $notif);
				$this->db->insert('tb_notifwa_client', $notif);
				$this->db->insert('tb_notifwa_ts', $notif);
				//insert timeline progress
				$progress = array(
					'ket_progress' 		=> $ket_progress,
					'no_ticket' 		=> $noticket,
					'tgl_progress' 		=> $finishdate,
					'jam_progress' 		=> $finishtime,
				);
				$this->db->insert('tb_progress', $progress);
				$this->session->set_flashdata('message', 'Request anda berhasil diselesaikan! Menunggu Approval');
				$this->session->set_flashdata('type', 'success');
			} else {
				$this->session->set_flashdata('message', 'Request anda gagal dieksekusi!');
				$this->session->set_flashdata('type', 'error');
			}
			redirect('ts/ticket/selesai', 'refresh');
		}
	}

	public function finish_approve()
	{
		$this->m_security->tssec();
		$waconfig 	=  $this->m_data->datawa();

		$config = array(
			array(
				'field' => 'approval_level',
				'label' => 'Status Approval',
				'rules' => 'required',
				'errors' => array(
					'required' => '%s tidak boleh kosong.',
				),
			),
			array(
				'field' => 'pejabat_penyetuju',
				'label' => 'Pejabat Penyetuju',
				'rules' => 'required',
				'errors' => array(
					'required' => '%s tidak boleh kosong.',
				),
			),
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) {
			// Jika validasi gagal, tampilkan kembali form dengan pesan error
			$this->session->set_flashdata('message', 'Inputan anda tidak sesuai!');
			$this->session->set_flashdata('type', 'error');
			redirect('ts/ticket/approve', 'refresh');
		} else {
			// Set zona waktu ke Asia/Jakarta
			date_default_timezone_set('Asia/Jakarta');
			$id         		= $this->input->post('id_ticket');
			$pejabat_penyetuju  = $this->input->post('pejabat_penyetuju');
			$approval_level   	= $this->input->post('approval_level');
			$tglapprove = date('Y-m-d');
			$ticket = array(
				'pejabat_penyetuju' 	=> $pejabat_penyetuju,
				'approval_level'       	=> $approval_level,
				'tgl_approve'       	=> $tglapprove,
			);

			$this->db->where('id_ticket', $id);
			$this->db->update('tb_ticket', $ticket);
			$this->session->set_flashdata('message', 'Berhasil Di Approve!');
			$this->session->set_flashdata('type', 'success');

			redirect('ts/ticket/approve', 'refresh');
		}
	}

	public function dataselesai()
	{
		$this->m_security->tssec();
		// POST data
		$div = $this->session->userdata('id_div');
		$loc = $this->session->userdata('id_loc');
		$postData = $this->input->post();

		// Get data
		$data = $this->m_data->tb_ticket($postData, $div);

		echo json_encode($data);
	}

	public function addtimeline()
	{
		$this->m_security->tssec();
		$waconfig 	=  $this->m_data->datawa();

		$config = array(
			array(
				'field' => 'ket_progress',
				'label' => 'PIC',
				'rules' => 'required|trim',
				'errors' => array(
					'required' => '%s tidak boleh kosong.',
				),
			)
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) {
			// Jika validasi gagal, tampilkan kembali form dengan pesan error
			$this->session->set_flashdata('message', 'Inputan anda tidak sesuai!');
			$this->session->set_flashdata('type', 'error');
			redirect('ts/ticket/proses', 'refresh');
		} else {
			// Set zona waktu ke Asia/Jakarta
			date_default_timezone_set('Asia/Jakarta');
			$today 	= date('Y-m-d');
			$jam	= date('H:i:s');

			$progress = array(
				'ket_progress' 		=> $this->input->post('ket_progress'),
				'no_ticket' 		=> $this->input->post('no_ticket'),
				'target_date_progres' => $this->input->post('target_date_progres'),
				'tgl_progress' 		=> $today,
				'jam_progress' 		=> $jam,
				// tambahan field
			);
			$result = $this->db->insert('tb_progress', $progress);

			if ($result) {
				$this->session->set_flashdata('message', 'Progress berhasil di update!');
				$this->session->set_flashdata('type', 'success');
			} else {
				$this->session->set_flashdata('message', 'Progress gagal diupdate!');
				$this->session->set_flashdata('type', 'error');
			}
			redirect('ts/ticket/proses', 'refresh');
		}
	}

	public function not_approve()
	{
		$this->m_security->tssec();
		$waconfig = $this->m_data->datawa();

		// Konfigurasi validasi
		$config = array(
			array(
				'field' => 'sts_ticket',
				'label' => 'Status Approval',
				'rules' => 'required',
				'errors' => array(
					'required' => '%s tidak boleh kosong.',
				),
			),
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) {
			// Jika validasi gagal, tampilkan kembali form dengan pesan error
			$this->session->set_flashdata('message', 'Inputan anda tidak sesuai!');
			$this->session->set_flashdata('type', 'error');
			redirect('ts/ticket/approve', 'refresh');
		} else {
			// Set zona waktu ke Asia/Jakarta
			date_default_timezone_set('Asia/Jakarta');
			$id         		= $this->input->post('id_ticket');
			$sts_ticket  		= $this->input->post('sts_ticket');

			$ticket = array(
				'sts_ticket' => $sts_ticket,
			);

			$this->db->where('id_ticket', $id);
			$this->db->update('tb_ticket', $ticket);
			$this->session->set_flashdata('message', 'Anda Tidak Menyetujui Penanganan!, Permasalahan dikembalikan ke unit penanggung jawab');
			$this->session->set_flashdata('type', 'warning');
			redirect('ts/ticket/approve', 'refresh');
		}
	}
}
