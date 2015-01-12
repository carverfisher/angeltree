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
<div data-role="popup" id="popupLogin" data-theme="a" class="ui-corner-all">
    <form name='sponsor_form' id='sponsor_form' method='POST' action='sponsor_save.php'>

        <label>name:</label>
    <input type='text' value='<?=$name?>' name='name' id='name'>

        <label>phone:</label>
        <input type='tel' value='<?=$phone?>' name='phone' id='phone'>

    <input type='hidden' value='<?=$sponsor_id?>' name='sponsor_id' id='sponsor_id'>
    Email;
        <input type="email" value='<?=$email?>' name='email' id='email'>
        <br>
    <input type='submit' id='submit_sponsor' name='submit_sponsor'value='submit'>
    </form>
</div>
