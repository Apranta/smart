<?php defined('BASEPATH') || exit('No direct script allowed');

class Nilai_kriteria_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'nilai_kriteria';
		$this->data['primary_key'] = 'id';
	}

	public function getBobot($cond='')
	{
		$paramater = $this->get(['kriteria' => $cond['id_kriteria']]);
		$nilai = $cond['nilai'];
		foreach ($paramater as $par) {
			if ($nilai >= $par->nilai_awal && $nilai <= $par->nilai_akhir) {
				# code...
				return $par->bobot;
			}
		}
		return 0;
	}

	public function getUtiliti($nilai , $id_kriteria)
	{
		$this->load->model('Kriteria_m');
			$max = $this->get_max(['kriteria' => $id_kriteria])->nilai;
			$min = $this->get_min(['kriteria' => $id_kriteria])->nilai;
			
			$hasil = ($nilai - $min) / ($max-$min);
			return $hasil;
	}

	public function get_max($cond = '')
	{
		if (is_array($cond))
			$this->db->where($cond);
		if (is_string($cond) && strlen($cond) > 3)
			$this->db->where($cond);
        $this->db->select_max('nilai');
		$query = $this->db->get($this->data['table_name']);

		return $query->row();
	}

	public function get_min($cond = '')
	{
		if (is_array($cond))
			$this->db->where($cond);
		if (is_string($cond) && strlen($cond) > 3)
			$this->db->where($cond);
        $this->db->select_min('nilai');
		$query = $this->db->get($this->data['table_name']);

		return $query->row();
	}

}

