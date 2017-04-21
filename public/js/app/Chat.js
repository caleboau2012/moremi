/**
 * Created by KayLee on 21/04/2017.
 */
var socket = io.connect('http://localhost:8890');

socket.on('message', function (data) {
    data = jQuery.parseJSON(data);
    console.log(data);
    var from = "#messages-between-" + data.id_user_to + '-' + data.id_user_from;
    var to = "#messages-between-" + data.id_user_from + '-' + data.id_user_to;

    console.log({
        from: from,
        to: to
    });

    $(from).append( "<strong>"+data.user+":</strong><p>"+data.message+"</p>" );
    $(to).append( "<strong>"+data.user+":</strong><p>"+data.message+"</p>" );
});

$(".send-msg").click(function(e){
    e.preventDefault();
    var token = $("#_token").text();
    var id_user_from = $("#id_user_from").text();
    var user = $("#user").text();

    var id_user_to = $(this).parent().parent().find('#id_user_to').text();
    var msg = $(this).parent().parent().find('.msg').val();

    var chatURL = $('#chat-url').text();

    if(msg != ''){
        $.ajax({
            type: "POST",
            url: chatURL,
            dataType: "json",
            data: {
                '_token': token,
                'message': msg,
                'user': user,
                'id_user_to': id_user_to,
                'id_user_from': id_user_from
            },
            success:function(data){
                console.log(data);
                $(".msg").val('');
            }
        });
    }else{
        swal("Ehem", "Please Add Message.");
    }
})