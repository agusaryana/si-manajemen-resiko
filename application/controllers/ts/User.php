<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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
			'title' 	    => 'Data Pengguna',
			'dataorg'	    => $this->m_data->getdataorg(),
			'tb_akses'      => $this->m_data->getakses(),
			'tb_division'   => $this->m_data->getdivision(),
			'tb_location'   => $this->m_data->getlocation(),

		];
		$data['user'] = $this->m_data->data_user()->result();
		$this->load->view('ts/user', $data);
	}

	public function add()
	{
		$this->m_security->adminsec();
		$web 	  	= base_url('troubleshoot');
		$waconfig 	=  $this->m_data->datawa();

		$config = array(
			array(
				'field' => 'nama_user',
				'label' => 'Nama Pengguna',
				'rules' => 'required|xss_clean|trim',
				'errors' => array(
					'required' => '%s tidak boleh kosong.',
				),
			),
			array(
				'field' => 'tlp_user',
				'label' => 'Telepon Pengguna',
				'rules' => 'required|xss_clean|trim|numeric',
				'errors' => array(
					'required' => '%s tidak boleh kosong.',
				),
			),
			array(
				'field' => 'username_user',
				'label' => 'Username Pengguna',
				'rules' => 'required|xss_clean|trim|strtolower|is_unique[tb_user.username_user]',
				'errors' => array(
					'required' => '%s tidak boleh kosong.',
				),
			),
			array(
				'field' => 'pass_user',
				'label' => 'Password Pengguna',
				'rules' => 'required|xss_clean|trim|min_length[3]',
				'errors' => array(
					'required' => '%s tidak boleh kosong.',
				),
			),
			array(
				'field' => 'cpass_user',
				'label' => 'Konfirmasi Password Pengguna',
				'rules' => 'required|xss_clean|trim|min_length[3]|matches[pass_user]',
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
			redirect('ts/user', 'refresh');
		} else {
			$user = array(
				'nama_user' 					=> $this->input->post('nama_user'),
				'id_div' 						=> $this->input->post('id_div'),
				'id_loc' 						=> $this->input->post('id_loc'),
				'id_akses' 						=> $this->input->post('id_akses'),
				'username_user' 				=> $this->input->post('username_user'),
				'pass_user' 					=> md5($this->input->post('pass_user')),
				'tlp_user' 						=> $this->input->post('tlp_user'),
			);
			$result = $this->db->insert('tb_user', $user);
			if ($result) {
				$nama       = $this->input->post('nama_user');
				$user       = $this->session->userdata('id_user');
				$cat        = "tb_user";
				$desk       = "Menambakan pengguna baru dengan nama " . $nama . ".";
				$username   = $this->input->post('username_user');
				$pass       = $this->input->post('pass_user');

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
						$phone = $this->input->post('tlp_user'); //untuk group pakai groupid contoh: 62812xxxxxx-xxxxx
						$message = "Halo Bapak/Ibu *" . $nama . "*,

Berikut adalah login detail anda pada Sistem | LED
(Lost Event Database) :

Username: *" . $username . "*
Password: *" . $pass . "*

Anda dapat melakukan login dengan klik link ini :
_" . $web . "_

Terima kasih.

Support by :
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
			redirect('ts/user', 'refresh');
		}
	}

	public function ajax()
	{
		$this->m_security->adminsec();
		$type = $this->input->get('type');
		if (empty($type)) {
			$this->session->set_flashdata('message', 'Akses tidak diizinkan');
			$this->session->set_flashdata('type', 'error');
			redirect('ts/user', 'refresh');
		} else {
			if ($type == 'nonactive') {
				$id_user = $this->input->post('user_id');
				$data['user'] = $this->m_data->datauser($id_user)->row_array();
				$html = $this->load->view('ts/modals/mod_nonactiveuser', $data);
				$reponse = [
					'html' => $html,
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash(),
					'success' => true
				];
			} elseif ($type == 'edituser') {
				$id_user = $this->input->post('user_id');
				$data = [
					'tb_akses'      => $this->m_data->getakses(),
					'tb_division'   => $this->m_data->getdivision(),
					'tb_location'   => $this->m_data->getlocation(),
					'user'          => $this->m_data->datauser($id_user)->row_array()
				];
				$html = $this->load->view('ts/modals/mod_edituser', $data);
				$reponse = [
					'html' => $html,
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash(),
					'success' => true
				];
			} elseif ($type == 'deleteuser') {
				$id_user = $this->input->post('user_id');
				$data['user'] = $this->m_data->datauser($id_user)->row_array();
				$html = $this->load->view('ts/modals/mod_deleteuser', $data);
				$reponse = [
					'html' => $html,
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash(),
					'success' => true
				];
			} elseif ($type == 'resetuser') {
				$id_user = $this->input->post('user_id');
				$data['user'] = $this->m_data->datauser($id_user)->row_array();
				$html = $this->load->view('ts/modals/mod_resetuser', $data);
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
		$id_user = $this->input->post('id_user');
		$user = array(
			'sts_user' => $this->input->post('sts_user'),
		);
		$this->db->where('id_user', $id_user);
		$result = $this->db->update('tb_user', $user);
		if ($result) {
			$this->session->set_flashdata('message', 'Aktivasi Lokasi berhasil diupdate!');
			$this->session->set_flashdata('type', 'success');
		} else {
			$this->session->set_flashdata('message', 'Data gagal disimpan!');
			$this->session->set_flashdata('type', 'error');
		}
		redirect('ts/user', 'refresh');
	}

	public function edit()
	{
		$this->m_security->adminsec();
		$config = array(
			array(
				'field' => 'nama_user',
				'label' => 'Nama Pengguna',
				'rules' => 'required|xss_clean|trim',
				'errors' => array(
					'required' => '%s tidak boleh kosong.',
				),
			),
			array(
				'field' => 'tlp_user',
				'label' => 'Telepon Pengguna',
				'rules' => 'required|xss_clean|trim|numeric',
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
			redirect('ts/user', 'refresh');
		} else {
			$user = array(
				'nama_user' 					=> $this->input->post('nama_user'),
				'id_div' 						=> $this->input->post('id_div'),
				'id_loc' 						=> $this->input->post('id_loc'),
				'id_akses' 						=> $this->input->post('id_akses'),
				'tlp_user' 						=> $this->input->post('tlp_user'),
			);
			$id_user = $this->input->post('id_user');
			$this->db->where('id_user', $id_user);
			$result = $this->db->update('tb_user', $user);
			if ($result) {
				$nama       = $this->input->post('nama_user');
				$user       = $this->session->userdata('id_user');
				$cat        = "tb_user";
				$desk       = "Merubah pengguna dengan nama " . $nama . ".";

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
			redirect('ts/user', 'refresh');
		}
	}

	public function reset()
	{
		$this->m_security->adminsec();
		$web 	  	= base_url('troubleshoot');
		$waconfig 	=  $this->m_data->datawa();
		$config = array(
			array(
				'field' => 'pass_user',
				'label' => 'Password Pengguna',
				'rules' => 'required|xss_clean|trim|min_length[3]',
				'errors' => array(
					'required' => '%s tidak boleh kosong.',
				),
			),
			array(
				'field' => 'cpass_user',
				'label' => 'Konfirmasi Password Pengguna',
				'rules' => 'required|xss_clean|trim|min_length[3]|matches[pass_user]',
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
			redirect('ts/user', 'refresh');
		} else {
			$id_user = $this->input->post('id_user');
			$user = array(
				'pass_user' => md5($this->input->post('pass_user'))
			);
			$this->db->where('id_user', $id_user);
			$result = $this->db->update('tb_user', $user);
			if ($result) {
				$nama    = $this->input->post('nama_user');
				$user    = $this->session->userdata('id_user');
				$cat     = "tb_user";
				$desk    = "Mereset password pengguna atas nama " . $nama . ".";
				$username   = $this->input->post('username_user');
				$pass       = $this->input->post('pass_user');

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
						$phone = $this->input->post('tlp_user'); //untuk group pakai groupid contoh: 62812xxxxxx-xxxxx
						$message = "Halo Bapak/Ibu *" . $nama . "*,
Kami telah melakukan reset password pada akun anda.
Berikut adalah login detail anda pada Sistem | LED 
(Lost Event Database) :

Username: *" . $username . "*
Password: *" . $pass . "*

Anda dapat melakukan login di link ini :
_" . $web . "_

Terima kasih.

Support by :
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
			redirect('ts/user', 'refresh');
		}
	}
}
