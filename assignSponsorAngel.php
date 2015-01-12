<?php

$results= array();
//require_once 'includes/site_functions.php';
require_once 'includes/angeltree.php';
require_once 'includes/sponsor.class.php';

$sponsor_id = (empty($_POST['sponsor_id']))? null: $_POST['sponsor_id'];
$angel_id   = (empty($_POST['angel_id']))? null: $_POST['angel_id'];
$angel_sponsor_id=null;

if( empty($sponsor_id) || empty($angel_id)) echo "incorrect parameters ";

$sql = "INSERT INTO angel_sponsor( angel_id, sponsor_id) VALUES (?,?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ii", $val1 , $val2);

$val1 = $angel_id;
$val2 = $sponsor_id;

if($stmt->execute() ){
    $new_id = $mysqli->insert_id;
    $angel_sponsor_id = $new_id;
    $return_message = "Insert Successful";
    $method=1;
}else{
    if( $mysqli->errno ==1062){
        $row = $this->getRecord($mysqli,"email",$this->getEmail());
        $angel_sponsor_id = 0;
        $return_message = "The Angel already assigned.";
        $method = 2;
    }else{
        $return_message = "error ".$mysqli->errno.": ".$mysqli->error." SQl: $sql";
        // $this->return_message = "error";
    }
}

$stmt->close();
//array("id"=>$angel_sponsor_id,"errno"=>$mysqli->errno,"message"=>$return_message);
echo json_encode(array("id"=>$angel_sponsor_id,"errno"=>$mysqli->errno,"message"=>$return_message,"method"=>$method));

?>