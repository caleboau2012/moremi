/**
 * Created by KayLee on 30/06/2016.
 */
/**
 * Created by KayLee on 30/06/2016.
 */
var Facebook = {
    init: function(){
        $("#login").click(Facebook.login);
    },
    login: function(){
        FB.login(function(response) {
            console.log(response);
            Facebook.status();
        }, {scope: 'public_profile,email'});
    },
    status: function(){
        FB.getLoginStatus(function(response) {
            if(response.status == "connected"){
                FB.api('/me?fields=id,first_name,last_name,email,gender', function(response) {
                    console.log(response);
                    //$.post($("#login").attr("data-url"), {
                    //    first_name: response.first_name,
                    //    last_name: response.last_name,
                    //    email: response.email,
                    //    facebook_id: response.id
                    //}, function(data){
                    //    console.log(data)
                    //}, "json");
                });
                $("#login").addClass("hidden");
                $("#login-cheek").removeClass("hidden");
            }
            else{
                $("#login").removeClass("hidden");
                $("#login-cheek").addClass("hidden");
            }
        });
    }
};

$(document).ready(function(){
    Facebook.init();
});