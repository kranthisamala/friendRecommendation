<?php
session_start();
if(!isset($_SESSION['login_status'])||empty($_SESSION['login_status']))
	header('Location: index.php');
$sno=$_GET['id'];
?>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	var slide1=0;
setInterval(function(){ 
	$("#arrow").animate({backgroundPosition:'+=5px'},180);
	slide=slide+5;
	if(slide1==60)
	{$("#arrow").animate({backgroundPosition:'0px'},180);}
},1);
	$("title").html("Login user");
	$("#search").keyup(function(){
		var val=$(this).val();
		if(val.length>0)
		{
			
	$.post("getphp.php",{key:val},function(data){
		if(data.lenght>0)
		alert(data);
		$("#results").html(data);
		});}
		else{
			$("#results").html("");
		}
	});
	$('.profile').click(function(){
		alert("hello");
	});
	$("#edit").click(function(){
		$("#edit_op").css("display","block");
	});
	$("edit_submit").click(function(){$("#edit_op").css("display","none");});
	$("#edit_op h1").click(function(){$("#edit_op").css("display","none");});
	$("#post h1").click(function(){
		$("#post").css("display","none");
				$("#post_block").css('color','white');
		$("#post_block").css('background-color','black');

	});
});
</script>
<style>
#pofile_pic
{
	
}
body, div, dl, dt, dd, ul, ol, li, h1, h2, h3, h4, h5, h6, pre, code, form, fieldset, legend, input, textarea, p, blockquote, th, td {
margin: 0;
padding: 0;
}
#img_holder
{
	position:absolute;
	width:50px;
	height:50px;
	left:20px;
	top:20px;
	overflow:hidden;
	background-color:black;
}
#back_black{
	background-color:black;
	height:730px;
	width:1366px;
	left:0px;
	top:0px;
	opacity:0.5;
}
.tabs{
	padding-top:5px;
	padding-left:5px;
	padding-right:5px;
	color:white;
	background-color:black;
	position:absolute;
	top:150px;
	height:18px;
	z-index:3;
	font-weight:bold;
}
.tabs:hover{
	color:black;
	background-color:white;	
	cursor:pointer;
	
}
#arrow
{
	background:url(arrow.png);
}
.middle_block{
	top:175px;
	left:203px;
	position:absolute;
	width:940px;
	background-color:#eeeeee;
}

</style>
<!----------------------------------------------------------------------------request form-------------------------------------------------------------------->
<div style="position:absolute;left:850px;top:40px;cursor:pointer;padding:5px;background-color:black;color:white;"><?php 
require 'minum_log.php';
$from=$_SESSION['serial_num'];
$query=mysql_query("SELECT * FROM `login_details` WHERE `sno`='$from'") or die("bollo");
$output=mysql_fetch_assoc($query);
$one=$output['id'];
$from=$_GET['id'];
$query=mysql_query("SELECT * FROM `login_details` WHERE `sno`='$from'") or die("bollo");
$output=mysql_fetch_assoc($query);
$two=$output['id'];
$print="send request";
$class="send_request";
$query1=mysql_query("SELECT * FROM `friends` WHERE (`from`='$one' AND `to`='$two' AND `status`='y') OR (`from`='$two' AND `to`='$one' AND `status`='y') ");
$query1=mysql_fetch_assoc($query1);
$query1=$query1['sno'];
if($query1>0)
{
$print="Unfriend";
$class="unfriend";
}
$query1=mysql_query("SELECT * FROM `friends` WHERE `from`='$one' AND `to`='$two' AND `status`='r' ");
$query1=mysql_fetch_assoc($query1);
$query1=$query1['sno'];
if($query1>0){
	$print="cancle sent request";
	$class="request_sent";
}
$query1=mysql_query("SELECT * FROM `friends` WHERE `from`='$two' AND `to`='$one' AND `status`='r' ");
$query1=mysql_fetch_assoc($query1);
$query1=$query1['sno'];
if($query1>0)
{
	$print="accept";
	$class="accept";
}
echo "<div class='$class' from='$one' to='$two'>".$print."</div>"; 
?></div>
<script>
$(".accept").click(function(){
	var from=$(this).attr("from");
	var to=$(this).attr("to");
	var class_a="accept";
	var url      = window.location.href;
	window.location=url;
	$.post("friend.php",{from:from,to:to,class_a:class_a},function(data){
		if(data==done){$(this).text("unfriend");$(this).removeClass('accept');$(this).addClass('unfriend');}
	});
});
$(".request_sent").click(function(){
	var from=$(this).attr("from");
	var to=$(this).attr("to");
	var class_a="request_sent";
	var url      = window.location.href;
	window.location=url;
	$.post("friend.php",{from:from,to:to,class_a:class_a},function(data){
		if(data==done){$(this).text("send request");$(this).removeClass('request_sent');$(this).addClass('send_request');}
	});
});
$(".unfriend").click(function(){
	var from=$(this).attr("from");
	var to=$(this).attr("to");
	var class_a="unfriend";
	var url      = window.location.href;
	window.location=url;
	$.post("friend.php",{from:from,to:to,class_a:class_a},function(data){
		if(data==done){$(this).text("send request");$(this).removeClass('unfriend');$(this).addClass('send_request');}
	});
});
$(".send_request").click(function(){
	var from=$(this).attr("from");
	var to=$(this).attr("to");
	var class_a="send_request";
	var url      = window.location.href;
	window.location=url;
	$.post("friend.php",{from:from,to:to,class_a:class_a},function(data){
		if(data==done){$(this).text("cancle sent request");$(this).removeClass('send_request');$(this).addClass('request_sent');}
	});
});
</script>
	<!----------------------------------------------------------- search bar ---------------------------------------------------------------------------------->
