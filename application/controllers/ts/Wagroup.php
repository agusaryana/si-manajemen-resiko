<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wagroup extends CI_Controller {

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
			'title' 	=> 'Data Whatsapp Group',
            'dataorg'	=> $this->m_data->getdataorg(),
            'datadiv'	=> $this->m_data->getdivision2(),
            'dataloc'	=> $this->m_data->getlocation2(),
        ];
        $data['wagroup'] = $this->m_data->data_wagroup()->result();
		$this->load->view('ts/wagroup', $data);
	}

    public function add()
	{
        $this->m_security->adminsec();
        $config = array(
            array(
                    'field' => 'nama_wagroup',
                    'label' => 'Nama Kategori',
                    'rules' => 'required|xss_clean|trim',
                    'errors' => array(
                        'required' => '%s tidak boleh kosong.',
                ),
            ),
            array(
                'field' => 'token_wagroup',
                'label' => 'ID Kategori',
                'rules' => 'required|xss_clean|trim',
                'errors' => array(
                    'required' => '%s tidak boleh kosong.',
            ),
        ),
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, tampilkan kembali form dengan pesan error
            $this->session->set_flashdata('message', 'Isian anda tidak valid!');
            $this->session->set_flashdata('type', 'error');
            redirect('ts/wagroup','refresh');
        } else 
        {
            $wg = array (
                'nama_wagroup' 					=> $this->input->post('nama_wagroup'),
                'token_wagroup' 				=> $this->input->post('token_wagroup'),
                'id_div' 						=> $this->input->post('id_div'),
                'id_loc' 						=> $this->input->post('id_loc'),
            );
            $result = $this->db->insert('tb_wagroup', $wg);
            if ($result) {
                $this->session->set_flashdata('message', 'Data berhasil disimpan!');
                $this->session->set_flashdata('type', 'success');
            } else {
                $this->session->set_flashdata('message', 'Data gagal disimpan!');
                $this->session->set_flashdata('type', 'error');
            }
            redirect('ts/wagroup','refresh');
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
            redirect('ts/wagroup','refresh');
        }else
        {
            if ($type == 'nonactive') {
                $id_wagroup = $this->input->post('wagroup_id');
                $data['wagroup'] = $this->m_data->datawagroup($id_wagroup)->row_array();
                $html = $this->load->view('ts/modals/mod_nonactivewagroup', $data);
                $reponse = [
                    'html' => $html,
                    'csrfName' => $this->security->get_csrf_token_name(),
                    'csrfHash' => $this->security->get_csrf_hash(),
                    'success' => true
                ];
            }elseif ($type == 'editwagroup') {
                $id_wagroup = $this->input->post('wagroup_id');
                $data['wagroup'] = $this->m_data->datawagroup($id_wagroup)->row_array();
                $data['datadiv'] = $this->m_data->getdivision2();
                $data['dataloc'] = $this->m_data->getlocation2();
                $html = $this->load->view('ts/modals/mod_editwagroup', $data);
                $reponse = [
                    'html' => $html,
                    'csrfName' => $this->security->get_csrf_token_name(),
                    'csrfHash' => $this->security->get_csrf_hash(),
                    'success' => true
                ];
            }elseif ($type == 'deletewagroup') {
                $id_wagroup = $this->input->post('wagroup_id');
                $data['wagroup'] = $this->m_data->datawagroup($id_wagroup)->row_array();
                $html = $this->load->view('ts/modals/mod_deletewagroup', $data);
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
        $id_wagroup = $this->input->post('id_wagroup');
		$wg = array (
			'sts_wagroup' 						=> $this->input->post('sts_wagroup'),
		);
        $this->db->where('id_wagroup', $id_wagroup);
		$result = $this->db->update('tb_wagroup', $wg);
		if ($result) {
            $this->session->set_flashdata('message', 'Aktivasi Whatsapp Group berhasil diupdate!');
            $this->session->set_flashdata('type', 'success');
        } else {
            $this->session->set_flashdata('message', 'Update gagal disimpan!');
            $this->session->set_flashdata('type', 'error');
        }
		redirect('ts/wagroup','refresh');
	}

    public function edit()
	{
        $this->m_security->adminsec();
        $config = array(
            array(
                    'field' => 'nama_wagroup',
                    'label' => 'Nama Kategori',
                    'rules' => 'required|xss_clean|trim',
                    'errors' => array(
                        'required' => '%s tidak boleh kosong.',
                ),
            ),
            array(
                'field' => 'token_wagroup',
                'label' => 'ID Kategori',
                'rules' => 'required|xss_clean|trim',
                'errors' => array(
                    'required' => '%s tidak boleh kosong.',
            ),
        ),
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, tampilkan kembali form dengan pesan error
            $this->session->set_flashdata('message', 'Isian anda tidak valid!');
            $this->session->set_flashdata('type', 'error');
            redirect('ts/wagroup','refresh');
        } else 
        {
            $id_wagroup = $this->input->post('id_wagroup');
            $wg = array (
                'nama_wagroup' 					=> $this->input->post('nama_wagroup'),
                'token_wagroup' 				=> $this->input->post('token_wagroup'),
                'id_div' 						=> $this->input->post('id_div'),
                'id_loc' 						=> $this->input->post('id_loc'),
            );
            $this->db->where('id_wagroup', $id_wagroup);
            $result = $this->db->update('tb_wagroup', $wg);
            if ($result) {
                $this->session->set_flashdata('message', 'Data berhasil disimpan!');
                $this->session->set_flashdata('type', 'success');
            } else {
                $this->session->set_flashdata('message', 'Data gagal disimpan!');
                $this->session->set_flashdata('type', 'error');
            }
            redirect('ts/wagroup','refresh');
        }
		
	}

}
