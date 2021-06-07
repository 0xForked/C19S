<?php defined('BASEPATH') OR exit('No direct script access allowed');

class AuthenticateUsers
{
	protected $instance;

	protected $email;

	protected $password;

	public function __construct()
	{
		$this->instance =& get_instance();

		if ($this->instance->session->is_logged_in) {
			redirect('home');
		}

		$this->instance->load->model('user');
	}

	public function login(): bool
	{
		if ($this->validate()) {
			return $this->attempt();
		}

		return FALSE;
	}

	private function validate(): bool
	{
		$this->instance->form_validation->set_rules('email', 'Email', 'required');
		$this->instance->form_validation->set_rules('password', 'Password', 'required');

		if ($this->instance->form_validation->run() == TRUE) {
			$this->email = $this->instance->input->post('email');
			$this->password = $this->instance->input->post('password');

			return TRUE;
		}

		return FALSE;
	}

	private function attempt(): bool
	{
		$user = $this->instance->user->findBy('email', $this->email);

		// if the user with that given email is not exists
		if (!$user) {
			redirect_with_alert(
				$this->instance, 'danger', 'login',
			"We couldn't find user with that email address"
			);
		}

		// if the user exist, validate given password
		if (!password_verify($this->password, $user->password)) {
			redirect_with_alert(
				$this->instance, 'danger', 'login',
				"Your credentials doesn't match with our record"
			);
		}

		// if user exist and given password match
		// set users session and redirect to home
		$this->instance->session->set_userdata([
			'user_id' => $user->id,
			'role_id' => $user->role_id,
			'full_name' => $user->name,
			'account_status' => $user->status,
			"is_logged_in" => true,
			'last_logged_in' => time()
		]);

		return TRUE;
	}
}
