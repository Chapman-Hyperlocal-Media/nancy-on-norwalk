
//
// 	Chapman Hyperlocal Media Google ad tags
//

var googletag = googletag || {};
googletag.cmd = googletag.cmd || [];

(function() {
var gads = document.createElement('script');
gads.async = true;
gads.type = 'text/javascript';
var useSSL = 'https:' == document.location.protocol;
gads.src = (useSSL ? 'https:' : 'http:') + 
'//www.googletagservices.com/tag/js/gpt.js';
var node = document.getElementsByTagName('script')[0];
node.parentNode.insertBefore(gads, node);
})(); 

googletag.cmd.push(function() {
    googletag.defineSlot('/1732998/NancyOnNorwalk_extra_300x250_ad_1', [300, 250], 'div-gpt-ad-1508816546283-0').addService(googletag.pubads());
    googletag.defineSlot('/1732998/NancyOnNorwalk_extra_300x250_ad_2', [300, 250], 'div-gpt-ad-1508816546283-1').addService(googletag.pubads());
    googletag.defineSlot('/1732998/NancyOnNorwalk_extra_300x250_ad_3', [300, 250], 'div-gpt-ad-1508816546283-2').addService(googletag.pubads());
    googletag.defineSlot('/1732998/Nancy-On-Norwalk-upper-sidebar', [300, 250], 'div-gpt-ad-1508816546283-3').addService(googletag.pubads());
    googletag.defineSlot('/1732998/Nancy_on_Norwalk_bottom_sidebar_large_rectangle_ad', [300, 250], 'div-gpt-ad-1508816546283-4').addService(googletag.pubads());
    googletag.defineSlot('/1732998/Nancy_on_Norwalk_top_sidebar_large_rectangle_ad', [300, 250], 'div-gpt-ad-1508816546283-5').addService(googletag.pubads());
    googletag.defineSlot('/1732998/NancyOnNorwalk-lower-sidebar', [300, 250], 'div-gpt-ad-1508816546283-6').addService(googletag.pubads());
    googletag.defineSlot('/1732998/NancyOnNorwalk-middle-sidebar', [300, 250], 'div-gpt-ad-1508816546283-7').addService(googletag.pubads());

//
//	Independant Media Network Google ad tags
//	Grouped together with ours because it's all Google. 
//
//
// googletag.defineSlot('/3021306/nancyonnorwalk-001-300x250', [300, 250], 'div-gpt-ad-1411766814990-0').addService(googletag.pubads());
// googletag.defineSlot('/3021306/nancyonnorwalk-002-300x250', [300, 250], 'div-gpt-ad-1411766814990-1').addService(googletag.pubads());
// googletag.defineSlot('/3021306/nancyonnorwalk-003-300x250', [300, 250], 'div-gpt-ad-1411766814990-2').addService(googletag.pubads());
// googletag.defineSlot('/3021306/nancyonnorwalk-004-300x250', [300, 250], 'div-gpt-ad-1411766814990-3').addService(googletag.pubads());
// googletag.defineSlot('/3021306/nancyonnorwalk-005-300x250', [300, 250], 'div-gpt-ad-1411766814990-4').addService(googletag.pubads());
// googletag.defineSlot('/3021306/nancyonnorwalk-006-300x250', [300, 250], 'div-gpt-ad-1411766814990-5').addService(googletag.pubads());
// googletag.defineSlot('/3021306/nancyonnorwalk-007-300x250', [300, 250], 'div-gpt-ad-1411766814990-6').addService(googletag.pubads());
// googletag.defineSlot('/3021306/nancyonnorwalk-008-300x250', [300, 250], 'div-gpt-ad-1411766814990-7').addService(googletag.pubads());
// googletag.defineSlot('/3021306/nancyonnorwalk-009-300x250', [300, 250], 'div-gpt-ad-1411766814990-8').addService(googletag.pubads());
// googletag.defineSlot('/3021306/nancyonnorwalk-010-300x250', [300, 250], 'div-gpt-ad-1411766814990-9').addService(googletag.pubads());

    googletag.pubads().enableSingleRequest();
    googletag.pubads().collapseEmptyDivs();
    googletag.enableServices();
});


//
//	Quantcast Analytics
//

var _qevents = _qevents || [];

(function() {
var elem = document.createElement('script');
elem.src = (document.location.protocol == "https:" ? "https://secure" : "http://edge") + ".quantserve.com/quant.js";
elem.async = true;
elem.type = "text/javascript";
var scpt = document.getElementsByTagName('script')[0];
scpt.parentNode.insertBefore(elem, scpt);
})();

_qevents.push({
qacct:"p-7GR1A7wZbYvVp"
});