/**
 * Created by KayLee on 30/06/2016.
 */
var Home = {
    CONSTANTS: {
        page: 0
    },
    init: function(){
        Home.fetchCheeks();

        $("#cheek-search").on("keyup", function(e){
            console.log(this.value);
        }).on("keydown", function(e){
            if(e.keyCode == 13){
                e.preventDefault();
            }
            if(this.value.length > 2){
                Home.fetchCheeks(this.value);
            }
        });

        $("#login-cheek").click(function(e){
            location.href = $(this).attr("data-url");
        });

        var cheeks = $("#contestant-parent");

        cheeks.scroll(function() {
            console.log({
                element: cheeks,
                top: cheeks.scrollTop()
            });
            //if(cheeks.scrollTop() == cheeks.height() - $(window).height()) {
            //    // ajax call get data from server and append to the div
            //}
        });
    },
    fetchCheeks: function(query){
        $("#cheeks-loading").removeClass("hidden");

        var url;

        if(query){
            url = $("#cheeks").attr("data-url") + "?search=" + query;
        }
        else{
            url = $("#cheeks").attr("data-url");
        }

        var HTML = "";

        $.getJSON(url, function(response){
            console.log(response);

            $("#contestant-parent").empty();

            if(response.status){
                for(var i = response.data.length - 1; i >= 0; i--){
                    HTML = $("#cheeks-template").html();
                    HTML = HTML.replaceAll("[[img-url]]", response.data[i].image);
                    HTML = HTML.replaceAll("[[name]]", response.data[i].name);
                    HTML = HTML.replaceAll("[[votes]]", response.data[i].vote);
                    HTML = HTML.replaceAll("[[id]]", response.data[i].id);
                    $("#contestant-parent").prepend(HTML);
                }
            }
            else{
                HTML = $("#cheeks-none").html();
                $("#contestant-parent").prepend(HTML);
            }

            $("#cheeks-loading").addClass("hidden");
        });
    }
};

$(document).ready(function(){
    Home.init();
});