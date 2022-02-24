$(document).ready(function(){

    // like and unlike click
    $(".like, .unlike").click(function(){
        var id = this.id;   // Getting Button id
        var split_id = id.split("_");

        var text = split_id[0];
        var myid = split_id[1];  // postid

        // Finding click type
        var mytype = 0;
        if(text == "like"){
            mytype = 1;
        }else{
            mytype = 0;
        }

        // AJAX Request
        $.ajax({
            url: 'likes.php',
            type: 'post',
            data: { id:myid, type:mytype },
            dataType: 'json',
            success: function(data){
                var likes = data['likes'];
                var unlikes = data['unlikes'];

                $("#likes_"+myid).text(likes);        // setting likes
                $("#unlikes_"+myid).text(unlikes);    // setting unlikes

                if(mytype == 1){
                    $("#like_"+myid).css("color","#dc2878");
                    $("#unlike_"+myid).css("color","rgb(32, 178, 170)");
                }

                if(mytype == 0){
                    $("#unlike_"+myid).css("color","#dc2878");
                    $("#like_"+myid).css("color","rgb(32, 178, 170)");
                }

            }
        });

    });

});