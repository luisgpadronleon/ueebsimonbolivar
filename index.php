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
				<a href="javascript:void(0);" onclick="smoothjump('about')" class="menu_item withtrans">Nosotros</a>
				<a href="javascript:void(0);" onclick="smoothjump('who')" class="menu_item withtrans">Descargas</a>
				<a href="javascript:void(0);" onclick="smoothjump('buy')" class="menu_item withtrans">Galería</a>
                <a href="javascript:void(0);" onclick="smoothjump('contact')" class="menu_item withtrans">Contáctos</a>
                <a href="login.php" class="menu_item withtrans">Ingresar</a>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
<!-- <div class="topmenu_trigger"></div> -->

<div class="wrapper hero" id="hero">
	<div class="brown-table"></div>
	<div class="toys">
		<img src="images/toys.png" title="UEEB “SIMÓN BOLÍVAR”" />
	</div>
	<div class="arrow_down_container">
		<a href="#" class="btn arrow_down"><span class="cover"></span></a>
	</div>
	<div class="content">
		<img src="images/top_intro1.png" class="top_intro" />
	</div>
</div>


<div class="wrapper about" id="about">
	<div class="content">
		<h1>Nuestra Institución</h1>
		<p style="font-size:14px; line-height:18px;">La Unidad Educativa Estatal Bolivariana. “Simón Bolívar”, tiene como MISIÓN, Educar a los niños, niñas, adolescentes y jóvenes  de la comunidad de El Hornito y de las comunidades que participen en ella, para constituir una generación a través de una educación de calidad que permita lograr su desarrollo integral como ciudadanos y ciudadanas democráticos(as), participativos(as), protagónicos(as), solidarios(as), conscientes, críticos, reflexivos(as), consustanciados(as) con su identidad nacional, latinoamericana y universal, para que esta educación sirva para la vida.</p>
        <p style="font-size:14px; line-height:18px;">Tiene como VISIÓN, Impartir una educación integral de calidad orientada hacia la excelencia, garante de los principios constitucionales y del desarrollo pleno de la personalidad, como al logro de la transformación de ciudadanos y ciudadanas soportados en inquebrantables valores espirituales, morales, éticos, y sociales, que influyan de manera positiva al contexto social y cultural, además del papel de defensor del niño, niña, adolescentes y jóvenes, ante el Estado y la Familia.</p>
	</div>
</div>	
<div class="wrapper who" id="who">
	<div class="content">
		<div class="left">
			<h1>Descargas</h1>
			<p>Consigue aquí constancias de Estudios y Constancias de Inscripción.</p>
			<a href="#" target="_blank" class="button withtrans" style="font-size:16px;">Constancia de Estudios</a>
			<a href="#" target="_blank" class="button withtrans" style="font-size:16px;">Constancia de Inscripción</a>
		</div>		
		<img src="images/bg_who.jpg" class="bg_who" />
	</div>
</div>	
<div class="wrapper buy" id="buy">
	<div class="content">
		<h1>Galería</h1>
		<div class="carousel">
			<div class="ipad"></div>
			<div class="rs-carousel carousel_slides">
				<ul>
					<li><img src="images/slide1.png" /></li>
					<li><img src="images/slide2.png" /></li>
					<li><img src="images/slide3.png" /></li>
					<li><img src="images/slide4.png" /></li>
					<li><img src="images/slide5.png" /></li>
					<li><img src="images/slide6.png" /></li>
				</ul>
			</div>
			<div class="carousel_arrow left"><span class="cover withtrans" ></span></div>
			<div class="carousel_arrow right"><span class="cover withtrans" ></span></div>
		</div>
	</div>
</div>	
<div class="wrapper share" id="share">
	<div class="content">
		<h1>Visita nuestas Redes</h1>
		<div class="btn_share_container">
			<a href="#" class="btn_share facebook"><span class="cover">Facebook</span></a>
			<a href="#" class="btn_share twitter"><span class="cover">Twitter</span></a>
			<a href="#" class="btn_share google g-interactivepost"><span class="cover">Google</span></a>
			<div class="clear"></div>
		</div>
        <ul class="instituciones">
			<li><img src="images/pae.png" width="94" height="75" /></li>
          	<li><img src="images/fundabit.png" width="200" height="66" /></li>
          	<li><img src="images/me.png" width="200" height="58" /></li>
          	<li><img src="images/opasme.png" width="200" height="72" /></li>
	  	</ul>
	</div>

</div>	


<div class="wrapper share" id="contact">
	<div class="content">
		<h1 style="margin-top:-170px; margin-bottom:10px;">Contáctanos</h1>
        <div style="margin-bottom:15px;">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1960.4062426080445!2d-71.5241443715208!3d10.671658447040498!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses-419!2sve!4v1414520479503" width="100%" height="200" frameborder="0" style="border:0"></iframe>        
        </div>
        <div class="direccion">
        	<ul>
            	<li>Avs. 3 y 4 manzana 28 urb. el nuevo hornito.</li>
                <li>Municipio Miranda</li>
                <li>Estado Zulia</li>
                <li>Teléfonos</li>
                <li>contacto@ueebsimonbolivar.com.ve</li><br />
                <li style="float:left;">
                    <div class="btn_share_container">
                        <a href="#" class="btn_share facebook"><span class="cover">Facebook</span></a>
                        <a href="#" class="btn_share twitter"><span class="cover">Twitter</span></a>
                        <a href="#" class="btn_share google g-interactivepost"><span class="cover">Google</span></a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="contactos">
        
<form action="prose-form.php" method="post" class="contact-form"  onsubmit="return validar(this);">				
			<div class="formulario">
				<div class="column">
					<label for="nombre">Nombre <span>(requerido)</span></label>
					<input type="text" name="nombre" class="form-input" onblur="revisar(this);"/>
					
					<label for="email">Email <span>(requerido)</span></label>
					<input type="email" name="email" class="form-input" onblur="revisar(this); revisaremail(this);"/>
					
					<label for="asunto">Asunto <span>(requerido)</span></label>
					<input type="text" name="asunto" class="form-input" onblur="revisar(this);"/>
				</div>
				
				<div class="column">
					<label for="mensaje">Mensaje </label>
					<textarea name="mensaje" class="form-input" ></textarea>
				</div>				
				
				<input class="form-btn" type="submit" value="Enviar Mensaje"/>
			</div>		
		</form>

        </div>
        
	</div>
	
	<div class="footer">
		<div class="footer_content">
			<div class="right">
				<span>Derechos Reservados &copy; 2014 <a href="http://www.puertolab.com.ve/" target="_blank" class="withtrans">puertoLab</a> &amp; <a href="http://www.puertolab.com.ve/" target="_blank" class="withtrans">puertoLab</a></span>

			</div>
			<div class="clear"></div>
		</div>
	</div>
		
		
	<a href="javascript:void(0);" class="gototop" onclick="smoothjump('hero')">
		<span class="back withtrans"></span>
		<span class="cover withtrans"></span>
	</a>
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
