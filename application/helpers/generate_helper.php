<?php

function noticket(){
    
    $ci = get_instance();
    $query = "SELECT max(no_reqpegawai) as maxKode FROM tb_reqpegawai";
    $data = $ci->db->query($query)->row_array();
    $kode = $data['maxKode'] ?? '';
    $noUrut = (int) substr($kode, 0, 6);
    $noUrut++;
    $bulan = date('n');
    $tahun = date('Y');
    $romawi = romawi_bulan($bulan);
    $char = "REQPEG";
    $nobaru = sprintf("%04s", $noUrut);
    $susun = $nobaru.'/'.$char.'/'.$romawi.'/'.$tahun;
    return $susun;
}

function generateid(){
    $ci = get_instance();
    $query = "SELECT max(id_pelamar) as maxKode FROM tb_pelamar";
    $data = $ci->db->query($query)->row_array();
    $kode = $data['maxKode'] ?? '';
    $noUrut = (int) substr($kode, 0, 8);
    $noUrut++;
    $nobaru = sprintf("%08s", $noUrut);
    $susun = $nobaru;
    return $susun;
}

function generate2(){
    $ci = get_instance();
    $query = "SELECT max(id_suratin) as agenda FROM tb_suratin";
    $data = $ci->db->query($query)->row_array();
    $kode = $data['agenda'];
    $noUrut = (int) substr($kode, 3, 6);
    $noUrut++;
    $nobaru = sprintf("%04s", $noUrut);
    return $nobaru;
}

function generate3(){
    $ci = get_instance();
    $query = "SELECT max(id_mou) as mou FROM tb_mou";
    $data = $ci->db->query($query)->row_array();
    $kode = $data['mou'];
    $noUrut = (int) substr($kode, 3, 6);
    $noUrut++;
    $nobaru = sprintf("%04s", $noUrut);
    return $nobaru;
}

?>
