/**
 * Created by KayLee on 30/06/2016.
 */
var Home = {
    init: function(){
        Home.fetchCheeks();
        $("#cheek-search").on("keyup", function(e){
            console.log(this.value);
        }).on("keydown", function(e){
            if(e.keyCode == 13){
                e.preventDefault();
            }
        });

        $("#login-cheek").click(function(e){
            location.href = $(this).attr("data-url");
        })
    },
    fetchCheeks: function(){
        var url = $("#cheeks").attr("data-url");
        var HTML = "";

        $.getJSON(url, function(response){
            console.log(response);

            if(response.status){
                for(var i = 0; i < response.data.length; i++){
                    HTML = $("#cheeks-template").html();
                    HTML = HTML.replaceAll("[[img-url]]", response.data[i].name);
                    HTML = HTML.replaceAll("[[name]]", response.data[i].name);
                    HTML = HTML.replaceAll("[[votes]]", response.data[i].name);
                }
            }
            else{

            }
        });
    }
};

$(document).ready(function(){
    Home.init();
});