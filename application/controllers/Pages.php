<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MY_Controller {

	public function index()
	{
		$this->render_view('login', 'Login');
	}
}
