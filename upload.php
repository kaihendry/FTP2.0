<?php
include("auth.php");
if (! getAdmin()) {
	header('HTTP/1.1 401 Unauthorized');
	die("Unauthorized");
}

date_default_timezone_set('Asia/Singapore');

//header("Content-Type: text/plain");
//print_r($_FILES);

if (! is_uploaded_file($_FILES['f']['tmp_name'])) {
	die("Upload fail: Missing file");
}

$dir = getcwd();
if (is_writable($dir)) {
	$dir = $dir . '/' . date("Y-m-d");
} else {
	die("No write permission.\n Fix with: chown -R www-data $dir");
}

@mkdir($dir, 0777);

$name = pathinfo($_FILES['f']['name'], PATHINFO_FILENAME);
$extension = pathinfo($_FILES['f']['name'], PATHINFO_EXTENSION);

$increment = ''; //start with no suffix

while(file_exists("$dir/" . $name . $increment . '.' . $extension)) {
	$increment++;
}

$basename = "$dir/" . $name . $increment . '.' . $extension;

move_uploaded_file($_FILES["f"]['tmp_name'], $basename);

header("Location: http://" . $_SERVER["HTTP_HOST"] . '/' . basename($dir));

?>
