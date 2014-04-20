// JavaScript Document

jQuery(function ($) {
	
// http://paulirish.com/2011/requestanimationframe-for-smart-animating/
// http://my.opera.com/emoller/blog/2011/12/20/requestanimationframe-for-smart-er-animating
 
// requestAnimationFrame polyfill by Erik Möller. fixes from Paul Irish and Tino Zijdel
 
// MIT license
 
(function() {
    var lastTime = 0;
    var vendors = ['ms', 'moz', 'webkit', 'o'];
    for(var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
        window.requestAnimationFrame = window[vendors[x]+'RequestAnimationFrame'];
        window.cancelAnimationFrame = window[vendors[x]+'CancelAnimationFrame'] 
                                   || window[vendors[x]+'CancelRequestAnimationFrame'];
    }
 
    if (!window.requestAnimationFrame)
        window.requestAnimationFrame = function(callback, element) {
            var currTime = new Date().getTime();
            var timeToCall = Math.max(0, 16 - (currTime - lastTime));
            var id = window.setTimeout(function() { callback(currTime + timeToCall); }, 
              timeToCall);
            lastTime = currTime + timeToCall;
            return id;
        };
 
    if (!window.cancelAnimationFrame)
        window.cancelAnimationFrame = function(id) {
            clearTimeout(id);
        };
}());

	var stickyNav = {
		init : function(){ 	 
		},
		
	}
	
	$(window).resize(function(e) {
		var height = $('#main-nav').outerHeight();
    //    $('#wallpaper-content').css({paddingTop:height})
    });
	  
$(window).scroll(function(e){	$('#main-nav').toggleClass('addLogo', $(window).scrollTop() >= 195);  });	

hideNav = function(e){

	var keepGoing = true;
	console.log(e);
	for (var i in e.target.parentElement.classList) {
		if (e.target.parentElement.classList[i] == 'menu-item') keepGoing = false;
	}

	if(e.target.id != 'nav-label' && keepGoing){
		$('#main-nav').removeClass('expand');
		$(e.data).off('click tap touchstart', null, null, hideNav);
		$('#nav-label, #nav-label > object').on('click tap', null, null, showNav);
	}
}

showNav = function(e){
	$('#main-nav').addClass('expand');
	var args = "#main-content, #mainhead, #mainfoot";
	$('#nav-label, #nav-label > object').off('click tap', null, null, showNav);
	$(args).on('click tap touchstart', null, args, hideNav );
}


	
$(document).ready(function(e) {

	if($('html').hasClass('wallpaper-ad')){
			var contentWidth = $(document).width() - 400;
			$('#NoN-content').css({width:contentWidth});
			
			$(window).resize(function(e){
			var contentWidth = $(document).width() - 400;
			$('#NoN-content').css({width:contentWidth});
		}); 
	}
	$('#nav-logo, #nav-label').prependTo('#main-nav').attr('style', '');
/*	$('.main-nav-post-nav') 
		.each(function(){
			var navlink = '<li class="menu-item" title="' + $(this).attr('title') + '">' + $(this).html() + '</li>';		
			console.log(this);
			$(this).remove();
			$('#menu-main-navigation').append(navlink);
		});*/
	$('#main-nextprev').appendTo('#main-nav').attr('style', '');	
		
	$('#nav-label, #nav-label > object').on('click tap', null, null, showNav); 
	

});

}); // jQuery encapsulation
