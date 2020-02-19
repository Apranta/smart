<?php defined('BASEPATH') || exit('No direct script allowed');

class Direktur_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'direktur';
		$this->data['primary_key'] = 'id';
	}
}

