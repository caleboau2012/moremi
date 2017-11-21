/**
 * Created by Moscoworld on 20/11/2017.
 */
var Hangout = {
    init: function(){

        $(document.hangoutForm).on('submit', function(e){
            e.preventDefault();
            console.log('Submittin');
            Hangout.initiateHangout($(this), $(this).attr('data-url'));
        });
    },
    initiateHangout: function (form, url) {
        $('#form_error').empty();

        Hangout.freezeHangoutForm();

        var spot = $('#spot_sel').val();
        var beneficiaries = $('#users_select').val();

        // Utils.swalLoader();
        Utils.post(url, {
            spot: spot,
            beneficiaries: beneficiaries
        }, 'POST', Hangout.requestUploaded, Hangout.uploadError);
    },
    uploadError: function(data){
         $('#form_error').html(data.responseJSON.message);
         Hangout.releaseHangoutForm();
    },
    requestUploaded: function(data){
        Hangout.releaseHangoutForm();
        $("#hangoutForm").trigger('reset');
        $('.modal').hide();

        if(data.status)
            swal({
                title: "Awesome",
                text: data.message,
                confirmButtonColor: "#fe7447"
            });
        else
            swal({
                title: "Oh Snap!",
                text: data.message,
                confirmButtonColor: "#fe7447"
            });
     },
    freezeHangoutForm : function () {
        $('#hangoutBtn').addClass('disabled');
        $('#hangoutBtn').html('<i class="fa fa-spinner fa-spin"></i> Submit');
    },
    releaseHangoutForm : function () {
        $('#hangoutBtn').removeClass('disabled');
        $('#hangoutBtn').html('Submit');
    }
};

$(document).ready(Hangout.init);