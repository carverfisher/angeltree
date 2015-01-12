<?php
//require_once 'includes/site_functions.php';
require_once 'includes/angeltree.php';
$sponsor_arr=array();
$sql = "select sponsor_id, first_name, last_name, email, phone, update_time from sponsors ";

    if($res = $mysqli->query("$sql")){

        if ($res->num_rows > 0) {
            // output data of each row
            while($row = $res->fetch_assoc()) {
               // print_r($row);
                $sponsor_arr['sponsors'][$row['sponsor_id']]=$row;
            }

        } else {

        }
    }else{
        echo "Query Error";
    }

$res->close();
echo json_encode($sponsor_arr);
?>
