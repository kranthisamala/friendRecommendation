<?php
require 'minum_log.php';
$sno=mysql_real_escape_string($_GET['id'])or die("bolo");
$image=mysql_query("SELECT * FROM `post` WHERE `sno`='$sno'") or die(mysql_error());
$image=mysql_fetch_assoc($image);
$image=$image['image'];
header("Content-type: image/jpeg");
echo $image;
?>