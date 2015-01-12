<?php
/**
 * Created by PhpStorm.
 * User: rob
 * Date: 11/9/14
 * Time: 8:06 AM
 */
?>
<html><body>
what
<div data-role="popup" id="popupSponsor" data-theme="a" class="ui-corner-all">

    <form name='sponsor_form' id='sponsor_form' method='POST' action='../sponsor_save.php'>

    <input type='text' value='first_test' name='first_name' id='first_name' placeholder="First Name">
<br>
    <input type='text' value='Last_test' name='last_name' id='last_name' placeholder="Last Name">
<br>
    <input type='tel' value='12344567890' name='phone' id='phone' placeholder="Phone No.">
<br>
    <input type='text' value='' name='sponsor_id' id='sponsor_id' placeholder="sponsor_id">

<br>
    <input type="email" value='test@testmail.com' name='email' id='email' placeholder="Email Address">
        <br>
    <input type='submit' class='ui-button' id='submit_sponsor' name='submit_sponsor' value='submit'>

    <input type='submit' id='remove_sponsor' name='remove_sponsor' value='Remove'>
    </form>
</div>
</body></html>