$(function(){
	$('img').on('mousedown',function (e) {
		e.preventDefault()
	});
	
	var mySwiper = new Swiper('.fo_weiper',{
			loop:false,
			observer:true,
			observeParents:true,
			prevButton:'.swiper-button-prev',
			nextButton:'.swiper-button-next',
			slidesPerView:'auto',
			slidesPerGroup:1,
		});
	var tiemh =1000;
		var scrollTop ="";
		var winH = $(window).height();
		
		
		/*var scrollTop ="";
		var winH = $(window).height();
		var pubLeng = $(".width1200");
		$(window).on("scroll", function(){
			scrollTop = $(window).scrollTop();
			console.log(scrollTop);
			loadCon(pubLeng);
		})
		console.log(pubLeng)
		function loadCon(arr) {
			for(var i = 0 ; i< arr.length; i++ ){
				if(arr[i].getBoundingClientRect().top < winH && !arr[i].isLoad){
					arr[i].isLoad = true;
					arr[i].className+=" "+"ani";
				}
			}
		}*/	
		
	if($(window).width() >= 320 && $(window).width() <= 1023){
		var winHeight = $(window).height();
		var headerHeight = $(".navBtn").height();
		var footerHeight = $(".fo_battom").height();
		var differenceH = winHeight - headerHeight - footerHeight;
		$(".contentBox").css("min-height",differenceH);
		
		$('.hade_nav > ul > li').click(function(){
			if($(this).find('.had_nav_lk').css('display') == 'none'){
				$(this).find('.had_nav_lk').slideDown();
				$(this).siblings('li').find('.had_nav_lk').slideUp();
			}else if($(this).find('.had_nav_lk').css('display') == 'block'){
				$(this).find('.had_nav_lk').slideUp();
			}
		});
		$(".hadeBox").click(function () {
			$("body").stop().animate({"margin-top":"0","margin-left":"0"});
			$(".hadeBox").stop().animate({"top":"-54px","left":"100%"});
			$(".query_Con").stop().animate({"top":"-40%",'right':'-100%'});
		});
		$('.navBtn').click(function(){
			$(".hadeBox").stop().animate({"top":"0px","left":"0%"});
			$(".query_Con").stop().animate({"top":"0%",'right':'0%'});
		})
		$(".query_Con, .hade_right").click(function (e) { e.stopPropagation();});
		var sNaLeng = $('.s_nav ul li').length;
		var sNa = $('.s_nav ul li').width()*3;
		var mun = parseFloat((sNaLeng*sNa));
		console.log(sNaLeng +'|' +sNa+'|'+mun*2);
		$('.s_nav ul').css({
			'width':mun,
		});
		
		$('.banner_text h3').animate({
			'margin':'70px auto 0px',
			'opacity': '1',
			'filter': 'alpha(opacity ==100)',
		},tiemh);
		$('.banner_text em').animate({
			'margin':'15px auto 0px',
			'opacity': '1',
			'filter': 'alpha(opacity ==100)',
		},tiemh)
		$('.banner_text p').animate({
			'margin':'15px auto 0px',
			'opacity': '1',
			'filter': 'alpha(opacity ==100)',
		},tiemh);	
		
		var pubLeng = $(".evaluation");
		var focu_item = $(".focu_item");
		$(window).on("scroll", function(){
			scrollTop = $(window).scrollTop();
			loadCon(focu_item);
			loadCon($('.dynamic'));
			loadCon($('.VideoBox'));
			loaConTwo($('.news_left'));
			loaConTwo($('.news_right'));
			loaConTwo($('.evalCon_item'));
			loaConTwo($('.a_news_right'));
			loaConTwo($('.latest_tit'));
			loaConTwo($('.latestCon'));
			loaConTwo($('.list-group li'));
			loaConTwo($('.downloadlist ul li'));
			
			
			loafth($('.newsCenter .newjoblist .list-group li'));
			loadCon($('.deslist ul li'));
			loadCon($('.Int_ensure'));
			loadCon($('.Int_n_img'));
			loaConTwo($('.Int_n_Text div'));
			loadCon($('.frame_titCon'));
			loaConTwo($('.far_c_item'));
			loadCon($('.fra_tit'));
			loaConTwo($('.great_c_v'));
			
			
			
			loadCon($('.frameCon'));
			loadCon($('.courseBox'));
			loadCon($('.greatVideo'));
			loaConTwo($('.sat_c_text'));
			loadCon($('.sat_c_img'));
			loaConTwo($('.leagueCon > div'));
			loadCon($('.cont_right'));
		})
		loadCon(pubLeng);
		loadCon($('.allTit'));
		loadCon($('.yearBox'));
		loaConTwo($('.leagueCon > div:nth-child(1)'));
		loadCon($('.deslist ul li:nth-child(1)'));
		loadCon($('.deslist ul li:nth-child(2)'));
		loadCon($('.deslist ul li:nth-child(3)'));
		loadCon($('.deslist ul li:nth-child(4)'));
		loaConTwo($('.newsHd .newsdetail'));
		loaConTwo($('.a_news_left'));
		loaConTwo($('.downloadlist ul li:first-child'));
		loafth($('.evalCon_item:first-child'));
		loadCon($('.sat_tit'));
		
		loadCon($('.expTit'));
		loadCon($('.man_img'));
		loadCon($('.cont_l_logo'));
		loadCon($('.cont_left'));
		function loadCon(arr) {
			for(var i = 0 ; i< arr.length; i++ ){
				if(arr[i].getBoundingClientRect().top < winH && !arr[i].isLoad){
					arr[i].isLoad = true;
					arr[i].className+=" "+"ani";
				}
			}
		}
		function loaConTwo(arr){
			for(var i = 0 ; i< arr.length; i++ ){
				if(arr[i].getBoundingClientRect().top < winH && !arr[i].isLoad){
					arr[i].isLoad = true;
					arr[i].className+=" "+"aneval";
				}
			}
		}
		function loafth(arr){
			for(var i = 0 ; i< arr.length; i++ ){
				if(arr[i].getBoundingClientRect().top < winH && !arr[i].isLoad){
					arr[i].isLoad = true;
					arr[i].className+=" "+"anNws";
				}
			}
		}
		$('.newjoblist ul li:first-child').animate({
			'marginTop':'0px !important',
			'opacity': '1',
			'filter': 'alpha(opacity ==100)',
		});
		var tTwo = 700;
		
			lacontent($('.focu_item:first-child'));
			lacontent($('.newsCenter .newslie'));
		function lacontent(con){
			con.animate({
				'marginTop':'0px',
				'opacity': '1',
				'filter': 'alpha(opacity ==100)',
			});
		}
		function laconEvl(bs){
			bs.animate({
				'marginTop':'30px',
				'opacity': '1',
				'filter': 'alpha(opacity ==100)',
			});
		}
	
	}
	
	// --------------------------------------------------
	
	
	
	if($(window).width() >= 1024){
		var winHeight = $(window).height();
		var headerHeight = $(".hadeBox").height();
		var footerHeight = $(".footerBox,.fo_battom").height();
		var differenceH = winHeight - headerHeight - footerHeight;
		$(".contentBox").css("min-height",differenceH);
		var hdHright = $('.hadeBox').height();
		$('.kBox').height(hdHright);
		$('.hade_nav > ul > li').hover(function(){
			$(this).find('.had_nav_lk').slideDown();
			$(this).siblings('li').find('.had_nav_lk').stop().slideUp();
		},function(){
			$('.had_nav_lk').stop().slideUp();
			return;
		});
		$('.navCon > ul > li').hover(function(){
			$(this).find('.navCon_lk').slideDown();
			$(this).siblings('li').find('.navCon_lk').stop().slideUp();
		},function(){
			$('.navCon_lk').stop().slideUp();
			return;
		});
		
		
		$('.banner_text h3').animate({
			'margin':'180px auto 0px',
			'opacity': '1',
			'filter': 'alpha(opacity ==100)',
		},1000);
		$('.banner_text em').animate({
			'margin':'25px auto 0px',
			'opacity': '1',
			'filter': 'alpha(opacity ==100)',
		},1300);
		$('.banner_text p').animate({
			'margin':'25px auto 0px',
			'opacity': '1',
			'filter': 'alpha(opacity ==100)',
		},1600)
		/*$('.banner_text h3').animate({
			'margin':'180px auto 0px',
			'opacity': '1',
			'filter': 'alpha(opacity ==100)',
		},tiemh,function(){
			$('.banner_text em').animate({
				'margin':'25px auto 0px',
				'opacity': '1',
				'filter': 'alpha(opacity ==100)',
			},tiemh,function(){
				$('.banner_text p').animate({
					'margin':'25px auto 0px',
					'opacity': '1',
					'filter': 'alpha(opacity ==100)',
				},tiemh);	
			});	
		});	*/
		var pubLeng = $(".performance");
		$(window).on("scroll", function(){
			var scrollH = $(window).scrollTop();
			loaConTwo($('.evalCon_item'));
			loafth($('.newsCenter .newjoblist .list-group li'));
			loadCon($('.deslist ul li'));
			loadCon($('.frameCon'));
			loadCon($('.courseBox'));
			loadCon($('.greatVideo'));
			loadCon($('.StagingArea'));
			loaConTwo($('.leagueCon > div'));
			loaConTwo($('.netlie ul li'));
			loadCon($('.newsHd .newsdetail'));
			loadCon($('.v_tit'));
			loaConTwo($('.v_Text')); 
			loadCon($('.newsTit'));
			loadCon($(".focu_item"));
			loadCon($(".fra_tit"));
			loaConTwo($(".fra_text"));
			loaConTwo($(".frame_Content"));
			loadCon($(".fra_tit"));
			
			
		});
		//-------------------
		loadCon($('.focu_item:nth-child(1)'));
		loadCon($('.focu_item:nth-child(2)'));
		loadCon($('.cont_l_logo'));
				//-------------------------
		loadCon($('.expTit'));
		loadCon($('.man_img'));
		loaConTwo($('.netlie ul li'));
		loadCon($('.newsHd .newsdetail'));
		loaConTwo($('.leagueCon > div:nth-child(1)'));
		loaConTwo($('.leagueCon > div:nth-child(2)'));
		loaConTwo($('.leagueCon > div:nth-child(3)'));
		loaConTwo($('.leagueCon > div:nth-child(4)'));
		loadCon($('.newsCenter .newjoblist .list-group li:first-child'));
		function loadCon(arr) {
			for(var i = 0 ; i< arr.length; i++ ){
				if(arr[i].getBoundingClientRect().top < winH && !arr[i].isLoad){
					arr[i].isLoad = true;
					arr[i].className+=" "+"ani";
				}
			}
		}
		function loaConTwo(arr){
			for(var i = 0 ; i< arr.length; i++ ){
				if(arr[i].getBoundingClientRect().top < winH && !arr[i].isLoad){
					arr[i].isLoad = true;
					arr[i].className+=" "+"aneval";
				}
			}
		}
		function loafth(arr){
			for(var i = 0 ; i< arr.length; i++ ){
				if(arr[i].getBoundingClientRect().top < winH && !arr[i].isLoad){
					arr[i].isLoad = true;
					arr[i].className+=" "+"anNws";
				}
			}
		}
		function loacLeft(arr){
			for(var i = 0 ; i< arr.length; i++ ){
				if(arr[i].getBoundingClientRect().top < winH && !arr[i].isLoad){
					arr[i].isLoad = true;
					arr[i].className+=" "+"evaleft";
				}
			}
		}
		function loacRight(arr){
			for(var i = 0 ; i< arr.length; i++ ){
				if(arr[i].getBoundingClientRect().top < winH && !arr[i].isLoad){
					arr[i].isLoad = true;
					arr[i].className+=" "+"evaright";
				}
			}
		}
		$('.newjoblist ul li:first-child').animate({
			'marginTop':'0px !important',
			'opacity': '1',
			'filter': 'alpha(opacity ==100)',
		});
		var tTwo = 700;
		$('.downloadlist ul li:first-child').animate({
			'top':'0px',
			'opacity': '1',
			'filter': 'alpha(opacity ==100)',
		},tTwo,function(){
			$('.downloadlist ul li:nth-child(2)').animate({
				'top':'0px',
				'opacity': '1',
				'filter': 'alpha(opacity ==100)',
			},tTwo,function(){
				$('.downloadlist ul li:nth-child(3)').animate({
					'top':'0px',
					'opacity': '1',
					'filter': 'alpha(opacity ==100)',
				},tTwo,function(){
					$('.downloadlist ul li:nth-child(4)').animate({
						'top':'0px',
						'opacity': '1',
						'filter': 'alpha(opacity ==100)',
					},tTwo,function(){
						$('.downloadlist ul li:nth-child(5)').animate({
							'top':'0px',
							'opacity': '1',
							'filter': 'alpha(opacity ==100)',
						},tTwo,function(){
							$('.downloadlist ul li:nth-child(6)').animate({
								'top':'0px',
								'opacity': '1',
								'filter': 'alpha(opacity ==100)',
							},tTwo);
						});
					});
				});
			});
		});
				
			
			lacontent($('.appr_news'));
			lacontent($('.allTit'));
			lacontent($('.yearBox'));
			lacontent($('.deslist ul li:nth-child(1)'));
			lacontent($('.deslist ul li:nth-child(2)'));
			lacontent($('.deslist ul li:nth-child(3)'));
			lacontent($('.deslist ul li:nth-child(4)'));
			lacontent($('.deslist ul li:nth-child(5)'));
			lacontent($('.deslist ul li:nth-child(6)'));
			laconEvl($('.evalCon_item:first-child'));
			laconEvl($('.evalCon_item:nth-child(2)'));
			laconEvl($('.evalCon_item:nth-child(3)'));
			lacontent($('.newsCenter .newslie'));
		function lacontent(con){
			con.animate({
				'marginTop':'0px',
				'opacity': '1',
				'filter': 'alpha(opacity ==100)',
			});
		}
		function laconEvl(bs){
			bs.animate({
				'marginTop':'30px',
				'opacity': '1',
				'filter': 'alpha(opacity ==100)',
			});
		}
		
		$(window).on("scroll", function(){
			$('.latest_tit').animate({
				'marginTop':'0px',
				'opacity': '1',
				'filter': 'alpha(opacity ==100)',
			},tiemh,function(){
				$('.latestCon').animate({
					'marginTop':'50px',
					'opacity': '1',
					'filter': 'alpha(opacity ==100)',
				},tiemh);
			});
		})
	}
	
});