<div style="position:absolute;left:0px;top:0px;z-index:3;height:30px;width:1346px;background-color:black;">
<div style="background-color:white;width:30px;height:28px;position:absolute;left:450px;top:1px;"><a href="index.php"><img src="home.png" width="30px" height="28px"></a></div>
<div style="width:390px;left:10px;position:relative;top:5px;background-color:black;color:white;height:15px;border-color:black;overflow:hidden;"><input type="text" name="search" placeholder="Search friends" title="search" id="search" style="width:400px;left:-1px;top:-1px;position:relative;background-color:black;color:white;border-color:black;"></div>
<div style="width:405px;height:1px;left:10px;position:absolute;top:24px;background-color:white;"></div>
<div id="results" style="position:absolute;width:402px;left:10px;background-color:black;top:25px;"></div>
</div>
<!----------------------------------------------------------updating image ad status------------------------------------------------------------------>

<?php
require 'minum_log.php';
if(isset($_FILES['image']))
{	
$file=$_FILES['image']['tmp_name'];
}
if(!isset($file))
{
	echo "please upload a pic";
}
else{
	$image=addslashes(file_get_contents($_FILES['image']['tmp_name']));
	$iamge_name=$_FILES['image']['name'];
	$image_size=getimagesize($_FILES['image']['tmp_name']);
	if($image_size==FALSE)
		echo "that is not image";
	else{
		session_start();
		$sno=$_GET['id'];
		$insert=mysql_query("UPDATE `login_details` SET `dp`='$image' WHERE `sno`='$sno'") or  die(mysql_error());
	}	
}
if(isset($_POST['status'])&&!empty($_POST['status']))
{	
	$status=$_POST['status'];
	session_start();
	$sno=$_GET['id'];
	$insert=mysql_query("UPDATE `login_details` SET `status`='$status' WHERE `sno`='$sno'") or  die(mysql_error());
}
?>
<div id="main"> <!--starting of ever visilble data--->
<!----------------------------------------------------------------------left block------------------------------------------------------------------>
<div style="position:absolute;width:150px;height:730px;top:50px;left:50px;background-color:black;">
 <div id='img_holder'>
<?php echo "<img id='profile_pic' src='pic.php?id=$sno' width='50px' height='50px' redir='same' >"?>
 </div>

  <div style="position:absolute;left:18px;top:70px;"><p style="color:white;"><?php $query_check=mysql_query("SELECT * FROM `login_details` WHERE `sno`='$sno'") or die("bollo");
	$value=mysql_fetch_assoc($query_check);
	echo $value['first_name']." ".$value['middle_name']." ".$value['last_name'];
	?></p></div>
 </div>
 <!---------------------------------------------------------------------top block---------------------------------------------------------------------------->
 <div style="background-color:black;position:relative;width:1146px;left:200px;top:75px;height:80px;">
 <div id="arrow"style="position:absolute;left:0px;top:0px;width:30px;height:25px;background-color:white;"></div>
 <div style="top:0px;left:30px;position:absolute;border-style:solid;border-color:rgb(20,20,20);background-color:white;">
 <h1> <?php $query_check=mysql_query("SELECT * FROM `login_details` WHERE `sno`='$sno'") or die("bollo");
	$value=mysql_fetch_assoc($query_check);
	echo $value['status'];
	?></h1>
 </div>
 </div>
 <div class="tabs" style="right:280px;color:black;background-color:white;" block="news_feed"><?php echo $value['first_name'];?>'s Timeline</div>
