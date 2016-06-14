<?php
	$sno=$_SESSION['serial_num'];
	$query_rec=mysql_query("SELECT * FROM `login_details` WHERE `sno` = '$sno'");
	$own_data=mysql_fetch_assoc($query_rec);
	$stemmed_own=$own_data['stemmed_text'];
	$own_stem_arr=preg_split('/[\s]+/', $stemmed_own);
	$own_habit_arr=preg_split('/[\s,]+/', $own_data['interests']);
	$own_habit_length=count($own_habit_arr);
	$own_lenght=count($own_stem_arr);
	$query_rec=mysql_query("SELECT * FROM `login_details` WHERE `sno` <> '$sno' AND `sno`> 0");
	while($row_rec=mysql_fetch_array($query_rec))
	{
		
		$check_stem= $row_rec['stemmed_text'];
		$check_stem_arr=preg_split('/[\s]+/', $check_stem);
		$check_habit_arr=preg_split('/[\s,]+/', $row_rec['interests']);
		$match=0;
		for($i=0;$i<$own_lenght;$i++)
		{
			if(in_array($own_stem_arr[$i], $check_stem_arr)&&trim($own_stem_arr[$i])!="")
			{
				$match++;
			}
		}
		for($i=0;$i<$own_habit_length;$i++)
		{
			if(in_array($own_habit_arr[$i], $check_habit_arr)&&trim($own_habit_arr[$i])!="")
			{
				$match++;
			}
		}
		$own_lenght--;
		$own_habit_length--;
		$match_per=0;
		if($own_lenght+$own_habit_length!=0)
		{
			$match_per=($match/($own_lenght+$own_habit_length))*100;
		}
		$rec_leve=0;
		if($match_per<=5)
		{
			$rec_leve=0;
		}
		else if($match_per<=10)
		{
			$rec_leve=1;
		}
		else if($match_per<=15)
		{
			$rec_leve=2;
		}
		else if($match_per<=20)
		{
			$rec_leve=3;
		}
		else if($match_per<=25)
		{
			$rec_leve=4;
		}
		else
		{
			$rec_leve=5;
		}
		echo "<a href='request.php?id=".$row_rec['sno']."' data='".($own_lenght+$own_habit_length)."'><div style='margin:25px;margin-left:75px;height:auto;padding:2px;float:left;border:1px solid black;'>";
		echo "<div style='background-color:black;padding:5px;height:50px;width:50px;float:left;'><img redir='same' id='profile_pic' src='pic.php?id=".$row_rec['sno']."' width='50px' height='50px'></div>";
		echo "<span style='height:50px;float:left;color:white;margin-left:2px;background-color:black;padding:5px;'>".$row_rec['first_name']." ".$row_rec['middle_name']." ".$row_rec['last_name']."<br/>
		<div style='margin-top:5px;border:1px solid white;width:250px;height:20px;'>
		<div style='background-color:white;width:".$match_per."%;height:100%;'>
		</div></div>";
		echo "<div style='width:250px;text-align:center;margin-top:-20px;color:blue;'>".number_format((float)$match_per, 1, '.', '')."%</div></span>";
		echo "<div style='color:white;margin-top:61px;padding:2px;padding-left:5px;background-color:black;'>Recommdation level :".$rec_leve."/5</div>";
		echo "</div></a>";
	}
?>