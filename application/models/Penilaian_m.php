<?php defined('BASEPATH') || exit('No direct script allowed');

class Penilaian_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'penilaian';
		$this->data['primary_key'] = 'id';
	}

	public function Total($id_pegawai)
	{
		$query = $this->db->query("SELECT SUM(bobot) AS total FROM `penilaian` JOIN nilai_kriteria ON penilaian.nilai = nilai_kriteria.id WHERE penilaian.id_pegawai= '$id_pegawai'");
		return $query->row();
	}
}

