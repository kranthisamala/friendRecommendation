<div style="top:30px;left:110px;background-color:black;position:absolute;width:1150px;height:160px;">
<h3 style="position:absolute;left:140px;top:60px;color:white;"><u>NISHITHA T</h3></div>
<img style="position:absolute;left:80px;top:10px;background-color:black;" width='150px' height='150px'>
<!----------------------------------------------------------------left block-------------------------------------------------------------------------->
<style>
.options
{
	left:15px;
	top:60px;
	margin-top:5px;
	border:solid 1px white; 
	position:relative;
	width:116px;
	height:26px;
	color:white;
	padding-left:14px;
	padding-top:10px;
}
.options:hover
{
	background-color:white;
	opacity:0.6;
	color:black;
	margin:9px;
}
</style>
<div style="position:absolute;top:192px;left:110px;height:500px;width:160px;background-color:black;">
<div class="options" block="create_exam">Create exam</div>
<div class="options" block="Edit_exam">Edit existing</div>
<div class="options" block="view_result">View result</div>
</div>
<div style="left:272px;top:192px;background-color:black;position:absolute;height:600px;width:990px;">
<div class="mid"id="create_exam" style="width:100%;height:100%;display:none;background-color:white;"></div>
<div class="mid" id="Edit_exam" style="width:100%;height:100%;display:none;background-color:pink;"></div>
<div class="mid" id="view_result" style="width:100%;height:100%;display:none;background-color:blue;"></div>
</div>
<script>
$(document).ready(function(){
	$(".options").click(function(){
		$(".options").css();
		$(".mid").css('display','none');
		$("#"+$(this).attr('block')).css('display','block');
	});
	$("")
});
</script>
