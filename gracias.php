<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>UEEB “SIMÓN BOLÍVAR”</title>
<meta name="description" content="Escuela" />
<meta name="keywords" content="escuela, altagracia, miranda, los puertos. zulia, venezuela" />
<meta name="robots" content="nombre" />

<meta name="viewport" content="target-densitydpi=high, width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<script type="text/javascript" src="../use.typekit.net/reg1jja.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<link rel="icon" type="image/png" href="images/favicon.ico">

<script language="javascript" type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script language="javascript" type="text/javascript" src="js/afterresize.min.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery.cycle.all.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script language="javascript" type="text/javascript" src="js/BrowserDetect.js"></script>

<link rel="stylesheet" type="text/css" media="screen" href="css/global.css" />

<meta property="og:url" content="http://timmytompkinsapp.com" />
<meta property="og:title" content="Timmy Tompkins' Awesome Fantasy Comic Book Superhero Adventure" />
<meta property="og:description" content="An interactive children's book for iPad by Fitz Fitzpatrick and Storypanda." />
<meta property="og:image" content="http://timmytompkinsapp.com/images/timmytompkins_facebookshare.jpg" />

<!-- carousel CSS -->
<link rel="stylesheet" type="text/css" href="dist/css/jquery.rs.carousel.css" media="all" />
<!-- lib -->
<script type="text/javascript" src="vendor/jquery.ui.widget.js"></script>
<!-- if using touch -->
<script type="text/javascript" src="vendor/jquery.event.drag.js"></script>
<!-- if using touch and translate3d -->
<script type="text/javascript" src="vendor/jquery.translate3d.js"></script>

<!-- carousel core -->
<script type="text/javascript" src="dist/js/jquery.rs.carousel.js"></script>

<!-- carousel extensions (optional) -->
<script type="text/javascript" src="dist/js/jquery.rs.carousel-autoscroll.js"></script>
<script type="text/javascript" src="dist/js/jquery.rs.carousel-continuous.js"></script>
<script type="text/javascript" src="dist/js/jquery.rs.carousel-touch.js"></script>

<script type="text/javascript">
var currStage = 'hero';
var nextOffset;
var prevOffset;
var winWidth = $(window).width();
var minWidth = 1024;

var desktop = false;
if(!BrowserDetect.isMobile()){ desktop = true; }

$(document).ready(function(){
	
	
	$('#width-indicator').html($(window).width() + 'px');
	$('#height-indicator').html($(window).height() + 'px');
		
	// initiates
	console.log(desktop);
	
	callbackStarts();	
	
	$(window).resize(function(){ callbackOnResize(); });
	$(window).afterResize(function(){ callbackAfterResize(); });
	
	$(window).bind('hashchange',function(e){ callbackHashChange(); });
    
    // small animations
    var animationTimer = setInterval(function(){ callbackInterval(); },6000);
    
    if(desktop && $(window).width() > 1024){
		// scroll events
		var mousewheelevt = (/Firefox/i.test(navigator.userAgent)) ? "DOMMouseScroll" : "mousewheel" //FF doesn't recognize mousewheel as of FF3.x
		$('body').bind(mousewheelevt, function(e){
			var evt = window.event || e //equalize event object     
			evt = evt.originalEvent ? evt.originalEvent : evt; //convert to originalEvent if possible               
			var delta = evt.detail ? evt.detail*(-40) : evt.wheelDelta //check for detail first, because it is used by Opera and FF

			if(delta > 0) { callbackScroll('up');e.preventDefault(); }
			else{ callbackScroll('down');e.preventDefault(); }   
		});
	}
	
	$('.arrow_down').on('click',function(){
		callbackScroll('down');
	});
	
	if(desktop){	// over min width
		$('.wrapper').on('mouseleave',function(){
			showMenu();
		}).on('mouseenter',function(){
			hideMenu();
		});
	
		$(document).on('mouseleave',function(){ hideMenu(); });
	
		$(document).on('focus',function(){ 
			clearInterval(animationTimer);
			animationTimer = setInterval(function(){ callbackInterval(); },6000);
		});
		
		$(window).on('focus',function(){ 
			clearInterval(animationTimer);
			animationTimer = setInterval(function(){ callbackInterval(); },6000);
		});
		
		$(document).on('blur',function(){ 
			clearInterval(animationTimer);
		});
		
		$(window).on('blur',function(){ 
			clearInterval(animationTimer);
		});
		
		$('.arrow_down').on('mouseover',function(){
			clearInterval(animationTimer);
		});
		
		$('.arrow_down').on('mouseout',function(){
			animationTimer = setInterval(function(){ callbackInterval(); },6000);
		});
		
	}	
	
	$('.mobile_menu_button').on('click',function(){
		if($('.topmenu .header_content .right').is(':hidden')){
			$('.topmenu .header_content .right').slideDown(100);
		}else{
			$('.topmenu .header_content .right').slideUp(100);
		}
	});
	
	$('.menu_item').on('click',function(){
		if($('.mobile_menu_button').is(':visible'))
			$('.topmenu .header_content .right').slideUp(100);
	});
	
	if (!desktop){
		$('.carousel_arrow.left').on('click',function(){
			$('.rs-carousel').carousel('prev');
		});
	
		$('.carousel_arrow.right').on('click',function(){
			$('.rs-carousel').carousel('next');
		});
	}
});

