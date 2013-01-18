<?php
/**
 * TEMPLATE NAME: Newsletter Template
 */
?>
<html lang="en">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
	<?php $background = get_option('cebo_background_color');
		$accent = get_option('cebo_accent_color');
		$bgimg = get_option('cebo_background_image');
		
		?>
	<style type="text/css">
		
		.clear {clear:both;} 
		
		.right {float: right;} 
		
		.left {float: left;}
		
		.alignright {float: right;margin: 0 0 2px 7px;}
		.alignleft {float: left;margin: 0 7px 2px 0; display: inline-block; *display: inline; zoom: 1;}
		
		img.left, img.alignleft {float: left;margin: 0 15px 7px 0; display: inline-block; *display: inline; zoom: 1;}
		
		img.right, img.alignright {float: right;margin: 0 0 7px 15px;}
		
		.post img.aligncenter, .attachment img.aligncenter { display:block; margin: 0 auto; text-align: center; }

		
		body { width:100%; margin:0; padding:0; }
		body, table, p, td, ul, ol{ color:#666666; font-family:Arial, sans-serif; font-size:12px; line-height:20px; }
		
		h1{ font-family:Arial, sans-serif; color:#000000; font-size:22px; }
			h1 span{ color:#000000; } /* Hotmail header color bug fix */
			h1 a{ text-decoration:none; color:#2A5DB0; }
			
		h2{ font-family:Arial, sans-serif; color:#000000; font-size:18px; }
			h2 span{ color:#000000; } /* Hotmail header color bug fix */
			h2 a{ text-decoration:none; color:#2A5DB0; }
			
		h3{ font-family:Arial, sans-serif; color:#000000; font-size:16px; }
			h3 span{ color:#000000; } /* Hotmail header color bug fix */
			h3 a{ text-decoration:none; color:#2A5DB0; }
			
		h4{ font-family:Arial, sans-serif; color:#000000; font-size:14px; }
			h4 span{ color:#000000; } /* Hotmail header color bug fix */
			h4 a{ text-decoration:none; color:#2A5DB0; }
		
		a{ color:#2A5DB0; }
		b{ color:#333333; }
		i{}
		p { width: 100%;}
		
		ul{ list-style-type: disc; list-style-position:inside; margin-left:0; padding-left:6px; }
		ol{ list-style-type: decimal; list-style-position:inside; margin-left:0; padding-left:6px; }
		
		/* Custom Classes */
		
		.wrapper{ table-layout:fixed; }	
		
		.block{ display:block; } 		
		
		
		.shout{ color:#FF0000; }
		.silence{ color:#666666; font-weight:400; }
		
		.text-align-center{ text-align:center; }
		.text-align-right{ text-align:right; }
		
		.img-left-aligned{ margin-right:20px; margin-top:5px; }
		.img-right-aligned{ margin-left:20px; margin-top:5px; }
		
		.bordered-bottom{ border-bottom:1px solid #d6d6d6; }
		.bordered-bottom-left{ border-bottom:1px solid #d6d6d6; border-left:1px solid #d6d6d6; }
		
		/* Layout */
		
		.view-mobile-browser{ line-height:14px; font-size:11px; }
			.view-mobile-browser a{ color:#3a3a3a; }
	
		.ourwebsite{ line-height:14px; font-size:11px; }
			.ourwebsite a{ font-weight:bold; }
		
		.logo{}
		
		.menu-or-slogan{}
			.menu-or-slogan a{ color:#3a3a3a; text-decoration:underline; }
		
		.main-content-wrap{ border-width: 1px 1px 1px 1px; border-spacing: 0px; border-style: solid solid solid solid; 
							border-color: #d6d6d6 #d6d6d6 #d6d6d6 #d6d6d6; border-collapse: collapse; background-color: #ffffff; }
		
		.companyinfo{}
			.companyinfo a{}
		
		.subscription{}
			.subscription a{}
		
		.social{ border-top:1px solid #D0D0D0; border-bottom:1px solid #D0D0D0; }
			.social a{ color:#3a3a3a; text-decoration:none; }
		
		.copyright{}
		
		.copyright a{ color:#565656; text-decoration:none; }
		
		a { border: none; }
		
		img { border: none; }
		
		
	</style>
<?php wp_head(); ?>
</head>
<body marginheight="0" background="<?php if($bgimg) { echo $bgimg; } elseif($background) { echo $background; } else { ?><?php bloginfo ('template_url'); ?>/images/bg.png <? } ?>" topmargin="0" marginwidth="0" style="font-size: 12px; margin: 0; padding: 0; font-family: Arial, sans-serif; line-height: 20px; color: #666666; width: 100%;" bgcolor="<?php if($background) { echo $background; } else { ?>#E3E3E3<? } ?>" offset="0" leftmargin="0">

<!-- wrapper table - needed as some readers strip the <html>, <head> and <body> tags -->	
<table class="wrapper" background="<?php if($bgimg) { echo $bgimg; } elseif($background) { echo $background; } else { ?><?php bloginfo ('template_url'); ?>/images/bg.png <? } ?>" cellspacing="0" style="font-size: 12px; font-family: Arial, sans-serif; line-height: 20px; color: #666666; table-layout: fixed;" bgcolor="<?php if($background) { echo $background; } else { ?>#E3E3E3<? } ?>" width="100%" cellpadding="0"><tr><td style="font-size: 12px; line-height: 20px; font-family: Arial, sans-serif; color: #666666;">





<!-- ============= Newsletter Content  =========== -->
	
	<br>	
		
	<table rules="none" cellspacing="0" border="0" align="center" style="font-size: 12px; line-height: 20px; font-family: Arial, sans-serif; color: #666666;" width="600" cellpadding="0"><tr><td style="font-size: 12px; line-height: 20px; font-family: Arial, sans-serif; color: #666666;">
	
	<!-- START HEADER CONTENT -->

		<table cellspacing="0" align="center" style="font-size: 12px; line-height: 20px; font-family: Arial, sans-serif; color: #666666;" width="560" cellpadding="0"><tr>
			<td class="logo" valign="top" style="font-size: 12px; line-height: 20px; font-family: Arial, sans-serif; color: #666666;" width="360">
				
			<?php if(get_option('cebo_logo') == '') { ?>
			
			<h1 class="logo" ><a style="border: none;" href="<?php bloginfo ('url'); ?>"><img src="<?php bloginfo ('template_url'); ?>/images/logo.png" alt="<?php bloginfo('description'); ?>" /></a></h1>
			
			<? } else { ?>
			
			<h1 class="logo" style="position: relative;"><a style="border: none;" href="<?php bloginfo ('url'); ?>"><img src="<?php echo get_option('cebo_logo'); ?>"></a></h1>
			
			<? } ?>
	
			</td>
			<td class="menu-or-slogan" align="right" valign="middle" style="font-size: 12px; line-height: 20px; font-family: Arial, sans-serif; color: #666666;" width="400">

					<h2 style="margin: 0; padding-bottom: 0px; font-size: 18px; font-family: Helvetica, Arial; font-style: italic; font-weight: lighter; color:<?php if($accent) { echo $accent; } else { ?>#159D9B;<? } ?>"><?php if(get_option('cebo_mailchimpgreet')) { echo __(get_option('cebo_mailchimpgreet'), 'cebolang'); } else { ?><?php _e('Hi', 'cebolang'); ?> *|FNAME|* <? } ?></h2>

				
			</td>	
		</tr></table>
		
	<!-- END HEADER CONTENT -->
	
	</td></tr></table>
	
	
	
	
		
	<table class="main-content-wrap" rules="none" cellspacing="0" border="1" bordercolor="#d6d6d6" frame="border" align="center" style="font-size: 12px; border-color: #d6d6d6 #d6d6d6 #d6d6d6 #d6d6d6; border-collapse: collapse; background-color: #ffffff; font-family: Arial, sans-serif; line-height: 20px; color: #666666; border-spacing: 0px; border-width: 1px 1px 1px 1px; border-style: solid solid solid solid;" bgcolor="#ffffff" width="600" cellpadding="0"><tr><td style="font-size: 12px; line-height: 20px; font-family: Arial, sans-serif; color: #666666;">
	
	<?php if(get_option('cebo_heading') ==  'true') { ?>
		
		<table cellspacing="0" align="center" style="font-size: 12px; line-height: 20px; margin-bottom: 20px; font-family: Arial, sans-serif; color: #666666; position: relative;" width="600" cellpadding="0">
			<tr>
				
				<td valign="top" style="font-size: 12px; line-height: 20px; font-family: Arial, sans-serif; color: #666666; background-color: #000;">
				
			
				
					<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
					
					<?php if(sp_get_image()) { ?>
					
					<img src="<?php echo sp_get_image(); ?>" width="600" alt="<?php the_title(); ?>">
					
					
					
					<?php $contactus = get_page_with_template('page-contact');
					$contactusnow = get_permalink($contactus); ?>
					
					
					
					<a style="display: block; width: 100%;" href="<?php echo $contactusnow; ?>"><img style="display: block; margin-top: -65px; bottom: -30px; text-align: right; padding: 10px 15px; background-color: #000000; position: relative; z-index: 999; width: 35px; left: 530px;" src="<?php bloginfo ('template_url'); ?>/images/contact_bubble.png" alt="Contact Us" /></a>
					
					
					<? } ?>
					
					<h3 style="font-size: 16px; font-family: Arial, sans-serif; color: #fff; padding: 10px 0 0 20px;"><span style="color: #fff;"><?php the_title(); ?></span></h3>

					 <?php endwhile; endif; wp_reset_query(); ?>
					 
					 
				
				</td>
				
			</tr>	
		</table>
		<!-- End Area -->
		
		
		
		<table cellspacing="0" align="center" style="font-size: 12px; line-height: 20px; font-family: Arial, sans-serif; color: #666666;" width="540" cellpadding="0">
			
			<tr>
	
				<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				
				
				<td valign="top" style="font-size: 12px; line-height: 20px; font-family: Arial, sans-serif; color: #666666;" width="540">
		
					<?php the_content(); ?>
				
				<?php endwhile; endif; wp_reset_query(); ?>	
					
				
				</td>
				
				
				
			</tr>
		</table>
		
		
		
		<img class="block" src="<?php bloginfo ('template_url'); ?>/images/divider.gif" height="61" alt="" style="display: block;" width="600" />

		


		<? } ?>

		<!-- =====================================    BEGIN PROJECT POSTS =================================== -->
		
		<?php if(get_option('cebo_recentprojects') == 'true' ) { ?>
		
		
		<table cellspacing="0" align="center" style="font-size: 12px; line-height: 20px; font-family: Arial, sans-serif; color: #666666;" width="540" cellpadding="0">
			<tr>
				
				
				<?php query_posts(
						array(
								'post_type' => 'project',
								'posts_per_page' => 3
							)
							); if(have_posts()) : while(have_posts()) : the_post(); $loopcounter++; ?>
				
				
				<td valign="top" style="font-size: 12px; line-height: 20px; font-family: Arial, sans-serif; color: #666666;" width="166">

				
					<a href="<?php the_permalink(); ?>" style="color: #2A5DB0;"><img src="<?php echo sp_get_image(); ?>" width="166" height="180" border="0" alt=""></a>
					
					<h3 style="font-size: 16px; font-family: Arial, sans-serif; color: #000000;"><span style="color: #000000;"><?php the_title(); ?></span></h3>

					<p style="font-size: 12px; line-height: 20px; font-family: Arial, sans-serif; color: #666666;"><?php echo excerpt(9); ?></p>
					
					<p style="font-size: 12px; line-height: 20px; font-family: Arial, sans-serif; color: #666666;"><a href="<?php the_permalink(); ?>" style="color: #2A5DB0;"><?php _e( 'Continue Reading', 'cebolang' ); ?></a></p>


					
				</td>
				
				<?php if ($loopcounter == 3 ) { ?>
				
				
				
				<? } else { ?>
				
				<td style="font-size: 12px; line-height: 20px; font-family: Arial, sans-serif; color: #666666;" width="20">&nbsp;</td><!-- spacer column -->
				
				<? } ?>
 				
				<?php endwhile; endif; wp_reset_query(); $count++ ?>	
				
				
			</tr>
		</table>
		
		<!-- End Area -->
		
		<img class="block" src="<?php bloginfo ('template_url'); ?>/images/divider.gif" height="61" alt="" style="display: block;" width="600" />
		
		<? } ?>
		
		<!-- =====================================    END PROJECT POSTS  =================================== -->
		
		
		<!-- =====================================    BEGIN BLOG POSTS =================================== -->
		<?php if(get_option('cebo_recentposts') == 'true' ) { ?>
		
		<?php query_posts('post_type=post&posts_per_page=5'); if(have_posts()) : while(have_posts()) : the_post(); ?>


		<!-- Module #5 | 2 columns, 166px, 20px spacer, 352px  -->
		<table cellspacing="0" align="center" style="font-size: 12px; line-height: 20px; font-family: Arial, sans-serif; color: #666666;" width="540" cellpadding="0">
		
		<tr style="font-size: 12px; line-height: 20px; font-family: Arial, sans-serif; color: #666666; height: 20px;" width="20" height="20"></tr>

			<tr>
				
				<?php if(sp_get_image()) { ?>
				
				<td valign="top" style="font-size: 12px; line-height: 20px; font-family: Arial, sans-serif; color: #666666;" width="206">

				
					<a href="<?php the_permalink(); ?>" style="color: #2A5DB0;"><img src="<?php echo sp_get_image(); ?>" alt="<?php the_title(); ?>" width="206" height="220" alt=""></a>
		
				</td>
				<td style="font-size: 12px; line-height: 20px; font-family: Arial, sans-serif; color: #666666;" width="20">&nbsp;</td><!-- spacer column -->
				
				<? } ?>
				
				<td valign="top" style="font-size: 12px; line-height: 20px; font-family: Arial, sans-serif; color: #666666;" width="312">
				
					<h3 style="font-size: 16px; font-family: Arial, sans-serif; color: #000000;"><span style="color: #000000;"><?php the_title(); ?></span></h3>

					<p style="font-size: 12px; line-height: 20px; font-family: Arial, sans-serif; color: #666666;"><?php echo excerpt(50); ?></p>

					<p style="font-size: 12px; line-height: 20px; font-family: Arial, sans-serif; color: #666666;"><a href="<?php the_permalink(); ?>" style="color: #2A5DB0;"><?php _e( 'Continue Reading', 'cebolang' ); ?></a></p>

				
				</td>

				
			</tr>
		</table>
		
		<img class="block" src="<?php bloginfo ('template_url'); ?>/images/divider.gif" height="61" alt="" style="display: block;" width="600" />
		
		<!-- =====================================    END BLOG POSTS =================================== -->
		<?php endwhile; endif; wp_reset_query(); ?>		
		
		<? } ?>
			
	<!-- =====================================  COMPANY INFORMATION  =================================== -->			
		
	

		
		<table class="social" cellspacing="0" style="font-size: 12px; margin: 30px 0 0; border-bottom: 1px solid #D0D0D0; font-family: Arial, sans-serif; line-height: 20px; color: #666666; border-top: 1px solid #D0D0D0;" bgcolor="#efefef" cellpadding="0">
			<tr>
				
				<td height="45" valign="middle" style="font-size: 12px; line-height: 20px; font-family: Arial, sans-serif; color: #666666;" width="600">&nbsp;<p style="color: #3a3a3a; text-decoration: none; padding: 0 20px 20px 20px; margin-top: -5px;"><?php echo get_option('cebo_quote'); ?></p>	</td>
				
							
			</tr>
		</table>

		<img class="block" src="<?php bloginfo ('template_url'); ?>/images/divider3.gif" height="25" alt="" style="display: block;" width="600" />

		
		<table cellspacing="0" align="center" style="font-size: 12px; line-height: 20px; font-family: Arial, sans-serif; color: #666666;" width="540" cellpadding="0">
			<tr>
			
				<td class="companyinfo" valign="top" style="font-size: 12px; line-height: 20px; font-family: Arial, sans-serif; color: #666666;" width="265">
				
					<p style="font-size: 12px; line-height: 20px; font-family: Arial, sans-serif; color: #666666;">
						<b style="color: #333333;"><?php echo get_option('cebo_company'); ?></b>
						<br><?php echo get_option('cebo_address'); ?>
						<br>Tel: <?php echo get_option('cebo_phone'); ?>
						<br>Email: <a href="mailto:<?php echo get_option('cebo_email'); ?>" style="color: #2A5DB0;"><?php echo get_option('cebo_email'); ?></a>

					</p>
		
				</td>
				<td style="font-size: 12px; line-height: 20px; font-family: Arial, sans-serif; color: #666666;" width="20">&nbsp;</td><!-- spacer column -->
				<td class="subscription" align="left" valign="top" style="padding-left: 150px; font-size: 12px; line-height: 20px; font-family: Arial, sans-serif; color: #666666;" width="255">
				
					
					<b style="color: #333333;"></b>
					<br>
					   
					<a href="<?php bloginfo('url'); ?>/feed/"><img style="float: left; margin: 0 10px;" src="<?php bloginfo ('template_url'); ?>/images/rss.png" alt="" /></a>
					
					<?php if (get_option('cebo_tweets')) { ?>
					
					<a href="http://twitter.com/<?php echo get_option('cebo_tweets'); ?>" target="_blank"><img style="float: left; margin: 0 10px;" src="<?php bloginfo ('template_url'); ?>/images/twitter1.png" alt="" /></a>
					
					<? } ?>
					
					<?php if (get_option('cebo_fb')) { ?>
					
					<a href="<?php echo get_option('cebo_fb'); ?>" target="_blank"><img style="float: left; margin: 0 10px;" src="<?php bloginfo ('template_url'); ?>/images/facebook.png" alt="" /></a>
					
					<? } ?>
					
				</td>
				
			</tr>
		</table>
		
		<img class="block" src="<?php bloginfo ('template_url'); ?>/images/divider3.gif" height="30" alt="" style="display: block;" width="600" />
			
	<!-- =====================================  COMPANY INFORMATION  =================================== -->	
			
	</td></tr></table>
	
	<br>

	
	<table cellspacing="0" align="center" style="font-size: 12px; line-height: 20px; font-family: Arial, sans-serif; color: #666666;" width="560" cellpadding="0">

	<tr><td class="copyright" align="center" valign="top" style="font-size: 12px; line-height: 20px; font-family: Arial, sans-serif; color: #666666;">
	
	<!-- START FOOTER CONTENT -->
		
		<p style="font-size: 12px; line-height: 20px; font-family: Arial, sans-serif; color: #666666;"><a href="<?php bloginfo ('url'); ?>"><?php echo get_option('cebo_company'); ?></a> <?php _e( 'All rights reserved.', 'cebolang' ); ?></h2></p>
	
	<!-- END FOOTER CONTENT -->
	
	</td></tr></table>

	
	<br>
	<br>

		
<!-- ///////////////////////////////////// End Newsletter Content  ///////////////////////////////////// -->
</td></tr></table><!-- end wrapper table-->	

</body>
</html> 