/*
 Main Page JS file for the WordPress Theme @JetSetter
*/

var imageHeight;
var scroll=0;
var d;
var c;
var scrollPercent;
var topMax;
var currentTop;	
var imageHeight;
var jsHeader;
var isHandheldDevice = false;

function sizeImage(){
	var containerHeight;
	if($(window).width() < 600){
		if(isHandheldDevice){
			imageHeight=$(window).height()+100;
		}else{
			imageHeight='100%';
		}
		$('#background-image-container').css({'height':imageHeight});
		//$('#background-image-container').css({'margin-top': -scroll + 'px'});

	}else{
		imageHeight=$(window).height()+($(window).height()*.1);
		$('#background-image-container').css({'height':imageHeight});
		$('#background-image-container').css({'margin-top': 0 + 'px'});

	}
	$('.background-image').each(function(){
		var backgroundImage = $(this).css('backgroundImage');
		$(this).css({'height':imageHeight});
		$(this).css({'backgroundImage':backgroundImage});
	});
}
var currentAnimation1;
var currentAnimation2;
var siteInit = false;
function resizeObjects(){
	if(!siteInit){
		siteInit=true;
		fadeSite();
	}
	i=0;
	sizeObjects('.region','.region-title',20);
	sizeObjects('.nav-item','.nav-item-title')
	$('.post-preview').each(function(){
		i++;
		var thisWidth = $(this).width();
		var titleWidth = $('#title',this).width();
		var excerptWidth = $('#excerpt',this).width();
		if($(window).width()<=600){
			$('#excerpt',this).css({'width':'100%'});
		}else{
			$('#excerpt',this).css({'width':thisWidth-titleWidth-2+'px'})
		}
		
	})
	if(currentAnimation1 == null){
		$('#post-container').css({'height':$('#post-preview-'+currentNumber).height()+15});
		$('#current-post-container').css({'height':$('#post-preview-'+currentNumber).height()+15});
	}
	if(!isHandheldDevice){
		sizeImage();
	}
	if($(window).width() < 600){
		$('#selector').css({'margin-top':'50'});
	}
	fontSize = 36;
	if($('#tagline').length > 0){
		$('#tagline').css({'font-size':fontSize});
		while($('#tagline span').width() >= $('#tagline').width()){
			fontSize = fontSize - 1;
			$('#tagline').css({'font-size':fontSize});
		}
		$('#tagline').css({'margin-top':$('#tagline').width()*-.09});
	}
	sizeRegionalNavigation();
	d = $(document).height(),
	c = $(window).height();
}


function sizeObjects($_class,$_title,$_padding){
	if($_padding == null){
		$_padding = 0;
	}
	var target = $($_class);
	var tallestRegion=0;
	target.each(function(){
		$(this).css({'height':'inherit'});
		var regionHeight = $(this).height();
		if(regionHeight > tallestRegion){
			tallestRegion = regionHeight + $_padding;
		}
	})
	target.css({'height':tallestRegion+'px'});

	target.each(function(){
		var title = $($_title,this);
		title.css({'padding-top': ($(this).height() - title.height())/2});
	});
}

function scrollImage(){
	scroll = $(window).scrollTop();
	if($(window).width()>600){
		scrollPercent = (scroll / (d-c)) * 100;
		topMax = d - imageHeight;
		currentTop = topMax * (scroll / (d-c));
		//$('#background-image-container').css({'top':currentTop+'px'});
		$('#background-image-container').css({'-webkit-transform':'translate3d(0px, '+currentTop+'px, 0px)'});
		$('#background-image-container').css({'-moz-transform':'translate3d(0px, '+currentTop+'px, 0px)'});
	}else{
	}
}

function sliderButtonClick($_number){
    changeFeaturedContent($_number);
}

function prevPost(){
	currentNumber--;
	if(currentNumber < 1){
		changeFeaturedContent(numberOfPosts);
	}else{
		changeFeaturedContent(currentNumber)
	}
}
function nextPost(){
	currentNumber++;
	if(currentNumber > numberOfPosts){
		changeFeaturedContent(1);
	}else{
		changeFeaturedContent(currentNumber)
	}
}

var currentButton;
var currentNumber;
var previousImage;
var numberOfPosts;
var currentPostPreview;
var currentPostsSwapping=0;
function changeRadioButton(){
    if(currentButton){
        currentButton.removeAttr("style");
    }
    currentButton = $('#radio-btn-'+currentNumber);
    currentButton.css({'background-color':'#fff'});
}

function changeImage(){
	var targetImage = $('#background-image-'+currentNumber).clone();
	$('#background-image-container').append(targetImage);
	targetImage.css({'left':0});
	targetImage.css({'z-index':5});
	if(previousImage){
		previousImage.css({'z-index':10});
		/*previousImage.animate({
			left: $(window).width(),
		}, 1000,function(){
			$(this).remove();
		});*/
		var prop;
		previousImage.animate(
			{ prop: $(window).width() },
			{ step: function(now,fx) {
			        $(this).css('-webkit-transform',"translate3d(" + now + "px, 0px, 0px)");
			        $(this).css('-moz-transform',"translate3d(" + now + "px, 0px, 0px)");
			    },
			    duration:1000,
			    complete:function(){
					$(this).remove();
				}
			},
			'expoEaseOut'
		);
	}
	
	previousImage = targetImage;
}

