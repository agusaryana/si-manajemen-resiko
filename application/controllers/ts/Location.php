<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Location extends CI_Controller
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
			'title' 	=> 'Data Lokasi',
			'dataorg'	=> $this->m_data->getdataorg(),
		];
		$data['lokasi'] = $this->m_data->data_lokasi()->result();
		$this->load->view('ts/location', $data);
	}

	public function add()
	{
		$this->m_security->adminsec();
		$config = array(
			array(
				'field' => 'nama_loc',
				'label' => 'Nama Lokasi',
				'rules' => 'required|xss_clean|trim',
				'errors' => array(
					'required' => '%s tidak boleh kosong.',
				),
			)
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) {
			// Jika validasi gagal, tampilkan kembali form dengan pesan error
			$this->session->set_flashdata('message', 'Nama Lokasi Tidak Boleh Kosong!');
			$this->session->set_flashdata('type', 'error');
			redirect('ts/location', 'refresh');
		} else {
			$lokasi = array(
				'nama_loc' 						=> $this->input->post('nama_loc'),
			);
			$result = $this->db->insert('tb_location', $lokasi);
			if ($result) {
				$namaloc = $this->input->post('nama_loc');
				$user    = $this->session->userdata('id_user');
				$cat     = "tb_lokasi";
				$desk    = "Menambakan lokasi baru dengan nama " . $namaloc . ".";

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
			redirect('ts/location', 'refresh');
		}
	}

	public function ajax()
	{
		$this->m_security->adminsec();
		$type = $this->input->get('type');
		if (empty($type)) {
			$this->session->set_flashdata('message', 'Akses tidak diizinkan');
			$this->session->set_flashdata('type', 'error');
			redirect('ts/location', 'refresh');
		} else {
			if ($type == 'nonactive') {
				$id_loc = $this->input->post('loc_id');
				$data['lokasi'] = $this->m_data->dataloc($id_loc)->row_array();
				$html = $this->load->view('ts/modals/mod_nonactivelocation', $data);
				$reponse = [
					'html' => $html,
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash(),
					'success' => true
				];
			} elseif ($type == 'editloc') {
				$id_loc = $this->input->post('loc_id');
				$data['lokasi'] = $this->m_data->dataloc($id_loc)->row_array();
				$html = $this->load->view('ts/modals/mod_editlocation', $data);
				$reponse = [
					'html' => $html,
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash(),
					'success' => true
				];
			} elseif ($type == 'deleteloc') {
				$id_loc = $this->input->post('loc_id');
				$data['lokasi'] = $this->m_data->dataloc($id_loc)->row_array();
				$html = $this->load->view('ts/modals/mod_deletelocation', $data);
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
		$id_loc = $this->input->post('id_loc');
		$lokasi = array(
			'sts_loc' 						=> $this->input->post('sts_loc'),
		);
		$this->db->where('id_loc', $id_loc);
		$result = $this->db->update('tb_location', $lokasi);
		if ($result) {
			$this->session->set_flashdata('message', 'Aktivasi Lokasi berhasil diupdate!');
			$this->session->set_flashdata('type', 'success');
		} else {
			$this->session->set_flashdata('message', 'Data gagal disimpan!');
			$this->session->set_flashdata('type', 'error');
		}
		redirect('ts/location', 'refresh');
	}

	public function edit()
	{
		$this->m_security->adminsec();
		$id_loc = $this->input->post('id_loc');
		$lokasi = array(
			'nama_loc' 						=> $this->input->post('nama_loc'),
		);
		$this->db->where('id_loc', $id_loc);
		$result = $this->db->update('tb_location', $lokasi);
		if ($result) {
			$this->session->set_flashdata('message', 'Nama Lokasi berhasil diupdate!');
			$this->session->set_flashdata('type', 'success');
		} else {
			$this->session->set_flashdata('message', 'Data gagal disimpan!');
			$this->session->set_flashdata('type', 'error');
		}
		redirect('ts/location', 'refresh');
	}
}
