<?php
require 'minum_log.php'
?>
<form action="#" method="post">
<input type="text" name="text">
<input type="submit" name="submit">
</form>
<?php
if(isset($_POST['submit']))
{
	$b=$_POST['text'];
	echo "<img src='getpost.php?id=$b'>";
}
?>