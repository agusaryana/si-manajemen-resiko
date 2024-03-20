<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

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
			'title' 	=> 'Data Kategori Masalah',
            'dataorg'	=> $this->m_data->getdataorg(),
            'datadiv'	=> $this->m_data->getdivisioncat(),
        ];
        $data['cat'] = $this->m_data->data_cat()->result();
		$this->load->view('ts/category', $data);
	}

    public function add()
	{
        $this->m_security->adminsec();
        $config = array(
            array(
                    'field' => 'nama_cat',
                    'label' => 'Nama Kategori',
                    'rules' => 'required|xss_clean|trim',
                    'errors' => array(
                        'required' => '%s tidak boleh kosong.',
                ),
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, tampilkan kembali form dengan pesan error
            $this->session->set_flashdata('message', 'Nama Kategori Tidak Boleh Kosong!');
            $this->session->set_flashdata('type', 'error');
            redirect('ts/category','refresh');
        } else 
        {
            $cat = array (
                'nama_cat' 						=> $this->input->post('nama_cat'),
                'id_div' 						=> $this->input->post('id_div'),
            );
            $result = $this->db->insert('tb_category', $cat);
            if ($result) {
                $this->session->set_flashdata('message', 'Data berhasil disimpan!');
                $this->session->set_flashdata('type', 'success');
            } else {
                $this->session->set_flashdata('message', 'Data gagal disimpan!');
                $this->session->set_flashdata('type', 'error');
            }
            redirect('ts/category','refresh');
        }
		
	}

    public function ajax()
	{
        $this->m_security->adminsec();
        $type = $this->input->get('type');
        if(empty($type))
        {
            $this->session->set_flashdata('message', 'Akses tidak diizinkan');
            $this->session->set_flashdata('type', 'error');
            redirect('ts/category','refresh');
        }else
        {
            if ($type == 'nonactive') {
                $id_cat = $this->input->post('cat_id');
                $data['cat'] = $this->m_data->datacat($id_cat)->row_array();
                $html = $this->load->view('ts/modals/mod_nonactivecat', $data);
                $reponse = [
                    'html' => $html,
                    'csrfName' => $this->security->get_csrf_token_name(),
                    'csrfHash' => $this->security->get_csrf_hash(),
                    'success' => true
                ];
            }elseif ($type == 'editcat') {
                $id_cat = $this->input->post('cat_id');
                $data['cat'] = $this->m_data->datacat($id_cat)->row_array();
                $data['datadiv'] = $this->m_data->getdivision();
                $html = $this->load->view('ts/modals/mod_editcat', $data);
                $reponse = [
                    'html' => $html,
                    'csrfName' => $this->security->get_csrf_token_name(),
                    'csrfHash' => $this->security->get_csrf_hash(),
                    'success' => true
                ];
            }elseif ($type == 'deletecat') {
                $id_cat = $this->input->post('cat_id');
                $data['cat'] = $this->m_data->datacat($id_cat)->row_array();
                $html = $this->load->view('ts/modals/mod_deletecat', $data);
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
        $id_cat = $this->input->post('id_cat');
		$cat = array (
			'sts_cat' 						=> $this->input->post('sts_cat'),
		);
        $this->db->where('id_cat', $id_cat);
		$result = $this->db->update('tb_category', $cat);
		if ($result) {
            $this->session->set_flashdata('message', 'Aktivasi Kategori berhasil diupdate!');
            $this->session->set_flashdata('type', 'success');
        } else {
            $this->session->set_flashdata('message', 'Update gagal disimpan!');
            $this->session->set_flashdata('type', 'error');
        }
		redirect('ts/category','refresh');
	}

    public function edit()
	{
        $this->m_security->adminsec();
        $config = array(
            array(
                    'field' => 'nama_cat',
                    'label' => 'Nama Kategori',
                    'rules' => 'required|xss_clean|trim',
                    'errors' => array(
                        'required' => '%s tidak boleh kosong.',
                ),
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, tampilkan kembali form dengan pesan error
            $this->session->set_flashdata('message', 'Nama Kategori tidak boleh kosong!');
            $this->session->set_flashdata('type', 'error');
            redirect('ts/category','refresh');
        } else 
        {
            $id_cat = $this->input->post('id_cat');
            $cat = array (
                'nama_cat' 						=> $this->input->post('nama_cat'),
                'id_div' 						=> $this->input->post('id_div'),
            );
            $this->db->where('id_cat', $id_cat);
            $result = $this->db->update('tb_category', $cat);
            if ($result) {
                $this->session->set_flashdata('message', 'Data berhasil disimpan!');
                $this->session->set_flashdata('type', 'success');
            } else {
                $this->session->set_flashdata('message', 'Data gagal disimpan!');
                $this->session->set_flashdata('type', 'error');
            }
            redirect('ts/category','refresh');
        }
		
	}

}
