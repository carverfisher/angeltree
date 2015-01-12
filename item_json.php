
<?php
//require_once 'includes/site_functions.php';
require_once 'includes/angeltree.php';
$items_arr = array();
$sql = " select asp.angel_sponsor_id, ai.angel_item_id, a.id as angel_id, asp.sponsor_id, i.item_id, i.item_name, i.item_desc, i.size
         from items i, angel_items ai,angels a
         left join ( select asp.angel_sponsor_id, asp.angel_id, asp.sponsor_id, s.first_name, s.last_name
                          , s.email, s.phone from angel_sponsor asp, sponsors s
                          where asp.sponsor_id=s.sponsor_id ) asp on asp.angel_id=a.id
          where ai.angel_id=a.id and ai.item_id=i.item_id ";

if($res = $mysqli->query("$sql")){

    if ($res->num_rows > 0) {
        // output data of each row

        while($row = $res->fetch_assoc()) {
            //$items_arr['items'][] = $row;
            $items_arr["items"][$row['item_id']] = $row;
        }
    } else {
        echo "No items Exist";
    }
}else{
    echo "Query Error";
}

$res->close();
 echo json_encode($items_arr);
?>
