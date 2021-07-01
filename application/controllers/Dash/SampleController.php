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
		// how to get date ??
		// $data[0]->logs['EXTRACTING']->created_at

		$this->load->view('pages/dash/samples/index', [
			'title' => 'Sampel Pemeriksaan',
			'samples' => $this->data()
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

		$description = (strtoupper($this->input->post('label_status')) === "PCR")
				? json_encode([
					"FAM" => $this->input->post('fam'),
					"Cy5" => $this->input->post('cy5'),
					"ROX" => $this->input->post('rox'),
					"JOE" => $this->input->post('joe'),
				])
				: NULL;

		$this->sample->makeLog([
			'sample_id' => $this->input->post('id'),
			'user_id' => $this->session->user_id,
			'status' => 'LABEL',
			'label' => strtoupper($this->input->post('label_status')),
			'description' => $description,
			'created_at' => date("Y-m-d H:i:s"),
		]);

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

		$this->sample->makeLog([
			'sample_id' => $this->input->post('id'),
			'user_id' => $this->session->user_id,
			'status' => 'VERIFY',
			'label' => strtoupper($this->input->post('verify_status')),
			'created_at' => date("Y-m-d H:i:s"),
		]);

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

	private function data()
	{
		$data = $this->sample->get();

		$index = 0;
		foreach ($data as $sample) {
			$logs = $this->sample->getLogs($sample->id);

			$log_data = [];
			foreach ($logs as $log) {
				$log_data[$log->label] = $log;
			}

			$data[$index]->logs = $log_data;
			$index++;
		}

		return $data;
	}

	public function exportCSV()
	{
		$file_name = time() . '_' . generate_random_string(16);
		$fp = fopen("export/csv/$file_name.csv", 'w');

		fputcsv($fp, array(
			'NO. SPESIMEN', 'NAMA', 'UMUR', 'TANGGAL SAMPLING', 'KETERANGAN SWAB',
			'TANGGAL PENERIMAAN SPESIMEN DILAB', 'TANGGAL PEMERIKSAAN SPESIMEN DILAB',
			'KESIMPULAN'
		));
		foreach ($this->data() as $field) {
			fputcsv($fp, array(
				'NO. SPESIMEN' => $field->code,
				'NAMA' => $field->patient_name,
				'UMUR' => calculate_age($field->patient_date_of_birth),
				'TANGGAL SAMPLING' => date('d-m-Y', strtotime($field->created_at)),
				'KETERANGAN SWAB' => $field->explanation_title,
				'TANGGAL PENERIMAAN SPESIMEN DILAB' => date('d-m-Y', strtotime($field->created_at)),
				'TANGGAL PEMERIKSAAN SPESIMEN DILAB' => date('d-m-Y', strtotime($field->created_at)),
				'KESIMPULAN' => "TEST"
			));
		}

		fclose($fp);
	}

	public function exportExcel()
	{

	}
}
