<meta name="viewport" content ="width=device-width">
<?php
if(!isset($_SESSION['login_status'])||empty($_SESSION['login_status']))
	header('Location: index.php');
else{
	$sno=$_SESSION['serial_num'];
	$query_check=mysql_query("SELECT * FROM `login_details` WHERE `sno`='$sno'");
	$value_k=mysql_fetch_assoc($query_check);
	$id1=$value_k['id'];
	$online_num=$_SESSION['online_num'];
	echo "<div class='sno' prof='$id1' sess='$online_num' ></div>";
}
?>
<script type="text/javascript">
	$(document).ready(function(){

	});
</script>
<style>
	body, html {
		margin: 0;
		padding: 0;
		overflow-x: auto;
		overflow-y: auto;
		width:1366px;
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
		top:140px;
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
		top:160px;
		left:203px;
		position:absolute;
		width:940px;
		background-color:#eeeeee;
	}
	#search:hover{
		border-color:black;
	}
</style>
<!----------------------------------------------------------form for editing profile-------------------------------------------------------------------------->
<div id="edit_op" style="z-index:10;position:absolute;left:460px;top:200px;width:400px;height:300px;background-color:black;color:white;display:none;opacity:0.8;">
	<form action="user.php" method="POST" enctype="multipart/form-data">
		<div style="position:relative;left:50px;top:50px;"><p style="color:white">Profile pic:</p><input type="file" name="image" ></div>
		<div style="position:relative;left:50px;top:70px;"><p style="color:white">Status:</p><input type="text" name="status"></div>
		<div style="position:relative;left:50px;top:90px;"><input id="edit_submit" type="submit" value="Upload"></div>
	</form>
	<h1 style="cursor:pointer;position:absolute;right:15px;top:2px;color:white;">x</h1>
</div>
<!----------------------------------------------------------search bar----------------------------------------------------------------------------------------->
<div style="position:absolute;left:0px;top:0px;z-index:3;height:30px;width:1346px;background-color:black;">
<div style="background-color:white;width:30px;height:28px;position:absolute;left:450px;top:1px;"><a href="index.php"><img src="home.png" width="30px" height="28px"></a></div>
<div style="width:399px;left:10px;position:relative;top:5px;background-color:black;color:white;height:15px;border-color:black;overflow:hidden;"><input type="text" name="search" placeholder="Search friends" title="search" id="search" style="width:400px;left:-1px;top:-1px;position:relative;background-color:black;color:white;border-color:black;"></div>
<div style="width:405px;height:1px;left:10px;position:absolute;top:24px;background-color:white;" ></div>
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
		$sno=$_SESSION['serial_num'];
		$insert=mysql_query("UPDATE `login_details` SET `dp`='$image' WHERE `sno`='$sno'") or  die(mysql_error());
	}	
}
if(isset($_POST['status'])&&!empty($_POST['status']))
{	
	$status=$_POST['status'];
	session_start();
	$sno=$_SESSION['serial_num'];
	$insert=mysql_query("UPDATE `login_details` SET `status`='$status' WHERE `sno`='$sno'") or  die(mysql_error());
}
?>
<div id="main"> <!--starting of ever visilble data--->
	<!----------------------------------------------------------------------left block------------------------------------------------------------------>
	<div style="position:absolute;width:150px;height:730px;top:50px;left:50px;background-color:black;">
		<div id='img_holder'>
			<?php echo "<img redir='same' id='profile_pic' src='pic.php?id=$sno' width='50px' height='50px'>"?>
		</div>
		<p id="edit" style="position:absolute;left:80px;top:30px;cursor:pointer;"><u style="color:white;">Edit Profile</u></p>
		<div style="position:absolute;left:18px;top:70px;"><p style="color:white;"><?php $query_check=mysql_query("SELECT * FROM `login_details` WHERE `sno`='$sno'") or die("bollo");
			$value=mysql_fetch_assoc($query_check);
			echo $value['first_name']." ".$value['middle_name']." ".$value['last_name'];
			?></p></div>
		</div>
		<!---------------------------------------------------------------------top block---------------------------------------------------------------------------->
		<div style="background-color:black;position:absolute;width:1146px;left:200px;top:75px;height:80px;">
			<div id="arrow"style="position:absolute;left:0px;top:0px;width:30px;height:25px;background-color:white;"></div>
			<div style="top:0px;left:30px;position:absolute;border-style:solid;border-color:rgb(20,20,20);background-color:white;">
				<h1> <?php $query_check=mysql_query("SELECT * FROM `login_details` WHERE `sno`='$sno'") or die("bollo");
					$value=mysql_fetch_assoc($query_check);
					echo $value['status'];
					?></h1>
				</div>
			</div>
			<div class="tabs" style="left:865px;color:black;background-color:white;width:80px;" block="news_feed">News Feeds</div>
			<div class="tabs" style="left:980px;" block="friend">Friends(<?php 
				$sno=$_SESSION['serial_num'];
				$query_check=mysql_query("SELECT * FROM `login_details` WHERE `sno`='$sno'") or die("bollo");
				$value=mysql_fetch_assoc($query_check);
				$value=$value['id'];
				$num=0;
				$query_check=mysql_query("SELECT distinct count(`sno`) `status` FROM `friends` WHERE (`to`='$value' AND `status`='y') OR (`from`='$value' AND `status`='y')") or die("bollo");
				$num=mysql_fetch_row($query_check);
				echo $num[0];
				?>)
			</div>
			<div class="tabs" style="left:1086px;" block="request">Requests(<?php 
				$sno=$_SESSION['serial_num'];
				$query_check=mysql_query("SELECT * FROM `login_details` WHERE `sno`='$sno'") or die("bollo");
				$value=mysql_fetch_assoc($query_check);
				$value=$value['id'];
				$query_check=mysql_query("SELECT `sno`, `from`, `to`, `status` FROM `friends` WHERE `to`='$value' AND `status`='r'") or die("bollo");
				$num=0;
				while(mysql_fetch_array($query_check))
					{$num=$num+1;}
				echo $num;
				?>)
			</div>
			<div class="tabs" style="left:1200px;" block="recommandation">Recommandation</div>
			<div class="tabs" id="post_block" style="left:350px;border-style:solid;border-color:rgb(ff,ff,ff);" block="post">Post Something</div>
	<!----------------------------------------------------------- middle block  ---------------------------------------------------------------------------------->
	<!----------------------------------------------------------- news feeds ---------------------------------------------------------------------------------->
