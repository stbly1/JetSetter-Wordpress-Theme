
var headerSrc;
var headerRollover;

function jetsetterHeader(){
    this.initHeader = initHeader;
    this.headerSrc = null;
    this.headerRollover = null;
}

function headerOver(){
	if(headerRollover == null){
		headerRollover = $('#header-image-rollover').attr('src');
		headerSrc = $('#header-image-display').attr('src');
	}
	$('#header-image-rollover').css({'height':'auto'});
	$('#header-image-rollover').attr('src',headerRollover);
}

function headerOut(){
	$('#header-image-rollover').css({'height':'0'});
}

function initHeader(){
    if($('#header-image').length>0){
		$('#header-image').mouseenter( headerOver ).mouseleave( headerOut );
    }
}