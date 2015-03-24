<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

	public function login()
	{
		$username = $this->input->post('email');
		$password = $this->input->post('password');
		
		if ($user = $this->user_model->auth($username, $password)) {
			$_SESSION['active_user'] = $user->id;
			redirect('/profile/', 'refresh');
		}
		$_SESSION['messages']['error'][] = 'Login failed.';
		redirect('/', 'refresh');
	}

	public function signup() {
		$last_id = $this->user_model->insert($this->input->post());
		$_SESSION['active_user'] = $last_id;
		redirect('/profile', 'refresh');
	}

	public function logout()
	{
		unset($_SESSION['active_user']);
		redirect('/', 'refresh');
	}
}
