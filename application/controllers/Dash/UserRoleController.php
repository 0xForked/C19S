<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Session session
 * @property Role role
 */
class UserRoleController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (!$this->session->is_logged_in) {
			redirect('login');
		}

		if ((int)$this->session->role_id !== USER_ROLE_ADMIN) {
			redirect_with_alert(
				$this,
				'warning', 'home',
				'You does not have permission to do this action!');
		}

		$this->load->model('role');
	}

	public function index()
	{
		$roles = $this->role->get();

		$this->load->view('pages/dash/users/roles/index', [
			'title' => 'Peran Pengguna',
			'roles' => $roles
		]);
	}
}
