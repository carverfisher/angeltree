<?php
//require_once 'includes/site_functions.php';
require_once 'includes/angeltree.php';

$sql = "select sponsor_id, first_name, last_name, email, phone, update_time from sponsors ";
?>
<div data-role="page" id="page1">
    <?php include_once 'includes/HeaderDiv.html'; ?>

    <div data-role="main" class="ui-content" id="sponsor_id">

    <table data-role="table" id="sponsor_table_id" class="ui-responsive">
    <thead>
    <tr>
        <th>First</th>
        <th>Last</th>
        <th>Email</th>
        <th>Phone</th>
    </tr>
    </thead>
    <tbody>

<?php
    if($res = $mysqli->query("$sql")){
        if ($res->num_rows > 0) {
            // output data of each row
            while($row = $res->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["first_name"]."</td>";
                echo "<td>".$row["last_name"]."</td>";
                echo "<td>".$row["email"]."</td>";
                echo "<td>".$row["phone"]."</td>";
                echo "</tr>";
               // echo "<br> id: ". $row["sponsor_id"]. " - Name: ". $row["name"]. " Email:" . $row["email"]. " Phone:" . $row["phone"]. " Updated:" . $row["update_time"];
            }
        } else {
            echo "No Records Exist";
        }
    }else{
        echo "Query Error";
    }

$res->close();


?>
<!--    <tr><td>MyName</td><td>MyLast Name</td><td>email@address.com</td><td>55555555</td></tr> -->
</tbody>
</table>

    </div>
    <div data-role="footer">
        <h1>My footer</h1>
    </div>
</div>