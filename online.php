<?php
require 'minum_log.php';
$id=$_POST['key'];
$res=mysql_query("SELECT distinct * from `friends` WHERE (`from`='$id' AND `status`='y') OR (`to`='$id' AND `status`='y')");
while($r=mysql_fetch_array($res))
{
	if($r['from']==$id)
	{
		$t=$r['to'];
		$checka=mysql_query("SELECT `sno` FROM `online` WHERE `id`='$t'");
		$check=mysql_fetch_assoc($checka);
		if($check['sno']>0)
		{
			$name_query=mysql_query("SELECT distinct * from `login_details` WHERE `id`='$t'");
			$name_arr=mysql_fetch_assoc($name_query);
			$name=$name_arr['first_name']." ".$name_arr['middle_name']." ".$name_arr['last_name'];
			echo "<p class='chat_head' style='left:8px;color:white;position:relative;' from='$id' to='$t'>".$name."</p>";
		}
	}
	if($r['to']==$id)
	{
		$t=$r['from'];
		$checka=mysql_query("SELECT `sno` FROM `online` WHERE `id`='$t'");
		$check=mysql_fetch_assoc($checka);
		if($check['sno']>0)
		{
			$name_query=mysql_query("SELECT distinct * from `login_details` WHERE `id`='$t'");
			$name_arr=mysql_fetch_assoc($name_query);
			$name=$name_arr['first_name']." ".$name_arr['middle_name']." ".$name_arr['last_name'];
			echo "<p class='chat_head' style='left:8px;color:white;position:relative;' from='$id' to='$t'>".$name."</p>";
		}
	}
}

?>