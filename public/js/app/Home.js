/**
 * Created by KayLee on 30/06/2016.
 */
var Home = {
    CONSTANTS: {
        page: 0,
        maleFilter: false,
        femaleFilter: false,
        spotFilter: false,
        spot: ''
    },
    init: function(){
        Home.CONSTANTS.spot = $('#spot').text();

        $("#cheek-search, #input-filter-search").on("keyup", function(e){
            //console.log(this.value);
        }).on("keyup", function(e){
            if(e.keyCode == 13){
                e.preventDefault();
            }
            //if(this.value.length > 2){
            //Home.fetchCheeks(this.value);
            Home.filterCheeks(this.value);
            //}
        });

        $("#login-cheek").click(function(e){
            location.href = $(this).attr("data-url");
        });

        $(document).delegate(".avatar", "click", function(){
            Home.showCheek($(this));
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

            Home.CONSTANTS.femaleFilter = false;
            Home.CONSTANTS.maleFilter = false;
            Home.CONSTANTS.spotFilter = false;

            Home.CONSTANTS[filter_id] = true;

            InfiniteScroll.Get();
        })
    },
    filterCheeks: function(query){
        //console.log(query);
        $("#cheeks-inf .user h2, #cheeks-inf .profile-card-name h4").each(function(i){
            //console.log({
            //    element: $(this),
            //    query: query,
            //    name: $(this).text(),
            //    conditional: ($(this).text().indexOf(query) == -1)
            //});
            //if(typeof query == "undefined")
            //query = "";
            if($(this).text().toLowerCase().indexOf(query.toLowerCase()) == -1){
                //$(this).parent().parent().parent().addClass("hidden");
                $(this).parent().parent().parent().parent().parent().addClass("hidden");
            }
            else{
                $(this).parent().parent().parent().parent().parent().removeClass("hidden");
                //$(this).parent().parent().parent().removeClass("hidden");
            }

            //Filters
            if(Home.CONSTANTS.maleFilter || Home.CONSTANTS.femaleFilter || Home.CONSTANTS.spotFilter){
                if(($(this).parent().attr('data-sex') != 'male') && (Home.CONSTANTS.maleFilter)){
                    $(this).parent().parent().parent().parent().parent().addClass("hidden");
                }

                if(($(this).parent().attr('data-sex') != 'female') && (Home.CONSTANTS.femaleFilter)){
                    $(this).parent().parent().parent().parent().parent().addClass("hidden");
                }

                if(($(this).parent().attr('data-venue') != Home.CONSTANTS.spot) && (Home.CONSTANTS.spotFilter)){
                    $(this).parent().parent().parent().parent().parent().addClass("hidden");
                }
            }
            //else{
            //    $(this).parent().parent().parent().parent().parent().removeClass("hidden");
            //}

            //console.log({
            //    spot: ($(this).parent().attr('data-venue')),
            //    userSpot: Home.CONSTANTS.spot,
            //    spotFilter: Home.CONSTANTS.spotFilter,
            //    cond: ($(this).parent().attr('data-venue') == Home.CONSTANTS.spot),
            //});
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
    Home.init();
    InfiniteScroll.init();
});