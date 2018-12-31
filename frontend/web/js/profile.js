$(function() {
    "use strict";

    $('.btn-change-request').on('click', function (e) {
        var value = 10;
        $.ajax({
            type: "POST",
            data: {value:value},
            url: "/profile",
            success: function(msg){
                if(msg !== '') {
                    $('.profile-info').html(msg);
                    $('.info-basic').find('.pull-right').html('<button type="button" class="btn btn-danger btn-save">Lưu thông tin</button>');
                    $('.btn-save').on('click', function (ev) {
                        $('.info-basic').find('form').submit();
                    })
                }
            }
        });
    })

});