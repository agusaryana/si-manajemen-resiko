<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Organisasi extends CI_Controller {

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
			'title' 	=> 'Data Organisasi',
            'dataorg'	=> $this->m_data->getdataorg(),
        ];
		$this->load->view('ts/organisasi', $data);
	}

    public function update()
	{
        $this->m_security->adminsec();
        $config = array(
            array(
                    'field' => 'nama_org',
                    'label' => 'Nama Organisasi',
                    'rules' => 'required|xss_clean|trim',
                    'errors' => array(
                        'required' => '%s tidak boleh kosong.',
                ),
            ),
            array(
                'field' => 'short_org',
                'label' => 'Nama Pendek Organisasi',
                'rules' => 'required|xss_clean|trim|max_length[15]',
                'errors' => array(
                    'required' => '%s tidak boleh kosong.',
                ),
            ),
            array(
                'field' => 'alamat_org',
                'label' => 'Alamat Organisasi',
                'rules' => 'required|xss_clean|trim',
                'errors' => array(
                    'required' => '%s tidak boleh kosong.',
                ),
            ),
            array(
                'field' => 'tlp_org',
                'label' => 'SMTP Port',
                'rules' => 'required|xss_clean|trim|numeric',
                'errors' => array(
                    'required' => '%s tidak boleh kosong.',
                ),
            ),
            array(
                'field' => 'email_org',
                'label' => 'SMTP Port',
                'rules' => 'required|xss_clean|trim|valid_email',
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
            redirect('ts/organisasi','refresh');
        } else 
        {
            $id = $this->input->post('id_org');
            $org = array (
                'nama_org' 					=> $this->input->post('nama_org'),
                'short_org' 				=> $this->input->post('short_org'),
                'email_org' 				=> $this->input->post('email_org'),
                'tlp_org' 					=> $this->input->post('tlp_org'),
                'alamat_org' 				=> $this->input->post('alamat_org')
            );
            $this->db->where('id_org', $id);
            $result = $this->db->update('tb_organisasi', $org);
            if ($result) {
                $user    = $this->session->userdata('id_user');
                $cat     = "tb_organisasi";
                $desk    = "Memperbaharui konfigurasi organisasi";
                
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
            redirect('ts/organisasi','refresh');
        }
		
	}

    public function updatelogo() 
    {
        $id_org = $this->input->post('id_org');
        // Mendapatkan informasi organisasi berdasarkan ID
        $organisasi = $this->db->get_where('tb_organisasi', array('id_org' => $id_org))->row();
    
        if ($organisasi) {
          // Mendapatkan direktori penyimpanan logo
          $logo_dir = 'asset/gambar/';
    
          // Menghapus logo lama jika ada
          if (!empty($organisasi->logo_org)) {
            @unlink($logo_dir . $organisasi->logo_org);
          }
    
          // Mengunggah logo baru
          $config['upload_path']       = $logo_dir;
          $config['allowed_types']     = 'jpg|jpeg|png';
          $config['max_size']          = 1024;
          $this->load->library('upload', $config);
    
          if ($this->upload->do_upload('logo_org')) {
            // File logo baru berhasil diunggah
            $upload_data = $this->upload->data();
            $new_logo = $upload_data['file_name'];
    
            // Memperbarui entri di database
            $data = array('logo_org' => $new_logo);
            $this->db->where('id_org', $id_org);
            $this->db->update('tb_organisasi', $data);
    
            // Redirect atau tampilkan pesan sukses
            $this->session->set_flashdata('message', 'Logo berhasil disimpan!');
            $this->session->set_flashdata('type', 'success');
          } else {
            // Menampilkan pesan kesalahan jika unggahan gagal
            $upload_error = $this->upload->display_errors();
            $this->session->set_flashdata('message', $upload_error);
            $this->session->set_flashdata('type', 'error');
          }
          redirect('ts/organisasi','refresh');
        } else {
          // Organisasi dengan ID yang diberikan tidak ditemukan
          echo 'Organisasi not found.';
        }
    }

    public function updatefavicon() 
    {
        $id_org = $this->input->post('id_org');
        // Mendapatkan informasi organisasi berdasarkan ID
        $organisasi = $this->db->get_where('tb_organisasi', array('id_org' => $id_org))->row();
    
        if ($organisasi) {
          // Mendapatkan direktori penyimpanan logo
          $fav_dir = 'asset/gambar/';
    
          // Menghapus logo lama jika ada
          if (!empty($organisasi->favicon_org)) {
            @unlink($fav_dir . $organisasi->favicon_org);
          }
    
          // Mengunggah logo baru
          $config['upload_path']       = $fav_dir;
          $config['allowed_types']     = 'jpg|jpeg|png|ico';
          $config['max_size']          = 100;
          $this->load->library('upload', $config);
    
          if ($this->upload->do_upload('favicon_org')) {
            // File logo baru berhasil diunggah
            $upload_data = $this->upload->data();
            $new_fav = $upload_data['file_name'];
    
            // Memperbarui entri di database
            $data = array('favicon_org' => $new_fav);
            $this->db->where('id_org', $id_org);
            $this->db->update('tb_organisasi', $data);
    
            // Redirect atau tampilkan pesan sukses
            $this->session->set_flashdata('message', 'Logo berhasil disimpan!');
            $this->session->set_flashdata('type', 'success');
          } else {
            // Menampilkan pesan kesalahan jika unggahan gagal
            $upload_error = $this->upload->display_errors();
            $this->session->set_flashdata('message', $upload_error);
            $this->session->set_flashdata('type', 'error');
          }
          redirect('ts/organisasi','refresh');
        } else {
          // Organisasi dengan ID yang diberikan tidak ditemukan
          echo 'Organisasi not found.';
        }
    }


}
