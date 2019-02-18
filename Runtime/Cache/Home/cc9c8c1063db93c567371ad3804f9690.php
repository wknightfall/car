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
						<a href="<?php echo U('Index/index');?>"><i class="glyphicon glyphicon-home"></i>首页</a>
						<span class="icon-rightjt"></span>
						<a><?php echo ((isset($typeInfo["title"]) && ($typeInfo["title"] !== ""))?($typeInfo["title"]):'媒体聚焦'); ?></a>
					</div>
					<!-- xiao nav -->
					<div class="s_nav">
						<ul>
							<?php if(is_array($twonav)): $kk = 0; $__LIST__ = $twonav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$twnav): $mod = ($kk % 2 );++$kk;?><li class="<?php if($get[typeid]==$twnav['id']){echo 'active';} ?>"><?php echo ($twnav['title']); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					</div>
				</div>
			</div>
			<!--  -->
			<div class="opt_Box">
				<div>
					<div class="width1200 FocusingBox">
						<div class="FocusingCon">
							<ul>
								<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="focu_item">
									<a href="<?php echo U('details',array('typeid'=>$vo['typeid'],'id'=>$vo['id']));?>">
                                        <?php if($vo['icon'] > 0): ?><div class="focu_Img"><div class="focu_ImgBox"><i></i></div>
											<img src="<?php echo picture($vo['icon']);?>" alt="">
										</div><?php endif; ?>
										<div class="focu_con">
											<div class="focu_c_text">
												<div class="focu_c_lt">
													<p><?php echo ($vo['title']); ?></p>
													<span><?php echo ($vo['descriptions']); ?></span>
												</div>
												<div class="focu_c_time">
													<p><?php echo (date('m-d',$vo['create_time'])); ?></p>
													<a href="<?php echo U('details',array('typeid'=>$vo['typeid'],'id'=>$vo['id']));?>"><i class="icon-rightjt"></i></a>
												</div>
											</div>
											<div class="focu_c_lk">
												<a><?php echo ($vo['source_web']); ?></a>
												<span>|</span>
												<a><?php echo ($vo['author']); ?></a>
											</div>
										</div>
									</a>
								</li><?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
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
		
	});
	</script>
</body>
</html>