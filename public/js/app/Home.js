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
                Home.fetchCheeks(this.value);
            }
        });

        $("#login-cheek").click(function(e){
            location.href = $(this).attr("data-url");
        })
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
                for(var i = 0; i < response.data.length; i++){
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