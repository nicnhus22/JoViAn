<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller {

	public function index()
	{
		$this->require_login();
		$this->render_view('my_profile', 'My Profile', array('user' => $this->get_active_user()));
	}

	public function show($id)
	{
		$this->require_login();
		$this->render_view('profile', 'User Profile', array('user' => $this->user_model->get($id)));
	}

	public function update()
	{
		$this->require_login();
		$active_user = $this->get_active_user();
		$this->user_model->update($active_user->id, $this->input->post());
		redirect('/profile', 'refresh');
	}

	public function candidates()
	{
		$this->require_login();
		$this->render_view('candidates', 'Candidates');
	}

}
