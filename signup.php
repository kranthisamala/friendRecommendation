<?php
	if(isset($_POST['submit']))
	{
		require 'minum_log.php';
		if(isset($_POST['uname'])&&isset($_POST['pass'])&&isset($_POST['lname'])&&isset($_POST['fname'])&&isset($_POST['interests']))
		{
			try
			{
				if(mysql_query("INSERT INTO `login_details`(`id`, `password`, `interests`, `first_name`, `last_name`) VALUES ('".$_POST['uname']."','".$_POST['pass']."','".$_POST['interests']."','".$_POST['fname']."','".$_POST['lname']."')"))
				{
					echo "done";
				}
			}
			catch(Exception $e)
			{
				echo 'Caught exception: ',  $e->getMessage(), "\n";		
			}
		}
		else
		{
			echo "wrong variables";
		}
		
	}
	else
	{
?>
<style type="text/css">
	input
	{
		display:block;
		padding:5px;
		margin-top:5px;
		width:250px;
	}
	#habit_holder
	{
		float:left;
		border:2px solid white;
		padding:10px;
		width:226px;
		color:white;
	}
	.habit_box
	{
		float:left;
		color:white;
		margin:1px;
		background-color:gray;
		padding:5px;
		border:1px solid black;
	}
</style>
<div style="background-color:black;padding:80px;padding-top:20px;display:block;margin:80px auto;width:250px;">
<div style="color:white;font-size:30px;margin-bottom:20px;">SignUp</div>
<form action="" method="post">
<input type="text" name="fname" placeholder="first name"/>
<input type="text" name="lname" placeholder="last name"/>
<input type="text" name="uname" placeholder="Username"/>
<input type="password" name="pass" placeholder="password"/>
<input type="text" id="habit" placeholder="interests" />
<input type="text" name="habit" style="display:none"/>
<div id="habit_holder"><div style="float:left">Interests List</div><br/></div>
<input type="button" value="submit" style="display:block;width:250;margin-top:50px;" name="submit"/>
</form>
</div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	var habits_list='';
	$("#habit").on("keyup",function(e){
		e.preventDefault();
		if(e.which==13)
		{
			habits_list=habits_list+ ','+ $(this).val();
			$("[name=habit]").val(habits_list);
			$("#habit_holder").append("<div class='habit_box'>"+$(this).val()+"</div>");
			$(this).val('');
		}
	});
	$('[name=submit]').click(function(){
		var fname=$('[name=fname]').val();
		var lname=$('[name=lname]').val();
		var uname=$('[name=uname]').val();
		var pass=$('[name=pass]').val();
		var interests=$('[name=habit]').val();
		if(interests.length>0)
		{
			interests=interests.substring(1,interests.length-1);
		}
		$.post('', {submit:'submit',fname:''+fname,lname:''+lname,uname:''+uname,pass:''+pass,interests:''+interests}, function(data) {
			if(data=="done")
			{
				alert("signup succesful");
				window.location="index.php";
			}
			else
			{
				alert(data);
			}
		});
	});
});
// var habits_list="";
// alert("hello");
// 
</script>
<?php
	}
?>
