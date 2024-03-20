<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ticketguest extends CI_Controller
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
		$data = [
			'title' => 'Create Ticket as Guest',
			'dataorg' => $this->m_data->getdataorg(),
			'tb_division' => $this->m_data->getdivision2(),
			'tb_location' => $this->m_data->getlocation2(),
			'tb_department' => $this->m_data->getdepartment()
		];
		$this->load->view('ticketguest', $data);
	}

	public function success()
	{
		$data = [
			'title' => 'Create Ticket Success',
			'dataorg' => $this->m_data->getdataorg()
		];
		$this->load->view('ticketsuccess', $data);
	}

	public function add_ajax_cat($id_div)
	{
		$query = $this->db->get_where('tb_category', array('id_div' => $id_div));
		$data = "<option value=''>- Pilih Kategori -</option>";
		foreach ($query->result() as $value) {
			$data .= "<option value='" . $value->id_cat . "'>" . $value->nama_cat . "</option>";
		}
		echo $data;
	}

	public function adda()
	{
		$web = base_url();
		$waconfig = $this->m_data->datawa();
		$idloc = $this->input->post('id_loc');
		$iddiv = $this->input->post('id_div');
		$idcat = $this->input->post('id_cat');
		$bulan = date('n');
		$ket_ticket = "open";

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
		$noticket = "TICK" . $bulan . "" . $idloc . "" . $iddiv . "" . $idcat . "" . $batas;

		//VALIDASI
		$config = array(
			array(
				'field' => 'nama_ticket',
				'label' => 'Nama Lengkap',
				'rules' => 'required|xss_clean|trim',
				'errors' => array(
						'required' => '%s tidak boleh kosong.',
					),
			),
			array(
				'field' => 'tlp_ticket',
				'label' => 'Telepon Anda',
				'rules' => 'required|xss_clean|trim|numeric',
				'errors' => array(
						'required' => '%s tidak boleh kosong.',
						'numeric' => '%s hanya boleh angka.',
					),
			),
			array(
				'field' => 'email_ticket',
				'label' => 'Email Anda',
				'rules' => 'required|xss_clean|trim|valid_email',
				'errors' => array(
						'required' => '%s tidak boleh kosong.',
						'valid_email' => '%s tidak valid.',
					),
			),
			array(
				'field' => 'desk_ticket',
				'label' => 'Deskripsi Ticket',
				'rules' => 'required|xss_clean|trim',
				'errors' => array(
						'required' => '%s tidak boleh kosong.',
					),
			)
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) {
			// Jika validasi gagal, tampilkan kembali form dengan pesan error
			$this->session->set_flashdata('message', 'Input tidak sesuai!');
			$this->session->set_flashdata('type', 'error');
			redirect('ticketguest');
		} else {

			// Mengunggah lampiran
			$config['upload_path'] = 'asset/lampiran/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size'] = 500;
			$config['encrypt_name'] = TRUE;
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('lampiran_ticket')) {
				// File logo baru berhasil diunggah
				$upload_lampiran = $this->upload->data();
				$new_name = $upload_lampiran['file_name'];

				// Memperbarui entri di database
				$ticket = array(
					'nama_ticket' => $this->input->post('nama_ticket'),
					'no_ticket' => $noticket,
					'id_div' => $this->input->post('id_div'),
					'id_loc' => $this->input->post('id_loc'),
					'id_dept' => $this->input->post('id_dept'),
					'id_cat' => $this->input->post('id_cat'),
					'email_ticket' => $this->input->post('email_ticket'),
					'tlp_ticket' => $this->input->post('tlp_ticket'),
					'desk_ticket' => $this->input->post('desk_ticket'),
					'lampiran_ticket' => $new_name,
				);
				$result = $this->db->insert('tb_ticket', $ticket);
				if ($result) {

				} else {
					$this->session->set_flashdata('message', 'Ticket gagal dibuat!');
					$this->session->set_flashdata('type', 'error');
					redirect('ticketguest');
				}
			} else {
				// Menampilkan pesan kesalahan jika unggahan gagal
				$upload_error = $this->upload->display_errors();
				$this->session->set_flashdata('message', $upload_error);
				$this->session->set_flashdata('type', 'error');
				redirect('ticketguest');

			}
		}

	}

	public function add()
	{
		//VALIDASI
		$configtext = array(
			array(
				'field' => 'nama_ticket',
				'label' => 'Nama Lengkap',
				'rules' => 'required|xss_clean|trim',
				'errors' => array(
						'required' => '%s tidak boleh kosong.',
					),
			),
			array(
				'field' => 'tlp_ticket',
				'label' => 'Telepon Anda',
				'rules' => 'required|xss_clean|trim|numeric',
				'errors' => array(
						'required' => '%s tidak boleh kosong.',
						'numeric' => '%s hanya boleh angka.',
					),
			),
			array(
				'field' => 'email_ticket',
				'label' => 'Email Anda',
				'rules' => 'required|xss_clean|trim|valid_email',
				'errors' => array(
						'required' => '%s tidak boleh kosong.',
						'valid_email' => '%s tidak valid.',
					),
			),
			array(
				'field' => 'desk_ticket',
				'label' => 'Deskripsi Ticket',
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
			$idloc 	= $this->input->post('id_loc');
			$iddiv 	= $this->input->post('id_div');
			$idcat 	= $this->input->post('id_cat');
			$bulan 	= date('n');
			$ket_notif = "open";
			$ket_progress = "Ticket dibuat oleh Klien";

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
			$noticket = "TICK" . $bulan . "" . $idloc . "" . $iddiv . "" . $idcat . "" . $batas;

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
					'nama_ticket' 		=> $this->input->post('nama_ticket'),
					'no_ticket' 		=> $noticket,
					'id_div' 			=> $this->input->post('id_div'),
					'id_loc' 			=> $this->input->post('id_loc'),
					'id_dept' 			=> $this->input->post('id_dept'),
					'id_cat' 			=> $this->input->post('id_cat'),
					'email_ticket' 		=> $this->input->post('email_ticket'),
					'tlp_ticket' 		=> $this->input->post('tlp_ticket'),
					'desk_ticket' 		=> $this->input->post('desk_ticket'),
					'lampiran_ticket' 	=> $new_name,
					'create_ticket'		=> $today,
					'start_time'		=> $jam,
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
					redirect('ticketguest/success');
				} else {
					$this->session->set_flashdata('message', 'Ticket gagal dibuat!');
					$this->session->set_flashdata('type', 'error');
					redirect('ticketguest');
				}
			} else {
				// Menampilkan pesan kesalahan jika unggahan gagal
				$ticket = array(
					'nama_ticket' 		=> $this->input->post('nama_ticket'),
					'no_ticket' 		=> $noticket,
					'id_div' 			=> $this->input->post('id_div'),
					'id_loc' 			=> $this->input->post('id_loc'),
					'id_dept' 			=> $this->input->post('id_dept'),
					'id_cat' 			=> $this->input->post('id_cat'),
					'email_ticket' 		=> $this->input->post('email_ticket'),
					'tlp_ticket' 		=> $this->input->post('tlp_ticket'),
					'desk_ticket' 		=> $this->input->post('desk_ticket'),
					'create_ticket'		=> $today,
					'start_time'		=> $jam,
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

					redirect('ticketguest/success');
				} else {
					$this->session->set_flashdata('message', 'Ticket gagal dibuat!');
					$this->session->set_flashdata('type', 'error');
					redirect('ticketguest');
				}

			}
		}


	}
}