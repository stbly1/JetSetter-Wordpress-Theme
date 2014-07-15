/*
 Gallery Page JS file for the WordPress Theme @JetSetter
*/

var siteInit = false;
function resizeObjects(){
	if(!siteInit){
		siteInit=true;
		fadeSite();
	}
	sizeGalleryImage();
	$('#primary').css({'margin-bottom':$('.site-footer').height()});
	sizeImages();
}

var originalWidth;
var originalHeight;
function preSizeImage($_target, $_widthCheck){
	console.log($(window).width(), $_widthCheck);
	if( $(window).width() > $_widthCheck ){
		console.log('case1');
		$_target.css({'height':'calc(100% - 80px)'});
		$_target.css({'height':'-webkit-calc(100% - 80px)'});
		$_target.css({'width':'auto'});
	}else{
		console.log('case2');
		$_target.css({'height':'auto'});
		$_target.css({'width':'100%'});
	}
	$_target.css({'margin-left':(-$_target.width())/2 - 20});
	$_target.css({'margin-top':-($_target.height()/2) - 20});
}

function sizeGalleryImage(){
	if(originalWidth==null){
		originalWidth = currentImage.width();
		originalHeight = currentImage.height();
		console.log('original image size = ',originalWidth,originalHeight);
	}
		preSizeImage(currentImage, originalWidth);
	/*if($(window).width() < 900){
		var backgroundSize = 'auto ' + (40 + $('#featured-image-header').height()) +'px';
		$('#image-container').css({'background-size':backgroundSize});
	}else{
		$('#image-container').css({'background-size':'contain'});
	}*/
}

function fadeSite(){
	$('.header-main').css({'opacity':1});
	$('#main').css({'opacity':1});
	$('#featured-image-header').css({'opacity':1});
	$('.site-footer').css({'opacity':1});
	$('.preloader').css({'opacity':0});
}

function sizeImages(){
	$('#featured-image-header').css({'height':$(window).height()-20});
	
}

var galleryImages = [];
var galleryContainers = [];

function initSite(){
	var gallerySliderControls = $("<div>", {id: "selector"});
	var gallerySliderContainer = $("<div>", {id: "selector-container"});
	var galleryParagraph = $("<p>", {text: "Select an Image:"})
	gallerySliderContainer.append(galleryParagraph)

	$('.entry-content img').each(function(){
		galleryImages.push(this);
	})
	for(var i=0; i<galleryImages.length; i++){
		var targetImage = $(galleryImages[i]);
		var galleryImage = $("<img>", {id: "image-container"});
		var src = targetImage.attr('src');
		var caption;
		var root = targetImage.parent().parent();
		if(root.is('figure')){
			var galleryCaption = $('figcaption',root).text();
			caption = $("<div>", {class: "gallery-caption"});
			caption.append(galleryCaption);
			galleryImage.append(caption);
		}
		var gradient = $("<div>", {class: "background-gradient"});
		galleryImage.append(gradient);
		galleryImage.attr('src',src);
		
		var gallerySelector = $('<div>', {class:'radio-btn',id:'radio-btn-'+i,onclick:'switchGalleryImage('+i+')'});
		gallerySliderContainer.append(gallerySelector);
		galleryContainers.push(galleryImage);
		galleryImage.css({'z-index':10});
		galleryImage.remove();
		targetImage.remove();
		root.remove();
	}
	var descriptionText = $('#gallery-description').text();
	if(descriptionText.length == 0){
		$('.entry-content p').each(function(){
			var target = $(this).text();
			console.log(target);
			$('#gallery-description').append(target);
		});
	}
	gallerySliderContainer.append($("<span>", {class:'instructions',text: "(Use Arrow Keys/Swipe to Change Images)"}))
	gallerySliderControls.append(gallerySliderContainer);
	$('#content').append($('<div>',{id:'caption-container'}));
	$('#content').append(gallerySliderControls);
	$('#content').append($('article'));
	$('#content').append($('<div>',{class:'clear'}));
    setTimeout(resizeObjects,500);
    $(window).resize(function() {
        resizeObjects();
    });
	$("#featured-image-header").swipe( { fingers:'all', swipeLeft:nextImage, swipeRight:prevImage, allowPageScroll:"auto", threshold:30} );

    $(document).keydown(function(e){
	    if (e.keyCode == 37) {
	    	console.log('prev image');
	    	prevImage();
	    }
	    if (e.keyCode == 39) {
	    	console.log('next image');
	    	nextImage();
	    }
	});
    switchGalleryImage(0);

}
var currentImage;
var currentButton;
var currentNumber;

var galleryToggled=false;
function toggleGalleriesGallery(){
	if(galleryToggled){
		galleryToggled = false;
		$('#galleries-navigation').css({'height':'0px'});
	}else{
		galleryToggled = true;
		$('#galleries-navigation').css({'height':'auto'});
	}
}

function prevImage(){
	currentNumber--;
	if(currentNumber < 0){
		switchGalleryImage((galleryContainers.length-1));
	}else{
		switchGalleryImage(currentNumber)
	}
}
function nextImage(){
	currentNumber++;
	if(currentNumber > (galleryContainers.length-1)){
		switchGalleryImage(0);
	}else{
		switchGalleryImage(currentNumber)
	}
}

function switchGalleryImage($_i){
	var oldImage;
	currentNumber = $_i;
	changeRadioButton();
	if(currentImage){
		$('#inactive-container').append(currentImage);
		currentImage.css({'z-index':15});
		oldImage = currentImage;
	}
	var target = $(galleryContainers[$_i]);
	$('#active-container').append(target);
	target.css({'z-index':20});
	target.css({'opacity':0});
	preSizeImage(target,target.width());
	target.animate({
		opacity: 1,
	}, 500, function() {
		originalWidth = null;
		sizeGalleryImage();
		if(oldImage)
			oldImage.remove();
	});
	if(oldImage){
		oldImage.animate({
			opacity: 0,
		}, 500, function() {
			oldImage.remove();
		});
	}
	currentImage = target;
	if($('.gallery-caption', currentImage).length > 0){
		var caption = $('.gallery-caption', currentImage).text();
		$('#caption-container').append($('<span>',{text:caption}));
		$('#caption-container').css({'padding':20});
	}else{
		$('#caption-container span').remove();
		$('#caption-container').css({'padding':10});
	}
}

function changeRadioButton(){
    if(currentButton){
        currentButton.removeAttr("style");
    }
    currentButton = $('#radio-btn-'+currentNumber);
    currentButton.css({'background-color':'#fff'});
}

$(document).ready(function(){
    initSite();
});