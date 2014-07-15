/*
 Main Page JS file for the WordPress Theme @JetSetter
*/

var siteInit = false;
var jsHeader;

function resizeObjects(){
	sizeImages();
	fontSize = 36;
	if($('#tagline').length > 0){
		$('#tagline').css({'font-size':fontSize});
		while($('#tagline span').width() >= $('#tagline').width()){
			fontSize = fontSize - 1;
			$('#tagline').css({'font-size':fontSize});
		}
		$('#tagline').css({'margin-top':$('#tagline').width()*-.09});
	}
	if($(window).width() < 900){
		var backgroundSize = 'auto ' + (40 + $('#featured-image-header').height()) +'px';
		$('#image-container').css({'background-size':backgroundSize});
	}else{
		$('#image-container').css({'background-size':'cover'});
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
	$('.preloader').css({'opacity':0});
}

function sizeImages(){
	var singleImageHeight;
	var doubleImageHeight;
	var tripleImageHeight;
	var featuredImageHeight;
	var imageMargin;
	var altImageMargin;
	/*$('.size-full').each(function(){
		$(this).attr('width',$(window).width());
		$(this).attr('height','auto');
	});*/
	$('#featured-image-header').css({'height':$(window).height()-20});

	$('.featured-image').css({'width':$(window).width()});
	$('.single-image').css({'width':$(window).width() - 22});
	$('.double-image').css({'width':$(window).width()/2-16});
	$('.double-image-container').css({'width':$(window).width()});
	$('.triple-image-container').css({'width':$(window).width()});
	$('.triple-image').css({'width':$(window).width()/3-14});
	
	if($(window).width()<600){
		singleImageHeight = $('.single-image').width();
		doubleImageHeight = $('.double-image').width();
		tripleImageHeight = $('.triple-image').width();
		featuredImageHeight = $(window).width();
		imageMargin = -40 + 'px';
		altImageMargin = -30+'px';
	}else if($(window).width()<800){
		singleImageHeight = $(window).width()*.85;
		doubleImageHeight = ($(window).width()/2)*.75;
		tripleImageHeight = $(window).width()/3*.75;
		featuredImageHeight = $(window).height()*.85;
		imageMargin = $(window).width()*-.1;
		altImageMargin = 10 + ($(window).width()*-.1)
	}else{
		singleImageHeight = $(window).height();
		doubleImageHeight = $(window).height()/2;
		tripleImageHeight = $(window).height()/3;
		featuredImageHeight = $(window).height();
		imageMargin = $(window).width()*-.1;
		altImageMargin = 10 + ($(window).width()*-.1)
	}

	$('.featured-image').css({'height':featuredImageHeight});
	$('.triple-image-container').css({'margin-left':imageMargin});
	$('.featured-image').css({'margin-left':imageMargin})
	$('.double-image-container').css({'margin-left':imageMargin});
	$('.single-image').css({'margin-left':altImageMargin})
	$('.single-image').css({'height':singleImageHeight});
	$('.double-image').css({'height':doubleImageHeight});
	$('.double-image-container').css({'height':doubleImageHeight});
	$('.triple-image').css({'height':tripleImageHeight});
	$('.triple-image-container').css({'height':tripleImageHeight});
}

function initSite(){
	/*if($('.post-thumbnail img').length > 0){
		$('.post-thumbnail img').attr('width','100%');
		$('.post-thumbnail img').attr('height','auto');
	}*/
    jsHeader = new jetsetterHeader();
    jsHeader.initHeader();
	var doubleImages = [];
	$('img.double').each(function(){
		doubleImages.push(this);
	})
	var doubleImageContainer;
	for(var i=0; i<doubleImages.length; i++){
		var targetImage = $(doubleImages[i]);
		if(targetImage.is( "a" )){
			targetImage = targetImage.find( "img" );
		}
		var linkContainer = $('<a>',{href:$(targetImage).attr('src')});
		var doubleImage = $("<div>", {class: "double-image"});

		var root = targetImage.parent().parent();
		var caption;

		if(i % 2 ==0){
			doubleImageContainer = $("<div>", {class: "double-image-container"});
			var newImage = targetImage.clone();
			if(root.is('figure') || root.is('p')){
				var galleryCaption = $('figcaption',root).text();
				caption = $("<div>", {class: "gallery-caption"});
				caption.append(galleryCaption);
				root.replaceWith( doubleImageContainer);
				doubleImage.append(caption);
			}else{
				targetImage.replaceWith( doubleImageContainer);
			}
			doubleImageContainer.append(linkContainer);
			linkContainer.append(newImage);
			newImage.replaceWith(doubleImage);
		}else{
			if(root.is('figure') || root.is('p')){
				var galleryCaption = $('figcaption',root).text();
				caption = $("<div>", {class: "gallery-caption"});
				caption.append(galleryCaption);
				root.remove();
				doubleImage.append(caption);
			}
			doubleImageContainer.append(linkContainer);
			linkContainer.append(targetImage);
			targetImage.replaceWith(doubleImage);
			doubleImage.css({'margin-left':0});
		}
		doubleImage.css({'background-image':'url(' + targetImage.attr('src') +')'});
		if(i % 2!=0){
			doubleImageContainer.append($("<div>", {class: "clear"}));
		}
	}
	var tripleImages = [];
	$('img.triple').each(function(){
		tripleImages.push(this);
	})
	var prevIteration=0;
	for(var i=0; i<tripleImages.length; i++){
		var targetImage = $(tripleImages[i]);
		if(targetImage.is( "a" )){
			targetImage = targetImage.find( "img" );
		}
		var linkContainer = $('<a>',{href:$(targetImage).attr('src')});
		var tripleImage = $("<div>", {class: "triple-image"});
		
		var root = targetImage.parent().parent();
		var caption;
		var htmlType = root.prop('tagName') //Example
		if(i % 3 == 0){
			tripleImageContainer = $("<div>", {class: "triple-image-container"});
			var newImage = targetImage.clone();
			if(root.is('figure') || root.is('p')){
				var galleryCaption = $('figcaption',root).text();
				caption = $("<div>", {class: "gallery-caption"});
				caption.append(galleryCaption);
				root.replaceWith( tripleImageContainer);
				tripleImage.append(caption);
			}else{
				targetImage.replaceWith( tripleImageContainer);
			}
			tripleImageContainer.append(linkContainer);
			linkContainer.append(newImage);
			newImage.replaceWith(tripleImage);
		}else{
			if(root.is('figure' || root.is('p'))){
				var galleryCaption = $('figcaption',root).text();
				caption = $("<div>", {class: "gallery-caption"});
				caption.append(galleryCaption);
				root.remove();
				tripleImage.append(caption);
			}
			tripleImageContainer.append(linkContainer);
			linkContainer.append(targetImage);
			targetImage.replaceWith(tripleImage);
			if(i / (prevIteration+1) == 1){
				tripleImage.css({'margin-left':0});
				tripleImage.css({'margin-right':0});
			}
		}
		tripleImage.css({'background-image':'url(' + targetImage.attr('src') +')'});
		if(i / (prevIteration+2) == 1){
			tripleImageContainer.append($("<div>", {class: "clear"}));
		}
	}
	$('img.featured').each(function(){
		var imageDiv = $("<div>", {class: "featured-image"});
		var parentIsAnchorTag = $(this).parent().is('a');
		imageDiv.css({'height':$(window).height()});
		imageDiv.css({'background-image':'url(' + $(this).attr('src') +')'});
		imageDiv.css({'width':$(this).width()});
		imageDiv.css({'margin-left':$(window).width()*-.1});
		var root = $(this).parent().parent();
		var caption;
		if(root.is('figure') || root.is('p')){
			var galleryCaption = $('figcaption',root).text();
			caption = $("<div>", {class: "gallery-caption"});
			caption.append(galleryCaption);
			imageDiv.append(caption);
			if(parentIsAnchorTag){
				root.replaceWith( $(this).parent() );
				$(this).replaceWith( imageDiv );
			}else{
				root.replaceWith( imageDiv );
			}
		}else{
			$(this).replaceWith( imageDiv );
		}
	})
	$('img.single').each(function(){
		var target;
		var parentIsAnchorTag = $(this).parent().is('a');
		//var linkContainer = $('<a>',{href:$(targetImage).attr('src')});
		var imageDiv = $("<div>", {class: "single-image"});
		imageDiv.css({'height':$(window).height()});
		imageDiv.css({'background-image':'url(' + $(this).attr('src') +')'});
		imageDiv.css({'width':$(this).width()});
		imageDiv.css({'margin-left':($(window).width()*-.1)+10})
		var root = $(this).parent().parent();
		var caption;
		if(root.is('figure') || root.is('p')){
			var galleryCaption = $('figcaption',root).text();
			caption = $("<div>", {class: "gallery-caption"});
			caption.append(galleryCaption);
			imageDiv.append(caption);
			if(parentIsAnchorTag){
				root.replaceWith( $(this).parent() );
				$(this).replaceWith( imageDiv );
			}else{
				root.replaceWith( imageDiv );
			}
		}else{
			$(this).replaceWith( imageDiv );
		}
	})
    setTimeout(resizeObjects,500);
    $(window).resize(function() {
        resizeObjects();
    });
}

$(document).ready(function(){
    initSite();
});