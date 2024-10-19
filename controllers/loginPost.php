<?php

global $db;
[$input, $error] = validation();



if ($error) {
	require VIEWS . "/login.tpl.php";
} else {
	$user = $db->login($input);

	if ($user and password_verify($input['password'], $user['password'])) {
		foreach($user as $key => $value) {
			if ($key == 'password') {
				continue;
			}
			$_SESSION['user'][$key] = $value;
		}
		redirect("/");
	} else {
		$_SESSION['error'] = "Wrong email or password";
		require VIEWS . "/login.tpl.php";
	}

}


function validation(): array
{
	$input = array();
	$error = array();
	$input['email'] = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
	if ($input['email'] === false or $input['email'] === null) {
		$error['email'] = 'Email is required';
	}
	$input['password'] = $_POST['password'] ?? "";
	if (trim($input['password']) == '') {
		$error['password'] = 'password is required';
	}
	$input['remember'] = isset($_POST['remember']);
	return [$input, $error];
}


