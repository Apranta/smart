<?php 

class Login_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']	= 'user';
		$this->data['primary_key']	= 'username';	
	}

	public function login($username, $password)
	{
		$user = $this->get_row(['username' => $username, 'password' => $password]);
		
		if ($user)
		{
			$this->session->set_userdata([
				'username'		=> $user->username,
				'role'	=> $user->role,
				'id' => $user->id_pegawai,
			]);
		}

		return $user;
	}
}