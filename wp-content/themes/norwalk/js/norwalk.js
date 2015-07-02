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

var $window = $(window),
	$mainNav = $('#main-nav'),
	$document = $(document),
	$mainContent = $('#main-content'),
	$sidebar = $mainContent.find('aside.sidebar'),
	$adSlots =  $sidebar.find('li.widget.goog-ad'),
	$ads = $adSlots.find('div.goog-ad'),
	$mobileAdSlots = $mainContent.find('div.content > div.mobile-ad-slot'),
	adsInSidebar = true;

$window.smartresize(function(e) {
	var height = $mainNav.outerHeight();
});
	  
$window.scroll(function(e){	$mainNav.toggleClass('addLogo', $window.scrollTop() >= 195);  });	

hideNav = function(e){

	var keepGoing = true;

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

norwalkTabsInit = function(e){
	var $tabGroups = $('div.norwalk-tabs');
	$tabGroups.each(function(){
		var $tabs = $(this);
		$tabs.find('.tab-title').each(function(){
			var $title = $(this),
				target = $title.data('tab'),
				text = $title.html(),
				isDefault = $title.parent().hasClass('default') ? true : false,
				buttonClass = isDefault ? 'tab-button active' : 'tab-button';
			$('<div class="'+ buttonClass +'" data-target="' + target + '">' + text + '</div>').insertBefore($title.closest('div.norwalk-tabs').children('.norwalk-tab.first'));
			$tabs.find('.default').addClass('active');
		});
		var $tabButtons = $tabs.find('div.tab-button');
		$tabButtons.click(function(){
			var $button = $(this),
				$target = $button.parent().find('div.' + $button.data('target'));
			if (!$target.hasClass('active')){
				$tabs.children('div.norwalk-tab, div.tab-button').removeClass('active');
				$target.add($button).addClass('active');
			}
		})
	})
}

mobileAdCheck = function(e){
	var documentWidth = $document.width();
	if( documentWidth < 801) {

		var slotNum = 0,
			newSlot = false;


		$ads.each(function(){ 
			$(this).appendTo($mobileAdSlots[slotNum]); 
			////
			////	check to see if element is filled and mark it if so.
			////
			var $thisSlot = $mobileAdSlots.eq(slotNum),
				slotEmpty = true; 
			$thisSlot.find('.goog-ad').each(function(){
				if( $.trim( $(this).html() )  == '' ){
					slotEmpty = true;
				} else {
					slotEmpty = false;
					return;
				}
			});
			
			if( !slotEmpty && !$thisSlot.hasClass('filled') ){
				$thisSlot.addClass('filled');
			}
			if (newSlot) {
				slotNum++;
				newSlot = false;
			} 
			else newSlot = true; 
		});

		googletag.pubads().refresh();
		adsInSidebar = false;
		googletag.enableServices();
	} 
	else if(!adsInSidebar && documentWidth >= 801) {

		var slotNum = 0;
		
		///
		///		Remove the filled marker
		///
		$ads.each(function(){ 
			$(this).appendTo($adSlots[slotNum]); 
			var $thisSlot = $mobileAdSlots.eq(slotNum); 

			if ( $thisSlot.hasClass('filled') ){
				$thisSlot.removeClass('filled')
			} 
			slotNum++;
		});
		
		googletag.pubads().refresh();
		adsInSidebar = true;
		googletag.enableServices();
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
	// $('.widget').each(function(){ 
	// 	try {
	// 		var $this = $(this);
	// 		if ($this.find('iframe').attr('id').search('google_ads') != -1 && $this.find('iframe').contents().find('body').contents().length == 0){
	// 			$this.remove();
	// 		}
	// 	} 
	// 	catch(err) {
	// 	}
	// });
   /*
	*	Mobile ad placement code
	*	
	*	Inserts mobile-ad-slots in between paragraphs on single story pages
	*
	*/
	if( $('body').hasClass('single') ){
		var $content = $('#main-content div.the-content'),
			storyHeight = 0,
			i = 1;

		$content.find('p').each(function(){
			storyHeight += $(this).outerHeight();

			if (storyHeight > 500){		// spacing the ads apart a bit
				$(this).after('<div id="mobile-ad-slot-' + i + '" class="mobile-ad-slot"><p class="ad-label">Advertisement</p></div>');
				storyHeight = 0;
				i++;
			}
		})
		$('#comments-section').find('article.comment.odd').each(function(){
			$(this).after('<div id="mobile-ad-slot-' + i + '" class="mobile-ad-slot comment"><p class="ad-label">Advertisement</p></div>');
			i++;
		})
		$mobileAdSlots = $mainContent.find('div.content div.the-content > div.mobile-ad-slot, #comments-section > div.comments > div.mobile-ad-slot');
		
	} 

	//	Move the ads from the sidebar into mobile ad slots when appropriate.
	//
	if($document.width() < 801){
		tLimit = 0;
		t = setInterval( function(){

			mobileAdCheck();
			if (tLimit >= 5000){
				clearInterval(t);
				googletag.pubads().refresh();
			}
			tLimit += 500;
		}, 500 )
	} else mobileAdCheck();
	$window.smartresize( function(e){ 
		mobileAdCheck(e); 
		googletag.pubads().refresh();
	});

	$('#nav-logo, #nav-label').prependTo('#main-nav').attr('style', '');

	$('#main-nextprev').appendTo('#main-nav').attr('style', '');	

	$('#nav-label, #nav-label > object').on('click tap', null, null, showNav); 

	if($('div.norwalk-tabs').length > 0){
		norwalkTabsInit();
	} else {console.log('no tabs found')}

	$('button.sc-payment-btn.stripe-button-el').click(function(){
		var $this = $(this);
		if (!$this.parents('html').hasClass('cssanimations')){
			//skip this whole thing if the browser can't do a css animation
			return;
		}
		$(this).addClass('stripe-on');
		function stripeCheck(el){
			if (!$('.stripe_checkout_app').is(":visible")){
				el.removeClass('stripe-on');
				return;
			}
			setTimeout(stripeCheck, 500, $this);
		}
		stripeCheck();
	});

});

}); // jQuery encapsulation