
<?php

/**
 * Created by PhpStorm.
 * User: rob
 * Date: 11/13/14
 * Time: 5:27 PM
 */

include_once 'includes/angel_items.cntrl.php';
$aic_obj = new angel_items_cntrl('sponsored','array');
$aic_obj->setSponsorId(1);
$angel_arr = $aic_obj->getAngelItemsArr();

?>
<h2>My Angels</h2>
    <table data-role="table" id="sp_angle_item_table_id" class="angel-list ui-responsive">
        <thead>
        <tr>
            <th>N#</th>
            <th>Gen</th>
            <th>Age</th>
            <th>Item</th>
            <th>Item Desc</th>
            <th>Size</th>
            <th>Remove</th>
        </tr>
        </thead>
        <tbody>

        <?php
        //while($row = $res->fetch_assoc()) {\
        foreach($angel_arr['angel_items'] as $row){
            $sponsor_text= "Remove";

            echo "<tr id='sponsored_item_id_{$row['item_id']}'>";
            echo "<td>".$row["angel_name"]."</td>";
            echo "<td>".$row["gender"]."</td>";
            echo "<td>".$row["age"]."</td>";
            echo "<td>".$row["item_name"]."</td>";
            echo "<td>".$row["item_desc"]."</td>";
            echo "<td>".$row["size"]."</td>";
//            echo "<td><a id='angel_item_sponsor_href_{$row['item_id']}' data-itemId='{$row['item_id']}' data-angelid='{$row['id']}' data-sponsorid='{$row['sponsor_id']}' href='#popupSponsor' data-rel='popup' data-position-to='window' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-check ui-btn-icon-left ui-btn-a' data-transition='pop'>$sponsor_text</a></td>";
            echo "<td>".$sponsor_text."</td>";
            echo "</tr>";
//            echo "<br> id: ". $row["id"]. " - Name/No.: ". $row["angel_name"]. " gender:" . $row["gender"]. " age:" . $row["age"]. " Updated:" . $row["update_time"];
        }
        ?>

        </tbody>
    </table>
