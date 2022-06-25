<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//cek git

class Auth extends CI_Controller {

	public function index()
	{
		$this->load->view('Login');
	}

	public function login()
	{
                redirect('dashboard1');
	}

 public function logout()
	{
                redirect('Auth');
	}
}
