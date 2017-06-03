/**
 * Created by Samuel.James on 8/12/2016.
 */
ProfileSidebar ={
    CONSTANTS: {
      url: Routes.Contentant,
      per_page: 10
    },

init: function(){

},
    getProfiles: function(){
       $.ajax({
           url: ProfileSidebar.CONSTANTS.url+'/'+ProfileSidebar.CONSTANTS.per_page,
           type: 'GET',
           dataType: "json",
           data: {},
           headers: {},
           beforeSend: function () {
           },
           success: function (result) {
               ProfileSidebar.processProfiles(result.data)
           },

           complete: function () {
           },
           error: function(){
               swal('Oops..','Error connecting to server','error');
           }
       });
   },

    processProfiles: function(data){
        var content=""
        for(var i=0; i<data.length; i++){
            var template =$('#contestant').html();
            var vote=0;
            if(data[i].vote>1){
                vote= data[i].vote +' Picks'}else{
                vote= data[i].vote +' Pick'
            }
            var h =template.replace('[[name]]',data[i].name)
                .replace('[[name]]',data[i].name)
                .replace('[[id]]',data[i].id)
                .replace('[[vote]]',vote)
                .replace('[[image]]',data[i].image)
            content +=h;
        }
        ProfileSidebar.appendProfiles(content);
       // return content;
    },
   removeContent: function () {
    $('#contestant-parent').html("")
   },

   appendProfiles: function(content){
    ProfileSidebar.removeContent();
       $('#contestant-parent').append(content)
   }

}