<div id="news_feed" style="display:block;" class="middle_block">
<?php
require 'minum_log.php';
	$sno=$_SESSION['serial_num'];
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
	if($sno_for_post==$sno)
	{
		$redir='same';
		$p="<div post='$post_num' class='del_post' title='Delete post' style='cursor:pointer;position:absolute;top:0px;right:3px;width:10px;height:60px;color:black;'>X</div>";
	}
	else{$redir=$sno_for_post;
	$p="";
	}
if(strlen($post_image)>0)
{
echo "<div class='click' style='float:left;overflowx:hidden;position:relative;margin:10px;top:6px;border-style:solid;border-color:rgb(20,20,20);left:6px;width:500px;height:360px;overflow-y:hidden;color:white;background-color:white;'>
".$p."
<img redir='$redir' src='pic.php?id=$sno_for_post' style='cursor:pointer;position:absolute;left:20px;top:20px;background-color:black;width:50px;height:50px;' width='50px' height='50px'>
<a href='request.php?id=".$out['sno']."'><div style='color:white;position:absolute;left:72px;height:50px;width:400px;top:20px;background-color:black;'><p style='top:20px;position:relative;left:10px;'><u>".$name."</u></p></div></a>
<div style='width:250px;float:left;height:auto;'><img redir='no' src='getpost.php?id=$post_num' style='border:1px solid black;float:left;position:relative;left:20px;top:80px;background-color:black;' width='100%'></div>
<div style='position:absolute;top:85px;color:black;left:280px;'><p style='color:black;font-size:20px;'>".$post_status."</p>
</div>
	</div>";}
	else
	{
echo "<div class='click' style='float:left;position:relative;margin:10px;top:6px;border-style:solid;border-color:rgb(20,20,20);left:6px;width:500px;height:150px;color:white;background-color:white;'>
".$p."
<img redir='$redir' src='pic.php?id=$sno_for_post' style='position:absolute;left:20px;top:20px;background-color:black;width:50px;height:50px;' width='50px' height='50px'>
<a href='request.php?id=".$out['sno']."'><div style='color:white;position:absolute;left:72px;height:50px;width:400px;top:20px;background-color:black;'><p style='top:20px;position:relative;left:10px;'><u>".$name."</u></p></div></a>
<div style='position:absolute;top:85px;color:black;left:20px;'><p style='color:black;font-size:20px;'>".$post_status."</p></div>
	</div>";
	}
	}
