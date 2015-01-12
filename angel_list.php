
<?php
//require_once 'includes/site_functions.php';
//require_once 'includes/angeltree.php';

$sql = "select angel_name, gender, age, id, update_time from angels ";

?>
    <div data-role="header">
        <h1>Angel Table</h1>
    </div>
    <table data-role="table" id="angle_table_id" class="ui-responsive">
        <thead>
        <tr>
            <th>Name/number</th>
            <th>Gender</th>
            <th>Age</th>
        </tr>
        </thead>
        <tbody>


<?php
if($res = $mysqli->query("$sql")){
    if ($res->num_rows > 0) {
        // output data of each row
        while($row = $res->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row["angel_name"]."</td>";
            echo "<td>".$row["gender"]."</td>";
            echo "<td>".$row["age"]."</td>";
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
