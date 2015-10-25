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

if (! is_uploaded_file($_FILES['f']['tmp_name'])) { die("Upload fail: Missing file " . $_FILES["f"]["name"]); }

$name = pathinfo($_FILES['f']['name'], PATHINFO_FILENAME);
$extension = pathinfo($_FILES['f']['name'], PATHINFO_EXTENSION);
$increment = ''; //start with no suffix

// We save to WebP, so we need to check for WebP filenames
while(file_exists("$dir/" . $name . $increment . '.' . "webp")) { $increment++; }

$incname = "$dir/" . $name . $increment . '.' . $extension;

if (fnmatch("jp*", $extension)) {
	$webp = "$dir/" . $name . $increment . '.' . "webp";
	move_uploaded_file($_FILES["f"]['tmp_name'], $incname);
	exec("jhead -autorot $incname", $output, $return);
	if ($return) { unlink($incname); die("Not a JPEG"); }
	exec("cwebp -short -metadata all $incname -o $webp", $output, $return);
	unlink($incname);
} else if ($extension == "png") {
	// PNGCRUSH
	move_uploaded_file($_FILES["f"]['tmp_name'], $incname);
} else {
	die("unknown extension: ". $extension);
}

@rmdir($dir); // remove directory if empty

$url = "http://" . $_SERVER["HTTP_HOST"] . '/' . basename($dir) . '/' . basename($webp);

$subject = gethostbyaddr($_SERVER['REMOTE_ADDR']) . ' ' . $_COOKIE['ftptwo'];
if ($_COOKIE['ftptwo'] == 'mom') {
	mail('up, prazefarm@gmail.com', $subject, $url);
}

switch ($_POST["after"]) {
case "listing":
	header("Location: http://" . $_SERVER["HTTP_HOST"] . '/' . basename($dir));
	break;
case "show":
	header("Location: $url");
	break;
default:
	header("Location: http://" . $_SERVER["HTTP_HOST"] . "/?success=$url");
}

?>
