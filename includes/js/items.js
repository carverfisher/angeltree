
$(document).on("pagecreate",function(){

    var sponsorGuid = "f48225ca-6aef-11e4-834d-001d096d0d4e";
    var sponsor_id = 1;
    var item_type = "available"
    alert("Should Load Page2");
    loadAngelItems("fill",sponsorGuid, item_type,"getAvailableItems", sponsor_id, appendToAngelItemTable);
})
$(document).on("pagecontainerloadfail",function(){

    alert("Page Container failed to load");
})

$(document).on("pagebeforecreate",function(){

    var sponsorGuid = "f48225ca-6aef-11e4-834d-001d096d0d4e";
    var sponsor_id = 1;
    var item_type = "sponsored";
    //var item_type = "available";
    alert("Should Load page1");
    //loadAngelItems("fill",sponsorGuid, angelType,"getAvailableItems", appendToAngelItemTable);
   loadAngelItems("fill",sponsorGuid, item_type,"getSponsoredItems", sponsor_id, appendToAngelItemTable );
});
var angelItems;

function loadAngelItems(action,sponsorGuid,item_type, method, sponsor_id, callback) {

    //url: "angel_item_json.php",
    $.ajax({
        url: "item_sponsor_cntrl.php",
        type: 'POST',
        dataType: 'json',
        async: 'false',
        data: {"sponsor_guid":sponsorGuid , "angelType":item_type,"method":method, "sponsor_id":sponsor_id },
        success: function (result) {
            angelItems=result;

            $.each(angelItems.angel_items, function () {
                console.log(this);
            });
        }
    }).done(function (result) {
        // Make sure the callback is a function​
        if (typeof callback === "function") {
            alert("Item_Type:"+item_type);
            // Execute the callback function and pass the parameters to it​
            //callback(angelItems.angel_items);
            callback(result.angel_items,item_type,function(){alert("completed")});
        }

    }).fail(function (request, status, error) {
        sponsor_result = null;
        alert('Status Failed:' + status + ' Error:' + error);
    }).always(function (result) {
    });
}

function appendToAngelItemTable(ais, item_type, callback){
    // $.each(angelItems.angel_items, function () {
    $.each(ais, function () {
        if(item_type != 'sponsored') {
            content = "<tr id='avail_item_id_" + this.item_id + "'>";
            lastTD = "<td><a id='av_item_href_" + this.item_id + "' data-sponsorId='' data-itemId='" + this.item_id + "' href='#assignSponsor' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-check ui-btn-icon-left ui-btn-a' >Sponsor</a></td>";
        }else {
            content = "<tr id='sponsored_item_id_"+this.item_id+"'>";
            lastTD = "<td><a id='sp_item_href_"+this.item_id+"' data-sponsorId='"+this.sponsor_id+"' data-itemId='"+this.item_id+"' href='#removeSponsor' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-check ui-btn-icon-left ui-btn-a' >Remove</a></td>";
        }

        content += '<td>'+this.angel_name+'</td>';
        content += '<td>'+this.gender+'</td>';
        content += '<td>'+this.age+'</td>';
        content += '<td>'+this.item_name+'</td>';
        content += '<td>'+this.item_desc+'</td>';
        content += '<td>'+this.size+'</td>';
        content += lastTD;
        content += '</tr>';

//        console.log(this);
        if(item_type != 'sponsored') {
            $('#avail_item_table_id').append( content );
        }else{
            $('#spons_item_table_id').append(content);
        }

    });
    callback();

}







 