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

        $(".image-box").each(function(i){
            $(this).height($(this).width());
        });

        $("#login-cheek").addClass("hidden");
        $("#facebook-fetch").removeClass("hidden").on("click", function(e){
            //Facebook.userPicture();
            //Facebook.userPhotos();
            Facebook.userAlbums();
        });
        $(document).undelegate(".select-picture", "click").delegate(".select-picture", "click", function(e){
            var pix = $(".pictures-panel");
            if(($(this).find("span").hasClass("fa-square-o")) && ((Profile.facebookPhotos.length + pix.length) < 6)) {
                $(this).find("span").toggleClass("fa-square-o").toggleClass("fa-check-square-o");
                Profile.facebookPhotos.push($(this).find("img").attr("src"));
                //console.log("Pushed" + $(this).find("img").attr("src"));
            }
            else if(($(this).find("span").hasClass("fa-square-o")) && (Profile.facebookPhotos.length >= 6)){
                swal('Relax','We only allow a total of 6 pictures');
                //console.log("Prevented" + $(this).find("img").attr("src"));
            }
            else if($(this).find("span").hasClass("fa-check-square-o")){
                $(this).find("span").toggleClass("fa-square-o").toggleClass("fa-check-square-o");
                for(var i = 0; i < Profile.facebookPhotos.length; i++){
                    if(Profile.facebookPhotos[i] == $(this).find("img").attr("src")){
                        //console.log("Removed" + Profile.facebookPhotos[i]);
                        Profile.facebookPhotos.remove(i);
                    }
                }
            }
        }).undelegate(".profile-pic", "dragover").undelegate(".profile-pic", "dragenter").undelegate(".image-box", "dragstart").undelegate(".profile-pic", "drop")
            .delegate(".image-box", "dragstart", function(e){
                console.log({
                    event: e,
                    url: $(this).find("img").attr("src")
                });
                e.originalEvent.dataTransfer.setData("url", $(this).find("img").attr("src"));
            }).delegate(".profile-pic", "drop", function(e){
                e.preventDefault();
                var newURL = e.originalEvent.dataTransfer.getData("url");
                var oldURL = $(this).find("img").attr("src");
                console.log({
                    newURL: newURL,
                    oldURL: oldURL
                });
                $(this).find("img").attr("src", newURL).removeClass("hidden");
                if(oldURL == ""){
                    $(this).find("p").remove();
                }
            }).delegate(".profile-pic", "dragover", function(e){
                e.preventDefault();
                e.stopPropagation();
            }).delegate(".profile-pic", "dragenter", function(e){
                e.preventDefault();
                e.stopPropagation();
            })
            //.undelegate(".picture-panel .fa-close").delegate(".picture-panel .fa-close", "click", function(e){
            //    Profile.deletePicture($(this).parent().parent().parent());
            //});

        $(".picture-upload").click(function(e){
            $("#pic-upload").click();
        });

        $("#pic-upload").change(function(e){
            console.log(e.target.files);
            var pix = $(".pictures-panel").length;
            if(pix + e.target.files.length > 5){
                swal("Relax", "We only allow a total of 6 pictures");
            }
            else{
                Profile.loadLocalPix(e.target.files);
            }
        });
    },
    deletePicture: function(picture){
        picture.remove();
    },
    saveToken: function(response){
        console.log(response);

        localStorage.setItem(TOKEN, JSON.stringify(response));
    },
    getToken: function(){
        return localStorage.getItem(TOKEN);
    },
    checkToken: function(){
        if(Profile.getToken)
            return true;
    },
    loadLocalPix: function(files){
        console.log(files);
        var HTML, template, reader;
        for(var i = 0; i < files.length; i++){
            if (files[i].type.indexOf('image') == -1) {
                continue;
            }
            reader = new FileReader();

            reader.onload = function(e) {
                template = $("#picture-template").html();
                HTML = template.replace("[[src]]", e.target.result);
                $("#pictures-panel").append(HTML);
            };

            reader.readAsDataURL(files[i]);
        }
    },
    setProfilePicture: function(data){
        $(".profile-pic img").attr("src", data.url);
    },
    setPhotos: function(data){
        var url, HTML, template;
        for(var i = 0; i < data.length; i++){
            template = $("#facebook-picture").html();
            if(i == 0)
                HTML = "<div class='row'>";
            url = Facebook.photo(data[i]);
            HTML += template.replace("[[src]]", url);
            if(i == 5)
                HTML += "</div><br><div class='row'>";
            if(i == 11){
                HTML += "</div>";
                break;
            }
        }

        $("#pictures-pane").html(HTML);

        $("#picturesModal").modal("show").on('hidden.bs.modal', function (e) {
            Profile.loadFacebookPix();
            Profile.facebookPhotos = [];
        });
    },
    loadFacebookPix: function(){
        var HTML = "", template;
        for(var i = 0; i < Profile.facebookPhotos.length; i++){
            template = $("#picture-template").html();
            HTML += template.replace("[[src]]", Profile.facebookPhotos[i]);
        }
        $("#pictures-panel").prepend(HTML);
    }
};

$(document).ready(Profile.init);