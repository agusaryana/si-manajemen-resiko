<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function index()
	{
		$data = [
			'title' 	=> 'SIMARKO | LOGIN',
			'dataorg'	=> $this->m_data->getdataorg()
		];
		$this->load->view('loginclient', $data);
	}

	public function auth()
	{
		$username_client 	= $this->input->post('username_client');
		$pass_client 		= $this->input->post('pass_client');
		$this->m_login->clientlogin($username_client, $pass_client);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login', 'refresh');
	}
}
