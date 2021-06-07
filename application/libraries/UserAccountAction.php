<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property User user
 */
class UserAccountAction
{
	private $instance;

	private $data;

	public function __construct()
	{
		$this->instance =& get_instance();

		if (!(bool)$this->instance->session->is_logged_in) {
			redirect('login');
		}

		if ((int)$this->instance->session->role_id !== USER_ROLE_ADMIN) {
			redirect_with_alert(
				$this->instance,
				'warning', 'home',
				'You does not have permission to do this action!');
		}

		$this->instance->load->model('user');
	}

	public function add()
	{
		if ($this->validate()) {
			return $this->store();
		}

		return FALSE;
	}

	public function edit($id, $type)
	{
		if ($this->validate($id, $type)) {
			if ($type === 'password') {
				return $this->validatePassword();
			}

			return $this->update();
		}

		return FALSE;
	}

	private function validate($id = NULL, $type = NULL): bool
	{
		if ($id !== null && $type !== null) {
			if ($type === 'basic') {
				$this->instance->form_validation->set_rules('name', 'Name', 'required');
				$this->instance->form_validation->set_rules('email', 'Email', 'required');
				$this->instance->form_validation->set_rules('phone', 'Phone', 'required');
			}

			if ($type === 'role') {
				$this->instance->form_validation->set_rules('role_id', 'Role', 'required');
			}

			if ($type === 'password') {
				$this->instance->form_validation->set_rules('old_password', 'Old Password', 'required');
				$this->instance->form_validation->set_rules('new_password', 'New Password', 'required');
			}
		} else {
			$this->instance->form_validation->set_rules('role_id', 'Role', 'required');
			$this->instance->form_validation->set_rules('name', 'Name', 'required');
			$this->instance->form_validation->set_rules('email', 'Email', 'required');
			$this->instance->form_validation->set_rules('phone', 'Phone', 'required');
			$this->instance->form_validation->set_rules('password', 'Password', 'required');
		}

		if ($this->instance->form_validation->run() == TRUE) {
			if ($id !== null && $type !== null) {
				if ($type === 'basic') {
					$this->data = [
						'id' => $id,
						'name' => $this->instance->input->post('name'),
						'email' => $this->instance->input->post('email'),
						'phone' => $this->instance->input->post('phone'),
					];
				}

				if ($type === 'role') {
					$this->data = [
						'id' => $id,
						'role_id' => $this->instance->input->post('role_id'),
					];
				}

				if ($type === 'password') {
					$this->data = [
						'id' => $id,
						'old_password' => $this->instance->input->post('old_password'),
						'new_password' => $this->instance->input->post('new_password'),
					];
				}
			} else {
				$this->data = [
					'role_id' => $this->instance->input->post('role_id'),
					'name' => $this->instance->input->post('name'),
					'email' => $this->instance->input->post('email'),
					'phone' => $this->instance->input->post('phone'),
					'password' => $this->instance->input->post('password'),
				];
			}

			return TRUE;
		}

		return FALSE;
	}

	private function validatePassword()
	{
		$user = $this->instance->user->findBy('id', $this->data['id']);

		if (!$user) {
			redirect_with_alert(
				$this->instance, 'danger', "users/accounts/{$this->data['id']}",
				"[FAILED] Update user password, user not found!"
			);

			return FALSE;
		}

		if (!password_verify($this->data['old_password'], $user->password)) {
			redirect_with_alert(
				$this->instance, 'danger', "users/accounts/{$this->data['id']}",
				"[FAILED] Update user password, old password didn't match!"
			);

			return FALSE;
		}

		$this->data = [
			'id' => $user->id,
			'password' => password_hash(
				$this->data["new_password"],
				PASSWORD_BCRYPT,
				array('cost' => 12)
			)
		];

		return $this->update();
	}

	private function store()
	{
		return $this->instance->user->insert($this->data);
	}

	private function update()
	{
		return $this->instance->user->update($this->data);
	}
}
