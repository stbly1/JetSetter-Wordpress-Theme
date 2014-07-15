/*
 Main Page JS file for the WordPress Theme @JetSetter
*/

var siteInit = false;
var jsHeader;

function resizeObjects(){
	sizeImages();
	$('#primary').css({'margin-bottom':$('.site-footer').height()});
	fontSize = 36;
	if($('#tagline').length > 0){
		$('#tagline').css({'font-size':fontSize});
		while($('#tagline span').width() >= $('#tagline').width()){
			fontSize = fontSize - 1;
			$('#tagline').css({'font-size':fontSize});
		}
		$('#tagline').css({'margin-top':$('#tagline').width()*-.09});
	}
	if(!siteInit){
		siteInit=true;
		fadeSite();
	}
}

function fadeSite(){
	$('.header-main').css({'opacity':1});
	$('#main').css({'opacity':1});
	$('#featured-image-header').css({'opacity':1});
	$('.site-footer').css({'opacity':1});
	$('.preloader').css({'opacity':0});
}

function sizeImages(){
	if($(window).width()<600){
		$('#featured-image-header').css({'height':$(window).height()});
	}else{
		$('#featured-image-header').css({'height':$(window).height()/2.5});
	}
}

function initSite(){
	$('#content').append($('#secondary'));
    jsHeader = new jetsetterHeader();
    jsHeader.initHeader();
    $(window).resize(function() {
        resizeObjects();
    });
    setTimeout(resizeObjects,500);
}

$(document).ready(function(){
    initSite();
});