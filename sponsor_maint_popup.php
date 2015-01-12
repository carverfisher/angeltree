<?php
/*
//require_once 'includes/site_functions.php';
require_once 'includes/sponsor.class.php';

$sponsor_id = (empty($_POST['sponsor_id']))? null: $_POST['sponsor_id'];
$name = (empty($_POST['name']))? null:$_POST['name'];
$email = (empty($_POST['email']))? null:$_POST['email'];
$phone = (empty($_POST['phone']))? null:$_POST['phone'];
//$ang_obj = new angel(null,39,'M',5);
*/
?>
<div data-role="popup" id="popupSponsor" data-theme="a" class="ui-corner-all">

    <a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
    <form name='sponsor_form' id='sponsor_form' method='POST' action='sponsor_save.php'>

    <input type='text' value='' name='first_name' id='first_name' placeholder="First Name">
    <input type='text' value='' name='last_name' id='last_name' placeholder="Last Name">
    <input type='tel' value='' name='phone' id='phone' placeholder="Phone No.">
    <input type='hidden' value='' name='sponsor_id' id='sponsor_id'>
    <input type='hidden' value='' name='sponsor_item_id' id='sponsor_item_id'>
    <input type="email" value='' name='email' id='email' placeholder="Email Address">
<br>
    <input type='button' class='ui-button' id='submit_sponsor' name='submit_sponsor' value='submit'>

   <!-- <input type='submit' id='remove_sponsor' name='remove_sponsor' value='Remove'> -->
    </form>
</div>
