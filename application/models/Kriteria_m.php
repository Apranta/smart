<?php defined('BASEPATH') || exit('No direct script allowed');

class Kriteria_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'kriteria';
		$this->data['primary_key'] = 'id';
	}

	public function get_total($cond = '')
	{
		if (is_array($cond))
			$this->db->where($cond);
		if (is_string($cond) && strlen($cond) > 3)
			$this->db->where($cond);
		$this->db->group_by('gabungan');
        // $this->db->select_sum('bobot');
		$query = $this->db->get($this->data['table_name']);
		$total = 0;
		$q =  $query->result();
		foreach ($q as $v) {
			$total += $v->bobot;
		}
		return $total;
	}

	public function getGroupBy($cond = '')
	{
		if (is_array($cond))
			$this->db->where($cond);
		if (is_string($cond) && strlen($cond) > 3)
			$this->db->where($cond);
        $this->db->group_by('gabungan');
		$query = $this->db->get($this->data['table_name']);

		return $query->result();
	}
}

