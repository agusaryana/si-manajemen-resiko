<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {

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
			'title' 	=> 'Konfigurasi Email',
            'dataorg'	=> $this->m_data->getdataorg(),
            'dataemail'	=> $this->m_data->getdataemail()
        ];
		$this->load->view('ts/email', $data);
	}

    public function update()
	{
        $this->m_security->adminsec();
        $config = array(
            array(
                    'field' => 'alamat_email',
                    'label' => 'Alamat Email',
                    'rules' => 'valid_email|required|xss_clean|trim',
                    'errors' => array(
                        'required' => '%s tidak boleh kosong.',
                ),
            ),
            array(
                'field' => 'pass_email',
                'label' => 'Password Email',
                'rules' => 'required|xss_clean|trim',
                'errors' => array(
                    'required' => '%s tidak boleh kosong.',
                ),
            ),
            array(
                'field' => 'smtphost_email',
                'label' => 'SMTP Host Email',
                'rules' => 'required|xss_clean|trim',
                'errors' => array(
                    'required' => '%s tidak boleh kosong.',
                ),
            ),
            array(
                'field' => 'smtpport_email',
                'label' => 'SMTP Port',
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
            redirect('ts/email','refresh');
        } else 
        {
            $id = $this->input->post('id_email');
            $email = array (
                'alamat_email' 						=> $this->input->post('alamat_email'),
                'pass_email' 						=> $this->input->post('pass_email'),
                'smtphost_email' 					=> $this->input->post('smtphost_email'),
                'smtpport_email' 					=> $this->input->post('smtpport_email'),
                'sts_email' 						=> $this->input->post('sts_email')
            );
            $this->db->where('id_email', $id);
            $result = $this->db->update('tb_email', $email);
            if ($result) {
                $namaloc = $this->input->post('nama_loc');
                $user    = $this->session->userdata('id_user');
                $cat     = "tb_email";
                $desk    = "Memperbaharui konfigurasi email";
                
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
            redirect('ts/email','refresh');
        }
		
	}

}
