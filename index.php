<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Upload an image to Kai</title>
<meta name="viewport" content="minimum-scale=1.0, maximum-scale=1.0, initial-scale=1.0, user-scalable=no">
<style>
body { font-family: "Gill Sans", sans-serif; }
#yourBtn{
   width: 80%
   text-align: center;
   background-color: #DDD;
   padding: 2em;
   border-radius:6px;
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
if (! getAdmin()) { die('<h1>You do not have the secret cookie to allow you to upload!</h1>'); }

if (isset($_GET["success"])) { echo "<h4>Successfully uploaded: <a href=" . $_GET['success'] . ">". $_GET['success'] . "</a></h4>"; }
?>

<form name="myForm" action="/upload.php" method="post" enctype="multipart/form-data">
<div id="yourBtn" onclick="getFile()">Click to upload <?php if (isset($_GET["success"])) { echo "another"; } else { echo "a"; } ?> photo</div>
<!-- i used the onchange event to fire the form submission-->
<div style='height: 0px;width: 0px; overflow:hidden;'><input id="upfile" type="file"  name=f onchange="sub(this)"/></div>

<p style="font-size: small">After upload, show:<br>
<input type="radio" id=success name="after" value="success" checked>
<label for="success">success</label>
<input type="radio" id=listing name="after" value="listing">
<label for="listing">listing</label>
<input type="radio" id=show name="after" value="show">
<label for="show">photo</label>
</p>
</form>

<!--
curl -f -H 'Cookie: ftptwo=<?php echo $_COOKIE['ftptwo']; ?>' -F "f=@/tmp/foobar.jpg" http://<?php echo $_SERVER["HTTP_HOST"]; ?>/upload.php
-->

</body>
</html>
