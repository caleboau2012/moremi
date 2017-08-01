/**
 * Created by KayLee on 06/07/2016.
 */
String.prototype.replaceAll = function(search, replacement) {
    var target = this;
    return target.split(search).join(replacement);
};

Array.prototype.remove = function(from, to) {
    var rest = this.slice((to || from) + 1 || this.length);
    this.length = from < 0 ? this.length + from : from;
    return this.push.apply(this, rest);
};

Utils = {
    post: function(url, data, type, callback, error){
        var token = Profile.getToken();

        $.ajax({
            url: url,
            data: data,
            error: error,
            success: callback,
            dataType: "json",
            type: type,
            headers: {
                authToken: token
            }
        });
    },
    swalLoader: function (title) {
        if(!title)
            title = 'Relax and sit back...';
        swal({
            title: title,
            html: "<div class='loading-icon'>Loading...</div>",
            showConfirmButton: false
        });
    },
    swalErrorAlert: function (text) {
        if(!text)
            text = 'Oops!, currently unable to process your request. Please, try again!';
        swal({
            type: 'error',
            html: text,
            confirmButtonColor: "#fe7447",
            showConfirmButton: true,
            showCloseButton: true
        });
    }
};