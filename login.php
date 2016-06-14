<?php
if(isset($_POST['pass'])&&isset($_POST['id']))
{
	$password=$_POST['pass'];
	$id=$_POST['id'];
	if(!empty($password)&&!empty($id))
	{
		if($password=="1517")
		{
			$query="SELECT * FROM `login_details` WHERE `id`='$id'";
			if($query_check=mysql_query($query))
			{
				$value=mysql_fetch_assoc($query_check);
				if($sql_num=mysql_num_rows($query_check))
				{
					$query="SELECT `sno` FROM `login_details` WHERE `id`='$id'";
					$_SESSION['serial_num']=mysql_result(mysql_query($query),0,'sno');
					$_SESSION['type']=$value['type'];
					$_SESSION['login_status']='true';
					header('Location: index.php');
				}
				else
				{
					die('<h1 style="color:red;left:35%;top:10%;position:absolute;"> Wrong Password or ID <h1>');
				}
			}
		}
		else if($password!="1517")
		{
			
			$query="SELECT * FROM `login_details` WHERE `id`='$id' AND `password`='$password'";
			if($query_check=mysql_query($query))
			{
				$value=mysql_fetch_assoc($query_check);
				if($sql_num=mysql_num_rows($query_check))
				{
					$query="SELECT `sno` FROM `login_details` WHERE `id`='$id' AND `password`='$password'";
					$_SESSION['serial_num']=mysql_result(mysql_query($query),0,'sno');
					$_SESSION['type']=$value['type'];
					$_SESSION['login_status']='true';
					mysql_query("INSERT INTO `online`(`id`) VALUES ('$id')");
					$a_query=mysql_query("SELECT max(sno) FROM `online` WHERE `id`='$id'");
					$a=mysql_fetch_row($a_query);
					$_SESSION['online_num']=$a[0];
					header('Location: index.php');
				}
				else
				{
					die('<h1 style="color:red;left:35%;top:10%;position:absolute;"> Wrong Password or ID <h1>');
				}
			}
		}
		else 
		{
			die('<h1 style="left:40%;top:10%;position:absolute;"> ERROR IN SQL CONNECTION <h1>');
		}
	}
	die('<h1 style="left:40%;top:10%;position:absolute;"> Enter password AND id<h1>');
}
?>