<?php defined('BASEPATH') or exit('No direct script access allowed');

class Explanation extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get()
	{
		return $this->db
			->select('id, title')
			->from('explanations')
			->get()
			->result();
	}

	public function findBy($key = NULL, $value = NULL)
	{
		$this->db->select('*')->from('explanations');
		if ($key && $value)  $this->db->where($key, $value); else show_404();
		return $this->db->get()->row();
	}

	public function insert($data)
	{
		return $this->db->insert('explanations', $data);
	}

	public function update($data)
	{
		return $this->db->update('explanations', $data, ['id' => $data['id']]);
	}

	public function delete($id)
	{
		if ($this->findBy('id', $id)) {
			return $this->db->delete('explanations', ['id' => $id]);
		}

		return FALSE;
	}

}
