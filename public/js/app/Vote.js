/**
 * Created by Samuel.James on 8/12/2016.
 */
Vote ={
    CONSTANT: {
        url: Routes.Vote
    },

    init: function(){
        //$('#contestant-parent').on('click','.vote-c', function(e){
        //    //$('.vote-c').click( function(e){
        //    e.preventDefault();
        //    var id =$(this).attr('data-id');
        //    $(this).attr('disabled');
        //    Vote.voteProfile(id,Vote.showResponse,this);
        //});

        $(document).delegate('.vote-c-tw', 'click', function(e){
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

    //showResponse: function (data, element) {
    //    if(data.status==false){
    //        swal('Oops..',data.msg,'error');
    //    }
    //    if(data.status==true){
    //        swal('Success',data.msg,'success');
    //        //Home.fetchCheeks(); //re arrange profile bar
    //    }
    //},
    increaseCount: function(data, element){
        if(data.status==false){
            swal('Oops..',data.msg,'error');
        }
        if(data.status==true){
            swal('Success',data.msg,'success');
            var count = parseInt($(element).parent().find(".vote-count span")[0].innerHTML) + 1;
            //console.log({
            //    element: element,
            //    count: count
            //});

            $(element).parent().find(".vote-count span")[0].innerHTML = count;
            //Home.fetchCheeks(); //re arrange profile bar
        }
    }
};