<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Session session
 * @property CI_Input input
 * @property Checkup checkup
 */
class ReferenceCheckupController extends CI_Controller
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

		$this->load->model('checkup');
	}

	public function index()
	{
		$this->load->view('pages/dash/references/checkups/index', [
			'title' => 'Tujuan Pemeriksaan',
			'checkups' => $this->checkup->get()
		]);
	}

	public function create()
	{
		if ($this->checkup->insert(['title' => $this->input->post('title')])) {
			redirect_with_alert(
				$this, 'success', 'references/checkups',
				"[SUCCESS] Create new checkup reference"
			);

			return;
		}

		redirect_with_alert(
			$this, 'danger', 'references/checkups',
			"[FAILED] Create new checkups reference"
		);
	}
}
