<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get()
	{
		return $this->db
			->select('id, role_id, name, email, phone, password, status, (SELECT title FROM roles WHERE id = users.role_id) as role_title')
			->from('users')
			->get()
			->result();
	}

	public function find($id = NULL, $email = NULL)
	{
		$this->db->select('*')->from('users');
		if ($id)  $this->db->where('users.id', $id);
		if ($email) $this->db->where('users.email', $email);
		return $this->db->get()->row();
	}

	public function findBy($key = NULL, $value = NULL)
	{
		$this->db->select('*')->from('users');
		if ($key && $value)  $this->db->where($key, $value); else show_404();
		return $this->db->get()->row();
	}

	public function insert($data)
	{
		$data["password"] = password_hash(
			$data["password"],
			PASSWORD_BCRYPT,
			array('cost' => 12)
		);

		return $this->db->insert('users', $data);
	}

	public function update($data)
	{
		return $this->db->update('users', $data, ['id' => $data['id']]);
	}

	public function delete($id)
	{
		if ($this->find($id)) {
			return $this->db->delete('users', ['id' => $id]);
		}

		return FALSE;
	}
}
