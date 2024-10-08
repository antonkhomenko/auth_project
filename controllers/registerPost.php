<?php


[$input, $error] = validate_form();



if ($error) {
	$default_values = $input;
	require VIEWS . "/register.tpl.php";
}


function validate_form(): array
{
	$input = array();
	$error = array();
	$target_dir = SITE_ROOT . "/public/assets/profile-pics/";

	$input['username'] = trim($_POST['username'] ?? '');
	if ($input['username'] == "") {
		$error['username'] = "Username is required";
	}
	$input['email'] = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
	if ($input['email'] == null or $input['email'] === false) {
		$error['email'] = 'Email is required';
	}
	if (isset($_POST['avatar'])) {
		$target_file = "/assets/profile-pics/" . $_POST['avatar'];
		$input['avatar'] = $target_file;
	} else if ($_FILES['avatar']['error'] === 0) {
		$target_file = $target_dir . basename($_FILES['avatar']['name']);
		if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $target_file)) {
			die("can not upload file");
		}
		chmod($target_file, 0666);
		$input['avatar'] = $target_file;
	} else {
		$error['avatar'] = 'Profile pic is required';
	}

	$input['password'] = trim($_POST['password'] ?? "");
	if ($input['password'] == '' or strlen($input['password']) < 5) {
		$error['password'] = "Password is required and should be at least 5 character";
	}
	$input['avatar_mode_selector'] = $_POST['avatar_mode_selector'];
	return [$input, $error];
}




