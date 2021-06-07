<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Session session
 */
class LogoutController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->session->sess_destroy();

		redirect(base_url("/"));
	}
}
