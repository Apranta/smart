<?php defined('BASEPATH') || exit('No direct script allowed');

class Tes_tertulis_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'tes_tertulis';
		$this->data['primary_key'] = 'id';
	}

	public function getUtiliti($id_pegawai)
	{
		$nilai = $this->get_row(['id_pegawai' => $id_pegawai])->nilai;
		$uti = 0;
		if ($nilai <= 60)
			$uti = 0;
		elseif ($nilai > 61 && $nilai < 70)
			$uti = 0.25;
		elseif ($nilai > 71 && $nilai < 80)
			$uti = 0.5;
		elseif ($nilai > 81 && $nilai < 90)
			$uti = 0.75;
		elseif ($nilai > 91 && $nilai < 101)
			$uti = 1;
		return $uti;
	}
}

