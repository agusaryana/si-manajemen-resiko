<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Department extends CI_Controller
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
			'title' 	=> 'Data Department',
			'dataorg'	=> $this->m_data->getdataorg(),
		];
		$data['dept'] = $this->m_data->data_dept()->result();
		$this->load->view('ts/department', $data);
	}

	public function add()
	{
		$this->m_security->adminsec();
		$config = array(
			array(
				'field' => 'nama_dept',
				'label' => 'Nama Department',
				'rules' => 'required|xss_clean|trim',
				'errors' => array(
					'required' => '%s tidak boleh kosong.',
				),
			)
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) {
			// Jika validasi gagal, tampilkan kembali form dengan pesan error
			$this->session->set_flashdata('message', 'Nama Department Tidak Boleh Kosong!');
			$this->session->set_flashdata('type', 'error');
			redirect('ts/department', 'refresh');
		} else {
			$dept = array(
				'nama_dept' 						=> $this->input->post('nama_dept'),
			);
			$result = $this->db->insert('tb_department', $dept);
			if ($result) {
				$this->session->set_flashdata('message', 'Data berhasil disimpan!');
				$this->session->set_flashdata('type', 'success');
			} else {
				$this->session->set_flashdata('message', 'Data gagal disimpan!');
				$this->session->set_flashdata('type', 'error');
			}
			redirect('ts/department', 'refresh');
		}
	}

	public function ajax()
	{
		$this->m_security->adminsec();
		$type = $this->input->get('type');
		if (empty($type)) {
			$this->session->set_flashdata('message', 'Akses tidak diizinkan');
			$this->session->set_flashdata('type', 'error');
			redirect('ts/department', 'refresh');
		} else {
			if ($type == 'nonactive') {
				$id_dept = $this->input->post('dept_id');
				$data['dept'] = $this->m_data->datadept($id_dept)->row_array();
				$html = $this->load->view('ts/modals/mod_nonactivedept', $data);
				$reponse = [
					'html' => $html,
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash(),
					'success' => true
				];
			} elseif ($type == 'editdept') {
				$id_dept = $this->input->post('dept_id');
				$data['dept'] = $this->m_data->datadept($id_dept)->row_array();
				$html = $this->load->view('ts/modals/mod_editdept', $data);
				$reponse = [
					'html' => $html,
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash(),
					'success' => true
				];
			} elseif ($type == 'deletedept') {
				$id_dept = $this->input->post('dept_id');
				$data['dept'] = $this->m_data->datadept($id_dept)->row_array();
				$html = $this->load->view('ts/modals/mod_deletedept', $data);
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
		$id_dept = $this->input->post('id_dept');
		$dept = array(
			'sts_dept' => $this->input->post('sts_dept'),
		);
		$this->db->where('id_dept', $id_dept);
		$result = $this->db->update('tb_department', $dept);
		if ($result) {
			$this->session->set_flashdata('message', 'Aktivasi Department berhasil diupdate!');
			$this->session->set_flashdata('type', 'success');
		} else {
			$this->session->set_flashdata('message', 'Update gagal disimpan!');
			$this->session->set_flashdata('type', 'error');
		}
		redirect('ts/department', 'refresh');
	}

	public function edit()
	{
		$this->m_security->adminsec();
		$config = array(
			array(
				'field' => 'nama_dept',
				'label' => 'Nama Department',
				'rules' => 'required|xss_clean|trim',
				'errors' => array(
					'required' => '%s tidak boleh kosong.',
				),
			)
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) {
			// Jika validasi gagal, tampilkan kembali form dengan pesan error
			$this->session->set_flashdata('message', 'Nama Department Tidak Boleh Kosong!');
			$this->session->set_flashdata('type', 'error');
			redirect('ts/department', 'refresh');
		} else {
			$id_dept = $this->input->post('id_dept');
			$dept = array(
				'nama_dept' 						=> $this->input->post('nama_dept'),
			);
			$this->db->where('id_dept', $id_dept);
			$result = $this->db->update('tb_department', $dept);
			if ($result) {
				$this->session->set_flashdata('message', 'Data berhasil disimpan!');
				$this->session->set_flashdata('type', 'success');
			} else {
				$this->session->set_flashdata('message', 'Data gagal disimpan!');
				$this->session->set_flashdata('type', 'error');
			}
			redirect('ts/department', 'refresh');
		}
	}
}
