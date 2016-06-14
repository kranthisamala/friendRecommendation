<?php	$image=addslashes(file_get_contents($_FILES['image']['tmp_name']));
	$iamge_name=$_FILES['image']['name'];
	$image_size=getimagesize($_FILES['image']['tmp_name']);
	echo $image;
?>