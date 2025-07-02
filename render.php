<?php
require_once "vendor/autoload.php";

$port = 4444;
$site = $_REQUEST['site'];
$root_path = realpath(__DIR__.'/../'.$site);
$public_path = "$root_path/public/";
$has_public = is_dir($public_path);

if($has_public){
	include "$public_path/index.php";
	die;
}
