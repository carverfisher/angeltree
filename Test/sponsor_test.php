<?php
/**
 * Created by PhpStorm.
 * User: rob
 * Date: 11/13/14
 * Time: 6:31 PM
 */

require_once '../includes/angeltree.php';
$sponsr_id ='f48225ca-6aef-11e4-834d-001d096d0d4e';
$sql = "select * from sponsor where sponsor_guid='$sponsor_id'";