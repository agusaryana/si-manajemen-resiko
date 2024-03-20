<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_ticket extends CI_Model
{
	//Get data Organisasi
	public function insert($ticket)
	{
		$web 	  	    = base_url('troubleshoot');
		$waconfig 	    = $this->m_data->datawa();
		$emailconfig 	= $this->m_data->dataemail();

		//urai array
		$nama       		= $ticket['nama_ticket'];
		$noticket   		= $ticket['no_ticket'];
		$div        		= $ticket['id_div'];
		$loc        		= $ticket['id_loc'];
		$dept       		= $ticket['id_dept'];
		$cat        		= $ticket['id_cat'];
		$email      		= $ticket['email_ticket'];
		$tlp        		= $ticket['tlp_ticket'];
		$desk       		= $ticket['desk_ticket'];
		$jenis_transaksi	= $ticket['jenis_transaksi'];
		$durasi_kejadian	= $ticket['durasi_kejadian'];
		$tempat_kejadian	= $ticket['tempat_kejadian'];
		$faktor_penyebab	= $ticket['faktor_penyebab'];
		$potensi_kerugian	= $ticket['potensi_kerugian'];
		$nominal 			= $ticket['nominal'];
		$tgl_kejadian 		= $ticket['tgl_kejadian'];
		$nama_karyawan 		= $ticket['nama_karyawan'];
		$jam_mulai			= $ticket['jam_mulai'];
		$jam_selesai 		= $ticket['jam_selesai'];
		$durasi 			= $ticket['durasi'];
		$pejabat_penyetuju 	= $ticket['pejabat_penyetuju'];

		if ($waconfig->sts_wa == 1) {
			//whatsapp
			$token = $waconfig->token_wa;
			$phone = $this->input->post('tlp_user'); //untuk group pakai groupid contoh: 62812xxxxxx-xxxxx
			$message = "Halo Bapak/Ibu *" . $nama . "*,

Request anda telah kami terima dengan nomor: " . $noticket . "
Kami akan selalu memberitahukan update perkembangan progres melalui whatsapp ini.

Terima kasih.";

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
					'target' => $phone,
					'message' => $message,
					'countryCode' => '62', //optional
				),
				CURLOPT_HTTPHEADER => array(
					'Authorization: ' . $token . '' //change TOKEN to your actual token
				),
			));

			$response = curl_exec($curl);

			curl_close($curl);
		} else {
			$this->session->set_flashdata('message', 'Data berhasil disimpan, tapi gagal mengirim whatsapp');
			$this->session->set_flashdata('type', 'warning');
		}
	}
}
