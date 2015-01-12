
<?php
//require_once 'includes/site_functions.php';
require_once 'includes/angeltree.php';
$angel_arr = array();
$sql = "select angel_name, gender, age, id, update_time from angels ";

if($res = $mysqli->query("$sql")){

    if ($res->num_rows > 0) {
        // output data of each row

        while($row = $res->fetch_assoc()) {
            $angel_arr['angels'][] = $row;
        }
    } else {
        echo "No Angels Exist";
    }
}else{
    echo "Query Error";
}

$res->close();
 echo json_encode($angel_arr);
?>
