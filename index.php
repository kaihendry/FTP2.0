<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>FTP2.0</title>
<style>
body { margin: 3em; font-size: 1.6em; font-family: sans-serif; text-align: center; background-color: white; }
input { font-size: 1.1em; }
form { border: 2.6em #42d451 solid; padding: 1em; background-color: #42d451; -moz-border-radius: 1em; -webkit-border-radius: 1em; border-radius: 1em; }
</style>
</head>
<body>
<?php
include("auth.php");
if (! getAdmin()) { die('<h1>You do not have the secret cookie to allow you to upload!</h1>
	<p><a href=/foo.php>Get one temporarily!</a></p>'); }
?>

<form action="/upload.php" method="post" enctype="multipart/form-data">
<input name="f[]" type="file" multiple="" />
<input value="Upload" type="submit">
</form>

<pre>curl -f -H 'Cookie: ftptwo=<?php echo $_COOKIE['ftptwo']; ?>' -F "f=@/tmp/foobar.png" http://<?php echo $_SERVER["HTTP_HOST"]; ?>/upload.php</pre>

<p><a href="https://github.com/kaihendry/FTP2.0">MIT licensed source code</a></p>

</body>
</html>
