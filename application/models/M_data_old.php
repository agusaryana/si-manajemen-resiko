<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_data extends CI_Model
{
	//Get data Organisasi
	public function getdataorg()
	{
		return $this->db->get_where('tb_organisasi')->row_array();
	}

	//Get data Whatsapp
	public function getdatawa()
	{
		return $this->db->get_where('tb_waconfig')->row_array();
	}

	//AMBIL CONFIG Ewhatsapp
	public function datawa()
	{
		$query = $this->db->get('tb_waconfig');
		return $query->row();
	}

	//NOTIFIKASI CLIENT
	public function notifwa_clientopen()
	{
		$this->db->join('tb_notifwa_client', 'tb_notifwa_client.no_ticket = tb_ticket.no_ticket', 'LEFT');
		$this->db->where('tb_notifwa_client.ket_notif', 'open');
		$this->db->where('tb_notifwa_client.sts_notif', '1');
		$query = $this->db->get_where('tb_ticket');
		if ($query === FALSE) {
			$error = $this->db->error();
			$error_message = $error['message']; // Mengambil pesan kesalahan dari array

			// Tampilkan pesan kesalahan
			echo "Database Error: " . $error_message;
		}
		return $query;
	}

	public function notifwa_clientproses()
	{
		$this->db->join('tb_notifwa_client', 'tb_notifwa_client.no_ticket = tb_ticket.no_ticket', 'LEFT');
		$this->db->join('tb_user', 'tb_user.id_user = tb_ticket.id_user', 'LEFT');
		$this->db->where('tb_notifwa_client.ket_notif', 'proses');
		$this->db->where('tb_notifwa_client.sts_notif', '1');
		$query = $this->db->get_where('tb_ticket');
		if ($query === FALSE) {
			$error = $this->db->error();
			$error_message = $error['message']; // Mengambil pesan kesalahan dari array

			// Tampilkan pesan kesalahan
			echo "Database Error: " . $error_message;
		}

		return $query;
	}

	public function notifwa_clientselesai()
	{
		$this->db->join('tb_notifwa_client', 'tb_notifwa_client.no_ticket = tb_ticket.no_ticket', 'LEFT');
		$this->db->join('tb_user', 'tb_user.id_user = tb_ticket.id_user', 'LEFT');
		$this->db->where('tb_notifwa_client.ket_notif', 'finish');
		$this->db->where('tb_notifwa_client.sts_notif', '1');
		$query = $this->db->get_where('tb_ticket');
		if ($query === FALSE) {
			$error = $this->db->error();
			$error_message = $error['message']; // Mengambil pesan kesalahan dari array

			// Tampilkan pesan kesalahan
			echo "Database Error: " . $error_message;
		}

		return $query;
	}

	public function notifemail_clientopen()
	{
		$this->db->join('tb_notifemail_client', 'tb_notifemail_client.no_ticket = tb_ticket.no_ticket', 'LEFT');
		$this->db->where('tb_notifemail_client.ket_notif', 'open');
		$this->db->where('tb_notifemail_client.sts_notif', '1');
		$query = $this->db->get_where('tb_ticket');
		if ($query === FALSE) {
			$error = $this->db->error();
			$error_message = $error['message']; // Mengambil pesan kesalahan dari array

			// Tampilkan pesan kesalahan
			echo "Database Error: " . $error_message;
		}
		return $query;
	}

	public function notifemail_clientproses()
	{
		$this->db->join('tb_notifemail_client', 'tb_notifemail_client.no_ticket = tb_ticket.no_ticket', 'LEFT');
		$this->db->join('tb_user', 'tb_user.id_user = tb_ticket.id_user', 'LEFT');
		$this->db->where('tb_notifemail_client.ket_notif', 'proses');
		$this->db->where('tb_notifemail_client.sts_notif', '1');
		$query = $this->db->get_where('tb_ticket');
		if ($query === FALSE) {
			$error = $this->db->error();
			$error_message = $error['message']; // Mengambil pesan kesalahan dari array

			// Tampilkan pesan kesalahan
			echo "Database Error: " . $error_message;
		}

		return $query;
	}

	public function notifemail_clientfinish()
	{
		$this->db->join('tb_notifemail_client', 'tb_notifemail_client.no_ticket = tb_ticket.no_ticket', 'LEFT');
		$this->db->join('tb_user', 'tb_user.id_user = tb_ticket.id_user', 'LEFT');
		$this->db->where('tb_notifemail_client.ket_notif', 'finish');
		$this->db->where('tb_notifemail_client.sts_notif', '1');
		$query = $this->db->get_where('tb_ticket');
		if ($query === FALSE) {
			$error = $this->db->error();
			$error_message = $error['message']; // Mengambil pesan kesalahan dari array

			// Tampilkan pesan kesalahan
			echo "Database Error: " . $error_message;
		}

		return $query;
	}

	public function notifwa_tsopen()
	{
		$this->db->select('tb_notifwa_ts.id_notifwa_ts, tb_wagroup.token_wagroup, tb_division.nama_div, tb_ticket.no_ticket, tb_ticket.nama_ticket, tb_ticket.desk_ticket, tb_location.nama_loc, tb_department.nama_dept');
		$this->db->from('tb_ticket');
		$this->db->join('tb_division', 'tb_division.id_div = tb_ticket.id_div', 'left');
		$this->db->join('tb_location', 'tb_location.id_loc = tb_ticket.id_loc', 'inner');
		$this->db->join('tb_wagroup', 'tb_wagroup.id_div = tb_ticket.id_div AND tb_wagroup.id_loc = tb_ticket.id_loc', 'left');
		$this->db->join('tb_department', 'tb_department.id_dept = tb_ticket.id_dept', 'inner');
		$this->db->join('tb_notifwa_ts', 'tb_notifwa_ts.no_ticket = tb_ticket.no_ticket', 'left');
		$this->db->where('tb_notifwa_ts.ket_notif', 'open');
		$this->db->where('tb_notifwa_ts.sts_notif', '1');
		$query = $this->db->get_where();
		if ($query === FALSE) {
			$error = $this->db->error();
			$error_message = $error['message']; // Mengambil pesan kesalahan dari array

			// Tampilkan pesan kesalahan
			echo "Database Error: " . $error_message;
		}
		return $query;
	}

	public function notifwa_tsproses()
	{
		$this->db->select('tb_notifwa_ts.id_notifwa_ts, tb_user.nama_user, tb_wagroup.token_wagroup, tb_division.nama_div, tb_ticket.no_ticket, tb_ticket.nama_ticket, tb_ticket.desk_ticket, tb_location.nama_loc, tb_department.nama_dept');
		$this->db->from('tb_ticket');
		$this->db->join('tb_division', 'tb_division.id_div = tb_ticket.id_div', 'left');
		$this->db->join('tb_location', 'tb_location.id_loc = tb_ticket.id_loc', 'inner');
		$this->db->join('tb_wagroup', 'tb_wagroup.id_div = tb_ticket.id_div AND tb_wagroup.id_loc = tb_ticket.id_loc', 'left');
		$this->db->join('tb_department', 'tb_department.id_dept = tb_ticket.id_dept', 'inner');
		$this->db->join('tb_notifwa_ts', 'tb_notifwa_ts.no_ticket = tb_ticket.no_ticket', 'left');
		$this->db->join('tb_user', 'tb_user.id_user = tb_ticket.id_user', 'inner');
		$this->db->where('tb_notifwa_ts.ket_notif', 'proses');
		$this->db->where('tb_notifwa_ts.sts_notif', '1');
		$query = $this->db->get_where();
		if ($query === FALSE) {
			$error = $this->db->error();
			$error_message = $error['message']; // Mengambil pesan kesalahan dari array

			// Tampilkan pesan kesalahan
			echo "Database Error: " . $error_message;
		}
		return $query;
	}

	public function notifwa_tsselesai()
	{
		$this->db->select('tb_notifwa_ts.id_notifwa_ts, tb_user.nama_user, tb_wagroup.token_wagroup, tb_division.nama_div, tb_ticket.no_ticket, tb_ticket.nama_ticket, tb_ticket.desk_ticket, tb_location.nama_loc, tb_department.nama_dept');
		$this->db->from('tb_ticket');
		$this->db->join('tb_division', 'tb_division.id_div = tb_ticket.id_div', 'left');
		$this->db->join('tb_location', 'tb_location.id_loc = tb_ticket.id_loc', 'inner');
		$this->db->join('tb_wagroup', 'tb_wagroup.id_div = tb_ticket.id_div AND tb_wagroup.id_loc = tb_ticket.id_loc', 'left');
		$this->db->join('tb_department', 'tb_department.id_dept = tb_ticket.id_dept', 'inner');
		$this->db->join('tb_notifwa_ts', 'tb_notifwa_ts.no_ticket = tb_ticket.no_ticket', 'left');
		$this->db->join('tb_user', 'tb_user.id_user = tb_ticket.id_user', 'inner');
		$this->db->where('tb_notifwa_ts.ket_notif', 'finish');
		$this->db->where('tb_notifwa_ts.sts_notif', '1');
		$query = $this->db->get_where();
		if ($query === FALSE) {
			$error = $this->db->error();
			$error_message = $error['message']; // Mengambil pesan kesalahan dari array

			// Tampilkan pesan kesalahan
			echo "Database Error: " . $error_message;
		}
		return $query;
	}

	//Get data Email
	public function getdataemail()
	{
		return $this->db->get_where('tb_email')->row_array();
	}

	//AMBIL CONFIG Email
	public function dataemail()
	{
		$query = $this->db->get('tb_email');
		return $query->row();
	}

	//Get data Division Option
	public function getdivision()
	{
		$this->db->where('sts_div', '1');
		$query = $this->db->get_where('tb_division');
		return $query->result();
	}

	//Get data Division Option
	public function getdivisioncat()
	{
		$this->db->where('sts_div', '1');
		$this->db->where_not_in('id_div', '1');
		$query = $this->db->get_where('tb_division');
		return $query->result();
	}

	//Get data Category Option
	public function getcategory($id_div)
	{
	}

	//Get data Division Option Guest
	public function getdivision2()
	{
		$this->db->where('sts_div', '1');
		$this->db->where_not_in('id_div', '1');
		$query = $this->db->get_where('tb_division');
		return $query->result();
	}

	//AMBIL CONFIG WA Group
	public function wgconfig($loc, $div)
	{
		$this->db->where('id_loc', $loc);
		$this->db->where('id_div', $div);
		$query = $this->db->get_where('tb_wagroup');
		return $query->row();
	}

	//AMBIL CONFIG Ticket
	public function tickconfig($noticket)
	{
		$this->db->select('tb_ticket.*, tb_division.nama_div, tb_location.nama_loc, tb_department.nama_dept, tb_category.nama_cat, tb_wagroup.token_wagroup');
		$this->db->from('tb_ticket');
		$this->db->join('tb_division', 'tb_division.id_div = tb_ticket.id_div');
		$this->db->join('tb_location', 'tb_location.id_loc = tb_ticket.id_loc');
		$this->db->join('tb_wagroup', 'tb_wagroup.id_div = tb_ticket.id_div');
		$this->db->join('tb_department', 'tb_department.id_dept = tb_ticket.id_dept');
		$this->db->join('tb_category', 'tb_category.id_cat = tb_ticket.id_cat');
		$this->db->where('tb_ticket.no_ticket', $noticket);
		$query = $this->db->get();
		return $query->row();
	}

	public function tickconfig2($noticket)
	{
		$this->db->select('tb_ticket.*, tb_division.nama_div, tb_location.nama_loc, tb_department.nama_dept, tb_category.nama_cat, tb_wagroup.token_wagroup, tb_user.nama_user');
		$this->db->from('tb_ticket');
		$this->db->join('tb_division', 'tb_division.id_div = tb_ticket.id_div');
		$this->db->join('tb_location', 'tb_location.id_loc = tb_ticket.id_loc');
		$this->db->join('tb_wagroup', 'tb_wagroup.id_div = tb_ticket.id_div');
		$this->db->join('tb_department', 'tb_department.id_dept = tb_ticket.id_dept');
		$this->db->join('tb_user', 'tb_user.id_user = tb_ticket.id_user');
		$this->db->join('tb_category', 'tb_category.id_cat = tb_ticket.id_cat');
		$this->db->where('tb_ticket.no_ticket', $noticket);
		$query = $this->db->get();
		return $query->row();
	}

	//AMBIL CONFIG Department
	public function deptconfig($dept)
	{
		$this->db->where('id_dept', $dept);
		$query = $this->db->get_where('tb_divisi');
		return $query->row();
	}

	//Get data Akses Option
	public function getakses()
	{
		$this->db->where('sts_akses', '1');
		$query = $this->db->get_where('tb_akses');
		return $query->result();
	}

	//Get data Location Option
	public function getlocation()
	{
		$this->db->where('sts_loc', '1');
		$query = $this->db->get_where('tb_location');
		return $query->result();
	}

	//Get data Location Option guest
	public function getlocation2()
	{
		$this->db->where('sts_loc', '1');
		$this->db->where_not_in('id_loc', '1');
		$query = $this->db->get_where('tb_location');
		return $query->result();
	}

	//Get data Department Option
	public function getdepartment()
	{
		$this->db->where('sts_dept', '1');
		$query = $this->db->get_where('tb_department');
		return $query->result();
	}

	//Model Data Lokasi
	public function data_lokasi()
	{
		$this->db->get('tb_location');
		$this->db->where_not_in('sts_loc', '3');
		$this->db->where_not_in('id_loc', '1');
		$lokasi = $this->db->get_where('tb_location');
		return $lokasi;
	}

	public function dataloc($id_loc)
	{
		$this->db->get('tb_location');
		$this->db->where('id_loc', $id_loc);
		$lokasi = $this->db->get_where('tb_location');
		return $lokasi;
	}

	//Model Data WA Grup
	public function data_wagroup()
	{
		$this->db->get('tb_wagroup');
		$this->db->join('tb_division', 'tb_division.id_div = tb_wagroup.id_div');
		$this->db->join('tb_location', 'tb_location.id_loc = tb_wagroup.id_loc');
		$this->db->where_not_in('sts_wagroup', '3');
		$wagroup = $this->db->get_where('tb_wagroup');
		return $wagroup;
	}

	public function datawagroup($id_wagroup)
	{
		$this->db->get('tb_wagroup');
		$this->db->join('tb_division', 'tb_division.id_div = tb_wagroup.id_div');
		$this->db->join('tb_location', 'tb_location.id_loc = tb_wagroup.id_loc');
		$this->db->where('id_wagroup', $id_wagroup);
		$wagroup = $this->db->get_where('tb_wagroup');
		return $wagroup;
	}

	//Model Data Divisi
	public function data_divisi()
	{
		$this->db->get('tb_division');
		$this->db->where_not_in('sts_div', '3');
		$this->db->where_not_in('id_div', '1');
		$divisi = $this->db->get_where('tb_division');
		return $divisi;
	}

	public function datadiv($id_div)
	{
		$this->db->get('tb_division');
		$this->db->where('id_div', $id_div);
		$divisi = $this->db->get_where('tb_division');
		return $divisi;
	}

	//Model Data Departemen
	public function data_dept()
	{
		$this->db->get('tb_department');
		$this->db->where_not_in('sts_dept', '3');
		$dept = $this->db->get_where('tb_department');
		return $dept;
	}

	public function datadept($id_dept)
	{
		$this->db->get('tb_department');
		$this->db->where('id_dept', $id_dept);
		$dept = $this->db->get_where('tb_department');
		return $dept;
	}

	// Model Data User
	public function data_user()
	{
		$this->db->get('tb_user');
		$this->db->join('tb_division', 'tb_division.id_div = tb_user.id_div');
		$this->db->join('tb_akses', 'tb_akses.id_akses = tb_user.id_akses');
		$this->db->join('tb_location', 'tb_location.id_loc = tb_user.id_loc');
		$this->db->where_not_in('sts_user', '3');
		$this->db->where_not_in('id_user', '1');
		$user = $this->db->get_where('tb_user');
		return $user;
	}

	public function datauser($id_user)
	{
		$this->db->get('tb_user');
		$this->db->join('tb_division', 'tb_division.id_div = tb_user.id_div');
		$this->db->join('tb_akses', 'tb_akses.id_akses = tb_user.id_akses');
		$this->db->join('tb_location', 'tb_location.id_loc = tb_user.id_loc');
		$this->db->where_not_in('sts_user', '3');
		$this->db->where_not_in('id_user', '1');
		$this->db->where('id_user', $id_user);
		$user = $this->db->get_where('tb_user');
		return $user;
	}

	//Model Data Category
	public function data_cat()
	{
		$this->db->get('tb_category');
		$this->db->join('tb_division', 'tb_division.id_div = tb_category.id_div');
		$this->db->where_not_in('sts_cat', '3');
		$cat = $this->db->get_where('tb_category');
		return $cat;
	}

	public function datacat($id_cat)
	{
		$this->db->get('tb_category');
		$this->db->join('tb_division', 'tb_division.id_div = tb_category.id_div');
		$this->db->where('id_cat', $id_cat);
		$cat = $this->db->get_where('tb_category');
		return $cat;
	}

	// Model Data Klien
	public function data_klien()
	{
		$this->db->get('tb_client');
		$this->db->join('tb_department', 'tb_department.id_dept = tb_client.id_dept');
		$this->db->join('tb_location', 'tb_location.id_loc = tb_client.id_loc');
		$this->db->where_not_in('sts_client', '3');
		$klien = $this->db->get_where('tb_client');
		return $klien;
	}

	public function dataklien($id_client)
	{
		$this->db->get('tb_client');
		$this->db->join('tb_department', 'tb_department.id_dept = tb_client.id_dept');
		$this->db->join('tb_location', 'tb_location.id_loc = tb_client.id_loc');
		$this->db->where_not_in('sts_client', '3');
		$this->db->where('id_client', $id_client);
		$klien = $this->db->get_where('tb_client');
		return $klien;
	}

	// Model Data Ticket
	public function data_ticketopen()
	{
		$akses 	= $this->session->userdata('id_akses');
		$div 	= $this->session->userdata('id_div');
		$loc 	= $this->session->userdata('id_loc');

		if ($akses == 1) {
			$this->db->join('tb_division', 'tb_division.id_div = tb_ticket.id_div');
			$this->db->join('tb_location', 'tb_location.id_loc = tb_ticket.id_loc');
			$this->db->join('tb_department', 'tb_department.id_dept = tb_ticket.id_dept');
			$this->db->join('tb_category', 'tb_category.id_cat = tb_ticket.id_cat');
			$this->db->where('tb_ticket.sts_ticket', '1');
			$ticket = $this->db->get_where('tb_ticket');
			return $ticket;
		} elseif ($akses == 2) {
			$this->db->join('tb_division', 'tb_division.id_div = tb_ticket.id_div');
			$this->db->join('tb_location', 'tb_location.id_loc = tb_ticket.id_loc');
			$this->db->join('tb_department', 'tb_department.id_dept = tb_ticket.id_dept');
			$this->db->join('tb_category', 'tb_category.id_cat = tb_ticket.id_cat');
			$this->db->where('tb_ticket.sts_ticket', '1');
			$this->db->where('tb_ticket.id_div', $div);
			$ticket = $this->db->get_where('tb_ticket');
			return $ticket;
		} elseif ($akses == 3) {
			$this->db->join('tb_division', 'tb_division.id_div = tb_ticket.id_div');
			$this->db->join('tb_location', 'tb_location.id_loc = tb_ticket.id_loc');
			$this->db->join('tb_department', 'tb_department.id_dept = tb_ticket.id_dept');
			$this->db->join('tb_category', 'tb_category.id_cat = tb_ticket.id_cat');
			$this->db->where('tb_ticket.sts_ticket', '1');
			$this->db->where('tb_ticket.id_div', $div);
			$this->db->where('tb_ticket.id_loc', $loc);
			$ticket = $this->db->get_where('tb_ticket');
			return $ticket;
		}
	}

	public function dataticketopen($id_ticket)
	{
		$akses 	= $this->session->userdata('id_akses');
		$div 	= $this->session->userdata('id_div');
		$loc 	= $this->session->userdata('id_loc');

		if ($akses == 1) {
			$this->db->join('tb_division', 'tb_division.id_div = tb_ticket.id_div');
			$this->db->join('tb_location', 'tb_location.id_loc = tb_ticket.id_loc');
			$this->db->join('tb_department', 'tb_department.id_dept = tb_ticket.id_dept');
			$this->db->join('tb_category', 'tb_category.id_cat = tb_ticket.id_cat');
			$this->db->where('tb_ticket.id_ticket', $id_ticket);
			$ticket = $this->db->get_where('tb_ticket');
			return $ticket;
		} elseif ($akses == 2) {
			$this->db->join('tb_division', 'tb_division.id_div = tb_ticket.id_div');
			$this->db->join('tb_location', 'tb_location.id_loc = tb_ticket.id_loc');
			$this->db->join('tb_department', 'tb_department.id_dept = tb_ticket.id_dept');
			$this->db->join('tb_category', 'tb_category.id_cat = tb_ticket.id_cat');
			$this->db->where('tb_ticket.id_div', $div);
			$this->db->where('tb_ticket.id_ticket', $id_ticket);
			$ticket = $this->db->get_where('tb_ticket');
			return $ticket;
		} elseif ($akses == 3) {
			$this->db->join('tb_division', 'tb_division.id_div = tb_ticket.id_div');
			$this->db->join('tb_location', 'tb_location.id_loc = tb_ticket.id_loc');
			$this->db->join('tb_department', 'tb_department.id_dept = tb_ticket.id_dept');
			$this->db->join('tb_category', 'tb_category.id_cat = tb_ticket.id_cat');
			$this->db->where('tb_ticket.id_div', $div);
			$this->db->where('tb_ticket.id_loc', $loc);
			$this->db->where('tb_ticket.id_ticket', $id_ticket);
			$ticket = $this->db->get_where('tb_ticket');
			return $ticket;
		}
	}

	public function dataticketopendetail($id_ticket)
	{
		$this->db->join('tb_division', 'tb_division.id_div = tb_ticket.id_div');
		$this->db->join('tb_location', 'tb_location.id_loc = tb_ticket.id_loc');
		$this->db->join('tb_department', 'tb_department.id_dept = tb_ticket.id_dept');
		$this->db->join('tb_category', 'tb_category.id_cat = tb_ticket.id_cat');
		$this->db->where('tb_ticket.id_ticket', $id_ticket);
		$ticket = $this->db->get_where('tb_ticket');
		return $ticket;
	}

	public function data_ticketproses()
	{
		$akses 	= $this->session->userdata('id_akses');
		$div 	= $this->session->userdata('id_div');
		$loc 	= $this->session->userdata('id_loc');

		if ($akses == 1) {
			$this->db->join('tb_division', 'tb_division.id_div = tb_ticket.id_div');
			$this->db->join('tb_location', 'tb_location.id_loc = tb_ticket.id_loc');
			$this->db->join('tb_department', 'tb_department.id_dept = tb_ticket.id_dept');
			$this->db->join('tb_category', 'tb_category.id_cat = tb_ticket.id_cat');
			$this->db->join('tb_user', 'tb_user.id_user = tb_ticket.id_user');
			$this->db->where('tb_ticket.sts_ticket', '2');
			$ticket = $this->db->get_where('tb_ticket');
			return $ticket;
		} elseif ($akses == 2) {
			$this->db->join('tb_division', 'tb_division.id_div = tb_ticket.id_div');
			$this->db->join('tb_location', 'tb_location.id_loc = tb_ticket.id_loc');
			$this->db->join('tb_department', 'tb_department.id_dept = tb_ticket.id_dept');
			$this->db->join('tb_category', 'tb_category.id_cat = tb_ticket.id_cat');
			$this->db->join('tb_user', 'tb_user.id_user = tb_ticket.id_user');
			$this->db->where('tb_ticket.sts_ticket', '2');
			$this->db->where('tb_ticket.id_div', $div);
			$ticket = $this->db->get_where('tb_ticket');
			return $ticket;
		} elseif ($akses == 3) {
			$this->db->join('tb_division', 'tb_division.id_div = tb_ticket.id_div');
			$this->db->join('tb_location', 'tb_location.id_loc = tb_ticket.id_loc');
			$this->db->join('tb_department', 'tb_department.id_dept = tb_ticket.id_dept');
			$this->db->join('tb_category', 'tb_category.id_cat = tb_ticket.id_cat');
			$this->db->join('tb_user', 'tb_user.id_user = tb_ticket.id_user');
			$this->db->where('tb_ticket.sts_ticket', '2');
			$this->db->where('tb_ticket.id_div', $div);
			$this->db->where('tb_ticket.id_loc', $loc);
			$ticket = $this->db->get_where('tb_ticket');
			return $ticket;
		}
	}

	public function dataticketproses($id_ticket)
	{
		$akses 	= $this->session->userdata('id_akses');
		$div 	= $this->session->userdata('id_div');
		$loc 	= $this->session->userdata('id_loc');

		if ($akses == 1) {
			$this->db->join('tb_division', 'tb_division.id_div = tb_ticket.id_div');
			$this->db->join('tb_location', 'tb_location.id_loc = tb_ticket.id_loc');
			$this->db->join('tb_department', 'tb_department.id_dept = tb_ticket.id_dept');
			$this->db->join('tb_category', 'tb_category.id_cat = tb_ticket.id_cat');
			$this->db->join('tb_user', 'tb_user.id_user = tb_ticket.id_user');
			$this->db->where('tb_ticket.sts_ticket', '2');
			$this->db->where('tb_ticket.id_ticket', $id_ticket);
			$ticket = $this->db->get_where('tb_ticket');
			return $ticket;
		} elseif ($akses == 2) {
			$this->db->join('tb_division', 'tb_division.id_div = tb_ticket.id_div');
			$this->db->join('tb_location', 'tb_location.id_loc = tb_ticket.id_loc');
			$this->db->join('tb_department', 'tb_department.id_dept = tb_ticket.id_dept');
			$this->db->join('tb_category', 'tb_category.id_cat = tb_ticket.id_cat');
			$this->db->join('tb_user', 'tb_user.id_user = tb_ticket.id_user');
			$this->db->where('tb_ticket.sts_ticket', '2');
			$this->db->where('tb_ticket.id_div', $div);
			$this->db->where('tb_ticket.id_ticket', $id_ticket);
			$ticket = $this->db->get_where('tb_ticket');
			return $ticket;
		} elseif ($akses == 3) {
			$this->db->join('tb_division', 'tb_division.id_div = tb_ticket.id_div');
			$this->db->join('tb_location', 'tb_location.id_loc = tb_ticket.id_loc');
			$this->db->join('tb_department', 'tb_department.id_dept = tb_ticket.id_dept');
			$this->db->join('tb_category', 'tb_category.id_cat = tb_ticket.id_cat');
			$this->db->join('tb_user', 'tb_user.id_user = tb_ticket.id_user');
			$this->db->where('tb_ticket.sts_ticket', '2');
			$this->db->where('tb_ticket.id_div', $div);
			$this->db->where('tb_ticket.id_loc', $loc);
			$this->db->where('tb_ticket.id_ticket', $id_ticket);
			$ticket = $this->db->get_where('tb_ticket');
			return $ticket;
		}
	}

	public function all_data_report()
	{
		// return $this->db->get_where('tb_ticket')->row_array();
		$this->db->select('
			tb_ticket.id_ticket, 
			tb_ticket.no_ticket, 
			tb_ticket.nama_ticket, 
			tb_ticket.create_ticket, 
			tb_ticket.priority_ticket, 
			tb_ticket.exe_time,
			tb_ticket.finish_ticket, 
			tb_ticket.end_time, 
			tb_ticket.sts_ticket, 
			tb_location.nama_loc, 
			tb_category.nama_cat, 
			tb_user.nama_user');
		$this->db->join('tb_division', 'tb_division.id_div = tb_ticket.id_div');
		$this->db->join('tb_location', 'tb_location.id_loc = tb_ticket.id_loc');
		$this->db->join('tb_department', 'tb_department.id_dept = tb_ticket.id_dept');
		$this->db->join('tb_category', 'tb_category.id_cat = tb_ticket.id_cat');
		$this->db->join('tb_user', 'tb_user.id_user = tb_ticket.id_user');
		$ticket = $this->db->get_where('tb_ticket');
		return $ticket;
	}

	public function data_ticketselesai()
	{
		$akses 	= $this->session->userdata('id_akses');
		$div 	= $this->session->userdata('id_div');
		$loc 	= $this->session->userdata('id_loc');

		if ($akses == 1) {
			$this->db->select('tb_ticket.id_ticket, tb_ticket.no_ticket, tb_ticket.nama_ticket, tb_ticket.create_ticket, tb_ticket.priority_ticket, tb_ticket.exe_time,
			tb_ticket.finish_ticket, tb_ticket.end_time, tb_ticket.sts_ticket, tb_location.nama_loc, tb_category.nama_cat, tb_user.nama_user');
			$this->db->join('tb_division', 'tb_division.id_div = tb_ticket.id_div');
			$this->db->join('tb_location', 'tb_location.id_loc = tb_ticket.id_loc');
			$this->db->join('tb_department', 'tb_department.id_dept = tb_ticket.id_dept');
			$this->db->join('tb_category', 'tb_category.id_cat = tb_ticket.id_cat');
			$this->db->join('tb_user', 'tb_user.id_user = tb_ticket.id_user');
			$this->db->where('tb_ticket.sts_ticket', '3');
			$ticket = $this->db->get_where('tb_ticket');
			return $ticket;
		} elseif ($akses == 2) {
			$this->db->join('tb_division', 'tb_division.id_div = tb_ticket.id_div');
			$this->db->join('tb_location', 'tb_location.id_loc = tb_ticket.id_loc');
			$this->db->join('tb_department', 'tb_department.id_dept = tb_ticket.id_dept');
			$this->db->join('tb_category', 'tb_category.id_cat = tb_ticket.id_cat');
			$this->db->join('tb_user', 'tb_user.id_user = tb_ticket.id_user');
			$this->db->where('tb_ticket.sts_ticket', '3');
			$this->db->where('tb_ticket.id_div', $div);
			$ticket = $this->db->get_where('tb_ticket');
			return $ticket;
		} elseif ($akses == 3) {
			$this->db->join('tb_division', 'tb_division.id_div = tb_ticket.id_div');
			$this->db->join('tb_location', 'tb_location.id_loc = tb_ticket.id_loc');
			$this->db->join('tb_department', 'tb_department.id_dept = tb_ticket.id_dept');
			$this->db->join('tb_category', 'tb_category.id_cat = tb_ticket.id_cat');
			$this->db->join('tb_user', 'tb_user.id_user = tb_ticket.id_user');
			$this->db->where('tb_ticket.sts_ticket', '3');
			$this->db->where('tb_ticket.id_div', $div);
			$this->db->where('tb_ticket.id_loc', $loc);
			$ticket = $this->db->get_where('tb_ticket');
			return $ticket;
		}
	}

	public function data_ticketreport()
	{
		$query = $this->db->query("SELECT * FROM tb_division WHERE nama_div");
		return $query->result();
	}

	public function dataticketselesai($id_ticket)
	{
		$akses 	= $this->session->userdata('id_akses');
		$div 	= $this->session->userdata('id_div');
		$loc 	= $this->session->userdata('id_loc');

		if ($akses == 1) {
			$this->db->join('tb_division', 'tb_division.id_div = tb_ticket.id_div');
			$this->db->join('tb_location', 'tb_location.id_loc = tb_ticket.id_loc');
			$this->db->join('tb_department', 'tb_department.id_dept = tb_ticket.id_dept');
			$this->db->join('tb_category', 'tb_category.id_cat = tb_ticket.id_cat');
			$this->db->join('tb_user', 'tb_user.id_user = tb_ticket.id_user');
			$this->db->where('tb_ticket.sts_ticket', '3');
			$this->db->where('tb_ticket.id_ticket', $id_ticket);
			$ticket = $this->db->get_where('tb_ticket');
			return $ticket;
		} elseif ($akses == 2) {
			$this->db->join('tb_division', 'tb_division.id_div = tb_ticket.id_div');
			$this->db->join('tb_location', 'tb_location.id_loc = tb_ticket.id_loc');
			$this->db->join('tb_department', 'tb_department.id_dept = tb_ticket.id_dept');
			$this->db->join('tb_category', 'tb_category.id_cat = tb_ticket.id_cat');
			$this->db->join('tb_user', 'tb_user.id_user = tb_ticket.id_user');
			$this->db->where('tb_ticket.sts_ticket', '3');
			$this->db->where('tb_ticket.id_div', $div);
			$this->db->where('tb_ticket.id_ticket', $id_ticket);
			$ticket = $this->db->get_where('tb_ticket');
			return $ticket;
		} elseif ($akses == 3) {
			$this->db->join('tb_division', 'tb_division.id_div = tb_ticket.id_div');
			$this->db->join('tb_location', 'tb_location.id_loc = tb_ticket.id_loc');
			$this->db->join('tb_department', 'tb_department.id_dept = tb_ticket.id_dept');
			$this->db->join('tb_category', 'tb_category.id_cat = tb_ticket.id_cat');
			$this->db->join('tb_user', 'tb_user.id_user = tb_ticket.id_user');
			$this->db->where('tb_ticket.sts_ticket', '3');
			$this->db->where('tb_ticket.id_div', $div);
			$this->db->where('tb_ticket.id_loc', $loc);
			$this->db->where('tb_ticket.id_ticket', $id_ticket);
			$ticket = $this->db->get_where('tb_ticket');
			return $ticket;
		}
	}

	public function tb_ticket($postData = null, $div)
	{
		if ($div == 1) {
			$response = array();

			## Read value
			$draw = $postData['draw'];
			$start = $postData['start'];
			$rowperpage = $postData['length']; // Rows display per page
			$columnIndex = $postData['order'][0]['column']; // Column index
			$columnName = $postData['columns'][$columnIndex]['data']; // Column name
			$columnSortOrder = $postData['order'][0]['dir']; // asc or desc
			$searchValue = $postData['search']['value']; // Search value

			## Search 
			$searchQuery = "";
			if ($searchValue != '') {
				$searchQuery = " (no_ticket like '%" . $searchValue . "%' 
						or
						nama_user like'%" . $searchValue . "%' 
						or  
						create_ticket like '%" . $searchValue . "%'
						or  
						nama_dept like '%" . $searchValue . "%') ";
			}


			## Total number of records without filtering
			$this->db->select('count(tb_ticket.id_ticket) as allcount');
			$this->db->where('sts_ticket', '3');
			$records = $this->db->get('tb_ticket')->result();
			$totalRecords = $records[0]->allcount;

			## Total number of record with filtering
			$this->db->select('count(tb_ticket.id_ticket) as allcount');
			$this->db->where('sts_ticket', '3');
			if ($searchQuery != '')
				$this->db->where($searchQuery);
			$records = $this->db->get('tb_ticket')->result();
			$totalRecordwithFilter = $records[0]->allcount;


			## Fetch records
			$this->db->select('tb_ticket.id_ticket, tb_ticket.no_ticket, tb_ticket.create_ticket, tb_ticket.priority_ticket, tb_ticket.nama_ticket, tb_ticket.exe_time,
			tb_ticket.finish_ticket, tb_ticket.end_time, tb_ticket.sts_ticket, tb_location.nama_loc, tb_category.nama_cat, tb_user.nama_user, tb_department.nama_dept, tb_division.nama_div');
			$this->db->from('tb_ticket');
			$this->db->join('tb_division', 'tb_division.id_div = tb_ticket.id_div');
			$this->db->join('tb_location', 'tb_location.id_loc = tb_ticket.id_loc');
			$this->db->join('tb_department', 'tb_department.id_dept = tb_ticket.id_dept');
			$this->db->join('tb_category', 'tb_category.id_cat = tb_ticket.id_cat');
			$this->db->join('tb_user', 'tb_user.id_user = tb_ticket.id_user');
			$this->db->where('tb_ticket.sts_ticket', '3');
			if ($searchQuery != '')
				$this->db->where($searchQuery);
			$this->db->order_by($columnName, $columnSortOrder);
			$this->db->limit($rowperpage, $start);
			$records = $this->db->get()->result();

			$data = array();

			foreach ($records as $record) {
				// Waktu Selesai
				$now = new DateTime($record->finish_ticket . '' . $record->end_time, new DateTimeZone('Asia/Jakarta'));

				// Waktu yang Anda miliki
				$yourDateTime = new DateTime('' . $record->exe_time . '', new DateTimeZone('Asia/Jakarta'));

				// Hitung selisih waktu
				$interval = $now->diff($yourDateTime);

				// Mendapatkan perbedaan jam
				$hours = $interval->h;

				// Mendapatkan perbedaan hari
				$days = $interval->days;

				if ($days > 0) {
					// Jika lebih dari satu hari, tampilkan perbedaan dalam hari
					$down_time = $days . ' hari';
				} elseif ($hours > 0) {
					// Jika lebih dari satu jam, tampilkan perbedaan dalam jam
					$down_time = $hours . ' jam';
				} else {
					// Jika kurang dari satu jam, tampilkan perbedaan dalam menit
					$down_time = $interval->i . ' menit';
				}
				// Query user input

				if ($record->priority_ticket == '1') {
					$priority = 'Low';
				} elseif ($record->priority_ticket == '2') {
					$priority = 'Normal';
				} elseif ($record->priority_ticket == '3') {
					$priority = 'High';
				}

				$data[] = array(
					"create_ticket"		=> tgl_indo($record->create_ticket),
					"no_ticket"			=> $record->no_ticket,
					"nama_ticket"		=> $record->nama_ticket,
					"nama_dept"			=> $record->nama_dept,
					"nama_loc"			=> $record->nama_loc,
					"nama_div"			=> $record->nama_div,
					"nama_cat"			=> $record->nama_cat,
					"priority_ticket"	=> $priority,
					"nama_user"			=> $record->nama_user,
					"down_time"			=> $down_time,
					"detail"			=> '<button type="button" class="btn btn-success btn-xs detail" data-ticket-id="' . $record->id_ticket . '" title="Deskripsi Ticket"><i class="fa fa-eye"></i> Detail</button>',
				);
			}

			## Response
			$response = array(
				"draw" => intval($draw),
				"iTotalRecords" => $totalRecords,
				"iTotalDisplayRecords" => $totalRecordwithFilter,
				"aaData" => $data
			);

			return $response;
		} else {
			$response = array();

			## Read value
			$draw = $postData['draw'];
			$start = $postData['start'];
			$rowperpage = $postData['length']; // Rows display per page
			$columnIndex = $postData['order'][0]['column']; // Column index
			$columnName = $postData['columns'][$columnIndex]['data']; // Column name
			$columnSortOrder = $postData['order'][0]['dir']; // asc or desc
			$searchValue = $postData['search']['value']; // Search value

			## Search 
			$searchQuery = "";
			if ($searchValue != '') {
				$searchQuery = " (no_ticket like '%" . $searchValue . "%' 
						or
						nama_user like'%" . $searchValue . "%' 
						or  
						create_ticket like '%" . $searchValue . "%'
						or  
						nama_dept like '%" . $searchValue . "%') ";
			}


			## Total number of records without filtering
			$this->db->select('count(tb_ticket.id_ticket) as allcount');
			$this->db->where('id_div', $div);
			$this->db->where('sts_ticket', '3');
			$records = $this->db->get('tb_ticket')->result();
			$totalRecords = $records[0]->allcount;

			## Total number of record with filtering
			$this->db->select('count(tb_ticket.id_ticket) as allcount');
			$this->db->where('id_div', $div);
			$this->db->where('sts_ticket', '3');
			if ($searchQuery != '')
				$this->db->where($searchQuery);
			$records = $this->db->get('tb_ticket')->result();
			$totalRecordwithFilter = $records[0]->allcount;


			## Fetch records
			$this->db->select('tb_ticket.id_ticket, tb_ticket.id_div, tb_ticket.no_ticket, tb_ticket.create_ticket, tb_ticket.priority_ticket, tb_ticket.nama_ticket, tb_ticket.exe_time,
			tb_ticket.finish_ticket, tb_ticket.end_time, tb_ticket.sts_ticket, tb_location.nama_loc, tb_category.nama_cat, tb_user.nama_user, tb_department.nama_dept, tb_division.nama_div');
			$this->db->from('tb_ticket');
			$this->db->join('tb_division', 'tb_division.id_div = tb_ticket.id_div');
			$this->db->join('tb_location', 'tb_location.id_loc = tb_ticket.id_loc');
			$this->db->join('tb_department', 'tb_department.id_dept = tb_ticket.id_dept');
			$this->db->join('tb_category', 'tb_category.id_cat = tb_ticket.id_cat');
			$this->db->join('tb_user', 'tb_user.id_user = tb_ticket.id_user');
			$this->db->where('tb_ticket.id_div', $div);
			$this->db->where('tb_ticket.sts_ticket', '3');
			if ($searchQuery != '')
				$this->db->where($searchQuery);
			$this->db->order_by($columnName, $columnSortOrder);
			$this->db->limit($rowperpage, $start);
			$records = $this->db->get()->result();

			$data = array();

			foreach ($records as $record) {
				// Waktu Selesai
				$now = new DateTime($record->finish_ticket . '' . $record->end_time, new DateTimeZone('Asia/Jakarta'));

				// Waktu yang Anda miliki
				$yourDateTime = new DateTime('' . $record->exe_time . '', new DateTimeZone('Asia/Jakarta'));

				// Hitung selisih waktu
				$interval = $now->diff($yourDateTime);

				// Mendapatkan perbedaan jam
				$hours = $interval->h;

				// Mendapatkan perbedaan hari
				$days = $interval->days;

				if ($days > 0) {
					// Jika lebih dari satu hari, tampilkan perbedaan dalam hari
					$down_time = $days . ' hari';
				} elseif ($hours > 0) {
					// Jika lebih dari satu jam, tampilkan perbedaan dalam jam
					$down_time = $hours . ' jam';
				} else {
					// Jika kurang dari satu jam, tampilkan perbedaan dalam menit
					$down_time = $interval->i . ' menit';
				}
				// end hitung downtime

				if ($record->priority_ticket == '1') {
					$priority = 'Low';
				} elseif ($record->priority_ticket == '2') {
					$priority = 'Normal';
				} elseif ($record->priority_ticket == '3') {
					$priority = 'High';
				}

				$data[] = array(
					"create_ticket"		=> tgl_indo($record->create_ticket),
					"no_ticket"			=> $record->no_ticket,
					"nama_ticket"		=> $record->nama_ticket,
					"nama_dept"			=> $record->nama_dept,
					"nama_loc"			=> $record->nama_loc,
					"nama_div"			=> $record->nama_div,
					"nama_cat"			=> $record->nama_cat,
					"priority_ticket"	=> $priority,
					"nama_user"			=> $record->nama_user,
					"down_time"			=> $down_time,
					"detail"			=> '<button type="button" class="btn btn-success btn-xs detail" data-ticket-id="' . $record->id_ticket . '" title="Deskripsi Ticket"><i class="fa fa-eye"></i> Detail</button>',
				);
			}

			## Response
			$response = array(
				"draw" => intval($draw),
				"iTotalRecords" => $totalRecords,
				"iTotalDisplayRecords" => $totalRecordwithFilter,
				"aaData" => $data
			);

			return $response;
		}
	}

	public function tb_ticketclient($postData = null, $client)
	{
		$response = array();

		## Read value
		$draw = $postData['draw'];
		$start = $postData['start'];
		$rowperpage = $postData['length']; // Rows display per page
		$columnIndex = $postData['order'][0]['column']; // Column index
		$columnName = $postData['columns'][$columnIndex]['data']; // Column name
		$columnSortOrder = $postData['order'][0]['dir']; // asc or desc
		$searchValue = $postData['search']['value']; // Search value

		## Search 
		$searchQuery = "";
		if ($searchValue != '') {
			$searchQuery = " (no_ticket like '%" . $searchValue . "%' 
						or
						nama_div like'%" . $searchValue . "%' 
						or  
						create_ticket like '%" . $searchValue . "%'
						or  
						nama_cat like '%" . $searchValue . "%') ";
		}
		## Total number of records without filtering
		$this->db->select('count(tb_ticket.id_ticket) as allcount');
		$this->db->where('id_client', $client);
		$records = $this->db->get('tb_ticket')->result();
		$totalRecords = $records[0]->allcount;

		## Total number of record with filtering
		$this->db->select('count(tb_ticket.id_ticket) as allcount');
		$this->db->where('id_client', $client);
		if ($searchQuery != '')
			$this->db->where($searchQuery);
		$records = $this->db->get('tb_ticket')->result();
		$totalRecordwithFilter = $records[0]->allcount;


		## Fetch records
		$this->db->select('tb_ticket.id_ticket,
						tb_ticket.id_client, 
						tb_ticket.no_ticket, 
						tb_ticket.create_ticket, 
						tb_ticket.priority_ticket, 
						tb_ticket.nama_ticket, 
						tb_ticket.exe_time,
						tb_ticket.finish_ticket, 
						tb_ticket.end_time,
						tb_ticket.sts_ticket, 
						tb_location.nama_loc, 
						tb_location.id_loc, 
						tb_category.nama_cat, 
						tb_department.id_dept, 
						tb_department.nama_dept, 
						tb_division.nama_div');
		$this->db->from('tb_ticket');
		$this->db->join('tb_division', 'tb_division.id_div = tb_ticket.id_div');
		$this->db->join('tb_location', 'tb_location.id_loc = tb_ticket.id_loc');
		$this->db->join('tb_department', 'tb_department.id_dept = tb_ticket.id_dept');
		$this->db->join('tb_category', 'tb_category.id_cat = tb_ticket.id_cat');
		$this->db->where('tb_ticket.id_client', $client);
		if ($searchQuery != '')
			$this->db->where($searchQuery);
		$this->db->order_by($columnName, $columnSortOrder);
		$this->db->limit($rowperpage, $start);
		$records = $this->db->get()->result();

		$data = array();
		foreach ($records as $record) {
			// Waktu Selesai
			$now = new DateTime($record->finish_ticket . '' . $record->end_time, new DateTimeZone('Asia/Jakarta'));

			// Waktu yang Anda miliki
			$yourDateTime = new DateTime('' . $record->exe_time . '', new DateTimeZone('Asia/Jakarta'));

			// Hitung selisih waktu
			$interval = $now->diff($yourDateTime);

			// Mendapatkan perbedaan jam
			$hours = $interval->h;

			// Mendapatkan perbedaan hari
			$days = $interval->days;

			if ($days > 0) {
				// Jika lebih dari satu hari, tampilkan perbedaan dalam hari
				$down_time = $days . ' hari';
			} elseif ($hours > 0) {
				// Jika lebih dari satu jam, tampilkan perbedaan dalam jam
				$down_time = $hours . ' jam';
			} else {
				// Jika kurang dari satu jam, tampilkan perbedaan dalam menit
				$down_time = $interval->i . ' menit';
			}
			// Query user input

			if ($record->priority_ticket == '1') {
				$priority = 'Low';
			} elseif ($record->priority_ticket == '2') {
				$priority = 'Normal';
			} elseif ($record->priority_ticket == '3') {
				$priority = 'High';
			}

			if ($record->sts_ticket == '1') {
				$sts = '<button type="button" class="btn btn-danger btn-xs" title="Open">Open</button>';
			} elseif ($record->sts_ticket == '2') {
				$sts = '<button type="button" class="btn btn-warning btn-xs timeline" data-ticket-id="' . $record->no_ticket . '" title="Proses">Proses</button>';
			} elseif ($record->sts_ticket == '3') {
				$sts = '<button type="button" class="btn btn-primary btn-xs timeline" data-ticket-id="' . $record->no_ticket . '" title="Selesai">Selesai</button>';
			}

			$data[] = array(
				"create_ticket"		=> tgl_indo($record->create_ticket),
				"no_ticket"			=> $record->no_ticket,
				"nama_div"			=> $record->nama_div,
				"nama_cat"			=> $record->nama_cat,
				"priority_ticket"	=> $priority,
				"down_time"			=> $down_time,
				"detail"			=> '<button type="button" class="btn btn-success btn-xs detail" data-ticket-id="' . $record->id_ticket . '" title="Deskripsi Ticket"><i class="fa fa-eye"></i> Detail</button>',
				"sts_ticket"		=> $sts,
				"aksi"				=> '<button type="button" class="btn btn-danger btn-xs delete" data-ticket-id="' . $record->id_ticket . '" title="Hapus Request"><i class="fa fa-trash"></i></button>',
			);
		}

		## Response
		$response = array(
			"draw" => intval($draw),
			"iTotalRecords" => $totalRecords,
			"iTotalDisplayRecords" => $totalRecordwithFilter,
			"aaData" => $data
		);

		return $response;
	}

	public function getticketdata()
	{
		$this->db->select('MONTH(create_ticket) AS bulan, COUNT(id_ticket) AS jumlah', FALSE);
		$this->db->from('tb_ticket');
		$this->db->where('YEAR(create_ticket)', date('Y'));
		$this->db->group_by('bulan');
		$query = $this->db->get();

		return $query->result();
	}
	public function getticketdataf()
	{
		$this->db->select('MONTH(create_ticket) AS bulan, COUNT(id_ticket) AS jumlah', FALSE);
		$this->db->from('tb_ticket');
		$this->db->where('YEAR(create_ticket)', date('Y'));
		$this->db->where('sts_ticket', '3');
		$this->db->group_by('bulan');
		$query = $this->db->get();

		return $query->result();
	}

	public function dataprogressticket($id_ticket)
	{
		$this->db->join('tb_ticket', 'tb_ticket.no_ticket = tb_progress.no_ticket');
		$this->db->join('tb_user', 'tb_user.id_user = tb_ticket.id_user');
		$this->db->where('tb_progress.no_ticket', $id_ticket);
		$progress = $this->db->get_where('tb_progress');
		return $progress;
	}

	public function filterbytanggal($where)
	{
		$query = $this->db->get_where('tb_ticket', $where);
		return $query->result();
	}

	// Contoh fungsi hapus di model
	public function deleteTicket($id_ticket)
	{
		$this->db->where('id_ticket', $id_ticket);
		$this->db->delete('tb_ticket'); // Gantilah nama_tabel dengan nama tabel Anda
	}
}
