<style>
html,body
{
	height:100%:
	width:100%;
	font-size:100%;
	font-height:100%;
}
.hexa
{
	width:160px;
	height:160px;
	position:absolute;
	background:url("32425.png") no-repeat;
	background-size:100% 100%;
	z-index:1;
}
.hexa:hover
{
	width:180px;
	height:180px;
	opacity:0.9;
	background:url("hexagon-outline-xxl.png") no-repeat;
	background-size:100% 100%;
	z-index:2;
}
h3
{
	left:30%;
	top:30%;
	font-size:100%;
	position:absolute;
	
}
.blocks
{
	width:50px;
	height:50px;
	background-color:black;
	position:absolute;
	box-shadow: 10px 10px 5px #888888;
}
#mid
{
	font-size:100%;
	left:30%;
}
body, html {
    margin: 0;
    padding: 0;
    text-align: center;
    overflow-x: auto;
    overflow-y: auto;
	width:1366px;
}
#home
{
	position:absolute;
	top:80px;
}
body, div, dl, dt, dd, ul, ol, li, h1, h2, h3, h4, h5, h6, pre, code, form, fieldset, legend, input, textarea, p, blockquote, th, td {
margin: 0;
padding: 0;
}
.verline
{
	-ms-transform: rotate(90deg);
	-webkit-transform: rotate(90deg);	
	transform: rotate(90deg);
	position:absolute;
	top:200px;
	width:400px;
	background-color:black;
	font-size:50px;
	height:10px;
}
.basic_s
{
	position:absolute;
	width:1300px;
	height:630px;
	left:2000px;
	top:30px;
	z-index:3;
	display:none;
}
.slide{
	position:absolute;
	width:100%;
	height:100%;
	left:0px;
	top:0px;
	opacity:0.8;
	background-color:white;
}
.inside_slide
{
	position:absolute;
	width:1240px;
	height:570px;
	left:30px;
	top:30px;
	opacity:0.7;
	background-color:white;
	border-bottom-left-radius:10px;
	border-bottom-right-radius:10px;
	border-top-left-radius:10px;
	border-top-right-radius:10px;
}
.close{
	position:absolute;
	right:8px;
	top:6px;
	font-size:25px;
	color:black;
	opacity:1;
}
.close:hover{
		opacity:1;
	font-size:30px;
}
#tait
{
	position:absolute;
	left:149px;
	top:5px;
	height:120px;
	width:120px;
	background-color:white;
	border-radius:75px;
	background-size:100% 100%;

}
[name='id'],[name='pass'],#submit
{
	display:block;
	margin-top:10px;
	padding:4px;
	background-color:white;
	border:none;
}
#submit
{
	float:right;
}
</style>
<div style="left:0px;top:0px;position:absolute;width:100%;height:130px;background-color:black;margin:0px;">
<h4 style="position:absolute;left:60px;top:40px;color:white;font-size:50px;">Friend Finder</h4>
<h4 style="position:absolute;left:180px;bottom:20px;color:white;"></h4>
<a href="signup.php"><div style="position: absolute;
    right: 60px;
    top: 61px;
    background-color: white;
    font-weight: bold;
    padding: 5px;
    font-size: 20px;
    color: black;">
SignUp
</div></a>
</div>

<!-- <div id="home" style="width:800px;height:240px;left:400px;top:240px;position:absolute;background-color:white;"> -->
<div style="margin:310px auto 20px;background-color:black;padding:20px 60px 10px;display:inline-block;box-shadow:3px 3px 5px rgba(0,0,0,0.5),-3px -3px 5px rgba(0,0,0,0.5)">
	<div style="color:white;"><b>User Login</b></div>
	<form action="index.php" method="POST" style="color:white;">
        <input placeholder="Username" style="" name='id'  type="text">
        <input placeholder="Password" style="" name='pass'  type="password"> 
        <input id="submit" style="" value="submit" type="submit"/>
	</form>
</div>
<!-- <div class="hexa" next="pastevent" style="left:0px;top:60px;"><h3 style="left:30%;top:40%;">PAST<br>EVENTS</h3></div>
<div class="hexa" next="what_new" style="left:110px;top:0px;"><h3 style="left:30%;top:40%;">WHAT'S<br>NEW</h3></div>
<div class="hexa" next="gallery" style="left:220px;top:60px;"><h3 id="mid" style="left:27%;top:45%;">GALLERY</h3></div>
<div class="hexa" next="results" style="left:330px;top:0px;"><h3 style="left:26%;top:45%;">RESULTS</h3></div>
<div class="hexa" next="aboutus" style="left:440px;top:60px;"><h3 style="left:20%;top:45%;">ABOUTS US</h3></div> -->
<!-- </div> -->
<?php
include 'desing.php';
?>
<div id="pastevent" class="basic_s"><div class="slide"></div><div class="inside_slide" style="background-color:#ffff51;"></div><div next="pastevent" class="close">X</div><div class="store">
<div></div>
</div></div>
<div id="what_new" class="basic_s"><div class="slide" ></div><div class="inside_slide" style="background-color:#4fff4f;">
<form action="index.php" method="POST" style="color:black;width:800px;text-align:left;">
            Login<input style="float:right;top:0%;width:30%;height: 90%; color:black;font-size:90%;" name='id'  type="text">
			<br/>
            Password<input style="float:right;top:0%;width:30%;height: 90%; color:black;font-size:90%;" name='pass'  type="password"> 
            <input id="submit" style="font-size:80%;" value="submit" type="submit"/>
</form>
</div><div next="what_new" class="close">X</div><div  class="store"></div></div>
<div id="gallery" class="basic_s"><div class="slide" ></div><div class="inside_slide" style="background-color:#ff5151;"></div><div next="gallery" class="close">X</div><div  class="store"></div></div>
<div id="results" class="basic_s"><div class="slide" ></div><div class="inside_slide" style="background-color:#4f4fff;"></div><div next="results" class="close">X</div><div  class="store"></div></div>
<div id="aboutus" class="basic_s"><div class="slide" ></div><div class="inside_slide" style="background-color:#ff48a4;"></div><div next="aboutus" class="close">X</div><div  class="store"></div></div>