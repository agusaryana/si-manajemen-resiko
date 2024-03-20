<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Testkirim extends CI_Controller
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
        'target' => '120363184790849706@g.us',
        'message' => 'test message', 
        'countryCode' => '62', //optional
        ),
        CURLOPT_HTTPHEADER => array(
            'Authorization: kMfPN#+N1Peh9Zn5986#' //change TOKEN to your actual token
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
	}

	public function success()
	{
		$data = [
			'title' => 'Create Ticket Success',
			'dataorg' => $this->m_data->getdataorg()
		];
		$this->load->view('ticketsuccess', $data);
	}

	public function add_ajax_cat($id_div)
	{
		$query = $this->db->get_where('tb_category', array('id_div' => $id_div));
		$data = "<option value=''>- Pilih Kategori -</option>";
		foreach ($query->result() as $value) {
			$data .= "<option value='" . $value->id_cat . "'>" . $value->nama_cat . "</option>";
		}
		echo $data;
	}

	public function add()
	{
		$web = base_url();
		$waconfig = $this->m_data->datawa();
		$idloc = $this->input->post('id_loc');
		$iddiv = $this->input->post('id_div');
		$idcat = $this->input->post('id_cat');
		$bulan = date('n');

		/** GENERATE NOMOR TICKET */
		$this->db->select('RIGHT(tb_ticket.no_ticket,3) as tic_no', FALSE);
		$this->db->order_by('tic_no','DESC');    
		$this->db->limit(1);    
		$query = $this->db->get('tb_ticket');
			if($query->num_rows() <> 0){      
				$data = $query->row();
				$kode = intval($data->tic_no) + 1; 
			}
			else{      
				$kode = 1;  
			}
		$batas = str_pad($kode, 3, "0", STR_PAD_LEFT);    
		$noticket = "TICK".$bulan."".$idloc."".$iddiv."".$idcat."".$batas;

		//VALIDASI
		$config = array(
			array(
				'field' => 'nama_ticket',
				'label' => 'Nama Lengkap',
				'rules' => 'required|xss_clean|trim',
				'errors' => array(
					'required' => '%s tidak boleh kosong.',
				),
			),
			array(
				'field' => 'tlp_ticket',
				'label' => 'Telepon Anda',
				'rules' => 'required|xss_clean|trim|numeric',
				'errors' => array(
					'required' => '%s tidak boleh kosong.',
					'numeric' => '%s hanya boleh angka.',
				),
			),
			array(
				'field' => 'email_ticket',
				'label' => 'Email Anda',
				'rules' => 'required|xss_clean|trim|valid_email',
				'errors' => array(
					'required' => '%s tidak boleh kosong.',
					'valid_email' => '%s tidak valid.',
				),
			),
			array(
				'field' => 'desk_ticket',
				'label' => 'Deskripsi Ticket',
				'rules' => 'required|xss_clean|trim',
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
			redirect('ticketguest', 'refresh');
		} else {

			// Mengunggah logo baru
			$config['upload_path']       = 'asset/lampiran/';
			$config['allowed_types']     = 'jpg|jpeg|png|pdf|xls|xlsx|doc|docx';
			$config['max_size']          = 500;
			$config['encrypt_name']      = TRUE;
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('lampiran_ticket')) 
			{
				// File logo baru berhasil diunggah
				$upload_lampiran = $this->upload->data("file_name");
				$new_name = $upload_lampiran['file_name'];
		
				// Memperbarui entri di database
				$ticket = array(
					'nama_ticket' 		=> $this->input->post('nama_ticket'),
					'no_ticket' 		=> $noticket,
					'id_div' 			=> $this->input->post('id_div'),
					'id_loc' 			=> $this->input->post('id_loc'),
					'id_dept' 			=> $this->input->post('id_dept'),
					'id_cat' 			=> $this->input->post('id_cat'),
					'email_ticket' 		=> $this->input->post('email_ticket'),
					'tlp_ticket' 		=> $this->input->post('tlp_ticket'),
					'desk_ticket' 		=> $this->input->post('desk_ticket'),
					'lampiran_ticket' 	=> $new_name,
				);
				$result = $this->db->insert('tb_ticket', $ticket);
				if($result)
				{
					// Redirect atau tampilkan pesan sukses
					redirect('ticketguest/success','refresh');
				}else{
					$this->session->set_flashdata('message', 'Ticket gagal disimpan!');
					$this->session->set_flashdata('type', 'error');
					redirect('ticketguest','refresh');
				}
			} else {
				// Menampilkan pesan kesalahan jika unggahan gagal
				$upload_error = $this->upload->display_errors();
				$ticket = array(
					'nama_ticket' 		=> $this->input->post('nama_ticket'),
					'no_ticket' 		=> $noticket,
					'id_div' 			=> $this->input->post('id_div'),
					'id_loc' 			=> $this->input->post('id_loc'),
					'id_dept' 			=> $this->input->post('id_dept'),
					'id_cat' 			=> $this->input->post('id_cat'),
					'email_ticket' 		=> $this->input->post('email_ticket'),
					'tlp_ticket' 		=> $this->input->post('tlp_ticket'),
					'desk_ticket' 		=> $this->input->post('desk_ticket'),
				);
				$result = $this->db->insert('tb_ticket', $ticket);
				if($result)
				{
					// Redirect atau tampilkan pesan sukses
					redirect('ticketguest/success','refresh');
				}else{
					$this->session->set_flashdata('message', 'Ticket gagal disimpan!');
					$this->session->set_flashdata('type', 'error');
					redirect('ticketguest','refresh');
				}
			}
		}

	}

}