<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.4/jquery.mobile-1.4.4.min.js"></script>

<script>
    var sponsors = $.parseJSON('{"sponsors":{"10":{"sponsor_id":"10","first_name":"Rob","last_name":"Barga","email":"rob.barga@crackerbarrel.com","phone":"615-424-3423","update_time":"2014-10-25 19:20:30"},"35":{"sponsor_id":"35","first_name":"brennita","last_name":"brennita","email":"brennita@brennita.com","phone":null,"update_time":"2014-11-10 20:32:27"}}}');
    $.each(sponsors.sponsors, function() {
        console.log(this);
    });

    var _sponsor = $.parseJSON('{"sponsors":{"55":{"sponsor_id":"55","first_name":"TestFirst","last_name":"TestLast","email":"EmailTest","phone":"PhoneTest","update_time":"2014-10-25 19:20:31"},"36":{"sponsor_id":"36","first_name":"brennita","last_name":"brennita","email":"brennita@brennita.com","phone":null,"update_time":"2014-11-10 20:32:28"}}}');

    console.log("_sponsor")
    $.each(_sponsor.sponsors, function() {
        console.log(this);
    });
    $.extend(sponsors.sponsors,_sponsor.sponsors);

    console.log("sponsors.sponsors");
    $.each(sponsors.sponsors, function() {
        console.log(this);
    });

</script>