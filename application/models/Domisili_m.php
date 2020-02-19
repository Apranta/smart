<?php defined('BASEPATH') || exit('No direct script allowed');

class Domisili_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'domisili';
		$this->data['primary_key'] = 'id';
	}

	public function getUtiliti($id_pegawai)
	{
		$nilai = $this->get_row(['id_pegawai' => $id_pegawai])->nilai;
		$uti = 0;
		switch ($nilai) {
			case 100:
				$uti = 1;
				break;
			case 80:
				$uti = 0.75;
				break;
			case 60:
				$uti = 0.6;
				break;
			case 40:
				$uti = 0.4;
				break;
			case 20:
				$uti = 0.2;
				break;
			case 0:
				$uti = 0;
				break;
		}
		return $uti;
	}
}