function changePostPreview(){
	if($('#current-post-container .post-preview').length > 1){
		$('#current-post-container .post-preview').first().remove();
	}
	var targetPost = $('#post-preview-'+currentNumber).clone();
	$('#current-post-container').append(targetPost);

	if(currentPostPreview){
		if(currentAnimation1){
			currentAnimation1.stop();
		}
		if(currentAnimation2){
			currentAnimation2.stop();
		}
		currentAnimation1 = $('#post-container').animate({
			height: $('#post-preview-'+currentNumber).height()+15,
		}, 1000,function(){
			currentAnimation1 = null;
		});
		currentAnimation2 = $('#current-post-container').animate({
			height: $('#post-preview-'+currentNumber).height()+15,
		}, 1000,function(){
			currentAnimation2=null;
		});
		currentPostPreview.animate({
			marginTop: -1 * currentPostPreview.height()-20,
		}, 1000,function(){
			resizeObjects();
			$(this).remove();
		});
	}

	/*console.log(targetPost.height());
	$('#post-container').animate({
		height: targetPost.height(),
	}, 1000);
	$('#current-post-container').animate({
		height: targetPost.height(),
	}, 1000);*/
	currentPostPreview=targetPost;
}


function changeFeaturedContent($_number){
    currentNumber = $_number;
    changeRadioButton();
    changeImage();
    changePostPreview();
    setTimeout(resizeObjects,500);
}

function fadeSite(){
	$('#masthead').css({'top':0});
	$('#content').css({'opacity':1});
	$('#masthead').css({'opacity':1});
	//removeTweens($('#masthead'));
}

$expoEaseOut = 'cubic-bezier(0.090, 0.425, 0.115, 0.995)';
function prepareTween($_target, $_type, $_time){
	_target = $_target;
	_type = $_type;
	_time = $_time;
	_target.css({'transition':_type + ' ' + _time});
	_target.css({'-webkit-transition':_type + ' ' + _time});
	$('#masthead').css({'transition-timing-function':$expoEaseOut});
	$('#masthead').css({'-webkit-transition-timing-function':$expoEaseOut});
}

function removeTweens($_target){
	_target = $_target;
	_target.css({'transition':'inherit'});
	_target.css({'-webkit-transition':'inherit'});
	$('#masthead').css({'transition-timing-function':'inherit'});
	$('#masthead').css({'-webkit-transition-timing-function':'inherit'});
}

var regions = [];
var regionGroups = [];
var imageString;
function sizeRegionalNavigation(){
	if(imageString==null){
		imageString = $('.region').css('background-image');
	}
	$('.category-navigation .container').css({'width':$('.category-navigation').width()+1});
	$('.category-navigation .container').each(function(){
		var regionsInGroup = $('.region',this).length;
		for(var i=0; i<regionsInGroup; i++){
			var region = $(this).children().eq(i);
			if($(window).width()>600){
				//console.log(Math.ceil((((regionGroupIterator - 1)*10)/regionGroupIterator)));
				var regionWidth = Math.floor(($('.category-navigation').width()/regionsInGroup) -  Math.ceil((((regionsInGroup - 1)*10)/regionsInGroup)));
				region.css({'width':regionWidth});

			}else{
				region.css({'width':$('.category-navigation').width()});
			}
			var regionImage = region.attr('id')+'-thumb';
			var base = imageString;
			var image = base.replace('thumb',regionImage);
			console.log(image);
			region.css({'background-image':image});
	    }
	});
    
}

function formatRegionalNavigation(){
	var regionCount = 0;
    $('.region').each(function(){
    	regions.push($(this));
    	regionCount++;
    })
    var container;
    var regionGroupIterator;
    if(regions.length > 4){
    	regionGroupIterator = 3;
    }else{
    	for(var i=3; i>0; i--){
    		if(regions.length % i == 0){
    			regionGroupIterator = i;
    			break;
    		}
    	}
    }
    for(var i=0; i<regions.length; i++){
    	if(i % regionGroupIterator == 0){
    		container = $('<div>', {class:'container'});
    		$('.category-navigation').append(container);
    	}
    	container.append(regions[i]);
    }
    sizeRegionalNavigation();
    $('.category-navigation').append($('#category-navigation-clear'));
}

function initSite(){
	console.log('jetsetter_v1');
    if( jQuery.browser.mobile ) {
    	console.log('handheld device');
    	isHandheldDevice=true;
	}else{
		console.log('not a handheld device');
	}
	sizeImage();
    setTimeout(fadeSite,500);
    window.addEventListener("scroll",scrollImage);
    numberOfPosts = $('.post-preview').length;
    changeFeaturedContent(1);
    jsHeader = new jetsetterHeader();
    jsHeader.initHeader();
    formatRegionalNavigation();
    $(window).resize(function() {
        resizeObjects();
    });
}

$(document).ready(function(){
    initSite();
});