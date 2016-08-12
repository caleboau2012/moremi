/**
 * Created by Samuel.James on 8/12/2016.
 */
Vote ={
    CONSTANT: {
    url: Routes.Vote
    },

    init: function(){
        $('.vote-c').click( function(){
          var id =$(this).attr('data-id');
            $(this).attr('disabled');
            alert(id);
            Vote.voteProfile(id);
        });
    },
    disableBtn: function (object) {
        object.attr('disabled');
    },
   voteProfile : function (id) {
       var data ={'profile_id':id};
       Vote.sendVote(data);
   },

  sendVote: function(data){
      $.ajax({
          url: Vote.CONSTANT.url,
          type: 'POST',
          dataType: "json",
          data: data,
          headers: {},
          beforeSend: function () {
          },
          success: function (result) {
             Vote.showResponse(result)
          },
          complete: function () {
          },
          error: function(){
              swal('Oops..','Error connecting to server','error');
          }
      });
  },

 showResponse: function (data) {
    if(data.status==false){
        swal('Oops..',data.msg,'error');
    }
     if(data.status==true){
         swal('Success',data.msg,'success')
     }
 }
}