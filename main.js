$(window).load(function (){
for(var i=0;i<63;i++)
{	number = (Math.floor(Math.random()*63)%63 );
	$("#bx"+number).hide(1);
}

/*	var i=0;
	for(i=0;i<64;i++)
	{
		var colr = (Math.floor(Math.random()*63)%5);
		if(colr==0)
			$("#bx"+i).css('backgroundColor','#4fff4f');
		else if(colr==1)
			$("#bx"+i).css('backgroundColor','#ffff51');
		else if(colr==2)
			$("#bx"+i).css('backgroundColor','#ff5151');
		else if(colr==3)
			$("#bx"+i).css('backgroundColor','#4f4fff');
		else
			$("#bx"+i).css('backgroundColor','#ff48a4');
	}*/
$('.blocks').mouseover(function(){
	$(this).animate({height:"60px",width:"60px"},250);
	$(this).toggle('slow');
    $(this).animate({height:"50px",width:"50px"},1);
});
	var prev,next=1,number;
setInterval(function() {
	number = (Math.floor(Math.random()*63)%63 );
	$("#bx"+number).toggle(2000);
}, 1000);
var savetop=0;
$("h3").mouseover(function(){
	$(this).animate({top:"+=3px"},50);
	for(i=0;i<3;i++)
	{
		$(this).animate({top:"-=6px"},30);
		$(this).animate({top:"+=6px"},30);
	}
	$(this).animate({top:"-=3px"},10);
});
var side;
/*$(".hexa").mouseover(function(){
	var nxt=$(this).attr("next");
	if(nxt=="what_new")
		$(this).css('backgroundColor','#4fff4f');
	else if(nxt=="pastevent")
		$(this).css('backgroundColor','#ffff51');
	else if(nxt=="gallery")
		$(this).css('backgroundColor','#ff5151');
	else if(nxt=="results")
		$(this).css('backgroundColor','#4f4fff');
	else
		$(this).css('backgroundColor','#ff48a4');
}).mouseout(function(){
	$(this).css('backgroundColor','');
});*/
var nxt;
$(".hexa").click(function(){
	nxt=$(this).attr("next");
	side=$("#"+nxt).css('left');
	$("#"+nxt).css('display','block');
$("#"+nxt).animate({left:'35px'},1000);
});
$(document).keyup(function(e) {
  if (e.keyCode == 27) {close();}   // esc
});
$(document).click(function (e) { //Default mouse Position 
        if(e.pageX<35||e.pageX>1335||e.pageY<30||e.pageY>660)close();
});
$(".close").click(function(){close();});
function close(){
	if(side=="-2000px")
	{
		$("#"+nxt).animate({left:'2000px'},1000).delay(1000).css('display','none');
	}
    else
	{
		$("#"+nxt).animate({left:'-2000px'},1000).delay(1000).css('display','none');
	}
	nxt="";
	
}

/*var slide=0;
setInterval(function(){ 
if(slide==0)
{
	$("#home").animate({left:'-=10px'},2000);
	slide=1;
}
else{$("#home").animate({left:'+=10px'},2000);slide=0}
}, 1000);*/
});