<?php

require_once dirname(__DIR__) . "/incs/config.php";
require_once INCS . "/Router.php";

$router = Router::create(CONTROLLERS);
$router->get("/", "index.php");
$router->get("/login", "login.php");
$router->get("/registration", "register.php");
$router->get("error_page", "error.php");
$router->match();

