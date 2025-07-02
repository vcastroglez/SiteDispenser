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

$all_files = scandir($root_path);
$has_index_php = in_array("index.php", $all_files);
$has_index_html = in_array("index.html", $all_files);

if($has_index_php){
	include "$root_path/index.php";
	die;
}

if($has_index_html){
	echo file_get_contents("$root_path/index.html");
	die;
}

dd("DOn't know what to do :/");//vla