function callbackStarts(){
	buildCarousel();
	
	if (!desktop)
		setTimeout(function(){ $('.rs-carousel').carousel('refresh'); }, 1000);
	
	setTimeout(function(){	
		if($(window).width() > 1024){	
			if(!location.hash){ location.hash = '#hero';
			}else{ currStage = location.hash.replace('#',''); }
			$('body').animate({ scrollTop:$('#'+currStage).offset().top });
			callbackHashChange();
		}
	},200);
	
	setTimeout(function(){
		if (currStage == 'hero') $('body').css('background-color','#47C8E8');
		if (currStage == 'about') $('body').css('background-color','#F88421');
		if (currStage == 'who') $('body').css('background-color','#FEC80A');
		if (currStage == 'buy') $('body').css('background-color','#45C7E9');	
	},200);
	
	callbackOnResize(); // call once
};

function callbackOnResize(){
	$('#width-indicator').html($(window).width() + 'px');

	if($(window).height() > 768){
		$('.wrapper').css('height',$(window).height());	
		
		if((BrowserDetect.browser == 'Explorer') && (BrowserDetect.version == 8)){
			$('.wrapper.hero').css('height','764');
			//console.log('IE8');
		}
		
	}else{
		$('.wrapper').css('height','768px');
	}
	
	if($(window).width() <= 640){
		$('.wrapper.hero').addClass('small');
		$('.wrapper.about').css('height','820px');
		$('.wrapper.who').css('height','570px');
		$('.wrapper.buy').css('height','550px');
		$('.wrapper.share').css('height','360px');
	}
	
	if($(window).width() <= 360){
		$('.wrapper.hero').addClass('small');
		$('.wrapper.about').css('height','392px');
		$('.wrapper.who').css('height','285px');
		$('.wrapper.buy').css('height','275px');
		$('.wrapper.share').css('height','183px');
	}
	
	if($(window).width() <= 320){
		$('.wrapper.hero').addClass('small');
		$('.wrapper.about').css('height','392px');
		$('.wrapper.who').css('height','285px');
		$('.wrapper.buy').css('height','275px');
		$('.wrapper.share').css('height','183px');
	}
		
	$('.wrapper').css('width',$(window).width());
	winWidth = $(window).width();
	setTimeout(function(){
		$('.content').each(function(){
			$(this).css({
				'top':'50%',
				'position':'absolute',
				'margin-top': -1 * ($(this).outerHeight() / 2),
				'left':'50%',
				'margin-left': -1 * ($(this).outerWidth() / 2)
			});
		});
		
		if($(window).width() < 1025){		
			$('.top_intro').css({
				'left':'50%',
				'margin-left':-1 * ($('.top_intro').width() / 2),
				'top':'50%',
				'margin-top':-1 * ($('.top_intro').height() * 0.8121)
			});
		}else{
			$('.top_intro').removeAttr('style');
		}
		
	},200);
	
	if($(window).width()>1024)
		$('.ipad').css('z-index','9999');
	else
		$('.ipad').css('z-index','0');
};

