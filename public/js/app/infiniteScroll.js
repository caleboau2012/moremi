/**
 * Created by Samuel.James on 9/12/2016.
 */
InfiniteScroll ={
    CONSTANT:{
        LINK:BASE_URL+CHEEKS_URL,
        PER_PAGE:5,
        CURRENT_PAGE:1,
        LAST_PAGE:10,
        END_OF_DATA:false,
        LOADING:false,
        QUERY: ''
    },
    init: function(){
        InfiniteScroll.Get();
        $(document).on('scroll', function() {
            //console.log({
            //    top: $(this).scrollTop(),
            //    loading: $('.loading-area').position().top
            //});

            if($(this).scrollTop()>=$('.loading-area').position().top){
                InfiniteScroll.Get();
            }
        });
        $("#cheek-search, #input-filter-search").on("keyup", function(e){
            //console.log(this.value);
            InfiniteScroll.CONSTANT.QUERY = this.value;
            InfiniteScroll.Get();

            if(e.keyCode == 13){
                e.preventDefault();
            }
        });
    },
    Get: function(){
        if(InfiniteScroll.CONSTANT.END_OF_DATA){
            App.filterCheeks($("#input-filter-search").val());
            return;
        }
        if(InfiniteScroll.CONSTANT.LOADING){
            return;  ///prevent multiple ajax request
        }
        InfiniteScroll.CONSTANT.LOADING=true;
        $.ajax({
            url:InfiniteScroll.CONSTANT.LINK+'/'+InfiniteScroll.CONSTANT.PER_PAGE+'?page='+InfiniteScroll.CONSTANT.CURRENT_PAGE + '&search=' + InfiniteScroll.CONSTANT.QUERY,
            type: 'GET',
            success: function (response) {
                //console.log(response);
                if(InfiniteScroll.CONSTANT.CURRENT_PAGE==1) {
                    $("#cheeks-inf").empty();
                }
                if(response.data.length==0){
                    InfiniteScroll.CONSTANT.END_OF_DATA=true;
                }
                InfiniteScroll.CONSTANT.LOADING=false; ///reset loading back to true;
                InfiniteScroll.CONSTANT.LAST_PAGE =response.pagination.last_page;
                InfiniteScroll.CONSTANT.CURRENT_PAGE += 1;
                InfiniteScroll.Render(response.data)
            },
            error: function(response){
                console.log(response);
                InfiniteScroll.CONSTANT.LOADING=false; ///reset loading back to true;

            }
        });
    },
    ShowLoading: function(){

    },
    HideLoading: function(){

    },
    Render : function(data){
        //console.log(data);
        var t =data.length;
        for(var i=0;i<t;i++ ){

            var tmp =$('#profile_TMP').html();
            tmp =tmp.replace("[[NAME]]",data[i].name);
            tmp =tmp.replace("[[NAME]]",data[i].name)
                .replace("[[PHOTO]]",data[i].image)
                .replace("[[ID]]",data[i].id)
                .replace("[[ID]]",data[i].id)
                .replace("[[VENUEID]]", data[i].venue_id)
                .replace("[[VENUE]]", data[i].venue)
                .replace("[[SEX]]", data[i].sex)
                .replace("[[VOTE]]",data[i].vote)
                .replace("[[VOTE]]",data[i].vote);
            for(var a=0;a<data[i].photos.length;a++){
                if(data[i].photos[a] === undefined){}else{
                    tmp =tmp.replace("[[data-img-"+a+"]]",data[i].photos[a].full_path)
                }
            }

            /**.replace("[[data-img-1]]",data[i].photos[0].full_path)
             .replace("[[data-img-2]]",data[i].photos[1].full_path)
             .replace("[[data-img-3]]",data[i].photos[2].full_path)
             .replace("[[data-img-4]]",data[i].photos[3].full_path)
             .replace("[[data-img-5]]",data[i].photos[4].full_path)
             .replace("[[data-img-6]]",data[i].photos[5].full_path)**/
            tmp= tmp.replace("[[DATA-NAME]]",data[i].name)
                .replace("[[DATA-ABOUT]]", data[i].about)
                .replace("[[SEXICON]]", (data[i].sex == 'male')?"icon-profile-male":"icon-profile-female");

            $('#cheeks-inf').append(tmp);
        }

        App.filterCheeks($("#input-filter-search").val());
    }

};
