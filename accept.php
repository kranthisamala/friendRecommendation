<?php
require 'minum_log.php';
$key=$_POST['key'];
$squery=mysql_query("UPDATE `friends` SET `status`='y' WHERE `sno`='$key'") or die(mysql_error());
header('Location: index.php');
?>