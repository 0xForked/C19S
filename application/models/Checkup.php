<?php defined('BASEPATH') or exit('No direct script access allowed');

class Checkup extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get()
	{
		return $this->db
			->select('id, title, (SELECT COUNT(*) FROM samples WHERE checkup_id = checkups.id) as samples_count')
			->from('checkups')
			->get()
			->result();
	}

	public function findBy($key = NULL, $value = NULL)
	{
		$this->db->select('*')->from('checkups');
		if ($key && $value)  $this->db->where($key, $value); else show_404();
		return $this->db->get()->row();
	}

	public function insert($data)
	{
		return $this->db->insert('checkups', $data);
	}

	public function update($data)
	{
		return $this->db->update('checkups', $data, ['id' => $data['id']]);
	}

	public function delete($id)
	{
		if ($this->findBy('id', $id)) {
			return $this->db->delete('checkups', ['id' => $id]);
		}

		return FALSE;
	}

}
