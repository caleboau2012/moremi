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
        var requestForm = form.serializeArray();
        var requestFormObject = {};
        $.each(requestForm,
            function(i, v) {
                requestFormObject[v.name] = v.value;
            });

        console.log(requestFormObject);
        return;

        Utils.swalLoader();
        Utils.post(url, {
            users: status_
        }, 'POST', Hangout.requestUploaded, Hangout.uploadError);
    },
    uploadError: function(data){
        swal('Oh Snap!', "We don't know what went wrong but we couldn't finish the operation");
    },
    requestUploaded: function(data){
        // console.log(data);
        $("#finish").button('reset');
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
        $(".status-content").html($("#statusContent").val());
    }
};

$(document).ready(Hangout.init);