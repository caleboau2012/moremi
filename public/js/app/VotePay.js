/**
 * Created by KayLee on 18/04/2017.
 */
var VotePay = {
    init: function(){
        $('.vote-pay').click(function(){
            var amount = $(this).attr('data-amount');
            var url = $('#pay-slips').attr('data-url');
            $(this).button("loading");

            Utils.post(url, {
                amount: amount,
                voted_profile_id: Vote.CONSTANT.profileID
            }, 'POST', VotePay.success, VotePay.error);
        });
    },
    success: function(data){
        console.log(data);
        $('.vote-pay').button('reset');
        if(data.status==false){
            if(!data.profile) {
                swal({
                        title: "Ouch...",
                        text: data.msg,
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                    },
                    function(){
                        $("#accountModal").modal('show');
                    });
            }
            else if(!data.validation){
                $('#pay-slips').addClass('hidden');
                $('#validationFrame').removeClass('hidden').find('iframe').attr('src', data.html);
            }

        }
        else if(data.status){
            swal('Success',data.msg,'success');
        }
    },
    error: function(data){
        console.log(data);
        $('.vote-pay').button('reset');
        swal('Ouch...',data.msg,'error');
    }
};

$(document).ready(VotePay.init);