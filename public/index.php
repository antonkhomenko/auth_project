<?php
session_start();
use Dotenv\Dotenv;

require_once dirname(__DIR__) . "/incs/config.php";
require_once INCS . "/Router.php";
require_once INCS . "/data.php";
require_once INCS . "/funcs.php";
require_once INCS . "/DB.php";
require_once ROOT . "/vendor/autoload.php";

$dotenv = Dotenv::createImmutable(ROOT);
$dotenv->load();

$dsn = "mysql:host=localhost;dbname={$_ENV['DB_NAME']};charset=utf8mb4";
$db = DB::create($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);

$router = Router::create(CONTROLLERS);
try {
	$router->get("/", "index.php");
	$router->get("/episode/*", "episode.php");
	$router->get("/login", "login.php");
	$router->get("/register", "register.php");
	$router->get("error_page", "error.php");
	$router->post("/register", "registerPost.php");
	$router->post("/login", "loginPost.php");
} catch (Exception $e) {
	die("can not register new router method: \"{$e->getMessage()}\"");
}


$router->match();

