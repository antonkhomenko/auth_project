<?php


global $db;

if (is_delete()) {
	delete_unused_profile_pic();
	$db->delete_user($_SESSION['user']['email']);
	unset($_SESSION['user']);
	redirect("/");
} else {
	[$input, $error] = validate_form();
	if ($error) {
		$default_value = $input;
		require VIEWS . "/profile.tpl.php";
	} else {
		if (!$db->set_new_password($_SESSION['user']['email'], password_hash($input['new_password'], PASSWORD_DEFAULT))) {
			$_SESSION['error'] = 'Internal server error';
			redirect("/profile");
		}
		try {
			change_profile_pic();
		} catch (Exception $exception) {
			$_SESSION['error'] = "Can not upload this picture. Please reload page and try again";
			redirect('/profile');
		}
		$_SESSION['success'] = "{$_SESSION['user']['username']} data was successfully updated";
		redirect("/profile");
	}
}


function validate_form(): array
{
	global $db;
	$error = array();
	$input = array();

	if (!empty($_POST['oldPassword']) or !empty($_POST['newPassword'])) {
		$input['old_password'] = $_POST['oldPassword'];
		$current_password = $db->get_password($_SESSION['user']['email']);
		if (!password_verify($input['old_password'], $current_password)) {
			$error['oldPassword'] = 'Old password is incorrect';
		}

		$input['new_password'] = $_POST['newPassword'];
		if (strlen(trim($input['new_password'])) < 5) {
			$error['newPassword'] = "New password should be at least 5 characters";
		}
	}

	return [$input, $error];
}

function change_profile_pic(): void
{
	global $db;
	if ($_FILES['newProfilePic']['error'] == 0) {
		delete_unused_profile_pic();

		$new_name = uniqid() . "." .pathinfo($_FILES['newProfilePic']['name'], PATHINFO_EXTENSION);
		$new_path = "/assets/profile-pics/custom_mode/$new_name";
		$move_to = SITE_ROOT . "/public{$new_path}";

		if (!move_uploaded_file($_FILES['newProfilePic']['tmp_name'], $move_to)) {
			throw new Exception("can not move file {$_FILES['avatar']['tmp_name']} to $move_to");
		}
		chmod($move_to, 0666);

		$_SESSION['user']['profile_pic'] = $new_path;
		$db->update_profile_pic($_SESSION['user']['email'], $new_path);
	}
}


function delete_unused_profile_pic(): void
{
	$real_path = SITE_ROOT . "/public" . $_SESSION['user']['profile_pic'];
	$custom_mode_path = SITE_ROOT . "/public/assets/profile-pics/custom_mode/" . basename($_SESSION['user']['profile_pic']);
	if (file_exists($custom_mode_path)) {
		unlink($real_path);
	}
}


function is_delete(): bool
{
	return isset($_POST['delete_account']);
}

