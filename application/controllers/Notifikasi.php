<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notifikasi extends CI_Controller
{

	public function notifwa_clientopen()
	{
		$waconfig 	= $this->m_data->datawa();
		$notif      = $this->m_data->notifwa_clientopen()->result();

		if ($waconfig->sts_wa == 1) {
			foreach ($notif as $key) {
				//whatsapp
				$token      = $waconfig->token_wa;
				$phone      = $key->tlp_ticket; //untuk group pakai groupid contoh: 62812xxxxxx-xxxxx
				$message    = "Halo Bapak/Ibu *" . $key->nama_ticket . "*,

Terima kasih telah menghubungi kami, request anda telah kami terima dengan nomor : *" . $key->no_ticket . "*.
Kami akan selalu memberikan notifikasi progres penyelesaian request anda.

Terimakasih";

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
				$edit = array(
					'sts_notif' 					=> '2',
				);
				$this->db->where('no_ticket', $key->no_ticket);
				$this->db->where('ket_notif', 'open');
				$this->db->update('tb_notifwa_client', $edit);
			}
		} else {
			echo "Whatsapp tidak aktif";
		}
	}

	public function notifwa_clientproses()
	{
		$waconfig 	= $this->m_data->datawa();
		$notif      = $this->m_data->notifwa_clientproses()->result();

		if ($waconfig->sts_wa == 1) {
			foreach ($notif as $key) {
				//whatsapp
				$token      = $waconfig->token_wa;
				$phone      = $key->tlp_ticket; //untuk group pakai groupid contoh: 62812xxxxxx-xxxxx
				$message    = "Halo Bapak/Ibu *" . $key->nama_ticket . "*,

Request anda telah kami proses, unit penanggung jawab akan segera menangani permasalahan anda.
Berikut detailnya:

Nomor Request : *" . $key->no_ticket . "*
Unit Penanggung Jawab : *" . $key->nama_user . "*

Terimakasih";

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
				$edit = array(
					'sts_notif' 					=> '2',
				);
				$this->db->where('no_ticket', $key->no_ticket);
				$this->db->where('ket_notif', 'proses');
				$this->db->update('tb_notifwa_client', $edit);
			}
		} else {
			echo "Whatsapp tidak aktif";
		}
	}

	public function notifwa_clientselesai()
	{
		$waconfig 	= $this->m_data->datawa();
		$notif      = $this->m_data->notifwa_clientselesai()->result();

		if ($waconfig->sts_wa == 1) {
			foreach ($notif as $key) {
				//whatsapp
				$token      = $waconfig->token_wa;
				$phone      = $key->tlp_ticket; //untuk group pakai groupid contoh: 62812xxxxxx-xxxxx
				$message    = "Halo Bapak/Ibu *" . $key->nama_ticket . "*,

Request anda telah diselesaikan, dan menunggu approval BOD.
Berikut detailnya:

Nomor Request : *" . $key->no_ticket . "*
Unit Penanggung Jawab : *" . $key->nama_user . "*
Catatan : *" . $key->remark_ticket . "*

Mohon maaf atas kendala yang terjadi.
Jika masih ada kekurangan silakan hubungi unit penanggung jawab kembali.

Terimakasih";

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
				$edit = array(
					'sts_notif' 					=> '2',
				);
				$this->db->where('no_ticket', $key->no_ticket);
				$this->db->where('ket_notif', 'finish');
				$this->db->update('tb_notifwa_client', $edit);
			}
		} else {
			echo "Whatsapp tidak aktif";
		}
	}

	public function notifwa_tsopen()
	{
		$waconfig 	= $this->m_data->datawa();
		$notif      = $this->m_data->notifwa_tsopen()->result();


		if ($waconfig->sts_wa == 1) {
			foreach ($notif as $key) {
				//whatsapp
				$token      = $waconfig->token_wa;
				$phone      = $key->token_wagroup; //untuk group pakai groupid contoh: 62812xxxxxx-xxxxx
				$message    = "Dear Tim *" . $key->nama_div . "*,

Terlampir Request baru dengan detail sebagai berikut:

Nomor Request : *" . $key->no_ticket . "*
Nama Client : *" . $key->nama_ticket . "*
Department : *" . $key->nama_dept . "*
Lokasi : *" . $key->nama_loc . "*
Deskripsi : *" . $key->desk_ticket . "*

Mohon untuk segera dieksekusi untuk menghindari downtime yang terlalu lama.

Terimakasih";

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
				$edit = array(
					'sts_notif' 					=> '2',
				);
				$this->db->where('id_notifwa_ts', $key->id_notifwa_ts);
				$this->db->update('tb_notifwa_ts', $edit);
			}
		} else {
			echo "Whatsapp tidak aktif";
		}
	}

	public function notifwa_tsproses()
	{
		$waconfig 	= $this->m_data->datawa();
		$notif      = $this->m_data->notifwa_tsproses()->result();


		if ($waconfig->sts_wa == 1) {
			foreach ($notif as $key) {
				//whatsapp
				$token      = $waconfig->token_wa;
				$phone      = $key->token_wagroup; //untuk group pakai groupid contoh: 62812xxxxxx-xxxxx
				$message    = "Dear Tim *" . $key->nama_div . "*,

Nomor Request *" . $key->no_ticket . "* telah ditangani oleh *" . $key->nama_user . "*.

Terimakasih";

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
				$edit = array(
					'sts_notif' 					=> '2',
				);
				$this->db->where('id_notifwa_ts', $key->id_notifwa_ts);
				$this->db->update('tb_notifwa_ts', $edit);
			}
		} else {
			echo "Whatsapp tidak aktif";
		}
	}

	public function notifwa_tsselesai()
	{
		$waconfig 	= $this->m_data->datawa();
		$notif      = $this->m_data->notifwa_tsselesai()->result();


		if ($waconfig->sts_wa == 1) {
			foreach ($notif as $key) {
				//whatsapp
				$token      = $waconfig->token_wa;
				$phone      = $key->token_wagroup; //untuk group pakai groupid contoh: 62812xxxxxx-xxxxx
				$message    = "Dear Tim *" . $key->nama_div . "*,

Nomor Requeest *" . $key->no_ticket . "* telah diselesaikan oleh *" . $key->nama_user . "*.

Terimakasih";

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
				$edit = array(
					'sts_notif' 					=> '2',
				);
				$this->db->where('id_notifwa_ts', $key->id_notifwa_ts);
				$this->db->update('tb_notifwa_ts', $edit);
			}
		} else {
			echo "Whatsapp tidak aktif";
		}
	}

	public function notifemail_clientopen()
	{
		$emailconfig 	= $this->m_data->dataemail();
		$notif          = $this->m_data->notifemail_clientopen()->result();

		if ($emailconfig->sts_email == 1) {
			foreach ($notif as $key) {
				/** KONFIGURASI EMAIL */
				$this->load->library('email');
				$config = array();
				$config['charset'] = 'utf-8';
				$config['useragent'] = 'Codeigniter';
				$config['protocol'] = "smtp";
				$config['mailtype'] = "html";
				$config['smtp_host'] = $emailconfig->smtphost_email; //pengaturan smtp
				$config['smtp_port'] = $emailconfig->smtpport_email;
				$config['smtp_timeout'] = "400";
				$config['smtp_user'] = $emailconfig->alamat_email;; // isi dengan email kamu
				$config['smtp_pass'] = $emailconfig->pass_email;; // isi dengan password kamu
				$config['crlf'] = "\r\n";
				$config['newline'] = "\r\n";
				$config['wordwrap'] = TRUE;
				//memanggil library email dan set konfigurasi untuk pengiriman email
				$this->email->initialize($config);
				//konfigurasi pengiriman
				$this->email->from($config['smtp_user'], 'Ticket Helpdesk');
				$this->email->to($key->email_ticket);
				$this->email->subject("TICKET BERHASIL DIBUAT");
				$this->email->message("Dear " . $key->nama_ticket . ",<br>
            Terima kasih telah menghubungi kami, request anda telah kami terima dengan nomor *" . $key->no_ticket . "*.
            Kami akan selalu memberikan notifikasi progres penyelesaian masalah anda.<br>
            Terimakasih.");

				if ($this->email->send()) {
					$edit = array(
						'sts_notif' 					=> '2',
					);
					$this->db->where('no_ticket', $key->no_ticket);
					$this->db->where('ket_notif', 'open');
					$this->db->update('tb_notifemail_client', $edit);
				} else {
					echo "Gagal kirim email";
				};
			}
		} else {
			echo "Email tidak aktif";
		}
	}

	public function notifemail_clientproses()
	{
		$emailconfig 	= $this->m_data->dataemail();
		$notif          = $this->m_data->notifemail_clientproses()->result();

		if ($emailconfig->sts_email == 1) {
			foreach ($notif as $key) {
				/** KONFIGURASI EMAIL */
				$this->load->library('email');
				$config = array();
				$config['charset'] = 'utf-8';
				$config['useragent'] = 'Codeigniter';
				$config['protocol'] = "smtp";
				$config['mailtype'] = "html";
				$config['smtp_host'] = $emailconfig->smtphost_email; //pengaturan smtp
				$config['smtp_port'] = $emailconfig->smtpport_email;
				$config['smtp_timeout'] = "400";
				$config['smtp_user'] = $emailconfig->alamat_email;; // isi dengan email kamu
				$config['smtp_pass'] = $emailconfig->pass_email;; // isi dengan password kamu
				$config['crlf'] = "\r\n";
				$config['newline'] = "\r\n";
				$config['wordwrap'] = TRUE;
				//memanggil library email dan set konfigurasi untuk pengiriman email
				$this->email->initialize($config);
				//konfigurasi pengiriman
				$this->email->from($config['smtp_user'], 'Ticket Helpdesk');
				$this->email->to($key->email_ticket);
				$this->email->subject("TICKET ANDA TELAH DIEKSEKUSI TEKNISI");
				$this->email->message("Dear " . $key->nama_ticket . ",<br>
            Request anda telah kami proses, Unit Penanggung Jawab akan segera menghubungi anda.<br>
            Berikut detailnya:<br><br>
            Nomor Request : " . $key->no_ticket . "<br>
            Unit Penanggung Jawab : " . $key->nama_user . "<br><br>
            <br><br><br><br>
            Terimakasih");

				if ($this->email->send()) {
					$edit = array(
						'sts_notif' 					=> '2',
					);
					$this->db->where('no_ticket', $key->no_ticket);
					$this->db->where('ket_notif', 'proses');
					$this->db->update('tb_notifemail_client', $edit);
				} else {
					echo "Gagal kirim email";
				};
			}
		} else {
			echo "Email tidak aktif";
		}
	}

	public function notifemail_clientselesai()
	{
		$emailconfig 	= $this->m_data->dataemail();
		$notif          = $this->m_data->notifemail_clientfinish()->result();

		if ($emailconfig->sts_email == 1) {
			foreach ($notif as $key) {
				/** KONFIGURASI EMAIL */
				$this->load->library('email');
				$config = array();
				$config['charset'] = 'utf-8';
				$config['useragent'] = 'Codeigniter';
				$config['protocol'] = "smtp";
				$config['mailtype'] = "html";
				$config['smtp_host'] = $emailconfig->smtphost_email; //pengaturan smtp
				$config['smtp_port'] = $emailconfig->smtpport_email;
				$config['smtp_timeout'] = "400";
				$config['smtp_user'] = $emailconfig->alamat_email;; // isi dengan email kamu
				$config['smtp_pass'] = $emailconfig->pass_email;; // isi dengan password kamu
				$config['crlf'] = "\r\n";
				$config['newline'] = "\r\n";
				$config['wordwrap'] = TRUE;
				//memanggil library email dan set konfigurasi untuk pengiriman email
				$this->email->initialize($config);
				//konfigurasi pengiriman
				$this->email->from($config['smtp_user'], 'Ticket Helpdesk');
				$this->email->to($key->email_ticket);
				$this->email->subject("REQUEST ANDA TELAH DISELESAIKAN");
				$this->email->message("Dear " . $key->nama_ticket . ",<br>
            Request anda telah kami proses, kami akan segera menghubungi anda.<br>
            Berikut detailnya:<br><br>
            Nomor Request : " . $key->no_ticket . "<br>
            Unit Penanggung Jawab : " . $key->nama_user . "<br>
            Catatan : " . $key->remark_ticket . "<br>
            <br><br>
            Mohon maaf atas kendala yang terjadi.<br>
            Jika masih ada kekurangan, silakan hubungi unit penanggung jawab kembali.<br><br>
            Terimakasih");

				if ($this->email->send()) {
					$edit = array(
						'sts_notif' 					=> '2',
					);
					$this->db->where('no_ticket', $key->no_ticket);
					$this->db->where('ket_notif', 'finish');
					$this->db->update('tb_notifemail_client', $edit);
				} else {
					echo "Gagal kirim email";
				};
			}
		} else {
			echo "Email tidak aktif";
		}
	}
}
