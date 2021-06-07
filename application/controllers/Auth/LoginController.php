<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property  AuthenticateUsers auth
 * @property  CI_Session session
 */
class LoginController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library('AuthenticateUsers', NULL, 'auth');
	}

	public function index()
	{
		if ($this->auth->login()) {
			redirect_with_alert(
				$this, 'success', 'login',
				"Welcome back, {$this->session->full_name}!"
			);

			return;
		}

		$this->load->view('pages/auth/login', ['title' => 'login']);
	}
}
