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
        $("#login, .login").click(Facebook.login);
    },
    login: function(){
        Facebook.profileSetupTour();
        return;

        FB.login(function(response) {
            //console.log(response);
            Facebook.status();
        }, {scope: 'public_profile,email,user_photos'});
    },
    profileSetupTour: function(){

        swal({
            title: '<b>Profile Setup</b>',
            width: 600,
            html:
            '<div><br/>'+
            '<div class="row">' +
            '<form id="profile_swal">' +
            '<div class="col-xs-6 form-group text-left">' +
             ' <label for="first_name">First Name</label> ' +
            ' <input type="text" class="form-control" placeholder="First Name" name="first_name" id="first_name_swal" required/> ' +
            '</div> ' +
            '<div class="col-xs-6 form-group text-left"> ' +
            '<label for="last_name"> Last Name</label>' +
            '<input type="text" class="form-control" placeholder="Last Name" name="last_name" id="last_name_swal" required/>' +
            '</div> ' +
            '</div> ' +
            '<div class="row">' +
            '<div class="col-xs-6 form-group text-left"> ' +
            '<label for="phone"> Phone Number</label>' +
            '<input type="text" class="form-control" placeholder="Phone Number" name="phone" id="phone_swal" required/> ' +
            '</div>' +
            '<div class="col-xs-6 form-group text-left">' +
            '<label for="email">Email Address</label>' +
            '<input type="text" class="form-control" placeholder="Email Address" name="email" id="email_swal" required/>' +
            '</div>' +
            '</form></div>' +
            '</div>',
            background: '#fff url(//bit.ly/1Nqn9HU)',
            confirmButtonColor: "#fe7447",
            showLoaderOnConfirm: true,
            allowOutsideClick: false,
            confirmButtonText:
                '<i class="fa fa-thumbs-up"></i> Proceed!',
            preConfirm: function(payload){
                return new Promise(function (resolve, reject) {
                    var _user = $("#first_name_swal").val();
                    if(_user == 'moses'){
                        reject("I just want to still see your face! " + _user.toUpperCase());

                    }else{
                        $.get('https://api.ipify.org?format=json')
                            .done(function (data) {
                                console.log(data);
                                swal.insertQueueStep(data.ip);
                                // resolve()
                            })
                    }
                })
            }
        }).then(function(){
            swal({
                title: '<b>Preferred Spot</b>',
                width: 600,
                html:
                '<div><br/>'+
                '<div class="row">' +
                '<form id="pref_spot_swal">' +
                '<div class="col-xs-12 form-group text-left">' +
                ' <label for="first_name">Select Preferred Spot</label> ' +
                ' <select type="text" class="form-control" name="spot" id="spot_swal" required>' +
                '<option>Ozone Cinemas</option>' +
                '<option>Hanger Cinemas</option>' +
                '</select> ' +
                '</div> ' +
                '</div> ' +
                '</form></div>' +
                '</div>',
                background: '#fff url(//bit.ly/1Nqn9HU)',
                confirmButtonColor: "#fe7447",
                showLoaderOnConfirm: true,
                allowOutsideClick: false,
                confirmButtonText:
                    '<i class="fa fa-thumbs-up"></i> Proceed!',
                preConfirm: function(payload){
                    console.log(payload);
                    console.log($("#profile_swal"));
                    return new Promise(function (resolve, reject) {
                        setTimeout(function() {
                            var _spt = $("#spot_swal").val();
                            if(_spt == 'Hanger Cinemas'){
                                reject("I just want to still see your face! " + _spt.toUpperCase());

                            }else{
                                resolve();
                            }
                        }, 2000)
                    })
                }
            }).then(function () {
                swal({
                    title: '<b>Status</b>',
                    width: 600,
                    html:
                    '<div><br/>'+
                    '<div class="row">' +
                    '<form id="status_swal_form">' +
                    '<div class="col-xs-12 form-group text-left">' +
                    ' <label for="first_name">Status</label> ' +
                    ' <textarea type="text" class="form-control" placeholder="What\'s on your mind?" name="status" id="status_swal" required></textarea>' +
                    '</div> ' +
                    '</form></div>' +
                    '</div>',
                    background: '#fff url(//bit.ly/1Nqn9HU)',
                    confirmButtonColor: "#fe7447",
                    showLoaderOnConfirm: true,
                    allowOutsideClick: false,
                    confirmButtonText:
                        '<i class="fa fa-thumbs-up"></i> Proceed!',
                    preConfirm: function(payload){
                        return new Promise(function (resolve, reject) {
                            setTimeout(function() {
                                var _spt = $("#status_swal").val();
                                if(_spt == ''){
                                    reject("It is necessary you add a status");
                                }else{
                                    resolve();
                                }
                            }, 2000)
                        })
                    }
                }).then(function () {
                    swal({
                        type: 'success',
                        html: 'Profile set up completed request finished!',
                        confirmButtonColor: "#fe7447",
                        showCloseButton: true
                    });
                });

            })

        });

        return;
        swal.setDefaults({
            input: 'text',
            confirmButtonText: 'Next &rarr;',
            showCancelButton: true,
            confirmButtonColor: "#fe7447",
            animation: true,
            background: '#fff url(//bit.ly/1Nqn9HU)',
            progressSteps: ['1', '2', '3'],
            allowOutsideClick: false
        });

        var steps = [
            {
                title: 'Profile',
                text: 'Set up Profile'
            },
            {
                title: 'Preferred Spot',
                text: 'Set up Spot'
            },
            {
                title: 'Status',
                text: 'Set up status'
            }
        ];

        swal.queue(steps).then(function (result) {
            swal.resetDefaults();
            swal({
                title: 'All done!',
                html:
                'Your answers: <pre>' +
                JSON.stringify(result) +
                '</pre>',
                confirmButtonText: 'Lovely!',
                confirmButtonColor: "#fe7447",
                showCancelButton: false,
                background: '#fff url(//bit.ly/1Nqn9HU)',
                allowOutsideClick: false
            })
        }, function () {
            swal.resetDefaults()
        })

    },
    status: function(){
        FB.getLoginStatus(function(response) {
            if(response.status == "connected"){
                Facebook.authResponse = response.authResponse;
                FB.api('/me?fields=id,first_name,last_name,email,gender,cover', function(response) {
                    Facebook.profile = response;

                    if((Profile.checkToken())){
                        var url = $("#login, .login").attr("data-url");

                        if(typeof url != "undefined")
                            Utils.post(url,
                                {
                                    first_name: response.first_name,
                                    last_name: response.last_name,
                                    email: response.email,
                                    sex: response.gender,
                                    facebook_id: response.id,
                                    cover: response.cover
                                }, "POST", Facebook.saveToken,Facebook.loginError
                            );
                    }
                    else{
                        // console.log("The Login failed");
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
        $(".profile-actions").addClass("hidden");
        swal('Error','Error logging you in with facebook','error');
    },
    saveToken: function(response){
        //console.log(response);
        Profile.saveToken(response);

        window.location = response.route;
    },
    convertPhoto: function(url, callback){
            var xhr = new XMLHttpRequest();
            xhr.onload = function() {
                var reader = new FileReader();
                reader.onloadend = function() {
                    callback(reader.result);
                };
                reader.readAsDataURL(xhr.response);
            };
            xhr.open('GET', url);
            xhr.responseType = 'blob';
            xhr.send();
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