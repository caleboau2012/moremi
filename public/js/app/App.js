/**
 * Created by KayLee on 30/06/2016.
 */
var App = {
    CONSTANTS: {
        page: 0,
        maleFilter: false,
        femaleFilter: false,
        spotFilter: false,
        spot: ''
    },
    init: function(){
        App.CONSTANTS.spot = $('#spot').text();

        $("#input-filter-search").on("keyup", function(e){
            //console.log(this.value);
        }).on("keyup", function(e){
            if(e.keyCode == 13){
                e.preventDefault();
            }
            //if(this.value.length > 2){
            //App.fetchCheeks(this.value);
            App.filterCheeks(this.value);
            //}
        });

        $("#login-cheek").click(function(e){
            location.href = $(this).attr("data-url");
        });

        $(document).delegate(".avatar", "click", function(){
            App.showCheek($(this));
        });

        $(".winner-photo").click(function(e){
            $("#winner-photo").attr('src', this.src);
        });

        /* Trending Block */
        $(".trending-items").owlCarousel({
            autoPlay: 3000, //Set AutoPlay to 3 seconds
            items : 4,
            itemsDesktop : [1199,4],
            itemsDesktopSmall : [979,3],
            itemsTablet	: [768,2],
            navigation : false,
            pagination : false
        });

//            /*Range slider*/
        $("#age_range").slider({});

        /*Change active Filter Button*/
        $(".filter-btn-option").click(function () {
            var filter_id = $(this).attr('data-filter-id');
            $('.filter-btn-option').removeClass('active');
            $("#" + filter_id).addClass('active');

            App.CONSTANTS.femaleFilter = false;
            App.CONSTANTS.maleFilter = false;
            App.CONSTANTS.spotFilter = false;

            App.CONSTANTS[filter_id] = true;

            InfiniteScroll.Get();
        });

        App.showDemo();
    },
    showDemo: function(){
        if((localStorage.getItem('app') == null) && ($(window).width() > 750)){
            introJs().start();
            if(typeof(Storage) !== "undefined"){
                localStorage.setItem('app', 'true');
            }
        }
    },
    filterCheeks: function(query){
        //console.log(query);
        $("#cheeks-inf .pick-item h4").each(function(i){
            if(typeof query == "undefined")
            query = "";
            if($(this).text().toLowerCase().indexOf(query.toLowerCase()) == -1){
                //$(this).parent().parent().parent().addClass("hidden");
                $(this).parent().parent().parent().parent().parent().addClass("hidden");
            }
            else{
                $(this).parent().parent().parent().parent().parent().removeClass("hidden");
                //$(this).parent().parent().parent().removeClass("hidden");
            }

            //console.log({
            //    female: App.CONSTANTS.femaleFilter,
            //    male: App.CONSTANTS.maleFilter,
            //    spot: App.CONSTANTS.spotFilter
            //});

            //Filters
            if(App.CONSTANTS.maleFilter || App.CONSTANTS.femaleFilter || App.CONSTANTS.spotFilter){
                if(($(this).attr('data-sex') != 'male') && (App.CONSTANTS.maleFilter)){
                    $(this).parent().parent().parent().parent().parent().addClass("hidden");
                }

                if(($(this).attr('data-sex') != 'female') && (App.CONSTANTS.femaleFilter)){
                    $(this).parent().parent().parent().parent().parent().addClass("hidden");
                }

                if(($(this).attr('data-venue') != App.CONSTANTS.spot) && (App.CONSTANTS.spotFilter)){
                    $(this).parent().parent().parent().parent().parent().addClass("hidden");
                }
            }
            //else{
            //    $(this).parent().parent().parent().parent().parent().removeClass("hidden");
            //}
        });
    },
    showCheek: function(element){
        var data = {
            name: element.attr('data-name'),
            about: element.attr('data-about'),
            images: [
                $(element.children()[0]).attr('data-img-1'),
                $(element.children()[0]).attr('data-img-2'),
                $(element.children()[0]).attr('data-img-3'),
                $(element.children()[0]).attr('data-img-4'),
                $(element.children()[0]).attr('data-img-5'),
                $(element.children()[0]).attr('data-img-6')
            ],
            vote: element.attr('data-vote'),
            id: element.attr('data-id')
        };

        $("#profileModalLabel").text(data.name);
        $("#profileModalVote").text(data.vote);
        $(".carousel-indicators").empty();
        $(".carousel-inner").empty();

        var controlHTML, carouselImage, voteHTML;
        var first = true;

        voteHTML = $("#profile-vote-template").html();
        voteHTML = voteHTML.replaceAll("[[id]]", data.id);
        $("#profileVote").html(voteHTML);

        for(var i = 0; i < data.images.length; i++) {
            if(data.images[i] != ""){
                controlHTML = $("#carousel-control-template").html();
                carouselImage = $("#carousel-image-template").html();

                if(first){
                    controlHTML = controlHTML.replaceAll("[[0]]", "active");
                    carouselImage = carouselImage.replaceAll("[[0]]", "active");
                    first = false;
                }
                else{
                    controlHTML = controlHTML.replaceAll("[[0]]", "");
                    carouselImage = carouselImage.replaceAll("[[0]]", "");
                }

                controlHTML = controlHTML.replaceAll("[[i]]", i);

                carouselImage = carouselImage.replaceAll("[[i]]", i);
                carouselImage = carouselImage.replaceAll("[[src]]", data.images[i]);
                carouselImage = carouselImage.replaceAll("[[about]]", data.about);

                $(".carousel-indicators").append(controlHTML);
                $(".carousel-inner").append(carouselImage);
            }
        }

        $("#carousel-example-generic").carousel();
        $("#profileModal").modal("show");
    }
};

$(document).ready(function(){
    App.init();
    InfiniteScroll.init();
});