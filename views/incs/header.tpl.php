<?php

/**
 * @var string $title ;
 */
$active_uri = strtok($_SERVER['REQUEST_URI'], "?");
$navbar = array(
	"/" => 'Home',
	"/login" => 'Login',
	'/register' => 'Registration',
);

$user_navbar = array(
        "/" => "⌂ Home",
        "/favorites" => "♡ Favorites",
        "/recommended" => "✧ Recommended",
);
if (check_auth()) {
    $navbar = $user_navbar;
}

$default_mode = $_COOKIE['mode'] ?? 'dark';
?>
<!doctype html>
<html lang="en" data-bs-theme="<?= $default_mode; ?>" style="min-height: 100vh">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>ApartFinder<?= isset($title) ? " • $title" : "" ?></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/style.css">
    <link rel="icon" type="image/x-icon" href="/assets/imgs/favicon.svg">
</head>
<body class="d-flex flex-column " style="min-height: 100vh">
<nav class="navbar navbar-expand-lg" style="border-bottom: 1px solid gray">
	<div class="container-lg " id="navbar-container">

        <div class="col-2 col-md">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <ul class="navbar-nav d-none d-lg-flex">
                <?php require VIEWS . "/incs/navbar.tpl.php" ?>
            </ul>
        </div>


        <div class="col-6 col-md d-flex flex-grow-1 justify-content-sm-center justify-content-end pointer">
            <a class="navbar-brand fw-semibold d-flex gap-1 align-items-center pointer" href="/" id="logo" style="line-height: 24px">
                <img src="/assets/imgs/favicon.svg" alt="Logo" width="30" height="24" class="align-self-top">
                ApartFinder
            </a>
        </div>


        <div class="col-4 col-md d-flex justify-content-end align-items-center">
            <button class="border-0  d-flex justify-content-center align-items-center p-2 rounded-circle" style="margin-right: 0px" id="themeModeBtn">
                <img src="/assets/imgs/<?=$default_mode?>_mode.svg" alt="mode" width="18px">
            </button>
	        <?php if (check_auth()): ?>
                <div class="dropdown user-dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="dropdown-item-user">
                        <div class="custom-profile-pic nav-profile-pic">
                            <img src="<?= $_SESSION['user']['profile_pic']; ?>" alt="profile-pic">
                        </div>
                        <strong style="font-size: 13px" class="d-sm-block d-none"><?= $_SESSION['user']['username'] ?></strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end mt-1">
                        <li class="dropdown-item-li"><a class="dropdown-item" href="/profile">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li class="dropdown-item-li"><a class="dropdown-item" href="/logout">Logout</a></li>
                    </ul>
                </div>
	        <?php endif; ?>
        </div>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  mb-lg-0 d-flex align-items-center">
	            <?php require VIEWS . "/incs/navbar.tpl.php" ?>
            </ul>
        </div>


    </div>
</nav>