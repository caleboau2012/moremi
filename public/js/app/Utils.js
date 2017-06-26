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
        swal({
            title: title,
            // text: "Relax and sit back...",
            text: "<div class='loading-icon'>Loading...</div>",
            html: true,
            showConfirmButton: false
        });
    }
};