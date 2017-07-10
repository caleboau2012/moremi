/**
 * Created by Samuel.James on 8/12/2016.
 */
Vote ={
    CONSTANT: {
        url: Routes.Vote,
        profileID: null
    },

    init: function(){
        $(document).undelegate('.vote-btn', 'click').delegate('.vote-btn', 'click', function(e){
            e.preventDefault();
            var id =$(this).attr('data-id');

            $(this).attr('disabled');
            Vote.voteProfile(id,Vote.increaseCount,this);
        });
    },

    disableBtn: function (object) {
        object.attr('disabled');
    },

    voteProfile : function (id, callback, element) {
        var data ={'profile_id':id};
        Vote.CONSTANT.profileID = id;
        Vote.sendVote(data,callback,element);
    },

    sendVote: function(data, callback, element){
        $.ajax({
            url: Vote.CONSTANT.url,
            type: 'POST',
            dataType: "json",
            data: data,
            headers: {},
            beforeSend: function () {
            },
            success: function (result) {
                callback(result,element)
            },
            complete: function () {
            },
            error: function(){
                swal('Oops..','Error connecting to server','error');
            }
        });
    },
    increaseCount: function(data, element){
        if(data.status==false){
            if(!data.auth){
                swal({
                    title: "Ouch...",
                    text: data.msg,
                    type: "error",
                    confirmButtonColor: "#fe7447"
                });
            }
            else if(!data.profile) {
                swal({
                        title: "Ouch...",
                        text: data.msg,
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#fe7447"
                    },
                    function(){
                        $("#accountModal").modal('show');
                    });
            }
            else{
                swal({
                        title: "Ouch...",
                        text: data.msg,
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#fe7447",
                        confirmButtonText: "Continue!"
                    },
                    function(){
                        $("#votePayModal").modal('show');
                    });
            }
        }
        else if(data.status){
            swal({
                    title: "Success",
                    text: data.msg,
                    type: "success",
                    showCancelButton: true,
                    confirmButtonColor: "#fe7447"
                },
                function(){
                });

            // swal('Success',data.msg,'success');

            if(typeof $(element).parent().parent().find(".vote-count")[0] != "undefined"){
                var count = parseInt($(element).parent().parent().find(".vote-count")[0].innerHTML) + 1;
                $(element).parent().parent().find(".vote-count")[0].innerHTML = count;
            }
            else{
                var count = parseInt($(".vote-count")[0].innerHTML) + 1;
                $(".vote-count")[0].innerHTML = count;
            }

            //App.fetchCheeks(); //re arrange profile bar
        }
    }
};

$(document).ready(Vote.init);