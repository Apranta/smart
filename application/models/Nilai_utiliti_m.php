<?php defined('BASEPATH') || exit('No direct script allowed');

class Nilai_utiliti_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'nilai_utiliti';
		$this->data['primary_key'] = 'id';
	}
}

