<?php
/**
 * Created by PhpStorm.
 * User: rob
 * Date: 11/13/14
 * Time: 6:31 PM
 */

//require_once 'includes/conn.class.php';
require_once 'includes/sponsor2.class.php';

$sponsor_id ='f48225ca-6aef-11e4-834d-001d096d0d4e';
$sponsor_obj = new sponsor();

if($sponsor_obj->isSponsor($sponsor_id)){
    echo "<br><h2>is valid</h2>";
}else {
    echo "<br><h2>is NOT valid</h2>";
}

//echo json_encode($sponsor_arr);

?>