<div class="tabs" style="right:180px;" block="friend_a">Friends(<?php 
$sno=$_GET['id'];
	$query_check=mysql_query("SELECT * FROM `login_details` WHERE `sno`='$sno'") or die("bollo");
	$value=mysql_fetch_assoc($query_check);
	$value=$value['id'];
	$num=0;
$query_check=mysql_query("SELECT distinct count(`sno`) `status` FROM `friends` WHERE (`to`='$value' AND `status`='y') OR (`from`='$value' AND `status`='y')") or die("bollo");
	$num=mysql_fetch_row($query_check);
	echo $num[0];
	?>)</div>
<!-----------------------------------------------------------------middle block------------------------------------------------------------------------------->
<!----------------------------------------------------------- news feeds ---------------------------------------------------------------------------------->
<div id="news_feed" style="display:block;" class="middle_block"><?php
require 'minum_log.php';
	$sno=$_GET['id'];
	$query_check=mysql_query("SELECT * FROM `login_details` WHERE `sno`='$sno'") or die("bollo");
	$value=mysql_fetch_assoc($query_check);
	$value=$value['id'];
	$query_check=mysql_query("SELECT distinct p.`sno`, p.`from`, p.`post`, p.`image` FROM `post` p, `friends` f WHERE (p.`from`=f.`from` AND f.`to`='$value' AND f.`status`='y') OR (p.`from`='$value') OR (p.`from`=f.`to` AND f.`from`='$value' AND f.`status`='y') ORDER BY p.`sno` desc" )or die(mysql_error());
	while($value_post=mysql_fetch_array($query_check))
	{	
$from=$value_post['from'];
$post_num=$value_post['sno'];
$post_status=$value_post['post'];
$post_image=$value_post['image'];
$out=mysql_query("SELECT * FROM `login_details` WHERE `id`='$from'") or die("bollo");
	$out=mysql_fetch_assoc($out);
	$sno_for_post=$out['sno'];
	$name=$out['first_name']." ".$out['middle_name']." ".$out['last_name'];
	if($sno_for_post==$_SESSION['serial_num'])
	{
		$redir='same';
		$p="<div post='$post_num' class='del_post' title ='Delete post' style='cursor:pointer;position:absolute;top:0px;right:3px;width:10px;height:60px;color:black;'>X</div>";
	}
	else{$redir=$sno_for_post;
	$p="";
	}
if(strlen($post_image)>0)
{
echo "<div class='click' style='position:relative;margin:10px;top:6px;border-style:solid;border-color:rgb(20,20,20);left:6px;width:500px;height:350px;color:white;background-color:white;'>
".$p."
<img redir='$redir' src='pic.php?id=$sno_for_post' style='position:absolute;left:20px;top:20px;background-color:black;width:50px;height:50px;' width='50px' height='50px'>
<a href='request.php?id=".$out['sno']."'><div style='color:white;position:absolute;left:72px;height:50px;width:400px;top:20px;background-color:black;'><p style='top:20px;position:relative;left:10px;'><u>".$name."</u></p></div></a>
<img redir='no' src='getpost.php?id=$post_num' style='position:relative;left:20px;top:80px;background-color:black;width:250px;height:250px;' width='250px' height='250px'>
<div style='position:absolute;top:85px;color:black;left:280px;'><p style='color:black;font-size:20px;'>".$post_status."</p>
</div>
	</div>";}
	else
	{
echo "<div class='click' style='position:relative;margin:10px;top:6px;border-style:solid;border-color:rgb(20,20,20);left:6px;width:500px;height:150px;color:white;background-color:white;'>
".$p."
<img redir='$redir' src='pic.php?id=$sno_for_post' style='position:absolute;left:20px;top:20px;background-color:black;width:50px;height:50px;' width='50px' height='50px'>
<a href='request.php?id=".$out['sno']."'><div style='color:white;position:absolute;left:72px;height:50px;width:400px;top:20px;background-color:black;'><p style='top:20px;position:relative;left:10px;'><u>".$name."</u></p></div></a>
<div style='position:absolute;top:85px;color:black;left:20px;'><p style='color:black;font-size:20px;'>".$post_status."</p></div>
	</div>";
	}
	}
?></div>
<!-------------------------------------------------------------------friends block---------------------------------------------------------------------------->
<div id="friend_a" style="display:none;"class="middle_block" ><?php 
$sno=$_GET['id'];
	$query_check=mysql_query("SELECT * FROM `login_details` WHERE `sno`='$sno'") or die(mysql_error());
	$value=mysql_fetch_assoc($query_check);
	$value1=$value['id'];
	$query_check_m=mysql_query("SELECT `sno`, `from`, `to`, `status` FROM `friends` WHERE (`from`='$value1' AND `status`='y') OR (`to`='$value1' AND `status`='y')") or die(mysql_error());
	while($req=mysql_fetch_array($query_check_m))
	{
		if($req['from']==$value1)
		$req_from=$req['to'];
	if($req['to']==$value1)
		$req_from=$req['from'];
		$query_check=mysql_query("SELECT * FROM `login_details` WHERE `id`='$req_from'") or die(mysql_error());
		$value=mysql_fetch_assoc($query_check);
		$req_sno=$value['sno'];
		$req_name=$value['first_name']." ".$value['middle_name']." ".$value['last_name'];
		if($req_sno==$_SESSION['serial_num'])$redir='same'; else $redir=$req_sno;
		echo "<div style='position:relative;float:left;margin:10px;background-color:white;width:250px;height:150px;border-style:solid;border-color:rgb(20,20,20);'>
		<img redir='$redir' src='pic.php?id=$req_sno' style='background-color:black;position:absolute;top:5px;left:5px;width:140px;height;140px;'width='140px' height='140px'>
		<div style='position:absolute;top:40px;left:160px;color:black;'><p>".$req_name."</p></div>
		</div>";
	}
	
	?></div>
	<script type="text/javascript">	$(".tabs").click(function(){
		$(".tabs").css('color','white');
		$(".tabs").css('background-color','black');
		$(this).css('color','black');
		$(this).css('background-color','white');
		var block=$(this).attr("block");
		$(".middle_block").css('display','none');
		$("#"+block).css('display','block');	
	});</script>
<!----------------------------------------------------------------create a post---------------------------------------------------------------------------->
<?php
require 'minum_log.php';
if(isset($_FILES['image_post']))
{	
$file=$_FILES['image_post']['tmp_name'];

	$image=addslashes(file_get_contents($_FILES['image_post']['tmp_name']));
	$iamge_name=$_FILES['image_post']['name'];
	$image_size=getimagesize($_FILES['image_post']['tmp_name']);
	if($image_size==FALSE)
		echo "that is not image";	
}
if((isset($_POST['text_post'])&&!empty($_POST['text_post']))||isset($_FILES['image_post']))
{	
	$post=$_POST['text_post'];
	session_start();
	$sno=$_GET['id'];
	$query_check=mysql_query("SELECT * FROM `login_details` WHERE `sno`='$sno'") or die("bollo");
	$value=mysql_fetch_assoc($query_check);
	$value=$value['id'];
	$insert=mysql_query("INSERT INTO `login_test`.`post` (`sno`, `from`, `post`,`image`) VALUES (NULL, '$value', '$post','$image');") or die("bollo");
}
?>
<!----------------------------------------------------------------left block---------------------------------------------------------------------------->
<div style="position:absolute;left:1146px;top:175px;width:200px;height:530px;background-color:black;">
<?php ?></div>
<!----------------------------------------------------------------log out key---------------------------------------------------------------------------->
 <script type="text/javascript">
$(document).ready(function(){
	$("img").click(function(){
		var url=$(this).attr("redir");
		if(url!="no")
		{
			if(url=='same'){
				window.location='index.php';
			}
				else{
					url="request.php?id="+url;
					window.location=url;
				}
		
		}
	});
	$(".del_post").click(function(){
		var url      = window.location.href;
		var num=$(this).attr("post");
		$.post("del_post.php",{key:num},function(data){
		alert(data);	
		});
		window.location=url;
	});
});
	
</script>
<?php
echo "<a style='position:absolute;left:1100px;top:40px;text-decoration:none;margin-top:5px;' href='logout.php'><span style='background-color:black;color:white;padding:5px;'>Logout</span></a>";
?>
</div>