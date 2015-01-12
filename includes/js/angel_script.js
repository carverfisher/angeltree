var angelItems;




$(document).on("pagebeforecreate",function(){

    var sponsorGuid = null;
    var angelType = null;

//    $( ":mobile-pagecontainer" ).pagecontainer( "load", "second.html", { role: "page" } );
/*
    //loadAngelItems("fill",sponsorGuid,angelType,appendToAngelItemTable);
*/
});

function assignItemSponsor(item_id,sponsor_id,sponsor_guid,callback){
    var sponsor_guid = $("#sponsor_guid").val();
    $.ajax({
        url: "item_sponsor_cntrl.php",
        type: 'POST',
        dataType: 'json',
        async: 'true',
        data: {"item_id":item_id,"sponsor_id":sponsor_id,"sponsor_guid":sponsor_guid},
        success: function (result) {
            itemResult=result;
/*            $.each(itemResult, function () {
                console.log(this);
            });
*/        }
    }).done(function (result,status,sponsor_id) {
        // Make sure the callback is a function​
        alert("Message: "+itemResult['message']);
        //removeAvailableItem(item_id);
        if (typeof callback === "function") {
            // Execute the callback function and pass the parameters to it​
            callback();
        }

    }).fail(function (request, status, error) {
        //sponsor_result = null;
        alert('Status Failed:' + status + ' Error:' + error);
    }).always(function (result) {
    });
}

function swapItemTableRow(tRow,toTable,item_id){
    //alert("item_id: "+tRow.children().last().attr( "id"));
    spsonsor_id=1

    if(toTable == 'available'){
        content = "<tr id='avail_item_id_"+item_id+"'>";
        lastTD = "<td><a id='sp_item_href_"+item_id+"' data-sponsorId='"+sponsor_id+"' data-itemId='"item_id+"' href='#assignSponsor' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-check ui-btn-icon-left ui-btn-a' >Remove</a></td>";
    }else {
        content = "<tr id='sponsored_item_id_"+item_id+"'>";
        lastTD = "<td><a id='sp_item_href_"+item_id+"' data-sponsorId='"+sponsor_id+"' data-itemId='"item_id+"' href='#assignSponsor' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-check ui-btn-icon-left ui-btn-a' >Sponsor</a></td>";
    }
    content += tRow.html()+lastTD+"</tr>";

    if(toTable == 'available') {
        $('#sp_angle_item_table_id').append(content);
    }else{
        $('#angle_item_table_id').append(content);
    }

    //get( 0 ).tagName
    //dataset.itemid
//    content = "<tr id='sponsored_item_id_'>";
}

function removeAvailableItem(item_id){

    $('#angle_item_table_id #avail_item_id_'+item_id).remove();

}

function appendToAngelItemTable(ais, callback){

    $.each(angelItems.angel_items, function () {
        content = '<tr>';
        content += '<td>'+this.angel_name+'</td>';
        content += '<td>'+this.gender+'</td>';
        content += '<td>'+this.age+'</td>';
        content += '<td>'+this.item_name+'</td>';
        content += '<td>'+this.item_desc+'</td>';
        content += '<td>'+this.size+'</td>';
        content += '<td>Sponsor</td>';
        content += '</tr>';
//        console.log(this);
        $('#angle_item_table_id').append( '<tr><td>' + content + '</td></tr>' );
    });

}
/**
 * creates angelItems
 */

function loadAngelItems(action,sponsorGuid,angelType, callback) {

    $.ajax({
        url: "angel_item_json.php",
        type: 'GET',
        dataType: 'json',
        async: 'false',
        data: {"sponsor_guid": "f48225ca-6aef-11e4-834d-001d096d0d4e", "angelType": "available"},
        success: function (result) {
            angelItems=result;

            $.each(angelItems.angel_items, function () {
                console.log(this);
            });
        }
    }).done(function (result) {
        // Make sure the callback is a function​
        if (typeof callback === "function") {
           // Execute the callback function and pass the parameters to it​
           callback(angelItems.angel_items);
        }

    }).fail(function (request, status, error) {
        sponsor_result = null;
        alert('Status Failed:' + status + ' Error:' + error);
    }).always(function (result) {
    });
}
/*
$(document).on("beforepagecontainerload",function(event,data){
    alert("before pageload event fired!\nURL: " + data.url);
});

$(document).on("pagecontainerload",function(event,data){
    alert("pageload event fired!\nURL: " + data.url);
});
*/
//$(document).on("beforepagecreate","#page1",function( event) {
//    alert("before page create");
/*    $("body").on("swipeleft", function () {
        alert("swiped_left");
        // dspItems();
    });

    $("body").on("swiperight", function () {
        alert("swiped_right");
    });
    $("[href='#popupSponsor']").click(function () {

        $("#submit_sponsor").click(function () {
            submitSponsorForm();

            if (!sponsor_result) {
                alert("No sponsor result");
            }
        });

        $("#popupSponsor").popup({
            afteropen: function (event, ui) {
                $('#email').focus();
            }
        });
        loadItems();    //loads the items json object.
        loadSponsors(); //loads teh sponsors json object.
    });
    */
//});

//general purpose



 