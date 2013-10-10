<?php
include("auth.php");
if (! getAdmin()) {
	header('HTTP/1.1 401 Unauthorized');
	die("Unauthorized");
}

// header("Content-Type: text/plain");
// print_r($_FILES);
// echo "Here: " . $_FILES['f']['tmp_name'][0] . "\n";
// echo "Here: " . $_FILES['f']['tmp_name'] . "\n";
// echo "Here: " . count($_FILES["f"]["name"]) . "\n";

// die("wtf");


date_default_timezone_set('Asia/Singapore');

$dir = getcwd();
if (is_writable($dir)) {
	$dir = $dir . '/' . date("Y-m-d");
} else {
	die("No write permission.\n Fix with: chown -R www-data $dir");
}
@mkdir($dir, 0777);

if (! is_array($_FILES["f"]["name"])) {

	if (! is_uploaded_file($_FILES['f']['tmp_name'])) { die("Upload fail: Missing file " . $_FILES["f"]["name"]); }

	$name = pathinfo($_FILES['f']['name'], PATHINFO_FILENAME);
	$extension = pathinfo($_FILES['f']['name'], PATHINFO_EXTENSION);
	$increment = ''; //start with no suffix

	while(file_exists("$dir/" . $name . $increment . '.' . $extension)) { $increment++; }

	$incname = "$dir/" . $name . $increment . '.' . $extension;
	move_uploaded_file($_FILES["f"]['tmp_name'], $incname);

} else {

	for ($i = 0; $i < count($_FILES["f"]["name"]); $i++) {

	if (! is_uploaded_file($_FILES['f']['tmp_name'][$i])) { die("Upload fail: Missing file " . $_FILES["f"]["name"][$i]); }

	$name = pathinfo($_FILES['f']['name'][$i], PATHINFO_FILENAME);
	$extension = pathinfo($_FILES['f']['name'][$i], PATHINFO_EXTENSION);
	$increment = ''; //start with no suffix

	while(file_exists("$dir/" . $name . $increment . '.' . $extension)) { $increment++; }

	$incname = "$dir/" . $name . $increment . '.' . $extension;
	move_uploaded_file($_FILES["f"]['tmp_name'][$i], $incname);

	}
}

@rmdir($dir); // remove directory if empty
header("Location: http://" . $_SERVER["HTTP_HOST"] . '/' . basename($dir));

?>
