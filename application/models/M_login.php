<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_login extends CI_Model
{


	public function tslogin($username, $pass_user)
	{
		$login = date('Y-m-d H:i:s');
		$this->db->get('tb_user');
		$this->db->join('tb_akses', 'tb_akses.id_akses = tb_user.id_akses', 'LEFT');
		$this->db->join('tb_division', 'tb_division.id_div = tb_user.id_div', 'LEFT');
		$this->db->where('username_user', $username);
		$this->db->where('pass_user', md5($pass_user));
		$query = $this->db->get('tb_user');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$sess = array(
					'id_user'			=> $row->id_user,
					'nama_user' 		=> $row->nama_user,
					'id_div'			=> $row->id_div,
					'id_loc'			=> $row->id_loc,
					'id_akses'		=> $row->id_akses,
					'username_user'	=> $row->username_user,
					'pass_user'		=> $row->pass_user,
					'tlp_user'		=> $row->tlp_user,
					'sts_user'		=> $row->sts_user,
					'nama_akses'		=> $row->nama_akses,
					'nama_div'		=> $row->nama_div,
				);
				$this->session->set_userdata($sess);
				if ($row->sts_user == '1' && $row->id_akses == '1') //administrator
				{
					$id_user = $row->id_user;
					$last_login = array(
						'last_login'				=> $login
					);
					$this->db->where('id_user', $id_user);
					$this->db->update('tb_user', $last_login);

					$this->session->set_flashdata('message', 'Selamat datang ' . $row->nama_user . '');
					$this->session->set_flashdata('type', 'success');
					redirect('ts/home', 'refresh');
				} elseif ($row->sts_user == '1' && $row->id_akses == '2') //koordinator
				{
					$id_user = $row->id_user;
					$last_login = array(
						'last_login'				=> $login
					);
					$this->db->where('id_user', $id_user);
					$this->db->update('tb_user', $last_login);

					$this->session->set_flashdata('message', 'Selamat datang ' . $row->nama_user . '');
					$this->session->set_flashdata('type', 'success');
					redirect('ts/home', 'refresh');
				} elseif ($row->sts_user == '1' && $row->id_akses == '3') //troubleshooter
				{
					$id_user = $row->id_user;
					$last_login = array(
						'last_login'				=> $login
					);
					$this->db->where('id_user', $id_user);
					$this->db->update('tb_user', $last_login);

					$this->session->set_flashdata('message', 'Selamat datang ' . $row->nama_user . '');
					$this->session->set_flashdata('type', 'success');
					redirect('ts/home', 'refresh');
				} elseif ($row->sts_user == '1' && $row->id_akses == '4') //approval
				{
					$id_user = $row->id_user;
					$last_login = array(
						'last_login'				=> $login
					);
					$this->db->where('id_user', $id_user);
					$this->db->update('tb_user', $last_login);

					$this->session->set_flashdata('message', 'Selamat datang ' . $row->nama_user . '');
					$this->session->set_flashdata('type', 'success');
					redirect('ts/home', 'refresh');
				} else {
					$this->session->set_flashdata('message', 'Akun anda tidak aktif, silakan hubungi IT Dept');
					$this->session->set_flashdata('type', 'warning');
					redirect('troubleshoot', 'refresh');
				}
			}
		} else {
			$this->session->set_flashdata('message', 'Username atau password salah!');
			$this->session->set_flashdata('type', 'error');
			redirect('troubleshoot', 'refresh');
		}
	}

	public function clientlogin($username_client, $pass_client)
	{
		$this->db->get('tb_client');
		$this->db->join('tb_location', 'tb_location.id_loc = tb_client.id_loc', 'LEFT');
		$this->db->join('tb_department', 'tb_department.id_dept = tb_client.id_dept', 'LEFT');
		$this->db->where('username_client', $username_client);
		$this->db->where('pass_client', md5($pass_client));
		$query = $this->db->get('tb_client');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$sess = array(
					'id_client'		=> $row->id_client,
					'nama_client' 	=> $row->nama_client,
					'id_dept'			=> $row->id_dept,
					'id_loc'			=> $row->id_loc,
					'email_client'	=> $row->email_client,
					'tlp_client'		=> $row->tlp_client,
					'username_client'	=> $row->username_client,
					'nama_dept'		=> $row->nama_dept,
					'nama_loc'		=> $row->nama_loc,
					'sts_client'		=> $row->sts_client,
				);
				$this->session->set_userdata($sess);
				if ($row->sts_client == '1') //aktif
				{
					$this->session->set_flashdata('message', 'Selamat datang ' . $row->nama_client . '');
					$this->session->set_flashdata('type', 'success');
					redirect('client/home', 'refresh');
				} elseif ($row->sts_client == '2') //nonaktif
				{
					$this->session->set_flashdata('message', 'Akun anda tidak aktif, hubungi IT Dept.');
					$this->session->set_flashdata('type', 'warning');
					redirect('login', 'refresh');
				}
			}
		} else {
			$this->session->set_flashdata('message', 'Username atau password salah!');
			$this->session->set_flashdata('type', 'error');
			redirect('login', 'refresh');
		}
	}
}
