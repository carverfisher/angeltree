<html>
<?php

echo "Angel save <br>";

//require_once 'includes/site_functions.php';
require_once 'includes/angeltree.php';
require_once 'includes/angel.class.php';

$angel_id = (empty($_POST['angel_id']))? null: $_POST['angel_id'];
$angel_name = (empty($_POST['angel_name']))? null:$_POST['angel_name'];
$angel_gender = (empty($_POST['angel_gender']))? null:$_POST['angel_gender'];
$angel_age = (empty($_POST['angel_age']))? null:$_POST['angel_age'];

print_r($_POST);
$ang_obj = new angel($angel_id,$angel_name,$angel_gender,$angel_age);


if(empty($angel_id)){
//angel_create($angel_number,$angel_age,$angel_gender);
    $ang_obj->insert($mysqli);
}else{
//angel_update($angel_id,$angel_number,$angel_age,$angel_gender)
    $ang_obj->update($mysqli);
}
//displaying the recordd
$ang_obj->getRecord($mysqli);

?>

Hope I made it.
</html>