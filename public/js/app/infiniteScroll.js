/**
 * Created by Samuel.James on 9/12/2016.
 */
InfiniteScroll ={
    CONSTANT:{
        LINK:BASE_URL+CHEEKS_URL,
        PER_PAGE:10,
        CURRENT_PAGE:1,
        LAST_PAGE:10,
        QUERY: ''
    },
    init: function(){
        InfiniteScroll.Get();
        $(document).on('scroll', function() {
            if($(this).scrollTop()>=$('.loading-area').position().top){
                InfiniteScroll.Get();
            }
        });
        $("#cheek-search").on("keyup", function(e){
            //console.log(this.value);
        }).on("keydown", function(e){
            //console.log(this.value);
            if(e.keyCode == 13){
                e.preventDefault();
            }
            if(this.value.length > 2){
                console.log(this.value);
                InfiniteScroll.CONSTANT.QUERY = this.value;
                InfiniteScroll.Get();
            }
        });
    },
    Get: function(){
        $.ajax({
            url:InfiniteScroll.CONSTANT.LINK+'/'+InfiniteScroll.CONSTANT.PER_PAGE+'?page='+InfiniteScroll.CONSTANT.CURRENT_PAGE + '&search=' + InfiniteScroll.CONSTANT.QUERY,
            type: 'GET',
            success: function (response) {
                console.log(response);
                $("#cheeks-inf").empty();
                InfiniteScroll.CONSTANT.LAST_PAGE =response.pagination.last_page;
                InfiniteScroll.CONSTANT.CURRENT_PAGE_PAGE += 1;
                InfiniteScroll.Render(response.data)
            }
        });
    },
    ShowLoading: function(){

    },
    HideLoading: function(){

    },
    Render : function(data){
        var t =data.length;
        for(var i=0;i<t;i++ ){
            var tmp =$('#profile_TMP').html();
            tmp =tmp.replace("[[NAME]]",data[i].name)
            tmp =tmp.replace("[[NAME]]",data[i].name)
                .replace("[[PHOTO]]",data[i].image)
                .replace("[[ID]]",data[i].id)
                .replace("[[VOTE]]",data[i].vote);
            $('#cheeks-inf').append(tmp);
        }
    }

};