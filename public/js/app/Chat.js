/**
 * Created by KayLee on 21/04/2017.
 */

var Chat = {
    CONSTANTS: {
        messages: ""
    },
    init: function(){
        Chat.initialiseSocket();

        $(".send-msg").click(function(e){
            e.preventDefault();
            Chat.send(this);
        });

        $('.msg').keydown(function(event) {
            if (event.keyCode == 13) {
                Chat.send(this);
                return false;
            }
        });

        $('.chat-messages').each(function(){
            Chat.CONSTANTS.messages = this;
            Chat.scrollToBottom();
        });
    },
    send: function(element){
        var token = $("#_token").text();
        var id_user_from = $("#id_user_from").text();
        var user = $("#user").text();

        var id_user_to = $(element).parent().parent().find('#id_user_to').text();
        var msg = $(element).parent().parent().find('.msg').val();
        Chat.CONSTANTS.messages = $(element).parent().parent().find('.chat-messages')[0];

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
                    //console.log(data);
                    $(".msg").val('');
                    Chat.scrollToBottom();
                }
            });
        }else{
            swal("Ehem", "Please Add Message.");
        }
    },
    initialiseSocket: function(){
        var socket = io.connect('http://localhost:8890');

        socket.on('message', function (data) {
            data = jQuery.parseJSON(data);
            //console.log(data);
            var from = "#messages-between-" + data.id_user_to + '-' + data.id_user_from;
            var to = "#messages-between-" + data.id_user_from + '-' + data.id_user_to;

            console.log($(from)[0], $(to)[0]);

            if(typeof $(from)[0] != 'undefined') {
                Chat.CONSTANTS.messages = $(from).find('.chat-messages')[0];
                Chat.scrollToBottom();
            }
            else if (typeof $(to)[0] != 'undefined'){
                Chat.CONSTANTS.messages = $(to).find('.chat-messages')[0];
                Chat.scrollToBottom();
            }

            $(from).append( "<div>" +
                "<strong>" + data.user + ":</strong>" +
                "<p class='chat-message'>" + data.message + "</p>" +
                "<small class='text-right chat-time'>" + data.time + "</small>" +
                "</div>" );
            $(to).append( "<div>" +
                "<strong>" + data.user + ":</strong>" +
                "<p class='chat-message'>" + data.message + "</p>" +
                "<small class='text-right chat-time'>" + data.time + "</small>" +
                "</div>" );
        });
    },
    scrollToBottom: function(){
        var element = Chat.CONSTANTS.messages;
        element.scrollTop = element.scrollHeight - element.clientHeight;
    }
};

$(document).ready(Chat.init);