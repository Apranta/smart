<?php

class Register extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_m');
		$this->load->model('Pegawai_m');
	}

	public function index()
	{
		if ($this->POST('register')) {
			if ($this->POST('password') != $this->POST('repassword')) {
				$this->flashmsg('Password anda tidak sama','warning');
				redirect('register');
				exit;
			}
			if ($this->User_m->get_row(['username'=> $this->POST('email')])) {
				$this->flashmsg('Username anda sudah digunakan','warning');
				redirect('register');
				exit;
			}
			$this->data['login'] = [
				'username' => $this->POST('email'),
				'password'	=> md5($this->POST('password')),
				'role'	=> '3',
			];
			$this->data['user'] = [
				'email'	=> $this->POST('email'),
				'nama'		=> $this->POST('nama'),
				'tahun_penerimaan'     => date("Y")
			];
			$this->User_m->insert($this->data['login']);
			$this->Pegawai_m->insert($this->data['user']);
			$this->flashmsg('Silahkan Login Menggunakan Email dan Password yang telah anda daftarkan tadi','success');
			redirect('register');
			exit;
		}
		$this->data['title'] = 'Register' . $this->title;
		$this->load->view('register', $this->data);
	}
}
