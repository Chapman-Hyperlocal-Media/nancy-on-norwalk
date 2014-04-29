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

////////////////////////

(function($,sr){

  // debouncing function from John Hann
  // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
  var debounce = function (func, threshold, execAsap) {
      var timeout;

      return function debounced () {
          var obj = this, args = arguments;
          function delayed () {
              if (!execAsap)
                  func.apply(obj, args);
              timeout = null;
          };

          if (timeout)
              clearTimeout(timeout);
          else if (execAsap)
              func.apply(obj, args);

          timeout = setTimeout(delayed, threshold || 100);
      };
  }
  // smartresize 
  jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };
})(jQuery,'smartresize');

//////////////////////// 

/*var stickyNav = {
	init : function(){ 	
	},
	
}*/

var $window = $(window),
	$mainNav = $('#main-nav'),
	$document = $(document),
	$mainContent = $('#main-content'),
	$sidebar = $mainContent.find('aside.sidebar'),
	$adSlots =  $sidebar.find('li.widget.adzerk-ad-slot')
	$ads = $adSlots.find('div.adzerk-ad'),
	$mobileAdSlots = $mainContent.find('div.content > div.mobile-ad-slot'),
	adsInSidebar = true;

$window.smartresize(function(e) {
	var height = $mainNav.outerHeight();
});
	  
$window.scroll(function(e){	$mainNav.toggleClass('addLogo', $window.scrollTop() >= 195);  });	

hideNav = function(e){

	var keepGoing = true;
	//console.log(e);
	for (var i in e.target.parentElement.classList) {
		if (e.target.parentElement.classList[i] == 'menu-item') keepGoing = false;
	}

	if(e.target.id != 'nav-label' && keepGoing){
		$mainNav.removeClass('expand');
		$(e.data).off('click tap touchstart', null, null, hideNav);
		$('#nav-label, #nav-label > object').on('click tap', null, null, showNav);
	}
}

showNav = function(e){
	$mainNav.addClass('expand');
	var args = "#main-content, #mainhead, #mainfoot";
	$('#nav-label, #nav-label > object').off('click tap', null, null, showNav);
	$(args).on('click tap touchstart', null, args, hideNav );
}

mobileAdCheck = function(e){
	var documentWidth = $document.width();
	if(adsInSidebar && documentWidth < 801) {
		console.log('move ads to content');

		var adNum = 0,
			slotNum = 0,
			newSlot = false;

		//console.log($ads); 
		//console.log($mobileAdSlots);

		$ads.each(function(){ 
			$(this).appendTo($mobileAdSlots[slotNum]); 
			adNum++; 
			if (newSlot) {
				slotNum++;
				newSlot = false;
			} 
			else newSlot = true; 
		});

		adsInSidebar = false;
	} 
	else if(!adsInSidebar && documentWidth >= 801) {
		console.log('move ads to sidebar');

		var adNum = 0,
			slotNum = 0;
			
		$ads.each(function(){ 
			$(this).appendTo($adSlots[slotNum]); 
			adNum++; 
			slotNum++;
		});

		adsInSidebar = true;
	}
}

$(document).ready(function(e) {

	if($('html').hasClass('wallpaper-ad')){
			var contentWidth = $document.width() - 400;
			$('#NoN-content').css({width:contentWidth});
			
			$window.smartresize(function(e){
				var contentWidth = $document.width() - 400;
				$('#NoN-content').css({width:contentWidth});
			}); 
	}
	if( $('body').hasClass('single') ){
		var $content = $('#main-content div.the-content'),
			storyHeight = 0,
			i = 1;

		$content.find('p').each(function(){
			storyHeight += $(this).outerHeight();

			if (storyHeight > 500){
				$(this).after('<div id="mobile-ad-slot-' + i + '" class="mobile-ad-slot"></div>');
				storyHeight = 0;
				i++;
			}
		})
		$('#comments-section').find('article.comment.odd').each(function(){
			$(this).after('<div id="mobile-ad-slot-' + i + '" class="mobile-ad-slot"></div>');
			i++;
		})
		$mobileAdSlots = $mainContent.find('div.content div.the-content > div.mobile-ad-slot, #comments-section > div.comments > div.mobile-ad-slot');
	}
	mobileAdCheck();
	$window.smartresize( function(e){ mobileAdCheck(e) });

	$('#nav-logo, #nav-label').prependTo('#main-nav').attr('style', '');

	$('#main-nextprev').appendTo('#main-nav').attr('style', '');	

	$('#nav-label, #nav-label > object').on('click tap', null, null, showNav); 
});

}); // jQuery encapsulation