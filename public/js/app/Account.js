/**
 * Created by KayLee on 17/04/2017.
 */
var Account = {
    init: function(){
        $(document.account).on('submit', function(e){
            e.preventDefault();

            var url = $(this).attr('data-url');
            var data = {
                first_name: this.first_name.value,
                last_name: this.last_name.value,
                phone: this.phone.value,
                email: this.email.value,
                venue: this.venue.value
            };

            Utils.post(url, data, 'POST', Account.success, Account.error);
        })
    },
    success: function(data){
        if(data.status){
            swal({
                    title: "Sweet",
                    text: data.msg,
                    type: "success",
                    confirmButtonColor: "#fe7447"
                },
                function(){
                    $('#accountModal').modal('hide');
                });
        }
    },
    error: function(response){
        response = JSON.parse(response.responseText);
        $.each(response, function(key, data){
            $('#' + key).parent().addClass('has-error');
            data.forEach(function(element){
                $('#' + key).parent().append("<span class='small'>" + element + "</span>");
            });
        });
    }
};

$(document).ready(Account.init);