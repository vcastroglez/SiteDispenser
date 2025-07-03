<?php
require_once "vendor/autoload.php";

$request_uri = $_SERVER['REQUEST_URI'];
$refereer = $_SERVER['HTTP_REFERER'];

file_put_contents("log.log", "-------------------\n", FILE_APPEND);
file_put_contents("log.log", "$refereer\n", FILE_APPEND);
file_put_contents("log.log", "$request_uri\n", FILE_APPEND);

if (str_contains($refereer, 'index') && str_contains($refereer, 'site') && !str_contains($request_uri, '/site')) {
	$wanted_file = $request_uri;
	$request_uri = $refereer;
	$request_uri = str_replace('http://'.$_SERVER['HTTP_HOST'], "", $request_uri);
	$request_uri = str_replace('https://'.$_SERVER['HTTP_HOST'], "", $request_uri);
	$request_uri = str_replace('/index', $wanted_file, $request_uri);
	$_SERVER['REQUEST_URI'] = $request_uri;
}
file_put_contents("log.log", "$request_uri\n", FILE_APPEND);
file_put_contents("log.log", "-------------------\n", FILE_APPEND);

if ($request_uri != '/') {
	$uri_parts = explode('/', trim($request_uri, '/'));
	file_put_contents("log.log", "$uri_parts[0]\n", FILE_APPEND);
	if ($uri_parts[0] == 'site') {
		$site = $uri_parts[1];
		include 'render.php';
		die;
	}
}

$all = scandir(__DIR__ . '/..');
$all = array_filter($all, fn($file) => !in_array($file, ['.', '..', 'vendor']));
?>

<!doctype html>
<html lang="en" >
<head >
	<meta charset="UTF-8" >
	<meta name="viewport" content="width=device-width, initial-scale=1" >
	<title >Site dispenser</title >
</head >
<body >
<table >
	<tbody >
	<?php foreach ($all as $file) { ?>
		<tr style="text-align: left" >
			<td ><a href="/site/<?php echo $file; ?>/index" target="_blank" ><?php echo $file; ?></a ></td >
		</tr >
	<?php } ?>
	</tbody >
</table >
</body >
</html >
