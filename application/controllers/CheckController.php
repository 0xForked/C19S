<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class  CheckController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('sample');
	}

	public function index()
	{
		$query = $this->input->get('q');

		$sample = null;
		if ($query) {
			$sample = $this->sample->findBy('samples.code', $query);
		}

		$this->load->view('pages/check/index', [
			'title' => 'Cek Status',
			'sample' => $sample
		]);
	}
}
