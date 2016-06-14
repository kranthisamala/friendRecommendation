<?php
require 'minum_log.php';
$from=$_POST['from'];
$to=$_POST['to'];
$class_a=$_POST['class_a'];
if($class_a=="unfriend")
{
	if(mysql_query("DELETE FROM `friends` WHERE (`from`='$from' AND `to`='$to' AND `status`='y') OR (`from`='$to' AND `to`='$from' AND `status`='y')"))
	{
		echo "done";
	}
	else
	{
		echo "fail";
	}
}
if($class_a=="send_request")
{
	if(mysql_query("INSERT INTO `friends`(`from`, `to`,`status`) VALUES ('$from','$to','r')"))
	{
		echo "done";
	}
	else
	{
		echo "fail";
	}
}
if($class_a=="request_sent")
{
	if(mysql_query("DELETE FROM `friends` WHERE (`from`='$from' AND `to`='$to' AND `status`='r') OR (`from`='$to' AND `to`='$from' AND `status`='r')"))
	{
		echo "done";
	}
	else
	{
		echo "fail";
	}
}
if($class_a=="accept")
{
	if(mysql_query("UPDATE `friends` SET `status`='y' WHERE from='$from' AND to='$to' ")){echo "done";}
	else if(mysql_query("UPDATE `friends` SET `status`='y' WHERE from='$to' AND to='$from' ")){echo "done";}
	else
	{
		echo "fail";
	}
}
?>