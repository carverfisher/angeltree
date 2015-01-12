<!DOCTYPE html>
<html>

<?php

    if( empty($_GET['code']) || $_GET['code']!='d48525ca-6wef-11e4-854d-001d396d0d4dk'){
        die();
    }
    if( empty($_GET['sponsor_guid'])){
        die();
    }
?>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.4/jquery.mobile-1.4.4.min.css">
    <link rel="stylesheet" type="text/css" href="includes/css/angel_list.css">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.4/jquery.mobile-1.4.4.min.js"></script>


    <script>

/*        $(document).on("pagecreate",function( event) {
            $("body").on("swipeleft", function () {
                alert("swiped_left");
                // dspItems();
            });
            alert("Should Load Page2");
        })
        $(document).on("pagecreate","#page2",function( event) {
            $("body").on("swiperight",function(){
                alert("swiped_right");
          });
 /*           $("[href='#assignSponsor']").click(function(){
//                alert("Parent:"+$( this ).parent().parent()); //getting the row tag
                swapItemTableRow($( this ).parent().parent(), "sponsor",this.dataset.itemid);
//                assignItemSponsor(this.dataset.itemid, this.dataset.sponsorid, this.dataset.sponsorguid,removeAvailableItem(this.dataset.itemid))

            });
        })
*/
    </script>

</head>

<body>

<div data-role="page" id="page1">
    <script src="includes/js/items.js"></script>
    <div data-role="header">
        <h1>Welcome to Angel Tree</h1>
        <a href="#page2" data-role="button" class="ui-btn ui-btn-right ui-corner-all ui-shadow ui-icon-plus ui-btn-icon-right">Available</a>
    </div>
    <div data-role="main" class="ui-content" >
        <table data-role="table" id="spons_item_table_id" class="angel-list ui-responsive">
            <thead>
            <tr>
                <th>N#</th>
                <th>Gen</th>
                <th>Age</th>
                <th>Item</th>
                <th>Item Desc</th>
                <th>Size</th>
                <th>Remove</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<div data-role="page" id="page2">
    <div data-role="header">
        <a href="#page1" data-role="button"  class="ui-btn ui-btn-left ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">My Angels</a>
        <h1>Welcome to Angel Tree</h1>
    </div>

     <div data-role="main" class="ui-content" >
         <div data-role="main" class="ui-content" >
             <table data-role="table" id="avail_item_table_id" class="angel-list ui-responsive">
                 <thead>
                 <tr>
                     <th>N#</th>
                     <th>Gen</th>
                     <th>Age</th>
                     <th>Item</th>
                     <th>Item Desc</th>
                     <th>Size</th>
                     <th>Sponsor</th>
                 </tr>
                 </thead>
                 <tbody>
                 </tbody>
             </table>
         </div>
     </div>
</div>


 </body>
