<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1">
	
	<meta name="Keywords" content="Keywords">
<meta name="description" content="description">
<title><?php echo C('WEB_SITE_TITLE');?></title>
	
	<link rel="stylesheet" type="text/css" href="/Public/Home/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="/Public/Home/css/swiper.min.css">
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/default.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/index.css"/>
	<link rel="stylesheet" type="text/css" href="/Public/Home/css/members.css">
	<link rel="stylesheet" type="text/css" href="/Public/Home/css/page.css"/>

	<script src="/Public/Home/js/jquery-1.9.1.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="/Public/Home/js/swiper.min.js" type="text/javascript" charset="utf-8"></script>
	<!-- <script src="/Public/Home/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script> -->
    <script type="text/javascript" src="/Public/Home/js/default.js"></script>
    <script type="text/javascript" src="/Public/layer/layer.js"></script>
	
	
	
	
</head>
<body>
	<!-- hade -->
	<div class="hadeBox">
		<div class="width1200 hadeCon">
			<a class="hd_logo" href="<?php echo U('Index/index');?>"><img src="/Public/Home/images/center/logo.png" alt=""></a>
			<div class="hade_right">
				<div class="hade_nav hade_pou">                              
					<ul>
						<li>
							<a href="<?php echo U('Index/index');?>">首页</a>
						</li>
						<?php if(is_array($navs)): $i = 0; $__LIST__ = $navs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$navighter): $mod = ($i % 2 );++$i;?><li>
							<a href="<?php echo U($navighter.url);?>"><?php echo ($navighter[title]); ?></a>
							<?php if(!empty($navighter['nav_son'])): ?><div class="had_nav_lk">
									<ul>
										<?php if(is_array($navighter['nav_son'])): $i = 0; $__LIST__ = $navighter['nav_son'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$son): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U($son.url,array('typeid'=>$son['id']));?>"><?php echo ($son["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
									</ul>
								</div><?php endif; ?>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
				
				<div class="hade_query">
					<div class="query_Con">
						<input type="text" name="keywords" placeholder="搜索关键字" class="query_Text">
						<input type="submit" value=" " class="query_sub icon-fdj btn_search">
					</div>
					<div class="bdsharebuttonbox que_lk">
						<a href="#" class="bds_weixin" data-cmd="weixin"></a>
						<span>|</span>
						<a href="<?php echo U('English/index/index');?>" class="bds_eg"></a>
					</div>
				</div>
			</div>
		</div>
		
		<!-- nav -->
		<div class="navBox hade_pc">
			<div class="width1200 navBs">
				<div class="navCon">                              
					<ul>
						<li>
							<a href="<?php echo U('Index/index');?>">首页</a>
						</li>
						<?php if(is_array($navs)): $i = 0; $__LIST__ = $navs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$navighter): $mod = ($i % 2 );++$i;?><li class="">
							<a href="<?php echo U($navighter[url]);?>"><?php echo ($navighter['title']); ?></a>
							<?php if(!empty($navighter['nav_son'])): ?><div class="navCon_lk">
								<ul>
									<?php if(is_array($navighter['nav_son'])): $i = 0; $__LIST__ = $navighter['nav_son'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$son): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U($son[url],array('typeid'=>$son['id']));?>"><?php echo ($son["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
								</ul>
							</div><?php endif; ?>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
					<div class="nav_pu">
						<i class="icon-dianh2"></i>
						<span>023-68195688</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- 手机 -->
	<div class="navBtn">
		<a href=""><img src="/Public/Home/images/center/logo2.png" alt=""></a>
		<div class="navsh"><img src="/Public/Home/images/icon/nav.png"></div>
	</div>
	
	
	
	
	
	
	
	
	
	<!-- kuai -->
	<div class="kBox"></div>
	
	<section class="contentBox">
		<!--  -->
		<div class="opt_tabBox">
			<div class="optionsBox">
				<div class="width1200 optionsCon">
					<div class="crumbsBox">
						<a href=""><i class="glyphicon glyphicon-home"></i>首页</a>
						<span class="icon-rightjt"></span>
						<a href="">联系我们</a>
					</div>
					<!-- xiao nav -->
					<div class="s_nav">
						<ul>                      
							<li class="active">联系我们</li>
						</ul>
					</div>
				</div>
			</div>
			<!--  -->
			<div class="opt_Box">
				<div>
					<div class="width1200 ContactUs">
						<div class="cont_l_logo"><img src="<?php echo picture($vo['icon']);?>" alt=""></div>
						<div class="ContactUsCon">
							<!-- left -->
							<div class="cont_left">
								<div class="cont_l_addlss">
									<p>地址：<?php echo ($vo['address']); ?></p>
									<p>电话：<?php echo ($vo['zj_mobile']); ?></p>
									<p>传真：<?php echo ($vo['fax_code']); ?> </p>
									<p>E-MAIL：<?php echo ($vo['email']); ?></p>
									<p>网址：<?php echo ($vo['web_url']); ?></p>
								</div>
								<div class="cont_l_er">
									<div><img src="<?php echo picture($vo['icon2']);?>" alt=""></div>
									<p>中国汽研官方二维码</p>
								</div>
							</div>
							<!-- right -->
							<div class="cont_right">
								<form id="form2">
									<div class="cont_r_item">
										<div class="co_r_left">
											<input type="text" name="name" placeholder="姓名">
										</div>
										<div class="co_r_right">
											<input type="text" name="tel" placeholder="电话">
										</div>
									</div>
									<div class="cont_r_item">
										<input type="text" name="email" placeholder="邮箱">
									</div>
									<div class="cont_r_item">
										<textarea name="content" placeholder="内容"></textarea>
									</div>
									<input type="button" value="提交" class="cont_r_sub btn_sure">
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</section>
	
	<!-- footer -->
