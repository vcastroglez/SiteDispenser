<?php
$projectsDir = __DIR__ . '/projects';
$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$parts = explode('/', $uri);

// Homepage listing
if ($uri === '') {
	$projects = array_filter(glob($projectsDir . '/*'), 'is_dir');
	echo "<h1>Select a project:</h1><ul>";
	foreach ($projects as $projectPath) {
		$projectName = basename($projectPath);
		echo "<li><a href=\"/site/$projectName\">$projectName</a></li>";
	}
	echo "</ul>";
	exit;
}

// Routing logic
if ($parts[0] === 'site' && isset($parts[1])) {
	$project = preg_replace('/[^a-zA-Z0-9_-]/', '', $parts[1]);
	$projectRoot = realpath("$projectsDir/$project");

	if (!$projectRoot || strpos($projectRoot, realpath($projectsDir)) !== 0) {
		http_response_code(404);
		echo "Invalid project.";
		exit;
	}

	$publicDir = "$projectRoot/public";
	$indexPath = "$publicDir/index.php";

	if (!file_exists($indexPath)) {
		http_response_code(500);
		echo "Laravel entry point not found.";
		exit;
	}

	// Rewrite $_SERVER variables to simulate Laravel context
	$_SERVER['SCRIPT_FILENAME'] = $indexPath;
	$_SERVER['SCRIPT_NAME'] = '/index.php';
	$_SERVER['PHP_SELF'] = '/index.php';

	// Fix path for Laravel routing
	$_SERVER['REQUEST_URI'] = '/' . implode('/', array_slice($parts, 2));

	// Change directory to public (Laravel expects it)
	chdir($publicDir);
	require $indexPath;
	exit;
}

// Not found
http_response_code(404);
echo "Page not found.";
