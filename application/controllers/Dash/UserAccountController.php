<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Session session
 * @property CI_Input input
 * @property UserAccountAction action
 * @property User user
 * @property Role role
 */
class UserAccountController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (!$this->session->is_logged_in) {
			redirect('login');
		}

		$this->load->model('user');
		$this->load->model('role');

		$this->load->library('UserAccountAction', NULL, 'action');
	}

	public function index()
	{
		$this->load->view('pages/dash/users/accounts/index', [
			'title' => 'Akun Pengguna',
			'users' =>  $this->user->get(),
			'roles' => $this->role->get()
		]);
	}

	public function create()
	{
		if ($this->action->add()) {
			redirect_with_alert(
				$this, 'success', 'users/accounts',
				"[SUCCESS] Create new user account!"
			);

			return;
		}

		redirect_with_alert(
			$this, 'danger', 'users/accounts',
			"[FAILED] Create new user account, All form input must not be empty!"
		);
	}

	public function show($id)
	{
		if ($this->action->edit($id, $this->input->get('type'))) {
			redirect_with_alert(
				$this, 'success', 'users/accounts',
				"[SUCCESS] Update user account"
			);

			return;
		}

		$this->load->view('pages/dash/users/accounts/edit', [
			'title' => 'login',
			'user' => $this->user->findBy('id', $id),
			'roles' => $this->role->get()
		]);
	}

	public function destroy($id)
	{
		if (!$this->user->delete($id)) {
			redirect_with_alert(
				$this, 'danger', 'users/accounts',
				"[FAILED] Delete user account"
			);

			return;
		}

		redirect_with_alert(
			$this, 'success', 'users/accounts',
			"[SUCCESS] Delete user account"
		);
	}
}
