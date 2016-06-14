<?php
$pattern = '/[ \n]/';
$string = "something here    ; and there,
 oh,that's all!";
echo '<pre>', print_r( preg_split('/[\s]+/', $string ) ), '</pre>'; 
?>