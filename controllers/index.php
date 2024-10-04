<?php

global $anime_data;
$title = "Home";

$episodes_per_page = 12;
$show_pagination = count($anime_data) > $episodes_per_page;
$current_page = $_GET['page'] ?? "1";
$offset = ($current_page - 1) * $episodes_per_page;
$pages_amount = ceil(count($anime_data) / $episodes_per_page);



include VIEWS . "/index.tpl.php";
