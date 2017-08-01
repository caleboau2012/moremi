/**
 * Created by KayLee on 13/08/2016.
 */
var Profile = {
    photos: [],
    facebookPhotos: [],
    init: function(){
        // Check for the various File API support.
        if (window.File && window.FileReader && window.FileList && window.Blob) {
            // Great success! All the File APIs are supported.
        } else {
            swal('Wait a minute', 'We detect your browser is outdated. Kindly upgrade');
        }

        $(document).undelegate('.drag-pp', 'click').delegate('.drag-pp', 'click' , function () {
            var _src = $(this).attr('data-img-src');
            var _index = $(this).attr('data-img-index');
            $('#profile-active-dp').attr('src', _src).attr('data-index', _index);

            Profile.finish($('#pictures-panel').attr("data-url"));
        });

        /*masonry*/
        $('#masonry_items').masonry({
            itemSelector: '.masonry_item'
        });

        $('.masonry_item').each(function() {
            $(this).imagesLoaded(function () {
                $('#masonry_items').masonry();
            });
        });

        //$(".image-box").each(function(i){
        //    $(this).height($(this).width());
        //});
        $(".edit_profile_btn").click(function (e) {
            e.preventDefault();
            $('#accountModal').modal();
        });

        $("#p_spot").change(function(e){
            var selected = $(this).find('option:selected');

            if(this.value == 0)
                $("#venue-url").addClass('hidden');
            else{
                var src = selected.data('image');
                var url = selected.data('url');
                var title = selected.data('title');

                $("#venue-image").attr('src', src);
                $("#venue-url").attr('href', url).removeClass('hidden');
                $("#venue-title").text(title);
            }
        });

        $("#login-cheek").addClass("hidden");
        $("#facebook-fetch").removeClass("hidden").on("click", function(e){
            //$("#picturesModal").modal("show");
            e.preventDefault();
            console.log(this);
            FB.getLoginStatus(function(response) {
                console.log(response);
                if(response.status == "connected"){
                    Facebook.authResponse = response.authResponse;
                    FB.api('/me?fields=id,first_name,last_name,email,gender,cover', function(response) {
                        console.log(response);
                        Facebook.profile = response;

                        Facebook.userAlbums();
                    });
                }
            });
        });
        $(document).undelegate(".select-picture", "click").delegate(".select-picture", "click", function(e){
            var pix = $(".pictures-panel");
            if(($(this).find("span").hasClass("icon-square-o")) && ((Profile.facebookPhotos.length + pix.length) < 6)) {
                $(this).find("span").toggleClass("icon-square-o").toggleClass("icon-check-square-o");
                Profile.facebookPhotos.push($(this).find("img").attr("src"));
                //console.log("Pushed" + $(this).find("img").attr("src"));
            }
            else if(($(this).find("span").hasClass("icon-square-o")) && (Profile.facebookPhotos.length >= 6)){
                swal('Relax','We only allow a total of 6 pictures');
                //console.log("Prevented" + $(this).find("img").attr("src"));
            }
            else if($(this).find("span").hasClass("icon-check-square-o")){
                $(this).find("span").toggleClass("icon-square-o").toggleClass("icon-check-square-o");
                for(var i = 0; i < Profile.facebookPhotos.length; i++){
                    if(Profile.facebookPhotos[i] == $(this).find("img").attr("src")){
                        //console.log("Removed" + Profile.facebookPhotos[i]);
                        Profile.facebookPhotos.remove(i);
                    }
                }
            }
        }).undelegate(".profile-pic", "dragover").undelegate(".profile-pic", "dragenter").undelegate(".image-box", "dragstart").undelegate(".profile-pic", "drop")
            .delegate(".image-box", "dragstart", function(e){
                //console.log({
                //    event: e,
                //    url: $(this).find("img").attr("src"),
                //    object: this
                //});
                e.originalEvent.dataTransfer.setData("url", $(this).find("img").attr("src"));
                e.originalEvent.dataTransfer.setData("index", $(this).find("img").attr("data-index"));
                //console.log(e.originalEvent.dataTransfer.getData("url"));
            }).delegate(".profile-pic", "drop", function(e){
                e.preventDefault();
                var newURL = e.originalEvent.dataTransfer.getData("url");
                var index = e.originalEvent.dataTransfer.getData("index");
                var oldURL = $(this).find("img").attr("src");
                /*console.log({
                 new: newURL,
                 old: oldURL,
                 index: index
                 });*/
                $(this).find("img").attr("src", newURL).attr("data-index", index).removeClass("hidden").css('display', 'block');
                if(oldURL == ""){
                    $(this).find(".image-placeholder").remove();
                }
            }).delegate(".profile-pic", "dragover", function(e){
                e.preventDefault();
                e.stopPropagation();
            }).delegate(".profile-pic", "dragenter", function(e){
                e.preventDefault();
                e.stopPropagation();
            }
        ).undelegate(".delete-picture", "click").delegate(".delete-picture", "click", function(e){
                var element = this;
                swal({
                    title: "Are you sure?",
                    text: "We cannot undo this action",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#fe7447"
                }).then(function(){
                    console.log(element, this, e);
                    Profile.deletePicture($(element).parent().parent().parent(), $(element).attr("data-url"));
                });
            }
        );
        //.undelegate(".picture-panel .fa-close").delegate(".picture-panel .fa-close", "click", function(e){
        //    Profile.deletePicture($(this).parent().parent().parent());
        //});

        $(".picture-upload").click(function(e){
            $("#pic-upload").click();
        });

        $("#pic-upload").change(function(e){
            var pix = $(".pictures-panel").length;
            if(pix + e.target.files.length > 5){
                swal("Relax", "We only allow a total of 6 pictures");
            }
            else{
                Profile.loadLocalPix(e.target.files);
            }
        });

        $("#finish").click(function(){
            Profile.finish($(this).attr("data-url"));
        });

        $(".help").click(function(e){
            e.preventDefault();
            introJs().setOption('disableInteraction', true).start();
        });

        /*Save status*/
        $('#statusForm').on('submit', function (e) {
            e.preventDefault();
            var status_ = $('#statusContent').val();
            var spot_ = $('#p_spot').val();

            if(spot_ == 0){
                swal('Oh Snap!', "You didn't pick a spot");
                return;
            }

            Utils.swalLoader();
            Utils.post($(this).attr('action'), {
                status: status_,
                spot: spot_
            }, 'POST', Profile.statusUploaded, Profile.uploadError);
        });
    },
    showDemo: function(){
        if((localStorage.getItem('profile') == null) && ($(window).width() > 750)){
            introJs().setOption('disableInteraction', true).start();
            if(typeof(Storage) !== "undefined"){
                localStorage.setItem('profile', 'true');
            }
        }
    },
    loadFromApi: function(response){
        if(response.status){
            Profile.loadApiPix(response.data);
        }
    },
    loadFromApiError: function(error){
    },
    finish: function(url){
        //console.log($(".picture-panel"));
        var status = $("#status").val();
        var venue = $('#venue').val();
        var img;
        var photos = [];
        $(".picture-panel").each(function(index, e){
            img = $(e).find("img")[0];
            photos.push(img.src);
        });
        var pPic = $($(".profile-pic").find("img")[0]).attr("data-index");

        if(pPic == location.href){
            swal("Chill!", "You need a profile picture");
        }

        var data = {
            status: status,
            photo: photos,
            venue: venue,
            profile_pic: pPic
        };

        Utils.swalLoader('Relax and sit back...');

        Utils.post(url,
            data, "POST", Profile.uploaded, Profile.uploadError
        );

        $("#finish").button('loading');
    },
    statusUploaded: function(data){
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
    },
    uploaded: function(data){
        // console.log(data);
        $("#finish").button('reset');
        if(data.status){
            swal({
                title: "Awesome",
                text: data.message,
                confirmButtonColor: "#fe7447"
            });
            $(".profile-dp-img").attr('src', $('#profile-active-dp').attr('src'));
        }
        else
            swal({
                title: "Oh Snap!",
                text: data.message,
                confirmButtonColor: "#fe7447"
            });
    },
    uploadError: function(data){
        swal('Oh Snap!', "We don't know what went wrong but we couldn't finish the operation");
        $("#finish").button('reset');
    },
    deletePicture: function(picture, url){
        console.log(url);
        Utils.post(url, null, "GET", Profile.deleteSuccessful, Profile.deleteFailed);
        picture.remove();
    },
    deleteSuccessful: function(response){
        if(response.status)
            swal('Gone', "That picture is gone...");
        else
            swal('Oh Snap', "Something went wrong when deleting your beautiful picture");
    },
    deleteFailed: function(error){
        // console.log(error);
    },
    saveToken: function(response){
        console.log(response);
        localStorage.setItem(TOKEN, response.authToken);
    },
    getToken: function(){
        return localStorage.getItem(TOKEN);
    },
    checkToken: function(){
        if(Profile.getToken())
            return true;
    },
    loadLocalPix: function(files){
        var HTML, template, reader;
        for(var i = 0; i < files.length; i++){
            if (files[i].type.indexOf('image') == -1) {
                continue;
            }
            reader = new FileReader();

            reader.onload = function(e) {
                template = $("#picture-template").html();
                HTML = template.replace("[[src]]", e.target.result)
                    .replace("[[src]]", e.target.result)
                    .replace("[[i]]", $(".picture-panel").length)
                    .replace("[[i]]", $(".picture-panel").length);
                $("#pictures-panel").append(HTML);
            };

            reader.readAsDataURL(files[i]);
        }
    },
    //setProfilePicture: function(data){
    //    console.log(data);
    //    $(".profile-pic img").attr("src", data.url);
    //},
    setPhotos: function(data){
        var url, HTML, template;
        $("#pictures-pane").empty();
        for(var i = 0; i < data.length; i++) {
            HTML = "";
            //console.log(Facebook.photo(data[i]));
            $.get(Facebook.photo(data[i]), function (response) {
                Facebook.convertPhoto(response.images[0].source, function (response) {
                    template = $("#facebook-picture").html();
                    url = response;
                    HTML = template.replace("[[src]]", url);
                    if ($("#pictures-pane .select-picture").length < 6) {
                        $("#pictures-pane").append(HTML);
                    }
                    else {
                        $("#pictures-pane").append(HTML);
                        $(".select-picture").each(function (i) {
                            $(this).height($(this).width());
                        });
                    }
                });
            });
        }

        $("#picturesModal").modal("show").on('hidden.bs.modal', function (e) {
            Profile.loadFacebookPix();
            Profile.facebookPhotos = [];
        });
    },
    loadFacebookPix: function(){
        var HTML = "", template;
        for(var i = 0; i < Profile.facebookPhotos.length; i++){
            //console.log(Profile.facebookPhotos[i]);
            template = $("#picture-template").html();
            HTML = template.replace("[[src]]", Profile.facebookPhotos[i])
                .replace("[[i]]", $(".picture-panel").length)
                .replace("[[src]]", Profile.facebookPhotos[i])
                .replace("[[i]]", $(".picture-panel").length);
            $("#pictures-panel").append(HTML);
        }
    },
    loadApiPix: function(response){
        var HTML = "", template;
        $(".profile-pic").find("img")[0].src = response.profile_pic.full_path;
        $("#status").val(response.status);
        for(var i = 0; i < response.photos.length; i++){
            template = $("#picture-template").html();
            HTML = template.replace("[[src]]", response.photos[i].full_path);
            $("#pictures-panel").append(HTML);
        }
        //$("#pictures-panel").prepend(HTML);
    }
};

$(document).ready(Profile.init);