<?php

if (!function_exists('redirect_with_alert')) {
	function redirect_with_alert($instance, $type, $path, $message)
	{
		$instance
			->session
			->set_flashdata(
				'message',
				'<div class="alert alert-'.$type.' alert-dismissible fade show" role="alert">
				  '. $message .'
				  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>'
			);

		redirect($path, 'refresh');
	}
}
