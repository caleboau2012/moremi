/**
 * Created by KayLee on 17/04/2017.
 */
var Account = {
    init: function(){
        $(document.account).on('submit', function(e){
            e.preventDefault();
            $('.form-error').empty();
            $("#save_profile").addClass('disabled');
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
                }).then(function(){
                    $('#accountModal').modal('hide');
                });
        }
        $("#save_profile").removeClass('disabled');
    },
    error: function(response){
        response = JSON.parse(response.responseText);
        $.each(response, function(key, data){
            $('#' + key).parent().addClass('has-error');
            data.forEach(function(element){
                $('#' + key + '-error-msg').html("<span class='small'>" + element + "</span>");
            });
        });
        $("#save_profile").removeClass('disabled');
    }
};

$(document).ready(Account.init);