/*客服*/
$(document).on("click",".foot_dom > ul > li:nth-child(2)",function (event) {

    event.stopPropagation();
    var qqkf = $(this).children(".qq_lis").css("display");
    if (qqkf=="none"){

        $(this).children(".qq_lis").css("display","block");
    }else {

        $(this).children(".qq_lis").css("display","none");
    }
})