<?php defined('BASEPATH') or exit('No direct script access allowed');

class Role extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get()
	{
		return $this->db
			->select('id, title, (SELECT COUNT(*) FROM users WHERE role_id = roles.id) as users_count')
			->from('roles')
			->get()
			->result();
	}

	public function findBy($key = NULL, $value = NULL)
	{
		$this->db->select('*')->from('roles');
		if ($key && $value)  $this->db->where($key, $value); else show_404();
		return $this->db->get()->row();
	}

	public function insert($data)
	{
		return $this->db->insert('roles', $data);
	}

	public function update($data)
	{
		return $this->db->update('roles', $data, ['id' => $data['id']]);
	}

	public function delete($id)
	{
		if ($this->findBy('id', $id)) {
			return $this->db->delete('roles', ['id' => $id]);
		}

		return FALSE;
	}

}
