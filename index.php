<!DOCTYPE html>
<html>

<?php
//require_once 'includes/site_functions.php';
require_once 'includes/angeltree.php';
if( empty($_GET['code']) || $_GET['code']!='271881671'){
    die();
}
$load_page= empty($_GET['load_page'])? "angel_item_sponsor": $_GET['load_page'] ;
$next_page= empty($_GET['next_page'])? "sponsor_list": $_GET['next_page'] ;
$prev_page= empty($_GET['prev_page'])? "angel_list": $_GET['prev_page'];

?>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.4/jquery.mobile-1.4.4.min.css">
    <link rel="stylesheet" type="text/css" href="includes/css/angel_list.css">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.4/jquery.mobile-1.4.4.min.js"></script>
    <script>

        var items;
        var itemRow;
        var sponsor;
        var sponsors;
        var sponsor_result;
        $(document).on("pagecreate","#page1",function( event){
            $("body").on("swipeleft",function(){
               alert("swiped_left");
               // dspItems();
            });

            $("body").on("swiperight",function(){
                alert("swiped_right");
            });
            $("[href='#popupSponsor']").click(function(){
                _itemRow=items["items"][this.dataset.itemid];
                loadSponsorItemForm(_itemRow['sponsor_id'],_itemRow['item_id']);

            });

            $("#submit_sponsor").click(function() {
                submitSponsorForm();

                if (!sponsor_result) {
                    alert("No sponsor result");
                }
            });

            $("#popupSponsor").popup({
                afteropen: function( event, ui ) {
                    $('#email').focus();
                }
            });
            loadItems();    //loads the items json object.
            loadSponsors(); //loads teh sponsors json object.
        });

        function assignSponsorToAngel(sponsor_id,angel_id, callBackFunction){
         //   alert("Need to assign sponsor:"+sponsor_id+" to angel: "+angel_id);
            $.ajax({
                url: "assignSponsorAngel.php",
                type: "POST",
                data: {"angel_id":angel_id,"sponsor_id":sponsor_id},
                dataType: 'json',
                async: false,
                success: function (result) {
                    //sponsor_result = result;
                    console.log(result);
                }
            })
                .done(function (result) {
                    if (result["errno"] == 0){
                        if( result['method'] == 1)
                        {

                            callBackFunction();
                            _itemRow['angel_sponsor_id'] = result['id'];
                            _itemRow['sponsor_id'] = sponsor_id;

                            $('#angel_item_sponsor_href_' + _itemRow['item_id']).text(sponsor['last_name']);
                        }
                    }
/*                    $.each(sponsor, function() {
                        console.log(this);
                    });
*/
                })
                .fail(function(request,status, error){
                   // sponsor_result=null;
                    alert('Status Failed:'+status+' Error:'+error);
                })
                .always( function(){
                //    alert("Sponsor Successfully assigned");
                });
        }

    </script>
    <script src="includes/js/script.js"></script>
    <script src="includes/js/items.js"></script>
    <script src="includes/js/sponsors.js"></script>
</head>


<body>

<div data-role="page" id="page1">
    <?php include_once 'includes/HeaderDiv.html'; ?>

    <div data-role="main" class="ui-content" >
        <?php include "$load_page.php";?>
        <?php include_once 'sponsor_maint_popup.php'; ?>
    </div>

    <div data-role="footer">
        <h1>My footer</h1>
    </div>
</div>

<?php include_once 'sponsor_maint_popup.php'; ?>

</body>