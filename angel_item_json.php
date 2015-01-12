<?php
//require_once 'includes/site_functions.php';
include_once 'includes/conn.class.php';
require_once 'includes/sponsor2.class.php';


$angel_type = ($_GET['angelType']=='assigned')? $_GET['angelType']: 'available';
$sponsor_id = $_GET['sponsor_id'];
$update_time = $_GET['update_time'];
$sponsor_guid = $_GET['sponsor_guid'];

$sponsor_guid ='f48225ca-6aef-11e4-834d-001d096d0d4e';

if(strlen($sponsor_guid) <> 36){
    echo "Not 36 chars";
    die();
}
//Check make sure sponsor is valid
$sponsor_obj = new sponsor();

if(!$sponsor_obj->isSponsor($sponsor_guid)){
    echo "<br><h2>is NOT valid</h2>";
} else{
    $sponsor_obj->loadCheckedSponsor();
}
$sponsor_id = $sponsor_obj->getSponsorId();

//TODO   check sponsor_id is int
//TODO   check update_time is time_date
$con_obj= new conn();
$angel_arr = array();

if ($angel_type=='assigned'){
    $sql = "select a.id as angel_id, a.angel_name, a.age, a.gender, i.item_id, i.item_name, i.item_desc
                ,i.size, asp.first_name, asp.last_name, asp.email, asp.phone, asp.sponsor_id
            from items i, angel_items ai,angels a angel_sponsor asp
           where ai.angel_id=a.id and ai.item_id=i.item_id and a.id= asp.angel_id ";
    if(!empty($sponsor_id)){
        $sql += " and asp.sponsor_id=$sponsor_id ";
    }

    if(!empty($update_time)){
        $sql += " and update_time > '$update_time' ";
    }

}else{
    $sql = "select a.id as angel_id, a.angel_name, a.age, a.gender, i.item_id, i.item_name, i.item_desc,i.size
            from items i, angel_items ai, angels a
            where ai.angel_id=a.id and ai.item_id=i.item_id
               and not exists( select item_sponsor_id from  item_sponsor isp where isp.item_id=ai.item_id)";
}
//echo "<br>SQL: $sql";
//echo "<br>";
if($res = $con_obj->mysqli->query("$sql")){

    if ($res->num_rows > 0) {
        // output data of each row

        while($row = $res->fetch_assoc()) {
            $angel_arr['angel_items'][$row['item_id']] = $row;
        }
    } else {
        echo "No Angels Exist";
    }
}else{
    echo "Error:".$con_obj->mysqli->errno." :".$con_obj->mysqli->error;
}
//print_r($sponsor_obj->getSponsorArray());
//print_r($angel_arr['angel_items']);
$res->close();
$angel_items_sponsor_arr['angel_items_sponsor']['sponsor']=$sponsor_obj->getSponsorArray();
$angel_items_sponsor_arr['angel_items_sponsor']['angel_items']=$angel_arr;
//echo json_encode($angel_items_sponsor_arr);

echo json_encode($angel_arr);

?>