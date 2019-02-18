$(function () {
    $(".yue_heada>img:first").click(function () {
        history.go(-1)
    })
    $(".tt_head>img:first").click(function () {
        history.go(-1)
    })
    $(".get_numa").click(function () {
        //settime($(this));
    })
    /*确认修改*/
    

    window['adaptive'].desinWidth = 750;
    window['adaptive'].baseFont = 24;
    window['adaptive'].maxWidth = 750;
    window['adaptive'].init();

    /*获得底部导航宽度*/
    var ft_width = $(window).width();
    $(".foot_dom ul li ").width(ft_width/ $(".foot_dom > ul > li ").length);

    $(window).resize(function () {
        $(".foot_dom ul li ").width(ft_width/ $(".foot_dom > ul > li ").length);
    })

})


/*60秒倒计时*/
var countdown=60;
function settime(clk) {
    clk.unbind();
    if (countdown == 0) {
        clk.val("获取验证码");
        countdown = 60;
        clk.click(function () {
            settime($(this));
        })
        return;
    } else {
        clk.val("倒计时"+ countdown +"秒");
        countdown--;
    }
    setTimeout(function() {
            settime(clk) }
        ,1000)
}
