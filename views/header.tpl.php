<?php
/**
 * @var string $title ;
 */
$active_uri = strtok($_SERVER['REQUEST_URI'], "?");
$navbar = array(
	"/login" => 'Login',
	'/register' => 'Registration',
	'/secret' => 'Secret page'
);

$default_mode = $_COOKIE['mode'] ?? 'dark';
?>
<!doctype html>
<html lang="en" data-bs-theme="<?= $default_mode; ?>" style="min-height: 100vh">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>AniNeko<?= isset($title) ? " • $title" : "" ?></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/style.css">
    <link rel="icon" type="image/x-icon" href="/assets/imgs/favicon.svg">
</head>
<body class="d-flex flex-column bg-body-secondary" style="min-height: 100vh">
<nav class="navbar navbar-expand-lg bg-body-tertiary">
	<div class="container-lg">
		<a class="navbar-brand fw-semibold d-flex" href="/">
            <img src="/assets/imgs/favicon.svg" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
            AniNeko
        </a>
        <button class="border-0 ms-auto bg-body-secondary d-flex justify-content-center align-items-center p-2 rounded-circle" style="margin-right: 10px" id="themeModeBtn">
            <img src="/assets/imgs/<?=$default_mode?>_mode.svg" alt="mode" width="18px">
        </button>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
				<?php foreach ($navbar as $key => $value): ?>
                    <li class="nav-item">
                        <a href="<?= $key ?>"
                           class="nav-link <?= ($key == $active_uri) ? 'active' : '' ?>"><?= $value ?></a>
                    </li>
				<?php endforeach; ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        User
                    </a>
                    <ul class="dropdown-menu" style="left: -50%">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>