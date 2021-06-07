<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Session session
 * @property CI_Form_validation form_validation
 * @property CI_Input input
 * @property Sample sample
 * @property Patient patient
 * @property Explanation explanation
 * @property Checkup checkup
 */
class SampleController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (!$this->session->is_logged_in) {
			redirect('login');
		}

		$this->load->model('sample');
		$this->load->model('patient');
		$this->load->model('explanation');
		$this->load->model('checkup');
	}

	public function index()
	{
		if (
			(int) $this->session->role_id === USER_ROLE_ADMIN ||
			(int) $this->session->role_id === USER_ROLE_INPUTOR
		) {
			$data = $this->sample->get();
		}

		if ((int) $this->session->role_id === USER_ROLE_LABELATOR) {
			$data = $this->sample->getWhere('status', 'ISSUED');
		}

		if ((int) $this->session->role_id === USER_ROLE_VALIDATOR) {
			$data = $this->sample->getWhere('status', 'LABELED');
		}

		$this->load->view('pages/dash/samples/index', [
			'title' => 'Sampel Pemeriksaan',
			'samples' => $data
		]);
	}

	public function create()
	{
		if(!empty($_POST)) {
			if (((int) $this->session->role_id === USER_ROLE_VALIDATOR) ||
				((int) $this->session->role_id === USER_ROLE_LABELATOR)
			) {
				redirect_with_alert(
					$this,
					'warning', 'home',
					'You does not have permission to do this action!');
			}

			$this->form();

			if ($this->form_validation->run() !== TRUE) {
				redirect_with_alert(
					$this, 'danger', 'samples/create',
					"[FAILED] Create new sample, All form input must not be empty!"
				);
				return;
			}

			if (
				$this->input->post('patient_id') === 'NONE' ||
				$this->input->post('checkup_id') === 'NONE' ||
				$this->input->post('explanation_id') === 'NONE'
			) {
				redirect_with_alert(
					$this, 'danger', 'samples/create',
					"[FAILED] Create new sample, All form input must not be empty!"
				);
				return;
			}

			$action = $this->sample->insert([
				'patient_id' => $this->input->post('patient_id'),
				'checkup_id' => $this->input->post('checkup_id'),
				'explanation_id' => $this->input->post('explanation_id'),
				'code' => "USR" . $this->input->post('code'),
				'indications' => $this->input->post('indications'),
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s"),
			]);

			if (!$action) {
				redirect_with_alert(
					$this, 'danger', 'samples/create',
					"[FAILED] Create new sample, Something went wrong with database!"
				);
				return;
			}

			redirect_with_alert(
				$this, 'success', 'samples',
				"[SUCCESS] Create new sample"
			);
			return;
		}

		$this->load->view('pages/dash/samples/add', [
			'title' => 'Tambah Sampel Pemeriksaan',
			'patients' => $this->patient->get(),
			'explanations' => $this->explanation->get(),
			'checkups' => $this->checkup->get()
		]);
	}

	public function show($id)
	{
		if(!empty($_POST)) {
			if (((int)$this->session->role_id === USER_ROLE_VALIDATOR) ||
				((int)$this->session->role_id === USER_ROLE_LABELATOR)
			) {
				redirect_with_alert(
					$this,
					'warning', 'home',
					'You does not have permission to do this action!');
			}

			$this->form();

			if ($this->form_validation->run() !== TRUE) {
				redirect_with_alert(
					$this, 'danger', "samples/$id",
					"[FAILED] Update sample, All form input must not be empty!"
				);
				return;
			}

			$action = $this->sample->update([
				'id' => $id,
				'patient_id' => $this->input->post('patient_id'),
				'checkup_id' => $this->input->post('checkup_id'),
				'explanation_id' => $this->input->post('explanation_id'),
				'code' => "USR" . $this->input->post('code'),
				'indications' => $this->input->post('indications'),
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s"),
			]);

			if (!$action) {
				redirect_with_alert(
					$this, 'danger', "samples/$id",
					"[FAILED] Update sample, Something went wrong with database!"
				);
				return;
			}

			redirect_with_alert(
				$this, 'success', 'samples',
				"[SUCCESS] Update sample"
			);
			return;
		}

		$this->load->view('pages/dash/samples/edit', [
			'title' => 'Perbaharui Sampel Data',
			'sample' => $this->sample->findBy('samples.id', $id),
			'patients' => $this->patient->get(),
			'explanations' => $this->explanation->get(),
			'checkups' => $this->checkup->get()
		]);
	}

	public function destroy($id)
	{
		if (((int) $this->session->role_id === USER_ROLE_VALIDATOR) ||
			((int) $this->session->role_id === USER_ROLE_LABELATOR)
		) {
			redirect_with_alert(
				$this,
				'warning', 'home',
				'You does not have permission to do this action!');
		}

		if (!$this->sample->delete($id)) {
			redirect_with_alert(
				$this, 'danger', 'samples',
				"[FAILED] Delete sample data"
			);

			return;
		}

		redirect_with_alert(
			$this, 'success', 'samples',
			"[SUCCESS] Delete sample data"
		);
	}

	public function labeled()
	{
		if (empty($this->input->post('id'))) {
			redirect_with_alert(
				$this, 'danger', 'samples',
				"[FAILED] Labeled sample data"
			);

			return;
		}

		if (empty($this->input->post('label_status')) ||
			$this->input->post('label_status') === 'NONE'
		) {
			redirect_with_alert(
				$this, 'danger', 'samples',
				"[FAILED] Labeled sample data, please select label type!"
			);

			return;
		}

		$action = $this->sample->update([
			'id' => $this->input->post('id'),
			'STATUS' => 'LABELED',
			'label_status' => $this->input->post('label_status'),
			'updated_at' => date("Y-m-d H:i:s"),
		]);

		if (!$action) {
			redirect_with_alert(
				$this, 'danger', "samples",
				"[FAILED] Labeled sample data, Something went wrong with database!"
			);
			return;
		}

		redirect_with_alert(
			$this, 'success', 'samples',
			"[SUCCESS] Labeled sample data"
		);
	}

	public function verified()
	{
		if (empty($this->input->post('id'))) {
			redirect_with_alert(
				$this, 'danger', 'samples',
				"[FAILED] Verified sample data"
			);

			return;
		}

		if (empty($this->input->post('verify_status')) ||
			$this->input->post('verify_status') === 'NONE'
		) {
			redirect_with_alert(
				$this, 'danger', 'samples',
				"[FAILED] Verified sample data, please select verification status!"
			);

			return;
		}

		$action = $this->sample->update([
			'id' => $this->input->post('id'),
			'STATUS' => 'VERIFIED',
			'verify_status' => $this->input->post('verify_status'),
			'updated_at' => date("Y-m-d H:i:s"),
		]);

		if (!$action) {
			redirect_with_alert(
				$this, 'danger', "samples",
				"[FAILED] Verified sample data, Something went wrong with database!"
			);
			return;
		}

		redirect_with_alert(
			$this, 'success', 'samples',
			"[SUCCESS] Verified sample data"
		);
	}

	public function print($id)
	{
		$this->load->view('pages/dash/samples/print', [
			'title' => 'Print Sample',
			'sample' => $this->sample->findBy('samples.id', $id),
		]);
	}

	private function form() {
		$this->form_validation->set_rules('patient_id', 'NIK', 'required');
		$this->form_validation->set_rules('checkup_id', 'Name', 'required');
		$this->form_validation->set_rules('explanation_id', 'Place of Birth', 'required');
		$this->form_validation->set_rules('code', 'Date of Birth', 'required');
		$this->form_validation->set_rules('indications', 'Phone', 'required');
	}
}
