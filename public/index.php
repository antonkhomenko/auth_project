<?php

require_once dirname(__DIR__) . "/incs/config.php";
require_once INCS . "/Router.php";
require INCS . "/data.php";

$router = Router::create(CONTROLLERS);
$router->get("/", "index.php");
$router->get("/episode/*", "episode.php");
$router->get("/login", "login.php");
$router->get("/register", "register.php");
$router->get("error_page", "error.php");
$router->match();


