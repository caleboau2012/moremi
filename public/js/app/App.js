/**
 * Created by Samuel.James on 8/24/2016.
 */
App={
    parameters: {
      base_url:'',

    },

    init: function(){

    },

    login: function(data) {
        //var data ={'first_name':'Samuel','last_name':'James','phone':'2348138671141','facebook_id':'13243563637'}

        $.ajax({
            url: App.parameters.base_url,
            data: data,
            error: function() {
            },
            dataType: 'jsonp',
            success: function(data) {
            },
            type: 'POST'
        });
    },

    storeToken: function(){

    },

    getToken: function(){

    },


}