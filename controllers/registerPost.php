<?php


global $db;
[$input, $error] = validate_form();
$default_values = $input;

if ($error) {
	require VIEWS . "/register.tpl.php";
} else {
	try {
		$db->register($input);
		$_SESSION['success'] = "User " . h($input['username']) . " was successfully register";
		redirect("/login");
	} catch (PDOException $e) {
		if ($e->getCode() == 23000) {
			$_SESSION['error'] = "This email is already used";
			require VIEWS . "/register.tpl.php";
		} else {
			http_response_code(401);
			redirect("/error");
		}
	}
}



function validate_form(): array
{
	$input = array();
	$error = array();

	$input['username'] = trim($_POST['username'] ?? '');
	if ($input['username'] == "") {
		$error['username'] = "Username is required";
	}
	$input['email'] = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
	if ($input['email'] == null or $input['email'] === false) {
		$error['email'] = 'Email is required';
	}
	try {
		$avatar_res = avatar_validation($input);
		if (!$avatar_res) {
			$error['avatar'] = 'Profile picture is required';
		}
	} catch (Exception $exception) {
		http_response_code(500);
		require_once VIEWS . "/register.tpl.php";
		exit;
	}
	$input['password'] = trim($_POST['password'] ?? "");
	if ($input['password'] == '' or strlen($input['password']) < 5) {
		$error['password'] = "Password is required and should be at least 5 character";
	}
	$input['avatar_mode_selector'] = $_POST['avatar_mode_selector'];
	return [$input, $error];
}

function avatar_validation(array &$input): bool
{
	switch ($_POST['avatar_mode_selector']) {
		case 'default_mode':
			if (!isset($_POST['avatar'])) {
				return false;
			}
			$input['avatar'] = "/assets/profile-pics/{$_POST['avatar']}";
			return true;
		case 'custom_mode':
			if ($_FILES['avatar']['error'] === 0) {
				$new_name = uniqid() . "." . pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
				$move_to = SITE_ROOT . "/public/assets/profile-pics/custom_mode/$new_name";
				if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $move_to)) {
					throw new Exception("can not move file {$_FILES['avatar']['tmp_name']} to $move_to");
				}
				chmod($move_to, 0666);
				$input['avatar'] = "/assets/profile-pics/custom_mode/$new_name";
				return true;
			} else if (isset($_POST['prev_avatar'])) {
				$input['avatar'] = $_POST['prev_avatar'];
				return true;
			} else {
				return false;
			}
		default:
			return false;
	}
}



