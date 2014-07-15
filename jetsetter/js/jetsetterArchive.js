/*
 Main Page JS file for the WordPress Theme @JetSetter
*/

function resizeObjects(){
	sizeImages();
}

function sizeImages(){
	if($(window).width()<600){
		$('#featured-image-header').css({'height':$(window).height()});
	}else{
		$('#featured-image-header').css({'height':$(window).height()/1.5});
	}
	$('#image-container').css({'height':$(window).height()/1.5});
	
}

function initSite(){
	resizeObjects();
	$('#content').append($('#secondary'));
    $(window).resize(function() {
        resizeObjects();
    });
}

$(document).ready(function(){
    initSite();
});