<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>FTP2.0</title>
<style>
body { margin: 3em; font-size: 2em; font-family: sans-serif; text-align: center; background-color: white; }
input { font-size: 1em; padding: 2em }
form { border: 1.6em #42d451 solid; padding: 0.4em; background-color: #42d451; }
#yourBtn{
   width: 100%
   text-align: center;
   background-color: #DDD;
   border: thin dashed #BBB;
   padding: 1em;
   cursor:pointer;
  }
</style>
<script>
 function getFile(){
   document.getElementById("upfile").click();
 }
 function sub(obj){
    var file = obj.value;
    var fileName = file.split("\\");
    document.getElementById("yourBtn").innerHTML = fileName[fileName.length-1];
    document.myForm.submit();
    event.preventDefault();
  }
</script>
</head>
<body>
<?php
include("auth.php");
if (! getAdmin()) { die('<h1>You do not have the secret cookie to allow you to upload!</h1>
	<p><a href=/foo.php>Get one temporarily!</a></p>'); }
?>

<form name="myForm" action="/upload.php" method="post" enctype="multipart/form-data">
<div id="yourBtn" onclick="getFile()">Click to upload a photo</div>
<!-- this is your file input tag, so i hide it!-->
<!-- i used the onchange event to fire the form submission-->
<div style='height: 0px;width: 0px; overflow:hidden;'><input id="upfile" type="file" name=f onchange="sub(this)"/></div>
<!-- here you can have file submit button or you can write a simple script to upload the file automatically-->
<!-- <input type="submit" value='submit' > -->
</form>

<pre>curl -f -H 'Cookie: ftptwo=<?php echo $_COOKIE['ftptwo']; ?>' -F "f=@/tmp/foobar.jpg" http://<?php echo $_SERVER["HTTP_HOST"]; ?>/upload.php</pre>

<p><a href="https://github.com/kaihendry/FTP2.0">MIT licensed source code</a></p>

</body>
</html>
