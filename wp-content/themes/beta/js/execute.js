// This section is for the tabs


		    $(document).ready(function() {
	
				//When page loads...
				$(".tab_content").hide(); //Hide all content
				$("ul.tabs li:first").addClass("active").show(); //Activate first tab
				$(".tab_content:first").show(); //Show first tab content
			
				//On Click Event
				$("ul.tabs li").click(function() {
			
					$("ul.tabs li").removeClass("active"); //Remove any "active" class
					$(this).addClass("active"); //Add "active" class to selected tab
					$(".tab_content").hide(); //Hide all tab content
			
					var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
					$(activeTab).fadeIn(); //Fade in the active ID content
					return false;
				});
				
// project thumbnail hover state
				
				$("#thumbnails ul li").hover(
				  function () {
				    $(this).addClass('hover').css('z-index','99').find('.title').stop().animate({ "height": 133}, 250);
				    $(this).siblings().stop().animate({opacity:0.3},250).css('z-index', '1');
				    $(this).find('.title').css('z-index', '9999');
				  }, 
				  function () {
				    $(this).removeClass('hover').find('.title').animate({ "height": 30}, 200);
				    $('#thumbnails ul li').stop().animate({opacity:1},200); 
				  }
				  );
				  
// icons on hoverstate
				  
				$(".socials img").hover(function() {
		    		$(this).stop().animate({ top: "-4px", opacity: "1" }, 250);
						},function(){
		    		$(this).stop().animate({ top: "0px",  opacity: "0.5" }, 250);

				});
				
				$(".socialbar img").hover(function() {
		    		$(this).stop().animate({ top: "-4px", opacity: "1" }, 250);
						},function(){
		    		$(this).stop().animate({ top: "0px",  opacity: "0.5" }, 250);

				});
// menu dropdown				

				$('nav li ul.sub-menu li ul.sub-menu').removeClass("sub-menu").addClass("sub-two");
				
				$("nav li").hover(function(){
					$(this).find("ul.sub-menu").stop().animate({ top: "40px", opacity: "1" }, 350);
					
				},function(){
		    		$(this).find("ul.sub-menu").stop().animate({ top: "30px",  opacity: "0" }, 350);
				
				});
				
				$("nav li ul li ").hover(function(){
					$(this).find("ul.sub-two").stop().animate({ right: "-162px", opacity: "1" }, 350);
					
				},function(){
		    		$(this).find("ul.sub-two").stop().animate({ right: "0px",  opacity: "0" }, 350);
				
				});
				
			});




/* =Realistic Navigation
============================================================================== */

	// Begin jQuery
	
	$(document).ready(function() {


	/* =Shadow Nav
	-------------------------------------------------------------------------- */
	
		// Animate buttons, shrink and fade shadow
		
		$("#widenav li").hover(function() {
			var e = this;
		    $(e).find("img").stop().animate({ marginTop: "-14px" }, 250, function() {
		    	$(e).find("img").animate({ marginTop: "-10px" }, 250);
		    });
		},function(){
			var e = this;
		    $(e).find("img").stop().animate({ marginTop: "0px" }, 250, function() {
		    	$(e).find("img").animate({ marginTop: "0px" }, 250);
		    });

		});
		
		$(".prime").hover(function() {
			var j = this;
		    $(j).find(".mite").stop().animate({ bottom: "15px", }, 250, function() {
		    	$(j).find(".mite").animate({ bottom: "10px" }, 250);
		    });
		},function(){
			var j = this;
		    $(j).find(".mite").stop().animate({ bottom: "4px" }, 250, function() {
		    	$(j).find(".mite").animate({ bottom: "4px" }, 250);
		    });

		});
						
	// End jQuery
	
	});
	
var isMobile;

// Identify if visitor on mobile with lame sniffing to remove parallaxing title
if( navigator.userAgent.match(/Android/i) ||
    navigator.userAgent.match(/webOS/i) ||
    navigator.userAgent.match(/iPhone/i) ||
    navigator.userAgent.match(/iPod/i) ||
    navigator.userAgent.match(/iPad/i) ||
    navigator.userAgent.match(/BlackBerry/)
){
  isMobile = true;
}

$(document).ready(function() {

  // Global vars
  
  var $everything = $('header');
  var $artHeaderInner = $('.primary');
  var $trigger = $('.primary-header .trigger');
  var $bg = $('header');
  var $artTitle = $('.art-title');
  var $blurp = $('.hellobox');
  var $navigation = $('nav');
  var $arrows = $('.load-item');
  var artTitleFontSize = parseInt($artTitle.css('font-size'));
  var $nav = $('.nav');
  var windowScroll;

  // Apply Fittext to article titles to make it scale responsively in a smooth fashion
  $artTitle.fitText(1, { minFontSize: '34px' });

  // Identify if visitor has a large enough viewport for parallaxing title
  function isLargeViewport() {
    if($nav.css('position') == "relative") {
      return false;
    } else {
      return true;
    }
  }

  // If large viewport and not mobile, parallax the title
  if(!isMobile) {
    $(window).scroll(function() {
      if(isLargeViewport()) {
        slidingTitle();
      }
    });
  }

  // Window gets large enough, need to recalc all parallaxing title values
  $(window).resize(function() {
    if(isLargeViewport()) {
      slidingTitle();
    }
  });

  // Functional parallaxing calculations
  function slidingTitle() {
    //Get scroll position of window
    windowScroll = $(this).scrollTop();

    //Slow scroll of .art-header-inner scroll and fade it out
    $artHeaderInner.css({
      'margin-top' : -(windowScroll/3)+"px",
      'opacity' : 1-(windowScroll/350)
    });
    
   //Slow scroll of .contact button scroll and fade it out
    $trigger.css({
      'margin-top' : -(windowScroll/1)+"px",
      'opacity' : 1-(windowScroll/250)
    });
    
       //Slow scroll of .contact button scroll and fade it out
    $arrows.css({
      'margin-top' : -(windowScroll/3)+"px",
      'opacity' : 1-(windowScroll/150)
    });
    
  //Slow scroll of .contact button scroll and fade it out
    $navigation.css({
      'margin-top' : -(windowScroll/3)+"px",
      'opacity' : 1-(windowScroll/350)
    });

    
    $blurp.css({
      'margin-top' : -(windowScroll/3)+"px",
      'opacity' : 1-(windowScroll/150)
    });

    //Slowly parallax the background of .art-header
    $bg.css({
      'background-position' : 'center ' + (-windowScroll/8)+"px"
    });

    //Fade the .nav out
    $nav.css({
      'opacity' : 1-(windowScroll/400)
    });
  }

  // Link to top of page without changing URL
  $('.back-to-top a').click(function(e) {
    e.preventDefault();
    $(window).scrollTop(0);
  })

});