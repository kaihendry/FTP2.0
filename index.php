<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8" />
  <title>Upload pastebin</title>
  <style>
  body { margin: 3em; font-size: 1.6em; font-family: sans-serif; text-align: center; background-color: white; }
  input { font-size: 1.1em; }
  form { border: 2.6em green solid; padding: 1em; background-color: green; -moz-border-radius: 1em; -webkit-border-radius: 1em; border-radius: 1em; }
</style>
</head>
<body>

<? echo "<h1>Hello " . $_SERVER["REMOTE_USER"] . "</h1>";  ?>

<form action="upload.php" method="post" enctype="multipart/form-data">
<input required name="f" type="file" />
<input value="Upload" type="submit">
</form>

<p><a href="https://github.com/kaihendry/FTP2.0">Source code</a></p>

<pre>
~$ grep -E 'filesize|max_size' /etc/php5/apache2/php.ini
post_max_size = 50M
upload_max_filesize = 50M
</pre>

<pre>curl -F "f=@/tmp/foobar.png" http://<?php echo $_SERVER["HTTP_HOST"]; ?>/upload.php</pre>

</body>
</html>
