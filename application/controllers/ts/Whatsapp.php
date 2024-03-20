<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Whatsapp extends CI_Controller
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
			'title' 	=> 'Konfigurasi Whatsapp',
			'dataorg'	=> $this->m_data->getdataorg(),
			'datawa'	=> $this->m_data->getdatawa()
		];
		$this->load->view('ts/whatsapp', $data);
	}

	public function update()
	{
		$this->m_security->adminsec();
		$config = array(
			array(
				'field' => 'no_wa',
				'label' => 'Nomor Whatsapp',
				'rules' => 'required|xss_clean|trim',
				'errors' => array(
					'required' => '%s tidak boleh kosong.',
				),
			),
			array(
				'field' => 'token_wa',
				'label' => 'Token Whatsapp',
				'rules' => 'required|xss_clean|trim',
				'errors' => array(
					'required' => '%s tidak boleh kosong.',
				),
			),
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) {
			// Jika validasi gagal, tampilkan kembali form dengan pesan error
			$this->session->set_flashdata('message', 'Isi data dengan benar!');
			$this->session->set_flashdata('type', 'error');
			redirect('ts/whatsapp', 'refresh');
		} else {
			$id_wa = $this->input->post('id_wa');
			$wa = array(
				'no_wa' 						=> $this->input->post('no_wa'),
				'token_wa' 						=> $this->input->post('token_wa'),
				'sts_wa' 						=> $this->input->post('sts_wa'),
			);
			$this->db->where('id_wa', $id_wa);
			$result = $this->db->update('tb_waconfig', $wa);
			if ($result) {
				$namaloc = $this->input->post('nama_loc');
				$user    = $this->session->userdata('id_user');
				$cat     = "tb_whatsapp";
				$desk    = "Memperbaharui konfigurasi whatsapp";

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
			redirect('ts/whatsapp', 'refresh');
		}
	}
}