function callbackAfterResize(){
	if(desktop) setCurrentStageToTop();
	if($(window).width() <= 1024){
		$('body').css('overflow-x','auto');
	}
	
	refreshCarousel();
	//$('.rs-carousel').carousel('refresh');
}

function callbackInterval(){
	if(desktop){
		$( ".btn.arrow_down" ).effect( "bounce", { distance: 20, times: 4 }, 1000 );
	}
}

function callbackScroll(direction){
	$('body').clearQueue().stop();
	
	var direction = direction;
	var nextOffset;
	console.log('scroll '+direction);
	
	$('#'+currStage).stop().css({
		'margin-top': 0
	});
	
	if(direction == 'down'){
		if($('#'+currStage).next('.wrapper').length){
			nextOffset = $('#'+currStage).next('.wrapper').offset().top;
			var nextWrapper = $('#'+currStage).next('.wrapper');
		}
	} else {
		if($('#'+currStage).prev('.wrapper').length){
			nextOffset = $('#'+currStage).prev('.wrapper').offset().top;
			var nextWrapper = $('#'+currStage).prev('.wrapper');
		}
	}
	
	if ($(nextWrapper).attr('id') == 'hero') $('body').css('background-color','#47C8E8');
	if ($(nextWrapper).attr('id') == 'about') $('body').css('background-color','#F88421');
	if ($(nextWrapper).attr('id') == 'who') $('body').css('background-color','#FEC80A');
	if ($(nextWrapper).attr('id') == 'buy') $('body').css('background-color','#45C7E9');
	if ($(nextWrapper).attr('id') == 'share') $('body').css('background-color','#F88421');	

	if(nextWrapper){
		$('body').animate({scrollTop: nextOffset}, 400, function() {
			currStage = $(nextWrapper).attr('id');
			location.hash = '#' + currStage;
		});
	}
}

function callbackHashChange(){
	if(location.hash != '#hero'){
		$('.gototop').fadeIn(200);
	}else{
		$('.gototop').fadeOut(200);
	}
}

function setCurrentStageToTop(){
	nextOffset = $('#'+currStage).offset().top;
	var nextWrapper = $('#'+currStage).next('.wrapper');
	if(nextWrapper){
		$('body').animate({scrollTop: nextOffset});
	}
}

function buildCarousel(){	
	if(desktop){
		$('.carousel_slides ul').cycle({
			next:   '.carousel_arrow.right', 
			prev:   '.carousel_arrow.left',
			pager:  '.pagination',
			timeout: 5000,
			speed:  400,
			fx: 'scrollHorz'
		});
	}else{
		$('.rs-carousel').carousel({
			'itemsPerPage':1,
			'autoScroll':true,
			'pause':5000,
			'pagination':false,
			'nextPrevActions':false,
			'loop':false,
			'disabled': false,
			'continuous':true
		});
	}
} 

function refreshCarousel(){
	$('.carousel_slides ul').cycle('destroy');
	$('.carousel_slides ul').removeAttr('style');
		
	if(desktop){	
		$('.carousel_slides ul img').removeAttr('style');
		setTimeout(function(){
			$('.carousel_slides ul').cycle({
				next:   '.carousel_arrow.right', 
				prev:   '.carousel_arrow.left',
				pager:  '.pagination',
				timeout: 5000,
				speed:  400,
				fx: 'scrollHorz'
			});
		},100);
	}else{
		$('.rs-carousel').carousel('refresh');
	}
}

