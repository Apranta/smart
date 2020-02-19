<?php defined('BASEPATH') || exit('No direct script allowed');

class User_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'user';
		$this->data['primary_key'] = 'username';
	}
}

