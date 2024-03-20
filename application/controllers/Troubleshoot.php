<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Troubleshoot extends CI_Controller
{

	public function index()
	{
		$data = [
			'title' 	=> 'SIMARKO LOGIN',
			'dataorg'	=> $this->m_data->getdataorg()
		];
		$this->load->view('logints', $data);
	}

	public function auth()
	{
		$username 	= $this->input->post('username_user');
		$pass_user 	= $this->input->post('pass_user');
		$this->m_login->tslogin($username, $pass_user);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('troubleshoot', 'refresh');
	}
}
