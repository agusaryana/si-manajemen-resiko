<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Divisi extends CI_Controller {

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
			'title' 	=> 'Data Divisi',
            'dataorg'	=> $this->m_data->getdataorg(),
        ];
        $data['divisi'] = $this->m_data->data_divisi()->result();
		$this->load->view('ts/division', $data);
	}

    public function add()
	{
        $this->m_security->adminsec();
        $config = array(
            array(
                    'field' => 'nama_div',
                    'label' => 'Nama Divisi',
                    'rules' => 'required|xss_clean|trim',
                    'errors' => array(
                        'required' => '%s tidak boleh kosong.',
                ),
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, tampilkan kembali form dengan pesan error
            $this->session->set_flashdata('message', 'Nama Divisi Tidak Boleh Kosong!');
            $this->session->set_flashdata('type', 'error');
            redirect('ts/divisi','refresh');
        } else 
        {
            $divisi = array (
                'nama_div' 						=> $this->input->post('nama_div'),
            );
            $result = $this->db->insert('tb_division', $divisi);
            if ($result) {
                $this->session->set_flashdata('message', 'Data berhasil disimpan!');
                $this->session->set_flashdata('type', 'success');
            } else {
                $this->session->set_flashdata('message', 'Data gagal disimpan!');
                $this->session->set_flashdata('type', 'error');
            }
            redirect('ts/divisi','refresh');
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
            redirect('ts/divisi','refresh');
        }else
        {
            if ($type == 'nonactive') {
                $id_div = $this->input->post('div_id');
                $data['divisi'] = $this->m_data->datadiv($id_div)->row_array();
                $html = $this->load->view('ts/modals/mod_nonactivedivision', $data);
                $reponse = [
                    'html' => $html,
                    'csrfName' => $this->security->get_csrf_token_name(),
                    'csrfHash' => $this->security->get_csrf_hash(),
                    'success' => true
                ];
            }elseif ($type == 'editdiv') {
                $id_div = $this->input->post('div_id');
                $data['divisi'] = $this->m_data->datadiv($id_div)->row_array();
                $html = $this->load->view('ts/modals/mod_editdivision', $data);
                $reponse = [
                    'html' => $html,
                    'csrfName' => $this->security->get_csrf_token_name(),
                    'csrfHash' => $this->security->get_csrf_hash(),
                    'success' => true
                ];
            }elseif ($type == 'deletediv') {
                $id_div = $this->input->post('div_id');
                $data['divisi'] = $this->m_data->datadiv($id_div)->row_array();
                $html = $this->load->view('ts/modals/mod_deletedivision', $data);
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
        $id_div = $this->input->post('id_div');
		$divisi = array (
			'sts_div' 						=> $this->input->post('sts_div'),
		);
        $this->db->where('id_div', $id_div);
		$result = $this->db->update('tb_division', $divisi);
		if ($result) {
            $this->session->set_flashdata('message', 'Aktivasi Lokasi berhasil diupdate!');
            $this->session->set_flashdata('type', 'success');
        } else {
            $this->session->set_flashdata('message', 'Data gagal disimpan!');
            $this->session->set_flashdata('type', 'error');
        }
		redirect('ts/divisi','refresh');
	}

    public function edit()
	{
        $this->m_security->adminsec();
        $config = array(
            array(
                    'field' => 'nama_div',
                    'label' => 'Nama Divisi',
                    'rules' => 'required|xss_clean|trim',
                    'errors' => array(
                        'required' => '%s tidak boleh kosong.',
                ),
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, tampilkan kembali form dengan pesan error
            $this->session->set_flashdata('message', 'Nama Divisi Tidak Boleh Kosong!');
            $this->session->set_flashdata('type', 'error');
            redirect('ts/divisi','refresh');
        } else 
        {
            $id_div = $this->input->post('id_div');
            $divisi = array (
                'nama_div' 						=> $this->input->post('nama_div'),
            );
            $this->db->where('id_div', $id_div);
            $result = $this->db->update('tb_division', $divisi);
            if ($result) {
                $this->session->set_flashdata('message', 'Data berhasil disimpan!');
                $this->session->set_flashdata('type', 'success');
            } else {
                $this->session->set_flashdata('message', 'Data gagal disimpan!');
                $this->session->set_flashdata('type', 'error');
            }
            redirect('ts/divisi','refresh');
        }
		
	}

}
