/**
 * Created by KayLee on 30/06/2016.
 */
/**
 * Created by KayLee on 30/06/2016.
 */
var Facebook = {
    profile: {},
    authResponse: {},
    init: function(){
        $("#login").click(Facebook.login);
    },
    login: function(){
        FB.login(function(response) {
            //console.log(response);
            Facebook.status();
        }, {scope: 'public_profile,email,user_photos'});
    },
    status: function(){
        FB.getLoginStatus(function(response) {
            if(response.status == "connected"){
                console.log(response);
                Facebook.authResponse = response.authResponse;
                FB.api('/me?fields=id,first_name,last_name,email,gender', function(response) {
                    //console.log(response);
                    Facebook.profile = response;

                    //console.log({
                    //    check: Profile.checkToken()
                    //});

                    if((Profile.checkToken()) && (response.gender == "female")){
                        var url = $("#login").attr("data-url");

                        Utils.post(url,
                            {
                                first_name: response.first_name,
                                last_name: response.last_name,
                                email: response.email,
                                facebook_id: response.id
                            }, "POST", Facebook.saveToken,Facebook.loginError
                        );
                    }
                    else{
                        $(".profile-actions").addClass("hidden");
                        $("#login").removeClass("hidden");
                    }
                });

            }
            else{
                $(".profile-actions").addClass("hidden");
                $("#login").removeClass("hidden");
            }
        });
    },
    loginError: function () {
        swal('Error','Error logging you in with facebook','error');
    },
    saveToken: function(response){
        Profile.saveToken(response);

        $(".profile-actions").addClass("hidden");
        if(location.pathname == "/profile"){
            $("#facebook-fetch").removeClass("hidden");
        }
        else{
            $("#login-cheek").removeClass("hidden");
        }
    },
    userPicture: function(){
        FB.api('/v2.7/' + Facebook.profile.id + '/picture?type=large', function(response){
            if (response && !response.error) {
                /* handle the result */
                //console.log(response);
                Profile.setProfilePicture(response.data);
            }
        })
    },
    userPhotos: function(){
        FB.api("/" + Facebook.profile.id + "/photos?type=uploaded",
            function (response) {
                if (response && !response.error) {
                    /* handle the result */
                    //console.log(response);
                    Profile.setPhotos(response.data);
                }
            }
        );
    },
    userAlbums: function(){
        FB.api(
            "/" + Facebook.profile.id + "/albums",
            function (response) {
                if (response && !response.error) {
                    for(var i = 0; i < response.data.length; i++){
                        if(response.data[i].name.toLowerCase() == "profile pictures"){
                            Facebook.album(response.data[i].id);
                        }
                    }
                    /* handle the result */
                }
            }
        );
    },
    album: function(id){
        FB.api(
            "/" + id + "/photos",
            function (response) {
                if (response && !response.error) {
                    /* handle the result */
                    Profile.setPhotos(response.data);
                }
            }
        );
    },
    photo: function(photo){
        var url = 'https://graph.facebook.com/' + photo.id + '?fields=images&access_token=' + Facebook.authResponse.accessToken;
        return url;
    }
};

$(document).ready(function(){
    Facebook.init();
});