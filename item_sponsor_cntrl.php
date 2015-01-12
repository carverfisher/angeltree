<?php
/**
 * Created by PhpStorm.
 * User: rob
 * Date: 11/16/14
 * Time: 9:18 PM
 */

if( empty($_POST['sponsor_guid']))
{
    echo "<br> Incorrect paramaters";
    die();
}
include_once 'includes/angel_items.class.php';

$sponsor_id = $_POST['sponsor_id'];
$item_id    = $_POST['item_id'];
$sponsor_guid = $_POST['sponsor_guid'];
$method = $_POST['method'];

$ai_obj = new angelItems();

if($method == 'getSponsoredItems'){
    if(empty($sponsor_id))
    {
        echo "<br> Incorrect paramaters";
        die();
    }
    $ai_obj->setSponsorId($sponsor_id);
    $return_arr = $ai_obj->getSponsordItems();
}
if($method == 'getAvailableItems'){
    $return_arr = $ai_obj->getAvailableItems();
}

if($method == 'assignItemSponsors') {
    if(empty($_POST['item_id']) || empty($_POST['sponsor_id']))
    {
        echo "<br> Incorrect paramaters";
        die();
    }

    $return_arr = $ai_obj->assignItemSponsor($item_id, $sponsor_id);
}

echo json_encode($return_arr);
?>