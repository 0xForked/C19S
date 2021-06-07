<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Session session
 * @property CI_Form_validation form_validation
 * @property CI_Input input
 * @property Patient patient
 */
class PatientController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (!$this->session->is_logged_in) {
			redirect('login');
		}

		if (
			!(int)$this->session->role_id === USER_ROLE_ADMIN ||
			!(int)$this->session->role_id === USER_ROLE_INPUTOR
		) {
			redirect_with_alert(
				$this,
				'warning', 'home',
				'You does not have permission to do this action!');
		}

		$this->load->model('patient');
	}

	public function index()
	{
		$this->load->view('pages/dash/patients/index', [
			'title' => 'Data Pasien',
			'patients' => $this->patient->get()
		]);
	}

	public function show($id)
	{
		$this->form();

		if ($this->form_validation->run() === TRUE) {
			$action = $this->patient->update([
				'id' => $id,
				'name' => $this->input->post('name'),
				'place_of_birth' => $this->input->post('place_of_birth'),
				'date_of_birth' => $this->input->post('date_of_birth'),
				'nik' => $this->input->post('nik'),
				'address' => $this->input->post('address'),
				'gender' => $this->input->post('gender'),
				'phone' => $this->input->post('phone'),
			]);

			if (!$action) {
				redirect_with_alert(
					$this, 'danger', 'patients',
					"[FAILED] Update new patient, Something went wrong with database!"
				);

				return;
			}

			redirect_with_alert(
				$this, 'success', 'patients',
				"[SUCCESS] Update patient data"
			);
		} else {
			if(!empty($_POST)) {
				redirect_with_alert(
					$this, 'danger', "patients/$id",
					"[FAILED] Update new patient, All input form is required!"
				);

				return;
			}

			$this->load->view('pages/dash/patients/edit', [
				'title' => 'Data Detail Pasien',
				'patient' => $this->patient->findBy('id', $id)
			]);
		}
	}

	public function create()
	{
		$this->form();

		if ($this->form_validation->run() !== TRUE) {
			redirect_with_alert(
				$this, 'danger', 'patients',
				"[FAILED] Create new patient, All form input must not be empty!"
			);
			return;
		}

		$action = $this->patient->insert([
			'name' => $this->input->post('name'),
			'place_of_birth' => $this->input->post('place_of_birth'),
			'date_of_birth' => $this->input->post('date_of_birth'),
			'nik' => $this->input->post('nik'),
			'address' => $this->input->post('address'),
			'gender' => $this->input->post('gender'),
			'phone' => $this->input->post('phone'),
		]);

		if (!$action) {
			redirect_with_alert(
				$this, 'danger', 'patients',
				"[FAILED] Create new patient, Something went wrong with database!"
			);
			return;
		}

		redirect_with_alert(
			$this, 'success', 'patients',
			"[SUCCESS] Create new patient"
		);
	}

	public function destroy($id)
	{
		if (!$this->patient->delete($id)) {
			redirect_with_alert(
				$this, 'danger', 'patients',
				"[FAILED] Delete patient data"
			);

			return;
		}

		redirect_with_alert(
			$this, 'success', 'patients',
			"[SUCCESS] Delete patient data"
		);
	}

	private function form() {
		$this->form_validation->set_rules('nik', 'NIK', 'required');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('place_of_birth', 'Place of Birth', 'required');
		$this->form_validation->set_rules('date_of_birth', 'Date of Birth', 'required');
		$this->form_validation->set_rules('phone', 'Phone', 'required');
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
	}
}
