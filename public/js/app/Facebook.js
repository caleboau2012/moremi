/**
 * Created by KayLee on 30/06/2016.
 */
/**
 * Created by KayLee on 30/06/2016.
 */
var Facebook = {
    profile: {},
    authResponse: {},
    ACTIVE_PROFILE :null,
    init: function(){
        $("#login, .login").click(Facebook.login);
    },
    login: function(){
        FB.login(function(response) {
            //console.log(response);
            Utils.swalLoader();
            Facebook.status();
        }, {scope: 'public_profile,email,user_photos'});
    },
    profileSetupTour: function(){

        var PROFILE_UPDATE_URL = window.location.origin + '/profile-update';
        var STATUS_UPDATE_URL = window.location.origin + '/update/status';
        var SPOT_UPDATE_URL = window.location.origin + '/update/spot';
        var SPOTS = null;

        swal({
            title: '<b>Profile Setup</b>',
            width: 600,
            html:
            '<div><br/>'+
                '<form id="profile_swal">' +
                    '<div class="row">' +
                        '<div class="col-xs-6 swal_con form-group text-left" id="first_name_swal_con">' +
                            ' <label for="first_name">First Name</label> ' +
                            ' <input type="text" class="form-control" placeholder="First Name" name="first_name" value="' + (Facebook.ACTIVE_PROFILE.first_name ? Facebook.ACTIVE_PROFILE.first_name : '') + '" id="first_name_swal" required/> ' +
                            '<span class="help-block text-danger small swal_form_error" id="first_name_swal_error"></span>' +
                        '</div> ' +
                        '<div class="col-xs-6 swal_con form-group text-left" id="last_name_swal_con"> ' +
                            '<label for="last_name"> Last Name</label>' +
                            '<input type="text" class="form-control" placeholder="Last Name" name="last_name" value="' + (Facebook.ACTIVE_PROFILE.last_name ? Facebook.ACTIVE_PROFILE.last_name : '') + '" id="last_name_swal" required/>' +
                            '<span class="help-block text-danger small swal_form_error" id="last_name_swal_error"></span>' +
                        '</div> ' +
                    '</div> ' +
                    '<div class="row">' +
                        '<div class="col-xs-6 swal_con form-group text-left" id="phone_swal_con"> ' +
                            '<label for="phone"> Phone Number</label>' +
                            '<input type="text" class="form-control" placeholder="Phone Number" name="phone" value="' + (Facebook.ACTIVE_PROFILE.phone ? Facebook.ACTIVE_PROFILE.phone : '') + '"  id="phone_swal" required/> ' +
                            '<span class="help-block text-danger small swal_form_error" id="phone_swal_error"></span>' +
                        '</div>' +
                        '<div class="col-xs-6 swal_con form-group text-left" id="email_swal_con">' +
                            '<label for="email">Email Address</label>' +
                            '<input type="text" class="form-control" placeholder="Email Address" name="email" value="' + (Facebook.ACTIVE_PROFILE.email ? Facebook.ACTIVE_PROFILE.email : '') + '"  id="email_swal" required/>' +
                            '<span class="help-block text-danger small swal_form_error" id="email_swal_error"></span>' +
                        '</div>' +
                   '</div>' +
                '</form>' +
            '</div>',
            confirmButtonColor: "#fe7447",
            showLoaderOnConfirm: true,
            allowOutsideClick: false,
            confirmButtonText:
                '<i class="fa fa-thumbs-up"></i> Proceed!',
            preConfirm: function(payload){
                return new Promise(function (resolve, reject) {
                    $('.swal_con').removeClass('has-error');
                    $('.swal_form_error').empty();
                    var payload = {
                        first_name : $("#first_name_swal").val(),
                        last_name : $("#last_name_swal").val(),
                        phone : $("#phone_swal").val(),
                        email : $("#email_swal").val()
                    };

                    Utils.post(PROFILE_UPDATE_URL, payload, 'POST',
                        function (data) {
                            SPOTS = data.venues;
                            resolve();
                        },
                        function (data) {
                            var res = data.responseJSON;
                            if(res.status != undefined){
                                reject(res.msg);
                            }else{
                                $.each(res, function( index, value ) {
                                    $("#" + index + "_swal_con").addClass('has-error');
                                    $("#" + index + "_swal_error").html(value);
                                });
                                reject();
                            }
                        });
                })
            }
        }).then(function(){
            var spotsOptionsHTML = "";
            $.each(SPOTS, function(item, value){
                spotsOptionsHTML += '<option value="'+ value.id +'">' + value.name + '</option>';
            });

            swal({
                title: '<b>Preferred Spot</b>',
                width: 600,
                html:
                '<div><br/>'+
                '<div class="row">' +
                '<form id="pref_spot_swal">' +
                '<div class="col-xs-12 form-group text-left" id="spot_swal_con">' +
                ' <label for="first_name">Select Preferred Spot</label> ' +
                ' <select type="text" class="form-control" name="spot" id="spot_swal" required>' +
                  spotsOptionsHTML +
                '</select> ' +
                '</div> ' +
                '</div> ' +
                '</form></div>' +
                '</div>',
                confirmButtonColor: "#fe7447",
                showLoaderOnConfirm: true,
                allowOutsideClick: false,
                confirmButtonText:
                    '<i class="fa fa-thumbs-up"></i> Proceed!',
                preConfirm: function(payload){
                    return new Promise(function (resolve, reject) {
                        $('#spot_swal_con').removeClass('has-error');
                        var payload = {
                            spot : $("#spot_swal").val()
                        };

                        Utils.post(SPOT_UPDATE_URL, payload, 'POST',
                            function (data) {
                                resolve();
                            },
                            function (data) {
                                var res = data.responseJSON;
                                $('#spot_swal_con').addClass('has-error');
                                reject(res.message);
                            });
                    })
                }
            }).then(function () {
                swal({
                    title: '<b>Profile Status</b>',
                    width: 600,
                    html:
                    '<div><br/>'+
                    '<div class="row">' +
                    '<form id="status_swal_form">' +
                    '<div class="col-xs-12 form-group swal-con text-left" id="status_swal_con">' +
                    ' <label for="status_swal">Status</label> ' +
                    ' <textarea type="text" class="form-control" placeholder="What\'s on your mind?" name="status" id="status_swal" required>' + (Facebook.ACTIVE_PROFILE.about ? Facebook.ACTIVE_PROFILE : '') + '</textarea>' +
                    '<span class="help-block text-danger small swal_form_error" id="status_swal_error"></span>' +
                    '</div> ' +
                    '</form></div>' +
                    '</div>',
                    confirmButtonColor: "#fe7447",
                    showLoaderOnConfirm: true,
                    allowOutsideClick: false,
                    confirmButtonText:
                        '<i class="fa fa-thumbs-up"></i> Proceed!',
                    preConfirm: function(payload){
                        return new Promise(function (resolve, reject) {
                            $('#status_swal_con').removeClass('has-error');
                            var payload = {
                                status : $("#status_swal").val()
                            };

                            Utils.post(STATUS_UPDATE_URL, payload, 'POST',
                                function (data) {
                                    resolve();
                                },
                                function (data) {
                                    var res = data.responseJSON;
                                    $('#status_swal_con').addClass('has-error');
                                    reject(res.message);
                                }
                            );
                        })
                    }
                }).then(function () {
                    swal({
                        type: 'success',
                        html: 'Profile set up completed!',
                        confirmButtonColor: "#fe7447",
                        showCloseButton: true,
                        preConfirm : function () {
                            window.location = Facebook.ACTIVE_PROFILE.responseRoute;
                        }
                    });
                });

            })

        });
    },
    status: function(callback){
        FB.getLoginStatus(function(response) {
            if(response.status == "connected"){
                Facebook.authResponse = response.authResponse;
                FB.api('/me?fields=id,first_name,last_name,email,gender,cover', function(response) {
                    Facebook.profile = response;

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
        Utils.swalErrorAlert('Unable to login. Please, try again');
    },
    saveToken: function(response){
        console.log(response);
        /*save active profile on the client*/
        Facebook.ACTIVE_PROFILE = response.profile;
        Profile.saveToken(response);

        console.log(!Facebook.ACTIVE_PROFILE.email || !Facebook.ACTIVE_PROFILE.about || !Facebook.ACTIVE_PROFILE.venue);

        if(!Facebook.ACTIVE_PROFILE.email || !Facebook.ACTIVE_PROFILE.about || !Facebook.ACTIVE_PROFILE.venue){
            Facebook.profileSetupTour();
            Facebook.ACTIVE_PROFILE.responseRoute = response.route;
        }else{
            window.location = response.route;
        }
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
        console.log(Facebook.profile);
        FB.api(
            "/" + Facebook.profile.id + "/albums",
            function (response) {
                console.log(response);
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