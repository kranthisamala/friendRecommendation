<?php
require 'minum_log.php';
$num=$_POST['key'];
mysql_query("DELETE FROM `post` WHERE `sno`='$num'");
?>