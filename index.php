<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>FTP2.0</title>
<style>
body { margin: 3em; font-size: 1.6em; font-family: sans-serif; text-align: center; background-color: white; }
input { font-size: 1.1em; }
form { border: 2.6em green solid; padding: 1em; background-color: green; -moz-border-radius: 1em; -webkit-border-radius: 1em; border-radius: 1em; }
</style>
</head>
<body>
<?php
include("auth.php");
if (getAdmin()) { echo '<p>Found cookie!</p>'; } else { die('<h1>You do not have the secret cookie to allow you to upload!</h1>
	<p><a href=/foo.php>Get one temporarily!</a></p>'); }
?>

<?php echo "<h1>Hello ☺</h1>";  ?>

<form action="/upload.php" method="post" enctype="multipart/form-data">
<input type="file" name="f" accept="image/*" capture="camera">
<input value="Upload" type="submit">
</form>

<p><a href="https://github.com/kaihendry/FTP2.0">Source code</a></p>

<pre>
~$ grep -E 'filesize|max_size' /etc/php5/apache2/php.ini
post_max_size = 50M
upload_max_filesize = 50M
</pre>

<pre>curl -f -H 'Cookie: ftptwo=<?php echo $_COOKIE['ftptwo']; ?>' -F "f=@/tmp/foobar.png" http://<?php echo $_SERVER["HTTP_HOST"]; ?>/upload.php</pre>

</body>
</html>
