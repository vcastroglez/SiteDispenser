<?php
$site ??= 'dummy';
$uri_parts ??= [];

$root_path = realpath(__DIR__ . '/../' . $site);
$public_path = "$root_path/public/";
$has_public = is_dir($public_path);
$refereer = $_SERVER['HTTP_REFERER'];

if (count($uri_parts) > 2 && $uri_parts[2] !== 'index') {
	unset($uri_parts[0]);
	unset($uri_parts[1]);
	$uri_parts = implode('/', $uri_parts);
	$requested_file = ($has_public ? $public_path : "$root_path/" ) . $uri_parts;
	echo file_get_contents("$requested_file");
	die;
}

if ($has_public) {
	passthru("php $public_path/index.php");
	die;
}

$all_files = scandir($root_path);
$has_index_php = in_array("index.php", $all_files);
$has_index_html = in_array("index.html", $all_files);

if ($has_index_php) {
	passthru("php $root_path/index.php");
	die;
}

if ($has_index_html) {
	echo file_get_contents("$root_path/index.html");
	die;
}

dd("DOn't know what to do :/");//vla
