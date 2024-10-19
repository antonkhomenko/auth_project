<?php

function dump(mixed $data): void
{
	print "<pre>";
	var_dump($data);
	print "<pre>";
}

function load(array $fillable, bool $post = true): array
{
	$loaded_data = $post ? $_POST : $_GET;
	$data = array();
	foreach($fillable as $value) {
		$data[$value] = trim($loaded_data[$value]) ?? '';
	}
	return $data;
}

function check_auth(): bool
{
	return isset($_SESSION['user']);
}

function redirect(string $url = ''): never
{
	if ($url === '') {
		$url = $_SERVER['REQUEST_URI'];
	}
	header("Location: $url");
	die;
}

function h(string $data): string
{
	return htmlspecialchars($data, ENT_QUOTES);
}


function get_alert(): void
{
	if (isset($_SESSION["success"])) {
		require VIEWS . "/incs/alert_success.tpl.php";
		unset($_SESSION['success']);
	}

	if (isset($_SESSION["error"])) {
		require VIEWS . "/incs/alert_danger.tpl.php";
		unset($_SESSION['error']);
	}
}