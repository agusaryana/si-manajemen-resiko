<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_security extends CI_Model
{


	public function tssec()
	{
		$akses = $this->session->userdata('id_akses');
		$sts = $this->session->userdata('sts_user');
		if (empty($akses)) {
			$this->session->set_flashdata('message', 'Silakan login terlebih dahulu.');
			$this->session->set_flashdata('type', 'error');
			redirect('troubleshoot', 'refresh');
		} elseif ($sts != '1') {
			$this->session->set_flashdata('message', 'Akun anda tidak aktif, silakan hubungi IT Dept');
			$this->session->set_flashdata('type', 'error');
			redirect('troubleshoot', 'refresh');
		}
	}

	public function adminsec()
	{
		$akses = $this->session->userdata('id_akses');
		$sts = $this->session->userdata('sts_user');
		if (empty($akses)) {
			$this->session->set_flashdata('message', 'Silakan login terlebih dahulu.');
			$this->session->set_flashdata('type', 'error');
			redirect('troubleshoot', 'refresh');
		} else if ($akses != '1' || $sts != '1') {
			$this->session->set_flashdata('message', 'Maaf! Akun anda dilarang mengakses halaman tersebut.');
			$this->session->set_flashdata('type', 'error');
			redirect('ts/home', 'refresh');
		}
	}

	public function clientsec()
	{
		$akses = $this->session->userdata('id_client');
		$sts = $this->session->userdata('sts_client');
		if (empty($akses)) {
			$this->session->set_flashdata('message', 'Silakan login terlebih dahulu.');
			$this->session->set_flashdata('type', 'error');
			redirect('login', 'refresh');
		} elseif ($sts != '1') {
			$this->session->set_flashdata('message', 'Akun anda tidak aktif, silakan hubungi IT Dept');
			$this->session->set_flashdata('type', 'error');
			redirect('login', 'refresh');
		}
	}
}
