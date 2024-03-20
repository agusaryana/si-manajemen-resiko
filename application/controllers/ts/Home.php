<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
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
		$this->m_security->tssec();
		$data = [
			'title' 	=> 'Dashboard LED',
			'dataorg'	=> $this->m_data->getdataorg()
		];
		$this->load->view('ts/home', $data);
	}

	public function getticketdata()
	{
		// Panggil model untuk mengambil data tiket
		$ticketdata = $this->m_data->getticketdata();
		$ticketdataf = $this->m_data->getticketdataf();

		// Format data ke format yang bisa digunakan oleh Chart.js (JSON)
		$data = array(
			'labels' => array(),
			'data' => array(),
			'labelsf' => array(),
			'dataf' => array()
		);

		foreach ($ticketdata as $row) {
			$data['labels'][] = $row->bulan;
			$data['data'][] = $row->jumlah;
		}

		foreach ($ticketdataf as $row) {
			$data['labelsf'][] = $row->bulan;
			$data['dataf'][] = $row->jumlah;
		}

		echo json_encode($data);
	}
}
