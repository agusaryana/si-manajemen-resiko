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
		$this->m_security->clientsec();
		$data = [
			'title' 	    => 'Data History Request',
			'dataorg'	    => $this->m_data->getdataorg(),

		];
		$this->load->view('client/historyticket', $data);
	}

	public function create()
	{
		$this->m_security->clientsec();
		$data = [
			'title' => 'Create Request',
			'dataorg' => $this->m_data->getdataorg(),
			'tb_division' => $this->m_data->getdivision2(),
			'tb_category' => $this->m_data->getcategory(),
			'tb_location' => $this->m_data->getlocation(),
		];
		$this->load->view('client/createticket', $data);
	}

	public function deleteTicket()
	{
		$id_ticket = $this->input->post('delete_ticket');

		if (!empty($id_ticket)) {
			$this->m_data->deleteTicket($id_ticket);
			$this->session->set_flashdata('message', 'Data Berhasil Dihapus!');
			$this->session->set_flashdata('type', 'success');
			// echo "Request dengan ID $id_ticket berhasil dihapus.";
		} else {
			echo "ID tiket tidak valid.";
		}
		redirect('client/ticket', 'refresh');
	}

	// public function add_ajax_cat($id_div)
	// {
	// 	$query = $this->db->get_where('tb_category', array('id_div' => $id_div));
	// 	$data = "<option value=''>- Pilih Kategori -</option>";
	// 	foreach ($query->result() as $value) {
	// 		$data .= "<option value='" . $value->id_cat . "'>" . $value->nama_cat . "</option>";
	// 	}
	// 	echo $data;
	// }
	public function add()
	{
		//VALIDASI
		$this->m_security->clientsec();
		$configtext = array(
			array(
				'field' => 'desk_ticket',
				'label' => 'Deskripsi Request',
				'rules' => 'required|xss_clean|trim',
				'errors' => array(
					'required' => '%s tidak boleh kosong.',
				),
			)
		);
		$this->form_validation->set_rules($configtext);
		if ($this->form_validation->run() == FALSE) {
			// Jika validasi gagal, tampilkan kembali form dengan pesan error
			$this->session->set_flashdata('message', 'Input tidak sesuai!');
			$this->session->set_flashdata('type', 'error');
			redirect('ticketguest');
		} else {
			// Set zona waktu ke Asia/Jakarta
			date_default_timezone_set('Asia/Jakarta');
			$today 	= date('Y-m-d');
			$jam	= date('H:i:s');
			$idloc = $this->input->post('id_loc');
			$iddiv = $this->input->post('id_div');
			$idcat = $this->input->post('id_cat');
			$bulan = date('n');
			$ket_notif = "open";
			$ket_progress = "Request dibuat oleh Inputer";

			/** GENERATE NOMOR TICKET */
			$this->db->select('RIGHT(tb_ticket.no_ticket,3) as tic_no', FALSE);
			$this->db->order_by('tic_no', 'DESC');
			$this->db->limit(1);
			$query = $this->db->get('tb_ticket');
			if ($query->num_rows() <> 0) {
				$data = $query->row();
				$kode = intval($data->tic_no) + 1;
			} else {
				$kode = 1;
			}
			$batas = str_pad($kode, 3, "0", STR_PAD_LEFT);
			$noticket = "KCD" . $bulan . "" . $idloc . "" . $iddiv . "" . $idcat . "" . $batas;

			// Mengunggah lampiran
			$config['upload_path'] = 'asset/lampiran/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size'] = 500;
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('lampiran_ticket')) {
				// File lampiran berhasil diunggah
				$upload_lampiran = $this->upload->data();
				$new_name = $upload_lampiran['file_name'];
				// Memperbarui entri di database
				$ticket = array(
					'nama_ticket' 			=> $this->input->post('nama_ticket'),
					'no_ticket' 			=> $noticket,
					'id_div' 				=> $this->input->post('id_div'),
					'id_loc' 				=> $this->input->post('id_loc'),
					'id_dept' 				=> $this->input->post('id_dept'),
					'id_client' 			=> $this->input->post('id_client'),
					'id_cat' 				=> $this->input->post('id_cat'),
					'email_ticket' 			=> $this->input->post('email_ticket'),
					'tlp_ticket' 			=> $this->input->post('tlp_ticket'),
					'desk_ticket' 			=> $this->input->post('desk_ticket'),
					'jenis_transaksi' 		=> $this->input->post('jenis_transaksi'),
					'inputTambahan' 		=> $this->input->post('inputTambahan'),
					'tempat_kejadian' 		=> $this->input->post('tempat_kejadian'),
					'faktor_penyebab' 		=> $this->input->post('faktor_penyebab'),
					'faktor_penyebab_lain' 	=> $this->input->post('faktor_penyebab_lain'),
					'potensi_kerugian' 		=> $this->input->post('potensi_kerugian'),
					'nominal_perkiraan' 	=> $this->input->post('nominal_perkiraan'),
					'tgl_kejadian' 			=> $this->input->post('tgl_kejadian'),
					'nama_karyawan' 		=> $this->input->post('nama_karyawan'),
					'jam_mulai' 			=> $this->input->post('jam_mulai'),
					'jam_selesai' 			=> $this->input->post('jam_selesai'),
					'durasi' 				=> $this->input->post('durasi'),
					// 'pejabat_penyetuju' 	=> $this->input->post('pejabat_penyetuju'),
					// 'pembebanan_kerugian' 	=> $this->input->post('pembebanan_kerugian'),
					// 'target_date'			=> $this->input->post('target_date'),
					'lampiran_ticket' 		=> $new_name,
					'create_ticket'			=> $today,
					'start_time'			=> $jam,
				);
				$result = $this->db->insert('tb_ticket', $ticket);
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
					redirect('client/ticket');
				} else {
					$this->session->set_flashdata('message', 'Request gagal dibuat!');
					$this->session->set_flashdata('type', 'error');
					redirect('client/ticket');
				}
			} else {
				// Menampilkan pesan kesalahan jika unggahan gagal
				$ticket = array(
					'nama_ticket' 			=> $this->input->post('nama_ticket'),
					'no_ticket' 			=> $noticket,
					'id_div' 				=> $this->input->post('id_div'),
					'id_loc' 				=> $this->input->post('id_loc'),
					'id_dept' 				=> $this->input->post('id_dept'),
					'id_cat' 				=> $this->input->post('id_cat'),
					'id_client' 			=> $this->input->post('id_client'),
					'email_ticket' 			=> $this->input->post('email_ticket'),
					'tlp_ticket' 			=> $this->input->post('tlp_ticket'),
					'desk_ticket' 			=> $this->input->post('desk_ticket'),
					'jenis_transaksi' 		=> $this->input->post('jenis_transaksi'),
					'inputTambahan' 		=> $this->input->post('inputTambahan'),
					'tempat_kejadian' 		=> $this->input->post('tempat_kejadian'),
					'faktor_penyebab' 		=> $this->input->post('faktor_penyebab'),
					'faktor_penyebab_lain' 	=> $this->input->post('faktor_penyebab_lain'),
					'potensi_kerugian' 		=> $this->input->post('potensi_kerugian'),
					'nominal_perkiraan' 	=> $this->input->post('nominal_perkiraan'),
					'tgl_kejadian' 			=> $this->input->post('tgl_kejadian'),
					'nama_karyawan' 		=> $this->input->post('nama_karyawan'),
					'jam_mulai' 			=> $this->input->post('jam_mulai'),
					'jam_selesai' 			=> $this->input->post('jam_selesai'),
					'durasi' 				=> $this->input->post('durasi'),
					'pejabat_penyetuju' 	=> $this->input->post('pejabat_penyetuju'),
					'pembebanan_kerugian' 	=> $this->input->post('pembebanan_kerugian'),
					'target_date' 			=> $this->input->post('target_date'),
					'create_ticket'			=> $today,
					'start_time'			=> $jam,
				);
				$result = $this->db->insert('tb_ticket', $ticket);
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
					redirect('client/ticket');
				} else {
					$this->session->set_flashdata('message', 'Ticket gagal dibuat!');
					$this->session->set_flashdata('type', 'error');
					redirect('client/ticket');
				}
			}
		}
	}

	public function ajax()
	{
		$this->m_security->clientsec();
		$type = $this->input->get('type');
		if (empty($type)) {
			$this->session->set_flashdata('message', 'Akses tidak diizinkan');
			$this->session->set_flashdata('type', 'error');
			redirect('client/ticket', 'refresh');
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
			} elseif ($type == 'timeline') {
				$id_ticket = $this->input->post('ticket_id');
				$data['progress'] = $this->m_data->dataprogressticket($id_ticket)->result();
				$html = $this->load->view('client/mod_timeline', $data);
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
			} elseif ($type == 'delete') {
				$id_ticket = $this->input->post('ticket_id');
				$data['ticket'] = $this->m_data->dataticketopen($id_ticket)->row_array();
				$html = $this->load->view('ts/modals/mod_deleteticket', $data);
				$reponse = [
					'html' => $html,
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash(),
					'success' => true
				];
			}
		}
	}

	public function dataticket()
	{
		$this->m_security->clientsec();
		// POST data
		$client    = $this->session->userdata('id_client');
		$postData = $this->input->post();

		// Get data
		$data = $this->m_data->tb_ticketclient($postData, $client);

		echo json_encode($data);

		// $data = [
		// 	'title' 	    => 'Data Request Diproses',
		// 	'dataorg'	    => $this->m_data->getdataorg(),

		// ];
		// $data['ticket'] = $this->m_data->tb_ticketclient()->result();
		// $this->load->view('client/historyticket', $data);
	}
}
