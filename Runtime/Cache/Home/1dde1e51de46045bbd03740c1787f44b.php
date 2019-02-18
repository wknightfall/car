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
	<script type="text/javascript">
		$('.yearBox label').hide();
		$('.evalCon_item').hide();
		$(function(){
			if($(window).width() >= 320 && $(window).width() <= 1023){
				$('.yearBox label:nth-child(3n-2)').css({
					'marginLeft':'0px',
				});
				$('.evalCon_item').css({
					'marginLeft':'0px',
				});
				var mySwiper = new Swiper('.latestCon',{
						loop:false,
						slidesPerView:2,
						slidesPerGroup :1,
						prevButton:'.TestNext',
						nextButton:'.TestPrev',
						observer:true,
						observeParents:true,
						spaceBetween : 20,
				});
			}
			if($(window).width() >= 1024){
				$('.yearBox label:nth-child(9n-8)').css({
					'marginLeft':'0px',
				});
				$('.evalCon_item:nth-child(3n-2)').css({
					'marginLeft':'0px',
				});
				var swiperbs = new Swiper('.latestCon',{
						loop:false,
						slidesPerView:4,
						slidesPerGroup :1,
						prevButton:'.TestNext',
						nextButton:'.TestPrev',
						observer:true,
						observeParents:true,
						spaceBetween : 20,
				});
				$('.latestCon').hover(function(){
					swiperbs.stopAutoplay();
					$(".TestNext, .TestPrev").stop().animate({"opacity":"1"})
				},function(){
					swiperbs.startAutoplay();
					$(".TestNext, .TestPrev").stop().animate({"opacity":"0"});
				});
			}
			setTimeout(function(){
				$('.yearBox label').show();
				$('.evalCon_item').show();
			},10)
		})
	</script>
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
						<a href=""><i class="glyphicon glyphicon-home"></i>首页</a>
						<span class="icon-rightjt"></span>
						<a href="">评级与安全奖</a>
						<span class="icon-rightjt"></span>
						<a class="crumbsTxt" href="">测评动态</a>
					</div>
					<!-- xiao nav -->
					<div class="s_nav">
						<ul>  
							<?php if(is_array($catelist)): $i = 0; $__LIST__ = $catelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$catelists): $mod = ($i % 2 );++$i;?><li <?php if($sid == $catelists['id']): ?>class="active"<?php endif; ?> data-id="<?php echo ($catelists["id"]); ?>"><?php echo ($catelists["title"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
							<!--<li class="active">测评动态</li>-->
						</ul>
					</div>
				</div>
			</div>
			<!--  -->
			<div class="opt_Box">
				<div <?php if($sid != $catelist[0]['id']): ?>class="hidddes"<?php endif; ?> style="text-align:center;font-size:25px;">
					暂未开通
				</div>
				<div <?php if($sid != $catelist[1]['id']): ?>class="hidddes"<?php endif; ?>>
					<div class="width1200 appraisal">
						<!--  -->
						<div class="appr_news">
							<!-- left -->
							<div class="a_news_left">
								<div class="nl_active">
									<div class="swiper-wrapper">
										<?php if(is_array($cpdtflag)): $i = 0; $__LIST__ = $cpdtflag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cpdtflags): $mod = ($i % 2 );++$i;?><a class="nl_acItem swiper-slide" href="">
											<img src="<?php echo (picture($cpdtflags["icon"])); ?>" alt="">
											<em></em>
											<p class="a_ac_co"><?php echo ($cpdtflags["title"]); ?></p>
										</a><?php endforeach; endif; else: echo "" ;endif; ?>
									</div>
								</div>
								<ul>
									<?php if(is_array($cpdt)): $i = 0; $__LIST__ = $cpdt;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cpdts): $mod = ($i % 2 );++$i;?><li class="a_nL_item">
										<a href="<?php echo U('media/details?typeid=14&id='.$cpdts['id']);?>">
											<div class="a_nL_con">
												<p><?php echo ($cpdts["title"]); ?></p>
												<span><?php echo (todate($cpdts["create_time"])); ?></span>
											</div>
										</a>
									</li><?php endforeach; endif; else: echo "" ;endif; ?>
								</ul>
								<a class="nl_move" href="/home/media/index?typeid=14">更多</a>
							</div>
							<!-- right -->
							<div class="a_news_right">
								<div class="a_nr_tit"><p>指数测评通知</p></div>
								<div class="a_nr_Con">
									<ul class="swiper-wrapper">
										<?php if(is_array($zslist)): $i = 0; $__LIST__ = $zslist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$zslists): $mod = ($i % 2 );++$i;?><li class="swiper-slide a_nr_item">
											<p><?php echo ($zslists["title"]); ?></p>
											<span><?php echo ($zslists["descriptions"]); ?></span>
										</li><?php endforeach; endif; else: echo "" ;endif; ?>
									</ul>
								</div>
							</div>
						</div>
						<!-- 最新测试车型 -->
						<div class="latestTest">
							<p class="latest_tit">最新测试车型</p>
							<div class="latestCon">
								<ul class="swiper-wrapper">
								<?php if(is_array($newcar)): $i = 0; $__LIST__ = $newcar;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$newcars): $mod = ($i % 2 );++$i;?><li class="swiper-slide test_item">
										<a href="javascript:void(0)">
											<div class="test_it_img"><img src="<?php echo (picture($newcars["icon"])); ?>" alt=""></div>
											<p class="test_it_text"><?php echo ($newcars["title"]); ?></p>
										</a>
									</li><?php endforeach; endif; else: echo "" ;endif; ?>
								</ul>
								<div class="TestPrev"><img src="/Public/Home/images/center/right.jpg" alt=""></div>
								<div class="TestNext"><img src="/Public/Home/images/center/left.jpg" alt=""></div>
							</div>
						</div>
					</div>
				</div>
				<div <?php if($sid != $catelist[2]['id']): ?>class="hidddes"<?php endif; ?>>
					<div class="width1200 resultsBox">
						<div class="resultsCon">
							<!--  -->
							<div class="allTit">
								<span class="all_t_t">年份评级</span>
								<div class="all_t_ck">
									<label><input type="checkbox" class="ids"> <span>全部</span></label>
								</div>
							</div>
							<!--  -->
							<div class="yearBox">
								<?php if(is_array($year)): $i = 0; $__LIST__ = $year;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$years): $mod = ($i % 2 );++$i;?><label><input type="checkbox" name="year[]" <?php if(in_array(($years['id']), is_array($get['year'])?$get['year']:explode(',',$get['year']))): ?>checked<?php endif; ?> class="check-all" value="<?php echo ($years["id"]); ?>"> <span><?php echo ($years["title"]); ?>年</span></label><?php endforeach; endif; else: echo "" ;endif; ?>
							</div>
							
							<!-- con -->
							<?php if(!empty($lists)): ?><div class="evalConBox">
								<ul>
									<?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lister): $mod = ($i % 2 );++$i;?><li class="evalCon_item">
										<div class="ev_hd">
											<div class="ev_hd_logo"><img src="<?php echo (picture(modelfield($lister["bid"],'category','icon'))); ?>" alt=""></div>
											<div class="ev_hd_tit">
												<p><?php echo ($lister["title"]); ?></p>
												<span><?php echo (modelfield($lister["cid"],'category','title')); ?></span>
											</div>
											<div class="ev_hd_time"><?php echo (modelfield($lister["year"],'category','title')); ?></div>
										</div>
										<div class="ev_c_Img"><img src="<?php echo (picture($lister["icon"])); ?>" alt=""></div>
										<div class="ev_ance">
											<div class="ev_ance_item">
												<div class="ev_a_img"><img src="/Public/Home/images/center/cshu.jpg" alt=""></div>
												<?php if(!empty($lister['point1'])): ?><div class="ev_a_level">
													<?php echo (pointlist($lister["point1"])); ?>

												</div>
												<span class="ev_a_f"><?php echo ($lister["point1"]); ?>分</span>
												<?php else: ?>
												<div class="ev_a_level">
													未搭载
												</div><?php endif; ?>
											</div>
											<div class="ev_ance_item">
												<div class="ev_a_img"><img src="/Public/Home/images/center/yliang.jpg" alt=""></div>
												<?php if(!empty($lister['point2'])): ?><div class="ev_a_level">
													<?php echo (pointlist($lister["point2"])); ?>
												</div>
												<span class="ev_a_f"><?php echo ($lister["point2"]); ?>分</span>
												<?php else: ?>
												<div class="ev_a_level">
													未搭载
												</div><?php endif; ?>
											</div>
											<div class="ev_ance_item">
												<div class="ev_a_img"><img src="/Public/Home/images/center/pzhung.jpg" alt=""></div>
												<?php if(!empty($lister['point3'])): ?><div class="ev_a_level">
													<?php echo (pointlist($lister["point3"])); ?>
												</div>
												<span class="ev_a_f"><?php echo ($lister["point3"]); ?>分</span>
												<?php else: ?>
												<div class="ev_a_level">
													未搭载
												</div><?php endif; ?>
											</div>
											<div class="ev_ance_item">
												<div class="ev_a_img"><img src="/Public/Home/images/center/caq.jpg" alt=""></div>
												<?php if(!empty($lister['point4'])): ?><div class="ev_a_level">
													<?php echo (pointlist($lister["point4"])); ?>
												</div>
												<span class="ev_a_f"><?php echo ($lister["point4"]); ?>分</span>
												<?php else: ?>
												<div class="ev_a_level">
													未搭载
												</div><?php endif; ?>
											</div>
											<div class="ev_ance_item">
												<div class="ev_a_img"><img src="/Public/Home/images/center/xsgl.jpg" alt=""></div>
												<?php if(!empty($lister['point5'])): ?><div class="ev_a_level">
													<?php echo (pointlist($lister["point5"])); ?>
												</div>
												<span class="ev_a_f"><?php echo ($lister["point5"]); ?>分</span>
												<?php else: ?>
												<div class="ev_a_level">
													未搭载
												</div><?php endif; ?>
											</div>
											<div class="ev_an_lk">
												<a href="<?php echo ($lister["url"]); ?>" target="_blank">查看报告链接</a>
											</div>
										</div>
									</li><?php endforeach; endif; else: echo "" ;endif; ?>
								</ul>
							</div>
							<!-- page -->
							<div class="ev_page">
								<!--<span class="act">1</span>
								<span><a href="">2</a></span>
								<span><a href="">3</a></span>-->
								<?php echo ($page); ?>
							</div>
							<?php else: ?>
							
							<div class="evalConBox">没有您想要查看的数据</div><?php endif; ?>
						</div>
					</div>
				</div>
				<div <?php if($sid != $catelist[3]['id']): ?>class="hidddes"<?php endif; ?> style="text-align:center;font-size:25px;">
					暂未开通
				</div>
			</div>
		</div>
		
	</section>
	
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
								<li class="swiper-slide"><a href="">中国银行保险监督管理委员会</a></li>
								<li class="swiper-slide"><a href="">中国保险行业协会</a></li>
								<li class="swiper-slide"><a href="">中国汽车工程研究院</a></li>
								<li class="swiper-slide"><a href="">中保研汽车技术研究院</a></li>
								<li class="swiper-slide"><a href="">IIHS</a></li>
								<li class="swiper-slide"><a href="">Euro-NCAP</a></li>
								<li class="swiper-slide"><a href="">RCAR</a></li>
								<li class="swiper-slide"><a href="">Euro-NCAP</a></li>
								<li class="swiper-slide"><a href="">RCAR</a></li>
								<li class="swiper-slide"><a href="">Euro-NCAP</a></li>
								<li class="swiper-slide"><a href="">RCAR</a></li>
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
	
	<script type="text/javascript">
	$(function(){
	
		$('.ev_page a').click(function(){
			var url = $(this).attr('href');
			var sid = $('.s_nav').find('.active').attr('data-id');
			
			if(url.indexOf("sid") >= 0){
				var list = url.split('/sid');
				var href = list[0]+'/sid/'+sid+'.html';
			
			}else{
				var list = url.split('.');
				var href = list[0]+'/sid/'+sid+'.'+list[1];
				
			}
			
			$(this).attr('href',href);

		
		});
	
		$(".ids").click(function(){
			var val = '';
			if($(".ids").is(':checked')){
				$(".check-all").prop("checked", true);
				$(".check-all").each(function(index){
			
					if(index == 0){
					
						val = $(this).val();
					
					}else{
					
						val = val +','+$(this).val();
					
					}
			
				});
	
			}else{
				$(".check-all").prop("checked", false);
			}
			screen(val);


		});
		
		$(".check-all").click(function(){
			var val = '';
			$(".check-all:checked").each(function(index){
			
				if(index == 0){
				
					val = $(this).val();
				
				}else{
				
					val = val +','+$(this).val();
				
				}
		
			});
			
			
			screen(val);
			
		
		})
		
		function screen(val){
		
			var href = '/home/safety/index?sid=15';
			
			if(val ==  ''){
			
				window.location.href = href;
			}else{
			
				window.location.href = href+'&year='+val;
			
			}
			
		
		}
		
	
		$(".opt_tabBox .s_nav ul > li").mouseover(function(){
			var _index = $(this).index();
			$(".opt_Box > div").eq(_index).show().siblings().hide();
			$(this).addClass("active").siblings().removeClass("active");
			var act = $(this).text();
			$('.crumbsTxt').html(act);
		});
		var mySwiper = new Swiper('.nl_active',{
				loop:false,
				autoplay : 3000,
				observer:true,
				observeParents:true,
				slidesPerView:1,
				slidesPerGroup :1,
		});
		var mySwiper = new Swiper('.a_nr_Con',{
				loop:false,
				direction : 'vertical',
				observer:true,
				observeParents:true,
				slidesPerView:4,
				slidesPerGroup :1,
		});
		var tiemh =1000;
		loadZf($('.appr_news'),$('.a_news_left'),$('.a_news_right'));
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
</body>
</html>