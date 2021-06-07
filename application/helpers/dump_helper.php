<?php

if (!function_exists('dd')) {
	function dd($data)
	{
		echo '<pre>';
		var_dump($data);
		echo '</pre>';
		die();
	}
}

if (!function_exists('dd_json')) {
	function dd_json($data)
	{
		header("Content-type: application/json; charset=utf-8");
		echo json_encode($data);
		die();
	}
}
