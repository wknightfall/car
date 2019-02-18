/*删除上传的图片（前台删除）*/
   $(document).delegate('.btn-close', 'click', function(e) {

       e.preventDefault();

       //删除与按钮所对应图片的data-id相同的 hidden input

       var id = $(this).parents(".upload-pre-item").find("img").data("id");

      for(var i = 0 ; i < $("#tab1 input[type='hidden']").length ; i++){

        if($("#tab1 input[type='hidden']").eq(i).val() == id){
          $("#tab1 input[type='hidden']").eq(i).remove();
          $(this).parents(".upload-pre-item").remove();
          return;
        }
      }
   })

/* 上传图片预览弹出层 */
$(function(){
    $(window).resize(function(){
        var winW = $(window).width();
        var winH = $(window).height();
        $(document).delegate('.upload-img-box img', 'click', function() {
            //如果没有图片则不显示
            if($(this).attr('src') === undefined){
                return false;
            }
            // 创建弹出框以及获取弹出图片
            var imgPopup = "<div id=\"uploadPop\" class=\"upload-img-popup\"></div>"
            var imgItem = $(this).parent(".upload-pre-item").html();

            //如果弹出层存在，则不能再弹出
            var popupLen = $(".upload-img-popup").length;
            if( popupLen < 1 ) {
                $(imgPopup).appendTo("body");
                $(".upload-img-popup").append($(this).clone());
                var $_a = $("<a class=\"close-pop\" href=\"javascript:;\" title=\"关闭\"></a>");
                $(".upload-img-popup").append($_a);
            }

            // 弹出层定位
            var uploadImg = $("#uploadPop").find("img");
            var popW = uploadImg.width();
            var popH = uploadImg.height();
            var left = (winW -popW)/2 + 50;
            var top = (winH - popH)/2 + 50;
            $(".upload-img-popup").css({
                // "max-width" : winW * 0.9,
                "left": left,
                "top": top
            });
        });

        // 关闭弹出层
        $("body").on("click", "#uploadPop .close-pop", function(){
            $(this).parent().remove();
        });
    }).resize();

    // 缩放图片
    function resizeImg(node,isSmall){
        if(!isSmall){
            $(node).height($(node).height()*1.2);
        } else {
            $(node).height($(node).height()*0.8);
        }
    }
})