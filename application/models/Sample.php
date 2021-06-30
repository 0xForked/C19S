<?php defined('BASEPATH') or exit('No direct script access allowed');

class Sample extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get()
	{
		return $this->db
			->select(
				'samples.id, samples.patient_id, samples.checkup_id, '.
				'samples.explanation_id, samples.code, samples.indications, '.
				'samples.created_at, samples.updated_at, samples.status, '.
				'samples.verify_status, samples.label_status, '.
				'patients.id as patient_id, patients.name as patient_name, '.
				'patients.place_of_birth as patient_place_of_birth, '.
				'patients.date_of_birth as patient_date_of_birth, '.
				'patients.nik as patient_nik, patients.address as patient_address, '.
				'patients.gender as patient_gender, patients.phone as patient_phone, '.
				'explanations.id as explanation_id, explanations.title as explanation_title, '.
				'checkups.id as checkup_id, checkups.title as checkup_title, '
			)
			->from('samples')
			->join('patients', 'samples.patient_id = patients.id', 'left')
			->join('checkups', 'samples.checkup_id = checkups.id', 'left')
			->join('explanations', 'samples.explanation_id = explanations.id', 'left')
			->get()
			->result();
	}

	public function getWhere($key = NULL, $value = NULL, $type = 'BASIC')
	{
		$this->db
			->select(
				'samples.id, samples.patient_id, samples.checkup_id, '.
				'samples.explanation_id, samples.code, samples.indications, '.
				'samples.created_at, samples.updated_at, samples.status, '.
				'samples.verify_status, samples.label_status, '.
				'patients.id as patient_id, patients.name as patient_name, '.
				'patients.place_of_birth as patient_place_of_birth, '.
				'patients.date_of_birth as patient_date_of_birth, '.
				'patients.nik as patient_nik, patients.address as patient_address, '.
				'patients.gender as patient_gender, patients.phone as patient_phone, '.
				'explanations.id as explanation_id, explanations.title as explanation_title, '.
				'checkups.id as checkup_id, checkups.title as checkup_title, '
			)
			->from('samples')
			->join('patients', 'samples.patient_id = patients.id', 'left')
			->join('checkups', 'samples.checkup_id = checkups.id', 'left')
			->join('explanations', 'samples.explanation_id = explanations.id', 'left');

		if ($type === 'BASIC') {
			$this->db->where($key, $value);
		} else {
			$this->db->like($key, $value);
			$this->db->or_like('patients.nik', $value);
			$this->db->or_like('patients.phone', $value);
			$this->db->or_like('patients.name', $value);
		}

		return $this->db->get()->result();
	}

	public function findBy($key = NULL, $value = NULL)
	{
		$this->db->select(
			'samples.id, samples.patient_id, samples.checkup_id, '.
			'samples.explanation_id, samples.code, samples.indications, '.
			'samples.created_at, samples.updated_at, samples.status, '.
			'samples.verify_status, samples.label_status, '.
			'patients.id as patient_id, patients.name as patient_name, '.
			'patients.place_of_birth as patient_place_of_birth, '.
			'patients.date_of_birth as patient_date_of_birth, '.
			'patients.nik as patient_nik, patients.address as patient_address, '.
			'patients.gender as patient_gender, patients.phone as patient_phone, '.
			'explanations.id as explanation_id, explanations.title as explanation_title, '.
			'checkups.id as checkup_id, checkups.title as checkup_title, '
		)->from('samples')
			->join('patients', 'samples.patient_id = patients.id', 'left')
			->join('checkups', 'samples.checkup_id = checkups.id', 'left')
			->join('explanations', 'samples.explanation_id = explanations.id', 'left');
		if ($key && $value)  $this->db->where($key, $value); else show_404();
		return $this->db->get()->row();
	}

	public function insert($data)
	{
		return $this->db->insert('samples', $data);
	}

	public function update($data)
	{
		return $this->db->update('samples', $data, ['id' => $data['id']]);
	}

	public function delete($id)
	{
		if ($this->findBy('samples.id', $id)) {
			return $this->db->delete('samples', ['id' => $id]);
		}

		return FALSE;
	}

}
