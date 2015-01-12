<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
//$hostname_angeltree = "127.0.0.1";
$hostname_angeltree = "barga.org";
$database_angeltree = "barga_angel_tree";
$username_angeltree = "barga_angelupd";
$password_angeltree = "tw3n6QXH0E6t";

global $mysqli;	
$mysqli = new mysqli($hostname_angeltree, $username_angeltree, $password_angeltree, $database_angeltree);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
} 
?>