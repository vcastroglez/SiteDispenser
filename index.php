<?php
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
			<td ><a href="/render.php?site=<?php echo $file; ?>" target="_blank" ><?php echo $file; ?></a ></td >
		</tr >
	<?php } ?>
	</tbody >
</table >
</body >
</html >
