<?php
require 'minum_log.php';
$key=$_POST['key'];
$squery=mysql_query("DELETE FROM `friends` WHERE `sno`='$key'") or die(mysql_error());
header('Location: index.php');
?>