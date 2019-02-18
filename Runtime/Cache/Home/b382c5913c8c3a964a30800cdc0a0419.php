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
						<a href="<?php echo U('News/index');?>">新闻中心</a>
						<span class="icon-rightjt"></span>
						<a class="crumbsTxt" >C-IASI要闻</a>
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
				<div style="<?php if($get[typeid]==17){echo 'display:block';}else{echo 'display:none';} ?>">
					<div class="width1200 newsCenter">
						<div class="container">
							<div class="row">
								<div class="col-md-8">
									<div class="newjoblist">
										<ul class="list-group">
                                           <?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
												<h2><?php echo ($vo['title']); ?></h2>
												<div class="jobtime">发布时间:<?php echo (date('Y-m-d',$vo['create_time'])); ?></div>
												<div class="jobimg"><img src="<?php echo picture($vo['icon']);?>"></div>
												<p><?php echo ($vo['descriptions']); ?></p>
												<a href="<?php echo U('details',array('typeid'=>$vo['typeid'],'id'=>$vo['id']));?>" class="joblink">阅读更多</a>
											</li><?php endforeach; endif; else: echo "" ;endif; ?>

										</ul>
									</div>
									<!-- page -->
									<div class="ev_page">

									</div>
								</div>
								<div class="col-md-4">
									<div class="newslie">
										<div class="newslie-tit">行业要闻</div>
										<div class="row netlie">
											<ul class="list-group">
												<?php if(is_array($listb)): $i = 0; $__LIST__ = $listb;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vob): $mod = ($i % 2 );++$i;?><li>
													<div class="col-md-5 newslie-l">
														<a href="<?php echo U('details',array('typeid'=>$vob['typeid'],'id'=>$vob['id']));?>"><img src="<?php echo picture($vob['icon']);?>"></a>
													</div>
													<div class="col-md-7 newslie-r">
														<a href="<?php echo U('details',array('typeid'=>$vob['typeid'],'id'=>$vob['id']));?>"><?php echo ($vob['title']); ?></a>
														<p>发布时间：<?php echo (date('Y-m-d',$vob['create_time'])); ?></p>
													</div>
												</li><?php endforeach; endif; else: echo "" ;endif; ?>
											</ul>
										</div>
										<!--<div class="newMore"><a href="#"> 更多&gt;&gt; </a> </div>-->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--  行业新闻  -->
				<div class="hidddes" style="<?php if($get[typeid]==18){echo 'display:block';}else{echo 'display:none';} ?>">
					<div class="width1200 newsCenter">
						<div class="container">
							<div class="row">
								<div class="col-md-8">
									<div class="newjoblist">
										<ul class="list-group">
											<?php if(is_array($listb)): $i = 0; $__LIST__ = $listb;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voc): $mod = ($i % 2 );++$i;?><li>
													<h2><?php echo ($voc['title']); ?></h2>
													<div class="jobtime">发布时间:<?php echo (date('Y-m-d',$voc['create_time'])); ?></div>
													<div class="jobimg"><img src="<?php echo picture($voc['icon']);?>"></div>
													<p><?php echo ($voc['descriptions']); ?></p>
													<a href="<?php echo U('details',array('typeid'=>$voc['typeid'],'id'=>$voc['id']));?>" class="joblink">阅读更多</a>
												</li><?php endforeach; endif; else: echo "" ;endif; ?>

										</ul>
									</div>
									<!-- page -->
									<div class="ev_page">

									</div>
								</div>
								<div class="col-md-4">
									<div class="newslie">
										<div class="newslie-tit">C-IASI新闻</div>
										<div class="row netlie">
											<ul class="list-group">
												<?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vod): $mod = ($i % 2 );++$i;?><li>
														<div class="col-md-5 newslie-l">
															<a href="<?php echo U('details',array('typeid'=>$vod['typeid'],'id'=>$vod['id']));?>"><img src="<?php echo picture($vod['icon']);?>"></a>
														</div>
														<div class="col-md-7 newslie-r">
															<a href="<?php echo U('details',array('typeid'=>$vod['typeid'],'id'=>$vod['id']));?>"><?php echo ($vod['title']); ?></a>
															<p>发布时间：<?php echo (date('Y-m-d',$vod['create_time'])); ?></p>
														</div>
													</li><?php endforeach; endif; else: echo "" ;endif; ?>
											</ul>
										</div>
										<!--<div class="newMore"><a href="#"> 更多&gt;&gt; </a> </div>-->
									</div>
								</div>
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
		var mySwiper = new Swiper('.a_nr_Con',{
				loop:false,
				slidesPerView:4,
				slidesPerGroup :1,
				mode:'vertical',
				watchActiveIndex: true,
		});
		var mySwiper = new Swiper('.latestCon',{
				loop:false,
				slidesPerView:4,
				slidesPerGroup :1,
				watchActiveIndex: true,
				onInit: function(swiper){
				  swiper.swipeNext()
				},
		});
			
			var tiemh =700;
			loadZf($('.newsCenter'),$('.newslie'));
			function loadZf($hade,$x){
				var winH = $(window).height();
				var scrollH = $(window).scrollTop();
				var $con = $hade.offset().top ;
				if($con < winH + scrollH){
					$x.animate({
						'right':'0',
						'opacity':'1',
						'filter': 'alpha(opacity ==100)',
					},tiemh);
				}
			}
	});
	</script>
</body>
</html>