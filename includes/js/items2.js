
//items

function dspItems(){
    if(!items){
        alert("items object didn't load");
    }
    $.each(items.items, function() {
        console.log(this);
    });
}

function loadItems(){
    $.ajax({
        url: "item_json.php",
        type: 'GET',
        dataType: 'json',
        async: 'true',
        success: function (result){
            items = result;
            /* $.each(items.items, function() {
             console.log(this);
             });*/
        },
        error: function (request, status, error){
            alert('Error: '+status+" "+error);
        }
    }).done(function(){
        //dspItems()
    });

}





 