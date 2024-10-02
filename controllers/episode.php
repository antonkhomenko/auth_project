<?php

global $anime_data;

$episode_number = explode("/", $_SERVER['REQUEST_URI'])[2];

if ($episode_number < 1 or $episode_number > count($anime_data)) {
	header("Location: /404");
	exit;
}


include VIEWS . "/episode.tpl.php";
