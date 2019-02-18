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
	<link rel="stylesheet" type="text/css" href="/Public/Home/css/page.css"/>

	<script src="/Public/Home/js/jquery-1.9.1.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="/Public/Home/js/swiper.min.js" type="text/javascript" charset="utf-8"></script>
	<!-- <script src="js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script> -->
    <script type="text/javascript" src="/Public/Home/js/default.js"></script>
</head>
<body>
<div class="hadeBox">
	<div class="hadeCon">
		<a class="hd_logo" href="<?php echo U('Index/index');?>"><img src="/Public/Home/images/center/logo.png" alt=""></a>
		<div class="hade_right">
			<div class="hade_nav">
				<ul>
					<li>
						<a href="<?php echo U('Index/index');?>">首页</a>
					</li>
					<?php if(is_array($navs)): $i = 0; $__LIST__ = $navs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$navt): $mod = ($i % 2 );++$i;?><li>
							<a href="<?php echo U($navt[url]);?>"><?php echo ($navt["title"]); ?></a>
							<?php if(!empty($navt['nav_son'])): ?><div class="had_nav_lk">
									<ul>
										<?php if(is_array($navt['nav_son'])): $i = 0; $__LIST__ = $navt['nav_son'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$son): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U($son[url],array('typeid'=>$son['id']));?>"><?php echo ($son["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
									</ul>
								</div><?php endif; ?>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>

			<div class="hade_query">
				<div class="query_Con">
					<input type="text" placeholder="搜索关键字" class="query_Text">
					<input type="submit" value=" " class="query_sub icon-fdj">
				</div>
				<div class="bdsharebuttonbox que_lk">
					<a href="#" class="bds_weixin" data-cmd="weixin"></a>
					<span>|</span>
					<a href="<?php echo U('English/index/index');?>" class="bds_eg"></a>
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
	<!-- banner -->
	<div class="bannerBox">
		<div class="bannerCon">
			<img src="/Public/Home/images/banner/banner.jpg" alt="">
			<div class="banner_text">
				<h3>中国保险汽车安全指数</h3>
				<em></em>
				<p> China Insurance Automotive Safety Index (C-IASI)</p>
			</div>
		</div>
	</div>
	
	<section class="contentBox">
		<!-- 测评动态 -->
		<div class="performance">
			<div class="width1200 perforCon">
				<!-- 评价 -->
				<div class="evaluation">
					<p class="eval_tit">评价结果</p>
					<form action="/home/safety/index" class="eval_form">
						<div class="eval_Item">
							<div class="eval_Left">                                
								<select name="bid">
									<option style="display: none;" value="">厂商</option>
									<?php if(is_array($changshang)): $i = 0; $__LIST__ = $changshang;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$brands): $mod = ($i % 2 );++$i;?><option value="<?php echo ($brands["id"]); ?>"><?php echo ($brands["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
								</select>
								<i class="glyphicon glyphicon-play"></i>
							</div>
							<div class="eval_right">
								<select name="cid">
									<option style="display: none;" value="">车型</option>
								</select>
								<i class="glyphicon glyphicon-play"></i>
							</div>
						</div>
						<div class="eval_Item">
							<select name="jid">
								<option style="display: none;" value="">级别</option>
								<?php if(is_array($jibie)): $i = 0; $__LIST__ = $jibie;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jibies): $mod = ($i % 2 );++$i;?><option value="<?php echo ($jibies["id"]); ?>"><?php echo ($jibies["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
							</select>
							<i class="glyphicon glyphicon-play"></i>
						</div>
						<input type="hidden" name="sid" value="15" />
						<input type="submit" value="参看搜索结果" class="eval_btn">
					</form>
				</div>
				<!-- 动态 -->
				<div class="dynamic">
					<p class="dynamic_tit">
						<a href="<?php echo U('Safety/index',array('typeid'=>14));?>"><img src="/Public/Home/images/icon/icon-chep.png" alt=""></a>测评动态
					</p>
					<div id="myCarousel">
						<ul class="swiper-wrapper">
							<?php if(is_array($cpdt)): $i = 0; $__LIST__ = $cpdt;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cpdts): $mod = ($i % 2 );++$i;?><li class="swiper-slide">
								<h3 class="dy_tit"><?php echo ($cpdts["title"]); ?></h3>
								<p class="dy_titD"><?php echo ($cpdts["short_title"]); ?></p>
								<p class="dy_text"><?php echo ($cpdts["descriptions"]); ?></p>
								<span class="dy_time">2018-09-10~14</span>
							</li><?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
						<div class="pagination"></div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- 视频展示 -->
		<div class="performance VideoBox">
			<div class="width1200 VideoCon">
				<div class="v_tit">
					<p><?php echo ($video["title"]); ?></p>
				</div>
				<p class="v_Text"><?php echo ($video["describle"]); ?></p>
				<div class="v_box">
					 <div class="v_video">
						 <video poster="<?php echo (picture($video["icon"])); ?>"  autoplay="autoplay" controls >
							 <source src="<?php echo file_url($video['file']);?>">
							 your browser does not support the video tag
						 </video>
					 </div> 
				</div>
			</div>
		</div>
		
		<!-- 新闻中心 -->
		<div class="performance newsBox">
			<div class="width1200 newsCon">
				<div class="newsTit">
					<div class="n_tit">
						<p>新闻中心</p>
						<span>News Center</span>
					</div>
					<a class="n_lk" href="<?php echo U('News/index');?>">更多资讯<i class="icon-rightjt"></i></a>
				</div>
				<div class="newsContent">
					<!-- left -->
					<div class="news_left">
						<!-- banner -->
						<div id="myCar" class="myCar">
							<ul class="swiper-wrapper">
								<?php if(is_array($img_news)): $i = 0; $__LIST__ = $img_news;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imgn): $mod = ($i % 2 );++$i;?><li class="swiper-slide">
											<a href="<?php echo U('News/details',array('typeid'=>$imgn['typeid'],'id'=>$imgn['id']));?>">
											<img src="<?php echo picture($imgn['icon']);?>" alt="">
											<em></em>
											<p><?php echo ($imgn['title']); ?></p>
											</a>
										</li><?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
							<div class="myCarpage"></div>
						</div>
						<!-- text -->
						<div class="news_left_text">
							<?php if(is_array($two_news)): $i = 0; $__LIST__ = $two_news;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$twon): $mod = ($i % 2 );++$i;?><div class="news_l_item">
								<a href="<?php echo U('News/details',array('typeid'=>$twon['typeid'],'id'=>$twon['id']));?>">
									<p><?php echo ($twon['title']); ?></p>
									<span><?php echo (date('Y-m-d',$twon['create_time'])); ?></span>
								</a>
							</div><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>
					<!-- right -->
					<div class="news_right">
						<?php if(is_array($thr_news)): $i = 0; $__LIST__ = $thr_news;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$thrn): $mod = ($i % 2 );++$i;?><div class="news_r_item">
							<div class="n_r_time">
								<p><?php echo (date('Y',$thrn['create_time'])); ?></p>
								<span><?php echo (date('m-d',$thrn['create_time'])); ?></span>
							</div>
							<div class="n_r_text">
								<p><a href="<?php echo U('News/details',array('typeid'=>$thrn['typeid'],'id'=>$thrn['id']));?>"><?php echo ($thrn['title']); ?></a></p>
								<span><?php echo ($thrn['descriptions']); ?></span>
							</div>
						</div><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
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
		var mySwiper = new Swiper('#myCarousel',{
				loop:false,
				autoplay : 3000,
				observer:true,
				observeParents:true,
				pagination : '.pagination',
				paginationClickable :true,
				autoplayDisableOnInteraction : false,
			});
		var mySwiper = new Swiper('#myCar',{
				loop:false,
				autoplay : 3000,
				observer:true,
				observeParents:true,
				pagination : '.myCarpage',
				paginationClickable :true,
				autoplayDisableOnInteraction : false,
			});
			if($(window).width() >= 1024){
				$(window).on("scroll", function(){
					var scrollH = $(window).scrollTop();
					loadZ($('.perforCon'),$('.evaluation'),$('.dynamic'));
					loadZ($('.newsContent'),$('.news_left'),$('.news_right'));
					if($('.v_box').offset().top < winH + scrollH){
						$('.v_box').animate({
							'marginTop':'110px',
							'opacity':'1',
						},700,function(){
							$('.v_video').animate({
								'left':'-60px',
								'bottom':'20px',
								'opacity':'1',
							},300);
						});
					}
				});
				var tiemh =1000;
				var winH = $(window).height();
				function loadZ($hade,$y,$x){
					var scrollH = $(window).scrollTop();
					var $con = $hade.offset().top;
					if( $con < winH + scrollH){
						$y.animate({
							'marginLeft':'0',
							'opacity':'1',
							'filter': 'alpha(opacity ==100)',
						},tiemh);
						$x.animate({
							'marginRight':'0',
							'opacity':'1',
							'filter': 'alpha(opacity ==100)',
						},tiemh);
					}
				}
			}
	});
	</script>

<script>
	$('select[name=bid]').change(function(){

		var val = $(this).val();
		$.post('<?php echo U("changelist");?>',{'bid':val},function(data){

			$('select[name=cid]').html('<option style="display: none;" value="">车型</option>'+data);

		});

	});
</script>
</body>
</html>