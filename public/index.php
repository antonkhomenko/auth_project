<?php

require_once dirname(__DIR__) . "/incs/config.php";
require_once INCS . "/Router.php";
require INCS . "/data.php";

$router = Router::create(CONTROLLERS);
try {
	$router->get("/", "index.php");
	$router->get("/episode/*", "episode.php");
	$router->get("/login", "login.php");
	$router->get("/register", "register.php");
	$router->get("error_page", "error.php");
} catch (Exception $e) {
	die("can not register new router method: \"{$e->getMessage()}\"");
}


$router->match();


