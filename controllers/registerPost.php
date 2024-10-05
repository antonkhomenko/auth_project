<?php

$target_dir = SITE_ROOT . "/public/assets/profile-pics/";


if (isset($_POST['avatar'])) {
	$target_file = "/assets/profile-pics/" . $_POST['avatar'];
} else {
	$target_file = $target_dir . basename($_FILES['avatar']['name']);
	if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $target_file)) {
		die("can not upload file");
	}
	chmod($target_file, 0666);
}

print $target_file;





