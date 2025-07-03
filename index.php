<?php
require_once "vendor/autoload.php";

$request_uri = $_SERVER['REQUEST_URI'];

if ($request_uri != '/') {
	$uri_parts = explode('/', trim($request_uri, '/'));
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
