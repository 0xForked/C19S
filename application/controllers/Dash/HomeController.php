<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Session session
 * @property CI_DB_driver db
 */
class HomeController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (!$this->session->is_logged_in) {
			redirect('login');
		}
	}

	public function index()
	{
		$this->load->view('pages/dash/home/index', [
			'title' => 'Beranda',
			'total_users' => $this->db->query("SELECT * FROM users")->num_rows(),
			'total_patients' => $this->db->query("SELECT * FROM patients")->num_rows(),
			'total_samples' => $this->db->query("SELECT * FROM samples")->num_rows(),
		]);
	}
}
