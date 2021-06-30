<?php defined('BASEPATH') or exit('No direct script access allowed');

class Patient extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get()
	{
		return $this->db
			->select('*')
			->from('patients')
			->get()
			->result();
	}

	public function getWhere($key = NULL, $value = NULL, $type = 'BASIC')
	{
		$this->db
			->select('*')
			->from('patients');

		if ($type === 'BASIC') {
			$this->db->where($key, $value);
		} else {
			$this->db->like($key, $value);
			$this->db->or_like('nik', $value);
			$this->db->or_like('phone', $value);
			$this->db->or_like('name', $value);
		}

		return $this->db->get()->result();
	}

	public function findBy($key = NULL, $value = NULL)
	{
		$this->db->select('*')->from('patients');
		if ($key && $value)  $this->db->where($key, $value); else show_404();
		return $this->db->get()->row();
	}

	public function insert($data)
	{
		return $this->db->insert('patients', $data);
	}

	public function update($data)
	{
		return $this->db->update('patients', $data, ['id' => $data['id']]);
	}

	public function delete($id)
	{
		if ($this->findBy('id', $id)) {
			return $this->db->delete('patients', ['id' => $id]);
		}

		return FALSE;
	}

}
