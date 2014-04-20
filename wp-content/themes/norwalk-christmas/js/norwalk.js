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
	
function scrollingSidebar(){ // Constructor

	// set up properties
	this.init = function(selector){
		this.selector = selector;
		this.oldScrollTop = $(window).scrollTop();
		this.scrollTop = $(window).scrollTop();
		this.windowHeight = $(window).height();
		this.parentHeight = $(selector).parent().height();
		this.parentOffset = $(selector).parent().offset();
		this.sidebarOffset = $(selector).offset();
		this.sidebarHeight = $(selector).height();
		this.sidebarMarginTop = parseInt($(selector).css('margin-top').replace("px",""));
		this.sidebarMarginBottom = parseInt($(selector).css('margin-bottom').replace("px",""));
		this.distanceToTop = this.sidebarOffset.top - this.scrollTop;
		this.distanceToBottom = (this.scrollTop + this.windowHeight) - (this.sidebarOffset.top + this.sidebarHeight);
		//this.position = 'top'; // records whether the sidebar is all the way at its top, bottom, or in the middle.
		instance = this;
		$(selector).css({position:'relative'});
		if (this.scrollTop > this.parentOffset.top){
			if(this.distanceToTop > 0) ;
			else ;
		}
		$(window).bind('scroll', function(){
			instance.adjust(instance);
			}
		);
	}
	
	this.adjust = function(instance, init){
		//we refresh everything in case something's changed the environment, because, hey, this theme is responsive.
		selector = this.selector;
		this.oldScrollTop = this.scrollTop;
		this.scrollTop = $(window).scrollTop();
		this.windowHeight = $(window).height();
		this.parentHeight = $(selector).parent().height();
		this.parentOffset = $(selector).parent().offset();
		this.sidebarOffset =  $(selector).offset();
		this.sidebarHeight = $(selector).outerHeight(true);
		this.sidebarMarginTop = parseInt($(selector).css('margin-top').replace("px",""));
		this.sidebarMarginBottom = parseInt($(selector).css('margin-bottom').replace("px",""));
		this.distanceToTop = this.sidebarOffset.top - this.scrollTop;
		this.distanceToBottom = (this.scrollTop + this.windowHeight) - (this.sidebarOffset.top + this.sidebarHeight);
		
		if (this.scrollTop < this.parentOffset.top - this.sidebarMarginTop){
			// checks to see if we've scrolled up above the parent element. 
			// If so, reverts to default styles by removing the inline styles added by jquery.
			$(selector).removeAttr('style'); 
		} 
		else if (this.scrollTop > this.oldScrollTop) { 
				// direction = 'down';
				if ($(selector).css('position') != "fixed" && 
					this.distanceToBottom >= 0 &&
					this.scrollTop + this.windowHeight < this.parentOffset.top + this.parentHeight )
					{
					topCoord = this.windowHeight - (this.sidebarHeight + this.sidebarMarginBottom);
					
					if (topCoord < 0) {
						$(selector).css({top:topCoord, left:this.sidebarOffset.left, position:'fixed'});
					}
				}
				else if($(selector).css('position') == "fixed" && 
						this.distanceToBottom < 0){
					topCoord = this.oldScrollTop - this.parentOffset.top;
					$(selector).css({position:"relative", top:topCoord, left:""});
				}
				else if (this.scrollTop + this.windowHeight > this.parentOffset.top + this.parentHeight){
					topCoord = this.parentHeight - this.sidebarHeight - this.sidebarMarginBottom;
					$(selector).css({position:"relative", top:topCoord, left:""});
				}
				this.init = null;
		} 
		else if (this.scrollTop < this.oldScrollTop) {
				// direction = 'up';
				if (this.distanceToTop > 0 + this.sidebarMarginTop){
					topCoord = 0 + this.sidebarMarginTop;
					sideCoord = this.sidebarOffset.left;
					$(selector).css({top:topCoord, left:sideCoord, position:'fixed'});
				}
				else if($(selector).css('position') == "fixed"){
					topCoord = this.sidebarOffset.top;
					$(selector).css({position:"relative", top:topCoord, left:""});
				}
		} 
	}
}		

// SNOW EFFECTS :)

// Snow code borrowed from user John S on Codepen.io 

function microtime()
{
	return new Date().getTime()*0.001;
}

// returns a random integer from min to max
function irand(min, max)
{
	return Math.floor((min||0) + Math.random() * ((max+1||100) - (min||0)));
}

// returns a random float from min to max
function frand(min, max)
{
	return (min||0) + Math.random() * ((max||1) - (min||0));
}

function clamp(value, min, max)
{
	return Math.min(Math.max(value, min), max);
}

// Two component vector class
function Vector2(x, y)
{
	this.x = x || 0;
	this.y = y || 0;
	
	this.add = function(other)
	{
		this.x += other.x;
		this.y += other.y;
	}
	
	this.magnitude = function()
	{
		return Math.sqrt(this.x * this.x + this.y * this.y);
	}
}