function smoothjump(id,device){
	if (id == 'hero') $('body').css('background-color','#47C8E8');
	if (id == 'about') $('body').css('background-color','#F88421');
	if (id == 'who') $('body').css('background-color','#FEC80A');
	if (id == 'buy') $('body').css('background-color','#45C7E9');
	if (id == 'share') $('body').css('background-color','#F88421');	

	if(id != currStage || (device == 'mobile')){
		
		if($(window).width() < 1024){
		
			if($(window).width() > 640 && id!='hero'){
				$('.wrapper').css('margin-top',0);
				$('.wrapper.hero').css('margin-top',76);
			}if($(window).width() <= 320 ){
				$('.wrapper.hero').css('margin-top',54);
			}else if(id=='hero'){
				$('.wrapper.hero').css('margin-top',76);
			}
		
		}else{
			$('.wrapper').css('margin-top',0);
		}		
		
		var extra = 0;
		
		if(id=='hero') {
			
			$('body').animate({scrollTop: 0});
			if(desktop) location.hash = '#' + id;
			currStage = id;
			return;
		}
		
		if($(window).width() <= 1024) extra = 73;
		if($(window).width() <= 768) extra = 73;
		if($(window).width() <= 640) extra = 76;
		if($(window).width() <= 360) extra = 54;
		if($(window).width() <= 320) extra = 54;
		
		var nextOffset = $('#'+id).offset().top - extra;
		$('body').animate({scrollTop: nextOffset}, 400, function() {
			currStage = id;
			if($(window).width() > 640)
				if(desktop) location.hash = '#' + currStage;
		});
	}
}

function fbs_click(u,t) {	
	if(!u) var u=location.href;
	if(!t) var t=document.title;
	window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'Sharer','toolbar=0,status=0,width=626,height=436');
	return false;
}

function tweet_click(u,t) {
	if(!u) var u=location.href;
	if(!t) var t="Timmy Tompkins', an interactive kid's book by @fitzfitzpatrick and @storypanda for iPad:";
	window.open('https://twitter.com/share?text='+encodeURIComponent(t)+'&url='+encodeURIComponent(u),'Tweet','toolbar=0,status=0,width=626,height=436');
	return false;
}

function google_click(u,t) {
	if(!u) var u=location.href;
	if(!t) var t=document.title;
	window.open('https://plus.google.com/share?url='+encodeURIComponent(u),'Google Plus','toolbar=0,status=0,width=626,height=436');
	return false;
}

</script>
</head>

<body>

<!-- <div style="height:100%;width:2px;background:Red;position:fixed;margin:auto;z-index:9999;left:50%;margin-left:-1px;display:none;"></div> -->
<div id="width-indicator" style="padding:10px;position:fixed;top:0px;left:0px;z-index:99999999;display:none;">1000px</div>
<div id="height-indicator" style="padding:10px;position:fixed;top:30px;left:0px;z-index:999999999;display:none;"></div>

<div class="topmenu" id="topmenu">
	<div style="background-color:#FFF;">
		<div class="header_content">
			<div class="left">
				<a href="javascript:void(0);" class="title withtrans" onclick="smoothjump('hero')">
                	<div style="font-size:14px; margin-top:-10px; margin-bottom:3px;">UNIDAD  EDUCATIVA ESTATAL BOLIVARIANA</div>
                	<span>“SIMÓN BOLÍVAR”</span>
                </a>
				<a href="javascript:void(0);" class="mobile_menu_button"><span class="cover withtrans"></span></a>	
			</div>
			<div class="right">
                <a href="login.php" class="menu_item withtrans">Ingresar</a>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
<div class="wrapper who" id="who">
  <div class="content">
  	  <img src="images/top_intro1.png" class="logo-gracias"/>
	<div class="boton-gracias">
			<a href="index.php" class="button withtrans" style="font-size:16px;">REGRESA A LA PAGINA</a>
	  </div>
	</div>
</div>



<script type="text/javascript">
  (function() {
   var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
   po.src = '../apis.google.com/js/client_plusone.js';
   var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
 })();
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','../www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-42806056-1', 'timmytompkinsapp.com');
  ga('send', 'pageview');

</script>

</body>
</html>
