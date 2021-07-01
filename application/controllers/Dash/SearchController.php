<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SearchController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (!$this->session->is_logged_in) {
			redirect('login');
		}

		$this->load->model('sample');
		$this->load->model('patient');
	}

	public function index()
	{
		$query = $this->input->get('q');

		$samples = $this->sample->getWhere('code', $query, 'SEARCH');
		$patients = $this->patient->getWhere('name', $query, 'SEARCH');

		$this->load->view('pages/dash/search/index', [
			'title' => 'Pencarian Data',
			'query' => $query,
			'samples' => $samples,
			'patients' => $patients
		]);
	}
}