function Color(r, g, b)
{
	this.r = r || 0;
	this.g = g || 0;
	this.b = b || 0;
}

if(!window.addEventListener){
	window.attachEvent('onload', function()
	{		
	  jsCanvasSnow.init();
	  document.getElementById('particle_canvas').width = $(window).innerWidth();
	  jsCanvasSnow.start();
	}, false);
	
} else {
	window.addEventListener('resize', function()
	{
	  jsCanvasSnow.resize(window.innerWidth, 240);
		jsCanvasSnow.init();
	}, false);
	
	window.addEventListener('load', function()
	{
	  jsCanvasSnow.init();
	  jsCanvasSnow.start();
	}, false);
}

function jsParticle(origin, velocity, size, amplitude)
{
	this.origin = origin;
	this.position = new Vector2(origin.x, origin.y);
	this.velocity = velocity || new Vector2(0, 0);
	this.size = size;
	this.amplitude = amplitude;
	
	// randomize start values a bit
	this.dx = Math.random() * 100;
	
	this.update = function(delta_time)
	{
		this.position.y += this.velocity.y * delta_time;
		
		// oscilate the x value between -amplitude and +amplitude
		this.dx += this.velocity.x*delta_time;		
		this.position.x = this.origin.x + (this.amplitude * Math.sin(this.dx));
	};
}

var jsCanvasSnow = 
{
	canvas : null,
	ctx : null,
	particles : [],
	running : false,
	
	start_time : 0,
	frame_time : 0,

	init : function( )
	{
		// use the container width and height
		this.canvas = document.getElementById('particle_canvas');
		this.ctx = this.canvas.getContext('2d');
		$('header .snowcap.side').appendTo('#main-content');
    	this.resize(window.innerWidth, jQuery('#mainhead').innerHeight());    

		// change these values
    // the 2 element arrays represent min and max values
		this.pAmount = 3500;         // amount of particles
		this.pSize = [0.3 , 2];    // min and max size
		this.pSwing = [0.1, 1];      // min and max oscilation speed for x movement
		this.pSpeed = [40, 100],     // min and max y speed
		this.pAmplitude = [25, 50];  // min and max distance for x movement
		
		if(!window.addEventListener) this.pAmount = 1500; // for ie8, to improve performance
		
    this._init_particles();
	},
	
	start : function()
	{
		this.running = true;
		this.start_time = this.frame_time = microtime();
		this._loop();
	},
	
	stop : function()
	{
		this.running = false;
	},
  
  resize : function(w, h)
  {
    this.canvas.width = w;
    this.canvas.height = h;
	$('#logo .snowcap-container').attr('style', '').css({ width: ( $('#logo .snowcap-container').width()-161 ) });
	$('.snowcap').css({opacity:1});
  },
	
	_loop : function()
	{
		if ( jsCanvasSnow.running )
		{
			jsCanvasSnow._clear();
			jsCanvasSnow._update();
			jsCanvasSnow._draw();
			jsCanvasSnow._queue();
		}
	},	
	
	_init_particles : function()
	{
		// clear the particles array
		this.particles.length = 0;
		
		for ( var i = 0 ; i < this.pAmount ; i++) 
		{
			var origin = new Vector2(frand(0, this.canvas.width), frand(-this.canvas.height, 0));
			var velocity = new Vector2(frand(this.pSwing[0],this.pSwing[1]), frand(this.pSpeed[0],this.pSpeed[1]));
			var size = frand(this.pSize[0], this.pSize[1]);
			var amplitude = frand(this.pAmplitude[0], this.pAmplitude[1]);
			
			this.particles.push(new jsParticle(origin, velocity, size, amplitude));
		}
	},

	_update : function()
	{
		// calculate the time since the last frame
		var now_time = microtime();
		var delta_time = now_time - this.frame_time;
		
		for ( var i = 0 ; i < this.particles.length ; i++)
		{
			var particle = this.particles[i];
			particle.update(delta_time);
			
			if (particle.position.y-particle.size > this.canvas.height)
			{
				// reset the particle to the top and a random x position
				particle.position.y = -particle.size;
				particle.position.x = particle.origin.x = Math.random() * this.canvas.width;
				particle.dx = Math.random() * 100;
			}			
		}
		
		// save this time for the next frame
		this.frame_time = now_time;
	},
	
	_draw : function()
	{
		this.ctx.fillStyle = 'rgb(255,255,255)';
		
		for ( var i = 0 ; i < this.particles.length ; i++)
		{
			var particle = this.particles[i];
			this.ctx.fillRect(particle.position.x, particle.position.y, particle.size, particle.size);
		}
	},
	
	_clear : function()
	{
		this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
	},
	
	_queue : function()
	{
		window.requestAnimationFrame( jsCanvasSnow._loop );
	}
};

// END SNOW EFFECTS :|






$(document).ready(function(e) {
	
	// Sliding sidebar
	
	//scrollSide = new scrollingSidebar();
	//scrollSide.init('.sidebar');

	
	});
});
