<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property  CI_Session session
 */
class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if ($this->session->is_logged_in) {
			redirect('home');
			return;
		}

		redirect('login');
	}
}
