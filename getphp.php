<?php
require 'minum_log.php';
$key=$_POST['key'];
session_start();
$sno=$_SESSION['serial_num'];
$squery=mysql_query("SELECT * FROM login_details WHERE (id LIKE '%$key%')") or die(mysql_error());
while($state=mysql_fetch_array($squery))
{$sat=$state['id'];
$sno_num=$state['sno'];
if($sno!=$sno_num)
	echo "<div class='profile' style='width:400px;z-index:3;position:relative;top:2px;border-style:solid;border-color:rgb(20,20,20);background-color:white;'><a href='request.php?id=$sno_num'>".$state['id']."</a></div>";
}
$squery=mysql_query("SELECT * FROM login_details WHERE (first_name LIKE '%$key%') OR ( middle_name LIKE '%$key%') OR(last_name LIKE '%$key%')") or die(mysql_error());
while($state=mysql_fetch_array($squery))
{$sat=$state['id'];
$sno_num=$state['sno'];
if($sno!=$sno_num)
	echo "<div class='profile' style='width:400px;z-index:3;position:relative;top:2px;border-style:solid;border-color:rgb(20,20,20);background-color:white;'><a href='request.php?id=$sno_num'>".$state['first_name']." ".$state['middle_name']." ".$state['last_name']."</a></div>";
}
?>