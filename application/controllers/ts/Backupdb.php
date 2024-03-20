<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backupdb extends CI_Controller {

	public function index()
	{
		$this->m_security->adminsec();
		$this->load->dbutil();
        $db_name = 'backup-db-'.$this->db->database.'-on'.date("Y-m-d").'.sql';

        $prefs = array(
            'format'             => 'zip',
            'filename'           => $db_name,
            'add_insert'         => TRUE,
            'foreign_key_checks' => FALSE
        );

        $backup = $this->dbutil->backup($prefs);

        //$save = 'asset/db/'.$db_name;

        //$this->load->helper('file');
        //write_file($save, $backup);

        $this->load->helper('download');
        force_download($db_name, $backup);

    	}

}
