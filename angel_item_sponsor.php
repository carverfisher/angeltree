<?php
/**
 * Created by PhpStorm.
 * User: rob
 * Date: 11/1/14
 * Time: 3:20 PM
 */

require_once 'includes/angeltree.php';

$sql = " select asp.angel_sponsor_id, a.id, a.angel_name, a.age, a.gender, i.item_id, i.item_name, i.item_desc
                ,i.size, asp.first_name, asp.last_name, asp.email, asp.phone, asp.sponsor_id
         from items i, angel_items ai,angels a
         left join ( select asp.angel_sponsor_id, asp.angel_id, asp.sponsor_id, s.first_name, s.last_name
                          , s.email, s.phone from angel_sponsor asp, sponsors s
                          where asp.sponsor_id=s.sponsor_id ) asp on asp.angel_id=a.id
          where ai.angel_id=a.id and ai.item_id=i.item_id ";
?>
<div data-role="header">
        <h1>Angel Table</h1>
    </div>
    <table data-role="table" id="angle_table_id" class="angel-list ui-responsive">
        <thead>
        <tr>
            <th>N#</th>
            <th>Gen</th>
            <th>Age</th>
            <th>Item</th>
            <th>Item Desc</th>
            <th>Size</th>
            <th>Sponsor</th>
        </tr>
        </thead>
        <tbody>


<?php
if($res = $mysqli->query("$sql")){
    if ($res->num_rows > 0) {
        // output data of each row
        while($row = $res->fetch_assoc()) {
            $sponsor_text= (empty($row['last_name']))? "Add Sponsor": $row['last_name'];

            echo "<tr>";
            echo "<td>".$row["angel_name"]."</td>";
            echo "<td>".$row["gender"]."</td>";
            echo "<td>".$row["age"]."</td>";
            echo "<td>".$row["item_name"]."</td>";
            echo "<td>".$row["item_desc"]."</td>";
            echo "<td>".$row["size"]."</td>";
            echo "<td><a id='angel_item_sponsor_href_{$row['item_id']}' data-itemId='{$row['item_id']}' data-angelid='{$row['id']}' data-sponsorid='{$row['sponsor_id']}' href='#popupSponsor' data-rel='popup' data-position-to='window' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-check ui-btn-icon-left ui-btn-a' data-transition='pop'>$sponsor_text</a></td>";
            echo "</tr>";
//            echo "<br> id: ". $row["id"]. " - Name/No.: ". $row["angel_name"]. " gender:" . $row["gender"]. " age:" . $row["age"]. " Updated:" . $row["update_time"];
        }
    } else {
        echo "No Angels Exist";
    }
}else{
    echo "Query Error";
}

$res->close();

?>
</tbody>
</table>
