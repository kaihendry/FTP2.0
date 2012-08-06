<?php

date_default_timezone_set('Europe/London');

if (! is_uploaded_file($_FILES['f']['tmp_name'])) {
	die("Upload fail: Missing file.");
}

$dir = getcwd();
if (is_writable($dir)) {
	$dir = $dir . '/' . date("Y-m-d");
} else {
	die("No write permission.\n Fix with: chown -R www-data $dir");
}
@mkdir($dir, 0777);
move_uploaded_file($_FILES["f"]['tmp_name'], "$dir/" . $_FILES['f']['name']);
header("Location: http://" . $_SERVER["HTTP_HOST"] . '/' . basename($dir));

?>
