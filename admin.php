<?php
	if(isset($_POST['adminid'])&&isset($_POST['adminpass']))
	{
		if($_POST['adminid']=="kranthi"&&$_POST['adminpass']=="samala")
		{
			session_start();
			$_SESSION['admin']="kranthi samala";
		}
	}
	if(isset($_SESSION['admin']))
	{
?>
<link rel="stylesheet" type="text/css" href="admin.css"/>
<div style="height:20px;margin:5px;width:100%;">
	<a id="logout" href="logout.php">Logout</a>
</div>
<div style="height:80px;background-color:black;margin-top:20px;text-align:center;color:white;line-height:80px;font-size:24px;">
Hello Admin "Kranthi Samala"
</div>
<div style="margin:50px auto;width:230px">
<span>
<select id="Recom_sel"style="width:auto;padding:5px;">
  <option value="" selected disabled>Recommandation minimum Level</option>
  <option value="0">All</option>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
</select>
</span>
</div>
<div id="rec_list"></div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/admin.js"></script>
<?php
	}
	else
	{
?>
<style>
html,body
{
	height:100%;
	width:100%;
}
#login
{
	margin:200px 38% 20px;
	background-color:black;
	padding:20px 60px 10px;
	display:inline-block;
	position:relative;
	box-shadow:3px 3px 5px rgba(0,0,0,0.5),-3px -3px 5px rgba(0,0,0,0.5);
}
#login input
{
	display:block;
	margin-top:10px;
	padding:4px;
	background-color:white;
	border:none;
}
[type="submit"]
{
	margin-top:10px;
	float:right;
}
</style>
<html>
<head>
</head>
<body>
<div>
<div></div>
	<div id="login">
		<div style='color:white;'><b>Admin Login</b></div>
		<form  style=""action="" method="post">
			<input type="text" placeholder="AdminId" name="adminid"/>
			<input type="password" placeholder="Password" name="adminpass"/>
			<input type="submit" value="submit"/>
		</form>
	</div>
	</div>
</body>
</html>
<?php
	}
?>