<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Klien extends CI_Controller
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
		$this->m_security->adminsec();
		$data = [
			'title' 	    => 'Data Klien',
			'dataorg'	    => $this->m_data->getdataorg(),
			'tb_department' => $this->m_data->getdepartment(),
			'tb_location'   => $this->m_data->getlocation2(),

		];
		$data['klien'] = $this->m_data->data_klien()->result();
		$this->load->view('ts/klien', $data);
	}

	public function add()
	{
		$this->m_security->adminsec();
		$web 	  	    = base_url();
		$waconfig 	    =  $this->m_data->datawa();
		$emailconfig 	=  $this->m_data->dataemail();

		$config = array(
			array(
				'field' => 'nama_client',
				'label' => 'Nama Klien',
				'rules' => 'required|xss_clean|trim',
				'errors' => array(
					'required' => '%s tidak boleh kosong.',
				),
			),
			array(
				'field' => 'tlp_client',
				'label' => 'Telepon Klien',
				'rules' => 'required|xss_clean|trim|numeric',
				'errors' => array(
					'required' => '%s tidak boleh kosong.',
				),
			),
			array(
				'field' => 'email_client',
				'label' => 'Email Klien',
				'rules' => 'required|xss_clean|trim|valid_email',
				'errors' => array(
					'required' => '%s tidak boleh kosong.',
				),
			),
			array(
				'field' => 'username_client',
				'label' => 'Username Klien',
				'rules' => 'required|xss_clean|trim|strtolower|is_unique[tb_client.username_client]',
				'errors' => array(
					'required' => '%s tidak boleh kosong.',
				),
			),
			array(
				'field' => 'pass_client',
				'label' => 'Password Klien',
				'rules' => 'required|xss_clean|trim|min_length[3]',
				'errors' => array(
					'required' => '%s tidak boleh kosong.',
				),
			),
			array(
				'field' => 'cpass_client',
				'label' => 'Konfirmasi Password Klien',
				'rules' => 'required|xss_clean|trim|min_length[3]|matches[pass_client]',
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
			redirect('ts/klien', 'refresh');
		} else {
			$client = array(
				'nama_client' 					=> $this->input->post('nama_client'),
				'id_dept' 						=> $this->input->post('id_dept'),
				'id_loc' 						=> $this->input->post('id_loc'),
				'email_client' 					=> $this->input->post('email_client'),
				'username_client' 				=> $this->input->post('username_client'),
				'pass_client' 					=> md5($this->input->post('pass_client')),
				'tlp_client' 					=> $this->input->post('tlp_client'),
			);
			$result = $this->db->insert('tb_client', $client);
			if ($result) {
				$nama       = $this->input->post('nama_client');
				$user       = $this->session->userdata('id_user');
				$cat        = "tb_client";
				$desk       = "Menambakan client baru dengan nama " . $nama . ".";
				$username   = $this->input->post('username_client');
				$pass       = $this->input->post('pass_client');

				$log = array(
					'id_user' 				=> $user,
					'cat_log'               => $cat,
					'desk_log'              => $desk
				);
				$finishlog = $this->db->insert('log_activity', $log);
				if ($finishlog) {
					if ($waconfig->sts_wa == 1) {
						//whatsapp
						$token = $waconfig->token_wa;
						$phone = $this->input->post('tlp_client'); //untuk group pakai groupid contoh: 62812xxxxxx-xxxxx
						$message = "Halo Bapak/Ibu *" . $nama . "*,

Berikut adalah login detail anda pada Sistem SIMARKO
(Sistem Informasi Manajemen Resiko) :

Username: *" . $username . "*
Password: *" . $pass . "*

Anda dapat melakukan login di link ini
_" . $web . "_

Terima kasih.
IT KCD";

						$curl = curl_init();

						curl_setopt_array($curl, array(
							CURLOPT_URL => 'https://api.fonnte.com/send',
							CURLOPT_RETURNTRANSFER => true,
							CURLOPT_ENCODING => '',
							CURLOPT_MAXREDIRS => 10,
							CURLOPT_TIMEOUT => 0,
							CURLOPT_FOLLOWLOCATION => true,
							CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							CURLOPT_CUSTOMREQUEST => 'POST',
							CURLOPT_POSTFIELDS => array(
								'target' => $phone,
								'message' => $message,
								'countryCode' => '62', //optional
							),
							CURLOPT_HTTPHEADER => array(
								'Authorization: ' . $token . '' //change TOKEN to your actual token
							),
						));

						$response = curl_exec($curl);

						curl_close($curl);

						$this->session->set_flashdata('message', 'Data berhasil disimpan!');
						$this->session->set_flashdata('type', 'success');
					} else {
						$this->session->set_flashdata('message', 'Data berhasil disimpan, tapi gagal mengirim whatsapp');
						$this->session->set_flashdata('type', 'warning');
					}
				} else {
					$this->session->set_flashdata('message', 'Data berhasil disimpan, tapi gagal log activity!');
					$this->session->set_flashdata('type', 'warning');
				}
			} else {
				$this->session->set_flashdata('message', 'Data gagal disimpan!');
				$this->session->set_flashdata('type', 'error');
			}
			redirect('ts/klien', 'refresh');
		}
	}

	public function ajax()
	{
		$this->m_security->adminsec();
		$type = $this->input->get('type');
		if (empty($type)) {
			$this->session->set_flashdata('message', 'Akses tidak diizinkan');
			$this->session->set_flashdata('type', 'error');
			redirect('ts/klien', 'refresh');
		} else {
			if ($type == 'nonactive') {
				$id_client = $this->input->post('klien_id');
				$data['client'] = $this->m_data->dataklien($id_client)->row_array();
				$html = $this->load->view('ts/modals/mod_nonactiveklien', $data);
				$reponse = [
					'html' => $html,
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash(),
					'success' => true
				];
			} elseif ($type == 'editklien') {
				$id_client = $this->input->post('klien_id');
				$data = [
					'tb_department' => $this->m_data->getdepartment(),
					'tb_location'   => $this->m_data->getlocation(),
					'client'        => $this->m_data->dataklien($id_client)->row_array()
				];
				$html = $this->load->view('ts/modals/mod_editklien', $data);
				$reponse = [
					'html' => $html,
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash(),
					'success' => true
				];
			} elseif ($type == 'deleteklien') {
				$id_client = $this->input->post('klien_id');
				$data['client'] = $this->m_data->dataklien($id_client)->row_array();
				$html = $this->load->view('ts/modals/mod_deleteklien', $data);
				$reponse = [
					'html' => $html,
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash(),
					'success' => true
				];
			} elseif ($type == 'resetklien') {
				$id_client = $this->input->post('klien_id');
				$data['client'] = $this->m_data->dataklien($id_client)->row_array();
				$html = $this->load->view('ts/modals/mod_resetklien', $data);
				$reponse = [
					'html' => $html,
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash(),
					'success' => true
				];
			}
		}
	}

	public function activation()
	{
		$this->m_security->adminsec();
		$id_client = $this->input->post('id_client');
		$client = array(
			'sts_client' 						=> $this->input->post('sts_client'),
		);
		$this->db->where('id_client', $id_client);
		$result = $this->db->update('tb_client', $client);
		if ($result) {
			$this->session->set_flashdata('message', 'Aktivasi Lokasi berhasil diupdate!');
			$this->session->set_flashdata('type', 'success');
		} else {
			$this->session->set_flashdata('message', 'Data gagal disimpan!');
			$this->session->set_flashdata('type', 'error');
		}
		redirect('ts/klien', 'refresh');
	}

	public function edit()
	{
		$this->m_security->adminsec();
		$config = array(
			array(
				'field' => 'nama_client',
				'label' => 'Nama Klien',
				'rules' => 'required|xss_clean|trim',
				'errors' => array(
					'required' => '%s tidak boleh kosong.',
				),
			),
			array(
				'field' => 'tlp_client',
				'label' => 'Telepon Klien',
				'rules' => 'required|xss_clean|trim|numeric',
				'errors' => array(
					'required' => '%s tidak boleh kosong.',
				),
			),
			array(
				'field' => 'email_client',
				'label' => 'Email Klien',
				'rules' => 'required|xss_clean|trim|valid_email',
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
			redirect('ts/klien', 'refresh');
		} else {
			$id_client = $this->input->post('id_client');
			$client = array(
				'nama_client' 					=> $this->input->post('nama_client'),
				'id_dept' 						=> $this->input->post('id_dept'),
				'id_loc' 						=> $this->input->post('id_loc'),
				'email_client' 					=> $this->input->post('email_client'),
				'tlp_client' 					=> $this->input->post('tlp_client'),
			);
			$id_client = $this->input->post('id_client');
			$this->db->where('id_client', $id_client);
			$result = $this->db->update('tb_client', $client);
			if ($result) {
				$nama       = $this->input->post('nama_client');
				$user       = $this->session->userdata('id_user');
				$cat        = "tb_client";
				$desk       = "Merubah Klien dengan nama " . $nama . ".";

				$log = array(
					'id_user' 				=> $user,
					'cat_log'               => $cat,
					'desk_log'              => $desk
				);
				$this->db->insert('log_activity', $log);

				$this->session->set_flashdata('message', 'Data berhasil disimpan!');
				$this->session->set_flashdata('type', 'success');
			} else {
				$this->session->set_flashdata('message', 'Data gagal disimpan!');
				$this->session->set_flashdata('type', 'error');
			}
			redirect('ts/klien', 'refresh');
		}
	}

	public function reset()
	{
		$this->m_security->adminsec();
		$web 	  	= base_url();
		$waconfig 	=  $this->m_data->datawa();
		$config = array(
			array(
				'field' => 'pass_client',
				'label' => 'Password Klien',
				'rules' => 'required|xss_clean|trim|min_length[3]',
				'errors' => array(
					'required' => '%s tidak boleh kosong.',
				),
			),
			array(
				'field' => 'cpass_client',
				'label' => 'Konfirmasi Password Pengguna',
				'rules' => 'required|xss_clean|trim|min_length[3]|matches[pass_client]',
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
			redirect('ts/klien', 'refresh');
		} else {
			$id_client = $this->input->post('id_client');
			$client = array(
				'pass_client' 					=> md5($this->input->post('pass_client'))
			);
			$this->db->where('id_client', $id_client);
			$result = $this->db->update('tb_client', $client);
			if ($result) {
				$nama    = $this->input->post('nama_client');
				$user    = $this->session->userdata('id_user');
				$cat     = "tb_client";
				$desk    = "Mereset password Klien atas nama " . $nama . ".";
				$username   = $this->input->post('username_client');
				$pass       = $this->input->post('pass_client');

				$log = array(
					'id_user' 				=> $user,
					'cat_log'               => $cat,
					'desk_log'              => $desk
				);
				$finishlog = $this->db->insert('log_activity', $log);
				if ($finishlog) {
					if ($waconfig->sts_wa == 1) {
						//whatsapp
						$token = $waconfig->token_wa;
						$phone = $this->input->post('tlp_client'); //untuk group pakai groupid contoh: 62812xxxxxx-xxxxx
						$message = "Halo Bapak/Ibu *" . $nama . "*,
Kami telah melakukan reset password pada akun anda.
Berikut adalah login detail anda pada Sistem SIMARKO
(Sistem Informasi Manajemen Resiko) :

Username: *" . $username . "*
Password: *" . $pass . "*

Anda dapat melakukan login di link ini
_" . $web . "_

Terima kasih.
IT KCD";

						$curl = curl_init();

						curl_setopt_array($curl, array(
							CURLOPT_URL => 'https://api.fonnte.com/send',
							CURLOPT_RETURNTRANSFER => true,
							CURLOPT_ENCODING => '',
							CURLOPT_MAXREDIRS => 10,
							CURLOPT_TIMEOUT => 0,
							CURLOPT_FOLLOWLOCATION => true,
							CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							CURLOPT_CUSTOMREQUEST => 'POST',
							CURLOPT_POSTFIELDS => array(
								'target' => $phone,
								'message' => $message,
								'countryCode' => '62', //optional
							),
							CURLOPT_HTTPHEADER => array(
								'Authorization: ' . $token . '' //change TOKEN to your actual token
							),
						));

						$response = curl_exec($curl);

						curl_close($curl);

						$this->session->set_flashdata('message', 'Data berhasil disimpan!');
						$this->session->set_flashdata('type', 'success');
					} else {
						$this->session->set_flashdata('message', 'Data berhasil disimpan, tapi gagal mengirim whatsapp');
						$this->session->set_flashdata('type', 'warning');
					}
				} else {
					$this->session->set_flashdata('message', 'Data berhasil disimpan, tapi gagal mencatat log dan mengirim WA');
					$this->session->set_flashdata('type', 'warning');
				}
			} else {
				$this->session->set_flashdata('message', 'Data gagal disimpan!');
				$this->session->set_flashdata('type', 'error');
			}
			redirect('ts/klien', 'refresh');
		}
	}
}
