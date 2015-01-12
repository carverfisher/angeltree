<?php

$results= array();
//require_once 'includes/site_functions.php';
require_once 'includes/angeltree.php';
require_once 'includes/sponsor.class.php';

$sponsor_id = (empty($_POST['sponsor_id']))? null: $_POST['sponsor_id'];
$first_name = (empty($_POST['first_name']))? null:$_POST['first_name'];
$last_name = (empty($_POST['last_name']))? null:$_POST['last_name'];
$email = (empty($_POST['email']))? null:$_POST['email'];
$phone = (empty($_POST['phone']))? null:$_POST['phone'];

//echo "<br>Email:$email";
$sponsor_obj = new sponsor($sponsor_id, $first_name, $last_name, $email, $phone);

if(empty($sponsor_id)){
//angel_create($name,$phone,$email);
    $sponsor_obj->insert($mysqli);
}else{
//angel_update($sponsor_id,$name,$phone,$email)
    $sponsor_obj->return_message = "Update Method Not Completed";
    $sponsor_obj->update($mysqli);
}

echo json_encode($sponsor_obj->getReturnArr($mysqli));

?>