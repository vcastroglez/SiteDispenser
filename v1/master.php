<?php
require_once "vendor/autoload.php";

$get = $_GET;
$uri = $_SERVER['REQUEST_URI'];
$refereer = $_SERVER['HTTP_REFERER'];

$site = explode("site=", $refereer)[1];