?></div>
<!-------------------------------------------------------------------friends block---------------------------------------------------------------------------->
<div id="friend" style="display:none;"class="middle_block" ><?php 
	$sno=$_SESSION['serial_num'];
	$query_check=mysql_query("SELECT * FROM `login_details` WHERE `sno`='$sno'") or die("bollo");
	$value=mysql_fetch_assoc($query_check);
	$value1=$value['id'];
	$query_check_h=mysql_query("SELECT `sno`, `from`, `to`, `status` FROM `friends` WHERE (`from`='$value1' AND `status`='y') OR (`to`='$value1' AND `status`='y')") or die(mysql_error());
	while($req=mysql_fetch_array($query_check_h))
	{
		if($req['from']==$value1)
			$req_from=$req['to'];
		if($req['to']==$value1)
			$req_from=$req['from'];
		$query_check=mysql_query("SELECT * FROM `login_details` WHERE `id`='$req_from'") or die("bollo");
		$value=mysql_fetch_assoc($query_check);
		$req_sno=$value['sno'];
		$req_name=$value['first_name']." ".$value['middle_name']." ".$value['last_name'];
		if($req_sno==$sno)$redir='same'; else $redir=$req_sno;
		echo "<div style='position:relative;float:left;margin:10px;background-color:white;width:250px;height:150px;border-style:solid;border-color:rgb(20,20,20);'>
		<img redir='$redir' src='pic.php?id=$req_sno' style='background-color:black;position:absolute;top:5px;left:5px;width:140px;height;140px;border:1px solid black'width='140px' height='140px'>
		<div style='position:absolute;top:40px;left:155px;color:black;'>".$req_name."</div>
	</div>";
}

?></div>
	<!----------------------------------------------------------- request block ---------------------------------------------------------------------------------->
<div id="request" style="display:none;" class="middle_block" ><?php 
$sno=$_SESSION['serial_num'];
	$query_check=mysql_query("SELECT * FROM `login_details` WHERE `sno`='$sno'") or die("bollo");
	$value=mysql_fetch_assoc($query_check);
	$value_id=$value['id'];
$query_check_m=mysql_query("SELECT `sno`, `from`, `to`, `status` FROM `friends` WHERE `to`='$value_id' AND `status`='r'") or die("bollo");
	while($req=mysql_fetch_array($query_check_m))
	{
		$req_from=$req['from'];
		$query_check1=mysql_query("SELECT * FROM `login_details` WHERE `id`='$req_from'") or die("bollo");
		$value1=mysql_fetch_assoc($query_check1);
		$req_from_sno=$value1['sno'];
		$req_sno1=$req['sno'];
		if($req_from_sno==$sno)$redir='same'; else $redir=$req_from_sno;
		echo "<div style='position:relative;float:left;margin:10px;background-color:white;width:250px;height:auto;border-style:solid;border-color:rgb(20,20,20);'>
		<img redir='$redir' src='pic.php?id=$req_from_sno' style='background-color:black;float:left;top:5px;left:5px;width:140px;height;140px;'width='140px' height='140px'>
		<div class='accept' style='position:absolute;top:40px;left:180px;color:white;background-color:black;' ser='$req_sno1'><u>accept</u></div>
		<div class='reject' style='position:absolute;top:80px;left:180px;color:white;background-color:black;' ser='$req_sno1'><u>reject</u></div>
		<div style='color:black;float:left;width:100%;padding:5px;text-transform: capitalize;'>".$value1['first_name']." ".$value1['middle_name']." ".$value1['last_name']."</div>
		</div>";
		
	}
	?></div>
	<!----------------------------------------------------------- recommandations  ---------------------------------------------------------------------------------->
