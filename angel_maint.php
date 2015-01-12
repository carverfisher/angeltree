<html>
<?php
//require_once 'includes/site_functions.php';
require_once 'includes/angel.class.php';

$angel_id = (empty($_POST['angel_id']))? null: $_POST['angel_id'];
$angel_name = (empty($_POST['angel_name']))? null:$_POST['angel_name'];
$angel_gender = (empty($_POST['angel_gender']))? null:$_POST['angel_gender'];
$angel_age = (empty($_POST['angel_age']))? null:$_POST['angel_age'];
//$ang_obj = new angel(null,39,'M',5);
?>
<form name='angel_form' id='angel_form' method='POST' action='angel_save.php'>

    <label>number:</label>
<input type='text' value='<?=$angel_name?>' name='angel_name' id='angel_name'>

    <label>age:</label>
    <input type='number' value='<?=$angel_age?>' name='angel_age' id='angel_age'>

<input type='hidden' value='<?=$angel_id?>' name='angel_id' id='angel_id'>
    Gender:
    <input type="radio" name="angel_gender" id="angel_gender" value="male">Male
<input type="radio" name="angel_gender" id="angel_gender" value="female">Female
    <br>
<input type='submit' id='submit_new_angel' name='submit_new_angel'value='submit'>
</form>
</html>