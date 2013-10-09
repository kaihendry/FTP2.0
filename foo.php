<?php
include("auth.php");
umask(002);
setAdmin(trim(`head -c 4 /dev/urandom | xxd -p`));
echo '<p>Set cookie!</p>';
?>
