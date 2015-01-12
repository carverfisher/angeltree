<?php
require_once '../_private/angeltree.php';

function pre($arr=array(), $str=null){
	echo "$str <pre> ";
	print_r($arr);
	echo "</pre>";
}
?>