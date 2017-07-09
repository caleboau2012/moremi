/**
 * Created by KayLee on 18/04/2017.
 */
var Pay = {
    init: function(){
        $('.vote-pay, .meet').submit( function(e) {
            this.voted_profile_id.value = Vote.CONSTANT.profileID;
            $(this).find('.btn').button("loading");
            return true;
        });
    }
};

$(document).ready(Pay.init);