var paytype=0;
var roomid=0;
$(function () {

    /*禁止所有图片被拖动*/
    $("img").attr("ondragstart","return false");

    /*底部点击选中*/
    foot_click();

    /*下拉菜单*/
    selcet_menu();

    /*酒店选择支付*/
    pay_list();

    /*收藏按钮*/
    collection();

    /*加减按钮*/
    math_jj();

    /*选择床*/
    sel_bed();

    /*旅游小贴士*/
    lv_question();

    /*景区视频*/
    jingqu_video("nav_vidos","video_fram","this_chk");
    jingqu_video("nav_vidoe","list_htt","this_chk");
    jingqu_video("news_list","new_annoment","news_this");

    window['adaptive'].desinWidth = 750;
    window['adaptive'].baseFont = 24;
    window['adaptive'].maxWidth = 750;
    window['adaptive'].init();

})

$(document).ready(function () {
    /*计算导航宽度滚动*/
    $(".nav_dom ul").width($(".nav_dom ul li").length*$(".nav_dom ul li").width());

    $(".nav_vidos > ul").width($(".nav_vidos > ul > li").length*$(".nav_vidos > ul > li").width());
    $(".nav_vidoe > ul").width($(".nav_vidoe > ul > li").length*$(".nav_vidoe > ul > li").width());

    /*计算推荐宽度滚动*/
    $(".scroll ul").width($(".scroll ul li").length*3.6+"rem");

    $(".scroll_carou ul").width($(".scroll_carou ul li").length*2.36+"rem");

    $(".mingsu_video ul").width($(".mingsu_video ul li").length*2.36+"rem");
    $(".huodong_video ul").width($(".huodong_video ul li").length*2.36+"rem");
    $(".jieqing_video ul").width($(".jieqing_video ul li").length*2.36+"rem");
    $(".mingfen_video ul").width($(".mingfen_video ul li").length*2.36+"rem");

    /*获得底部导航宽度*/
    var ft_width = $(window).width();
    $(".foot_dom ul li ").width(ft_width/ $(".foot_dom ul li ").length);
    $(window).resize(function () {
        $(".foot_dom ul li ").width(ft_width/ $(".foot_dom ul li ").length);
    })
})

    /*底部点击选中*/
function foot_click() {

    $(document).on("click",".foot_dom ul li",function () {

        if ($(this).hasClass("nav_chk")){
            return;
        }else {
            $(this).siblings("li").removeClass("nav_chk");
            $(this).addClass("nav_chk");
        }
    })
}
    /*下拉菜单*/
function selcet_menu(){

    $(".sele_click").click(function () {

        selcet_fun($(this));
    })

    $(".sele_chd ul li").click(function () {

        selcet_fun($(".sele_click"));
        // $(".sele_click").removeClass("blk_fon");
        $(this).parent().parent().prev(".sele_click").children("i").text($(this).text());
        if($(this).hasClass("list_chkd")){

            $(this).removeClass("list_chkd");
        }else {
            $(".sele_chd ul li").removeClass("list_chkd");
            $(this).addClass("list_chkd");
        }
    })
}
function selcet_fun(menu) {

    if (menu.next(".sele_chd").hasClass("dow_sele")) {

        menu.removeClass("blk_fon");
        menu.next(".sele_chd").removeClass("dow_sele");
        menu.next(".sele_chd").stop(true, true).slideUp();
    } else {

        menu.addClass("blk_fon");
        menu.next(".sele_chd").addClass("dow_sele");
        menu.next(".sele_chd").stop(true, true).slideDown();
    }
}
/*选择床*/
function  sel_bed() {

    $(".sel_bed i").click(function () {
        roomid=$(this).attr('value');
        if($(this).hasClass("ched_bed")){

            return;
        }else {
            $(".sel_bed i").removeClass("ched_bed");
            $(this).addClass("ched_bed");
        }
    })
}

    /*酒店选择支付*/
function pay_list() {

    $(".list_zf li .list_chked p").click(function () {
paytype=$(this).parent().parent().index()+1;
    if ($(this).hasClass("pay_list")){
        $(this).removeClass("pay_list");
    }else {
        $(".list_zf li .list_chked p").removeClass("pay_list");
        $(this).addClass("pay_list");
    }
    })
}
    /*收藏按钮*/
var ssc = true;
function collection() {

    var src_un = "image/icon/heart_0.png";
    var src_im = "image/icon/heart.png";


    $(".collection_bt").click(function () {

        if (ssc){

            $(this).attr("src",src_im);
            ssc = false;
        }else {

            $(this).attr("src",src_un);
            ssc = true;
        }
    })
}

/*加减按钮*/
function math_jj() {

    $(".shop_num>p:nth-child(1)").click(function () {

        var max = 1;
        var num = $(".shop_num input").val();
        var tot = parseInt(num);
        if (max == num) {
            $(".shop_num input").val(max);
        } else {
            $(".shop_num input").val(tot - 1);
        }
    })

    $(".shop_num>p:nth-child(3)").click(function () {

        var max = 100;
        var num = $(".shop_num input").val();
        var tot = parseInt(num);
        if (max == num) {
            $(".shop_num input").val(max);
        } else {
            $(".shop_num input").val(tot + 1);
        }
    })
}



    /*景区视频*/
function jingqu_video(lis,dom,clshow) {

        var sw_dom = "";
    $("."+ dom +" > div:first-child").css("display","inline-block");
    $(document).on("click","."+ lis +" ul li",function () {

        var t_thid = $(this).attr("class");
        var n_thid = t_thid.split(" ");

        if($(this).hasClass(clshow)){

            return ;
        }else {

            $(this).siblings("li").removeClass(clshow);
            $(this).addClass(clshow);
        }
        for (var a = 0;a<n_thid.length;a++){

            $("."+ dom +" > div").each(function () {

                var d_dom = $(this).attr("class");
                var n_dom =  d_dom.split(" ");

                for (var b = 0;b<n_dom.length;b++){

                    if(n_thid[a] == n_dom[b] ){

                       return sw_dom = n_dom[b];
                    }
                }
            })
        }
        $("."+dom+" > div").css("display","none");
        $("."+sw_dom).css("display","inline-block");
    })
}
/*旅游小贴士*/
function lv_question() {

    $(document).on("click",".xts_problem_list ul li",function () {

        if ($(this).children("p").children("i").hasClass("off_listl")){

            $(this).children("p").children("i").removeClass("off_listl");
            $(this).children("div").stop(true, true).slideUp();

        } else {

            $(this).siblings("li").children("p").children("i").removeClass("off_listl");
            $(this).children("p").children("i").addClass("off_listl");
            $(this).siblings("li").children("div").stop(true, true).slideUp();
            $(this).children("div").stop(true, true).slideDown();
        }
    })
}






















