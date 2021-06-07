<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Session session
 * @property CI_Input input
 * @property Explanation explanation
 */
class ReferencesExplanationController extends CI_Controller
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

		$this->load->model('explanation');
	}

	public function index()
	{
		$this->load->view('pages/dash/references/explanations/index', [
			'title' => 'Keterangan Swab',
			'explanations' => $this->explanation->get()
		]);
	}

	public function create()
	{
		if ($this->explanation->insert(['title' => $this->input->post('title')])) {
			redirect_with_alert(
				$this, 'success', 'references/explanations',
				"[SUCCESS] Create new explanation reference"
			);

			return;
		}

		redirect_with_alert(
			$this, 'danger', 'references/explanations',
			"[FAILED] Create new explanation reference"
		);
	}
}
