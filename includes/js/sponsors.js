//sponsors

/*
var sponsor = function(){
    var sponsor_id;
    var first_name;
    var last_name;
    var email;
    var phone;
}
*/
function clearSponsor(){
    return [{"sponsor_id":null,"first_name":null,"last_name":null,"email":null,"phone":null}];
}

function loadSponsorItemForm(sponsor_id, item_id){
    //want to load the item_id even if a sponsor doesn't exists
    if(item_id)  $("#popupSponsor").find("#sponsor_item_id").val(item_id); else return;

    if(!sponsor_id) {
        sponsor=clearSponsor();
    }else {
        sponsor = sponsors["sponsors"][sponsor_id];
    }

    $("#popupSponsor").find("#email").val(sponsor['email']);
    $("#popupSponsor").find("#first_name").val(sponsor['first_name']);
    $("#popupSponsor").find("#last_name").val(sponsor['last_name']);
    $("#popupSponsor").find("#phone").val(sponsor['phone']);
    $("#popupSponsor").find("#sponsor_id").val(sponsor['sponsor_id']);

}


function loadSponsors(){
    $.ajax({
        url: "sponsor_json.php",
        type: 'GET',
        dataType: 'json',
        async: 'true',
        success: function (result){
            //alert("sponsors: "+result);
            sponsors = result;
/*             $.each(sponsors.sponsors, function() {
             console.log(this);
             });
*/        },
        error: function (request, error){
            alert('Network error has occurred please try again!');
        }
    }).done(function(){});
}

function addSponsorToSponsors(sponsor_id,fname,lname,email,phone){
    var d = Date();
    var _sponsor = $.parseJSON('{"sponsors":{"'+sponsor_id+'":{"sponsor_id":"'+sponsor_id+'","first_name":"'+fname+'","last_name":"'+lname+'","email":"'+email+'","phone":"'+phone+'","update_time":"'+d+'"}}}');

//    console.log(_sponsor);
    $.extend(sponsors.sponsors,_sponsor.sponsors);

}

function submitSponsorForm() {

    var form_data = $("#sponsor_form" ).serialize();

         $.ajax({
         url: "sponsor_save.php",
         type: "POST",
         data: form_data,
         dataType: 'json',
         async: false
         })
         .done(function (result) {
                 sponsor_result = result;
                 if($("#sponsor_form #sponsor_item_id" ).val()) {
                     //console.log(result);
                     if (result['errno'] == 0){
                         if(result['method'] == 1) {
                             addSponsorToSponsors(result['id'], $("#popupSponsor #first_name").val(), $("#popupSponsor #last_name").val(), $("#popupSponsor #email").val(),
                                 $("#popupSponsor #phone").val());
                         }

                         //Set sponsor if assigned properly.
                         assignSponsorToAngel(result['id'],_itemRow['angel_id'],function(){ sponsor=sponsors["sponsors"][result['id']];});
                     }else{
                         alert("Error in submitting sponsor");
                     }

                 }
         })
         .fail(function(request,status, error){
             sponsor_result=null;
             alert('Status Failed:'+status+' Error:'+error);
         })
         .always( function(result){
             $('#popupSponsor').popup("close");
         });
}
