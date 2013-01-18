<?php
/**
 * The Header for the theme
 *
 */ ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />


<!-- This is just a lot of code for applying custom titles based on the information for pages -->
<title>
<?php global $page, $paged; wp_title( '|', true, 'right' ); bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'cebolang' ), max( $paged, $page ) );
?>
</title>

<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php if (get_option('cebo_custom_favicon') == '') { ?>

<link rel="icon" href="<?php bloginfo ('template_url'); ?>/cebo_options/images/admin_sidebar_icon.png" type="image/x-ico"/>

<? } else { ?>

<link rel="icon" href="<?php echo get_option('cebo_custom_favicon'); ?>" type="image/x-ico"/>

<? } ?>
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php if ( get_option('cebo_feedburner_url') <> "" ) { echo get_option('cebo_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link href="<?php bloginfo ('template_url'); ?>/js/jquery.thumbnailScroller.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?php bloginfo ('template_url'); ?>/js/supersized.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php bloginfo ('template_url'); ?>/js/supersized.shutter.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php bloginfo ('template_url'); ?>/js/carousel.css" />		
	<!-- Modernizer script that allows HTML5 to display on all browsers -->
	<script src="<?php bloginfo('template_url'); ?>/js/modernizr-1.6.min.js"></script>

		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
		<script type="text/javascript" src="<?php bloginfo ('template_url'); ?>/js/jquery.easing.min.js"></script>
		<script src="<?php bloginfo ('template_url'); ?>/js/panel.js"></script>
		<?php if(is_home()) { ?>
		
		<script src="<?php bloginfo ('template_url'); ?>/js/recover.js"></script>
		<script type="text/javascript" src="<?php bloginfo ('template_url'); ?>/js/supersized.3.2.7.min.js"></script>
		<script type="text/javascript" src="<?php bloginfo ('template_url'); ?>/js/supersized.shutter.min.js"></script>
		<script type="text/javascript">
			
			jQuery(function($){
				
				$.supersized({
				
					// Functionality
					slide_interval          :   4000,		// Length between transitions
					transition              :   1, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
					transition_speed		:	700,		// Speed of transition
															   
					// Components							
					slide_links				:	'blank',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
					slides 					:  	[			// Slideshow Images
					
					<?php $pcount = get_option('cebo_slidecount'); ?>
					<?php $query = new WP_Query(array(
								'post_type' => 'slides',
								'posts_per_page' => $pcount, 
								'orderby' => 'title', 
								'order' => 'DESC' )); ?>
						  <?php if ($query->have_posts()) : ?>
						      <?php while ($query->have_posts()) : $query->the_post(); ?>
					
					
														{image : '<?php echo sp_get_image(); ?>', title : '<h1><?php the_title(); ?></h1><br>', thumb : '', url : ''}<?php if(($query->current_post + 1) == ($query->post_count)) { ?> <? } else { ?>,<? } ?>
														
														
						<?php endwhile; endif; wp_reset_query(); ?>	
						
												]
					
				});
		    });
		    
		</script>
		<? } ?>
  	 <script src="<?php bloginfo ('template_url'); ?>/js/jquery.lettering.js"></script>
		  <script type="text/javascript">
		  	$(document).ready(function() {
					$("#widenav h2").lettering('words');
					$(".primary h1").lettering('words');
					$(".mega").lettering('words');
					$(".foot li h3").lettering('words');
					
				});
		  </script>
		<script src="<?php bloginfo ('template_url'); ?>/js/jquery.tweet.js" type="text/javascript"></script>
		<script type='text/javascript'>
		    jQuery(function($){
		        $(".tweet").tweet({
		            username: "<?php echo get_option('cebo_tweets'); ?>",
		            count: <?php echo get_option('cebo_tweetcount'); ?>,
		        });
		    });
		</script> 
		<script type="text/javascript" src="<?php bloginfo ('template_url'); ?>/js/execute.js"></script>
		
	<script src="<?php bloginfo ('template_url'); ?>/js/jquery.fittext.js"></script>
  	<script src="<?php bloginfo ('template_url'); ?>/js/app.js"></script>
		<script type="text/javascript" src="<?php bloginfo ('template_url'); ?>/js/jquery.isotope.min.js"></script>
		<script type="text/javascript">
			// cache container
			var $container = $('#thumbnail ul');
			// initialize isotope
			$container.isotope({
			  // options...
			});
			
			// filter items when filter link is clicked
			$('.filter a').click(function(){
			  var selector = $(this).attr('data-filter');
			  $container.isotope({ filter: selector });
			  return false;
			});
		</script>
		<script type="text/javascript">
			$(window).load(function() {
			  var imgwidth = 0;
				$('.touchcarousel-container').find('img').each(function() {
				   imgwidth = $(this).width();
				   
				   $(this).css('width', imgwidth);
				});
				
			});
		</script>
		<script src="<?php bloginfo ('template_url'); ?>/js/jquery.touchcarousel-1.1.min.js"></script> 
		<script type="text/javascript">
		$(window).load(function() {
		
			jQuery(function($) {
				
				$("#carousel-gallery").touchCarousel({				
					itemsPerPage: 1,	
					autoplay: true,			
					scrollbar: true,
					scrollbarAutoHide: false,
					scrollbarTheme: "dark",				
					pagingNav: false,
					snapToItems: false,
					scrollToLast: false,
					useWebkit3d: true,				
					loopItems: false
				});			
			});
			
			});
	    </script>
	    <link rel="stylesheet" type="text/css" href="<?php bloginfo ('template_url'); ?>/js/shadowbox.css">
		<script type="text/javascript" src="<?php bloginfo ('template_url'); ?>/js/shadowbox.js"></script>
		<script type="text/javascript">
		Shadowbox.init({
		    handleOversize: "drag",
		    modal: true
		});
		</script>
	    <?php if(is_page_template( 'page-contact.php' ) ) { ?>

	    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
		<script type="text/javascript">
		  var geocoder;
		  var map;
		  var address ="<?php echo get_option('cebo_address'); ?>";
		  function initialize() {
		    geocoder = new google.maps.Geocoder();
		    var latlng = new google.maps.LatLng(-34.397, 150.644);
		    var myOptions = {
		      zoom: 10,
		      center: latlng,
		    mapTypeControl: true,
		    mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
		    navigationControl: true,
		      mapTypeId: google.maps.MapTypeId.ROADMAP
		    };
		    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
		    if (geocoder) {
		      geocoder.geocode( { 'address': address}, function(results, status) {
		        if (status == google.maps.GeocoderStatus.OK) {
		          if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
		          map.setCenter(results[0].geometry.location);
		
		            var infowindow = new google.maps.InfoWindow(
		                { content: '<b>'+address+'</b>',
		                  size: new google.maps.Size(150,50)
		                });
		    
		            var marker = new google.maps.Marker({
		                position: results[0].geometry.location,
		                map: map, 
		                title:address
		            }); 
		            google.maps.event.addListener(marker, 'click', function() {
		                infowindow.open(map,marker);
		            });
		
		          } else {
		            alert("No results found");
		          }
		        } else {
		          alert("Geocode was not successful for the following reason: " + status);
		        }
		      });
		    }
		  }
		</script>
		<? } ?>
	<script>
	 // DOM ready
	 $(function() {
	   
      // Create the dropdown base
      $("<span><select /></span>").appendTo("nav");
      
      // Create default option "Go to..."
      $("<option />", {
         "selected": "selected",
         "value"   : "",
         "text"    : "<?php _e('Menu', 'cebolang'); ?>"
      }).appendTo("nav select");
      
      // Populate dropdown with menu items
      $("nav a").each(function() {
       var el = $(this);
       $("<option />", {
           "value"   : el.attr("href"),
           "text"    : el.text()
       }).appendTo("nav select");
      });

      $("nav select").change(function() {
        window.location = $(this).find("option:selected").val();
      });
	 
	 });
	</script>
<style type="text/css">

<?php

	include(TEMPLATEPATH. "/library/inset.php");
?>

</style>
<base target="_parent"/>
<?php
	/****************** DO NOT REMOVE **********************
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	wp_head();
?>
</head>

<!-- primary header with large image -->

<body class="home" onload="initialize()">

	<?php include(TEMPLATEPATH . '/library/panel.php'); ?>
	
	<?php if(!is_page_template( 'page-facebook.php' ) ) { ?>
	
	<?php if(is_home()) { ?>
		
	<header class="primary-header white">
	
		
		<div id="header">
		
 			
		  <!--Arrow Navigation-->
			<a id="prevslide" class="load-item"></a>
			<a id="nextslide" class="load-item"></a>
		 
		 <!--Control Bar-->
		<div id="controls-wrapper" class="load-item">
				<div id="controls">
					
					<!--Navigation-->
					<ul id="slide-list"></ul>
					
					<div id="slidecaption"></div>
					
					
					
				</div>
			</div>
		  
		</div>
				
		<? } ?>	
		
		
		<!--===================================================================   MAP ON THE CONTACT PAGE =================-->
		
		
		<?php if(is_page_template( 'page-contact.php' ) ) { ?>
		
			<header class="primary-header white contacto">
		
			
				<div id="header">
					
					<?php if(is_page_template('page-contact.php')) {  ?> 
					
					
						<div class="projectinfo" style="top: -19px;">
						
							<?php if(get_option('cebo_company') ) { ?>
							
							<h3 style="text-align: center; margin: 0 0 5px 0;"><?php echo get_option('cebo_company'); ?></h3>
							
							<? } ?>
							<?php if(get_option('cebo_address') ) { ?>
							<p style="text-align: center; padding: 0;"><?php echo get_option('cebo_address'); ?></p>
							
							<? } ?>
							<?php if(get_option('cebo_phone') ) { ?>
							
							<h4 style="text-align: center; margin: 0;"><?php echo get_option('cebo_phone'); ?></h4>
							
							<? } ?>
							<?php if(get_option('cebo_email') ) { ?>
							
							
							<p style="text-align: center;"><a href="mailto:<?php echo get_option('cebo_email'); ?>"><?php echo get_option('cebo_email'); ?></a></p>
							
							<? } ?>
							
							<div class="clear"></div>
						
						</div>
						
					<? } ?>
					
			
					<div id="map_canvas" style="top: 100px; width: 100%; height: 500px;"></div>
					
					<nav>
		
					<?php if(get_option('cebo_logo') == '') { ?>
						
						<h1 class="logo" ><a href="<?php bloginfo ('url'); ?>"><img src="<?php bloginfo ('template_url'); ?>/images/logo.png" alt="<?php bloginfo('description'); ?>" /></a></h1>
						
						<? } else { ?>
						
						<h1 class="logo" style="position:;"><a href="<?php bloginfo ('url'); ?>"><img src="<?php echo get_option('cebo_logo'); ?>"></a></h1>
						
						<? } ?>
	
			
				<?php wp_nav_menu( array( 'theme_location' => 'primary' , 'menu_class' => 'nav-primary contact' ) ); ?>
				
		
		<? } elseif( !is_home() ) { ?>
		
		<div id="pageheader">
		
		
		<nav class="subhead">
		
		<?php if(get_option('cebo_logo') == '') { ?>
			
			<h1 class="logo" ><a href="<?php bloginfo ('url'); ?>"><img src="<?php bloginfo ('template_url'); ?>/images/logo.png" alt="<?php bloginfo('description'); ?>" /></a></h1>
			
			<? } else { ?>
			
			<h1 class="logo" style="position: relative;"><a href="<?php bloginfo ('url'); ?>"><img src="<?php echo get_option('cebo_logo'); ?>"></a></h1>
			
			<? } ?>
	
			
				<?php wp_nav_menu( array( 'theme_location' => 'primary' , 'menu_class' => 'nav-primary' ) ); ?>
				
				
				
		
		<?	} else { ?>
		
		
		<nav>
		
		
		<?php if(get_option('cebo_logo') == '') { ?>
			
			<h1 class="logo"><a href="<?php bloginfo ('url'); ?>"><img src="<?php bloginfo ('template_url'); ?>/images/logo.png" alt="<?php bloginfo('description'); ?>" /></a></h1>
			
			<? } else { ?>
			
			<h1 class="logo"><a href="<?php bloginfo ('url'); ?>"><img src="<?php echo get_option('cebo_logo'); ?>"></a></h1>
			
			<? } ?>
	
			
				<?php wp_nav_menu( array( 'theme_location' => 'primary' , 'menu_class' => 'nav-primary' ) ); ?>
				
				
		
		<? } ?>	

		</nav>
		
		<?php if(is_page_template( 'page-contact.php' ) ) { ?>
		
			<div class="contacthead"></div>
		
				</div>
		  
					</header>
					
					
				
		
		<? } ?>
		
		 <div class="clear"></div>
		 
		 <?php if(is_home()) { ?>
		 
		 <div class="trigger-container">	
		 
		 <!-- pulls the title of the large image background and inserts it into this div -->
		 
		 <div class="primary">
		 
		 
		 	
		 	
		 
		 </div>
		 
		 
		 <!-- end primary -->
		 
		 <!-- contact form trigger  -->
		      
		      
		      
		  <!-- company welcome blurp to be reused  --> 
		     
		  <?php if(get_option('cebo_quote')) { ?>
		     
		     <div class="hellobox">
		     
		     	<p><?php echo get_option('cebo_quote'); ?></p>
		     	
		     	<a class="trigger" href="#"><img src="<?php bloginfo ("template_url"); ?>/images/contact_bubble.png" title="contact us" /></a>

		     </div>
		   <? } ?>  
		      
		 
			</div>
			
	</header><!-- end featured -->
		
			<? }  } ?>