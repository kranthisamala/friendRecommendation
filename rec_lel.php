<?php
include 'minum_log.php';
	if(isset($_POST['rec']))
	{
		$res=mysql_query("SELECT * FROM `login_details` WHERE `sno`> 0");	
		while($row=mysql_fetch_array($res))
		{
			echo "<span style='color:white;background-color:black;padding:5px 5px 0;float:left;'><img redir='same' id='profile_pic' src='pic.php?id=".$row['sno']."' width='50px' height='50px' style='border:1px solid white;float:left;'>
			<span style='float:left;margin:5px 5px;'>".$row['first_name']." ".$row['middle_name']." ".$row['last_name']."</span></span>";
			echo "<div style='height:auto;border:2px solid black;float:left;margin-bottom:50px;width:100%;'>";
			$sno=$row['sno'];
			$query_rec=mysql_query("SELECT * FROM `login_details` WHERE `sno` = '$sno'");
			$stemmed_own=mysql_fetch_assoc($query_rec);
			$stemmed_own=$stemmed_own['stemmed_text'];
			$own_stem_arr=preg_split('/[\s]+/', $stemmed_own);
			$own_lenght=count($own_stem_arr);
			$query_rec=mysql_query("SELECT * FROM `login_details` WHERE `sno` <> '$sno' AND `sno`> 0");
			while($row_rec=mysql_fetch_array($query_rec))
			{
				
				$check_stem= $row_rec['stemmed_text'];
				$check_stem_arr=preg_split('/[\s]+/', $check_stem);
				$match=0;
				for($i=0;$i<$own_lenght;$i++)
				{
					if(in_array($own_stem_arr[$i], $check_stem_arr)&&trim($own_stem_arr[$i])!="")
					{
						$match++;
					}
				}
				$match_per=($match/$own_lenght)*100;
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
				if($rec_leve<$_POST['rec'])continue;
				echo "<div class='rec_block'>";
				echo "<div class='rec_info'><img redir='same' id='profile_pic' src='pic.php?id=".$row_rec['sno']."' width='50px' height='50px'></div>";
				echo "<span class='rec_name'>".$row_rec['first_name']." ".$row_rec['middle_name']." ".$row_rec['last_name']."<br/>
				<div style='margin-top:5px;border:1px solid white;width:250px;height:20px;'>
				<div style='background-color:white;width:".$match_per."%;height:100%;'>
				</div></div>";
				echo "<div style='width:250px;text-align:center;margin-top:-20px;color:blue;'>".number_format((float)$match_per, 1, '.', '')."%</div></span>";
				echo "<div class='rec_level'>Recommdation level :".$rec_leve."/5</div>";
				echo "</div>";
			}
			echo "</div>";
		}
		echo "
		<script type='text/javascript'>
		$('.rec_block').on('click',function(){
		$(this).find('.rec_info').css('background-color','red');
		$(this).find('.rec_level').css('background-color','red');
		$(this).find('.rec_name').css('background-color','red');
		});
		</script>";
	}
?>