<?php
session_start();
require 'minum_log.php';
$sno=$_GET['sno'];
mysql_query("DELETE FROM `online` WHERE `sno`='$sno'");
session_destroy();

header('Location: index.php');
?>