<!-- footer -->
<div class="footerBox">
    <div class="width1200 footerCon">
        <div class="fo_hd">
            <!-- lk -->
            <div class="fo_hd_lk">
                <p class="fo_hdTit">友情链接</p>
                <div class="fo_hdBa" id="fo_hdBa">
                    <div class="fo_weiper">
                        <ul class="swiper-wrapper">
                            <?php if(is_array($links_list)): $i = 0; $__LIST__ = $links_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$link): $mod = ($i % 2 );++$i;?><li class="swiper-slide"><a href="<?php echo ($link['url']); ?>"><?php echo ($link['title']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                    <div class="swiper-button-prev">&lt;</div>
                    <div class="swiper-button-next">&gt;</div>
                </div>
            </div>
            <!-- er -->
            <div class="fo_hd_er">
                <img src="/Public/Home/images/center/erweima.jpg" alt="">
            </div>
        </div>
    </div>
</div>
<!-- bottom -->
<div class="fo_battom">
    <div class="width1200 fo_battomCon">
        <p class="fo_b_footer">Copyright © 中国保险汽车安全指数  版权所有</p>
        <div class="fo_b_pu">
            <i class="glyphicon glyphicon-earphone"></i>
            <span>023-68824060</span>
        </div>
    </div>
</div>
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdPic":"","bdStyle":"0","bdSize":"16"},"share":{},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
<script type="text/javascript" src="/Public/layer/layer.js"></script>
<script>
    //搜索
    $(".btn_search").click(function () {
        var keywords = $("input[name='keywords']").val();
        if(keywords==''){
            layer.msg('请输入关键词！'); return false;
        }
        window.location.href='/Home/News/search/keyword/'+keywords;
    });

</script>

	<script>
		$(".btn_sure").click(function () {
			$.post("<?php echo U('/Home/Contact/addmsg');?>",$("#form2").serialize(),function (dd) {
				if(dd.code==200){
				    layer.msg(dd.msg,{time:1500});
				    setTimeout(function () {
						window.location.reload();
                    },1500);
				}else{
                    layer.msg(dd.msg);
				}
            })
        });
	</script>

	
	<script type="text/javascript">
	$(function(){
		$(".opt_tabBox .s_nav ul > li").mouseover(function(){
			var _index = $(this).index();
			$(".opt_Box > div").eq(_index).show().siblings().hide();
			$(this).addClass("active").siblings().removeClass("active");
			var act = $(this).text();
			$('.crumbsTxt').html(act);
		});
		$(".a_news_left .a_nL_item").mouseover(function(){
			$(this).addClass('nl_active').siblings().removeClass('nl_active');
		});
		
		var tiemh =1000;
		loadZf($('.ContactUsCon'),$('.cont_left'),$('.cont_right'));
		function loadZf($hade,$y,$x){
			var winH = $(window).height();
			var scrollH = $(window).scrollTop();
			var $con = $hade.offset().top ;
			if($con < winH + scrollH){
				$y.animate({
					'left':'0',
					'opacity':'1',
					'filter': 'alpha(opacity ==100)',
				},tiemh);
				$x.animate({
					'right':'0',
					'opacity':'1',
					'filter': 'alpha(opacity ==100)',
				},tiemh);
			}
		}
		
		
	});
	</script>
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdPic":"","bdStyle":"0","bdSize":"16"},"share":{},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>			

</body>
</html>