<div id="recommandation" style="display:none;"class="middle_block" >
	<?php
		include 'recommandation.php'; 
	?>
</div>
	<!-----------------------------------------------------------post form---------------------------------------------------------------------------------->
	<div id="post" style="display:none;top:178px;left:300px;width:400px;background-color:black;color:white;height:250px;z-index:10;" class="middle_block" >
		<form action="user.php" method="POST" enctype="multipart/form-data">
			<div style="position:relative;left:50px;top:50px;"><p style="color:white">Post pic:</p><input type="file" name="image_post" ></div>
			<div style="position:relative;left:50px;top:70px;"><p style="color:white">write text:</p><input type="text" name="text_post"></div>
			<div style="position:relative;left:50px;top:90px;"><input id="edit_submit" type="submit" value="Upload"></div>
		</form>
		<h1 style="cursor:pointer;position:absolute;right:15px;top:2px;color:white;">x</h1></div>
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
			$sno=$_SESSION['serial_num'];
			$query_check=mysql_query("SELECT * FROM `login_details` WHERE `sno`='$sno'") or die("bollo");
			$value1=mysql_fetch_assoc($query_check);
			$value=$value1['id'];
			$insert=mysql_query("INSERT INTO `login_test`.`post` (`sno`, `from`, `post`,`image`) VALUES (NULL, '$value', '$post','$image');") or die("bollo");
			require 'stemmer.php';
			$stemmed_text=$value1['stemmed_text'];
			$stemmed_text=autostem($post,$stemmed_text);
			$query=mysql_query("UPDATE `login_details` SET `stemmed_text`='$stemmed_text' WHERE `sno`='$sno'") or die('you failed machha');
	//$stem = PorterStemmer::Stem($word);
		}
		?>
		<!----------------------------------------------------------------left block---------------------------------------------------------------------------->
<div style="position:absolute;left:1146px;top:165px;width:200px;height:530px;background-color:black;">
<p style="color:white;top:60px;left:10px;position:relative;">online</p>
<div style="top:60px;position:relative;width:90%;left:3%;height:2px;background-color:white;"></div>
<div id="names" style="width:100%;position:absolute;top:85px;left:0px;background-color:black;"></div>
</div>
		<!----------------------------------------------------------------log out key---------------------------------------------------------------------------->
 <script type="text/javascript">
$(document).ready(function(){
	$('.accept').click(function(){
		var ser=$(this).attr("ser");
		$.post("accept.php",{key:ser});
	 window.location="index.php";
	});
	$('.reject').click(function(){
		var ser=$(this).attr("ser");
		$.post("reject.php",{key:ser});
		window.location="index.php";
		});
});
</script>
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
	setInterval(function(){
		var id=$('.sno').attr("prof");
		$.post("online.php",{key:id},function(data){
			$("#names").html(data);
		});
	},500);
	$(".del_post").click(function(){
		var url      = window.location.href;
		var num=$(this).attr("post");
		$.post("del_post.php",{key:num},function(data){	
		});
		window.location=url;
	});
	var slide1=0;
setInterval(function(){ 
	$("#arrow").animate({backgroundPosition:'+=5px'},180);
	slide1=slide1+5;
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
	$(".tabs").click(function(){
		$(".tabs").css('color','white');
		$(".tabs").css('background-color','black');
		$(this).css('color','black');
		$(this).css('background-color','white');
		var block=$(this).attr("block");
		if(block!="post"){
		$(".middle_block").css('display','none');
		$("#"+block).css('display','block');
		}
		else{
			$("#"+block).css('display','block');
		}
	});
	$("#post h1").click(function(){
		$("#post").css("display","none");
				$("#post_block").css('color','white');
		$("#post_block").css('background-color','black');

	});
window.onunload = function () {
	var sno=$(".sno").attr("sess");
 $.get( "logout.php", {sno:sno} );
}
	
});
</script>
<?php
echo "<a style='position:absolute;left:1100px;top:40px;text-decoration:none;margin-top:5px;' href='logout.php?sno=$online_num'><span style='background-color:black;color:white;padding:5px;'>Logout</span></a>";
?>
</div>