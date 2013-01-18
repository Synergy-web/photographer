<?php
/**
 * TEMPLATE NAME: Facebook Landing Tab Template
 *

 */
	get_header(); ?>
		
		
		<?php include(TEMPLATEPATH . '/library/panel.php'); ?>
		
			<?php if(get_option('cebo_logo') == '') { ?>

			<h1 style="text-align: center;"><a href="<?php bloginfo ('url'); ?>"><img src="<?php bloginfo ('template_url'); ?>/images/logo.png" alt="<?php bloginfo('description'); ?>" /></a></h1>
			
			<? } else { ?>
			
			<h1 style="text-align: center; position: relative;"><a href="<?php bloginfo ('url'); ?>"><img src="<?php echo get_option('cebo_logo'); ?>"></a></h1>
			
			<? } ?>
		
			<div class="fb-main">
			
				<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				
				
				<a href="<?php the_permalink(); ?>"><img src="<?php echo sp_get_image(); ?>" alt="<?php the_title(); ?>" width="750" /></a>
				
				<?php endwhile; endif; wp_reset_query(); ?>	
				
				<?php if(get_option('cebo_welcomebox') == 'true') { ?>
				
					<div class="hellobox">
			     
			     		<p><?php echo get_option('cebo_quote'); ?></p>
	
			     	</div>
			     	
		     	<? } ?>
				
			</div>

		<div class="fb-arena" style="position: relative; top: 0px;">
	
			<article style="padding: 0px 15px 30px 15px; position: relative;">
					
				<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				
				
					<h1 class="fbhead"><?php the_title(); ?></h1>
					
					<?php $contactus = get_page_with_template('page-contact');
					$contactusnow = get_permalink($contactus); ?>
					
					
					
					<a class="trigger" style="display: block; width: 100%;" href="#"><img style="padding: 10px 15px; background-color: #000000; position: absolute; z-index: 999; width: 35px; right: 0; top: -40px;" src="<?php bloginfo ('template_url'); ?>/images/contact_bubble.png" alt="Contact Us" /></a>
					
					<?php the_content(); ?>
					
				<?php endwhile; endif; wp_reset_query(); ?>	
				
			<?php if(get_option('cebo_fbposts') == 'true') { ?>
			
			<h2 style="text-align: center;"><?php _e('From Our Blog', 'cebolang'); ?></h2>	
			
			<ul class="postlings">
							
			<?php $fbcount = get_option('cebo_fbcount'); query_posts('post_type=post&posts_per_page=' . $fbcount); if(have_posts()) : while(have_posts()) : the_post(); ?>
						
						
						<li>
						
							<?php if(get_post_meta($post->ID, 'youtube', $single = true)) { ?>
							
							<iframe width="630" height="360" src="http://www.youtube.com/embed/<?php echo get_post_meta($post->ID, 'youtube', $single = true); ?>"></iframe>	
							
							<? } elseif (get_post_meta($post->ID, 'vimeo', $single = true)) { ?>
							
							<iframe src="http://player.vimeo.com/video/<?php echo get_post_meta($post->ID, 'vimeo', $single = true); ?>" width="630" height="360"></iframe>
							
							<?php } elseif(sp_get_image()) { ?> 
							
							<a href="<?php the_permalink(); ?>"><img src="<?php echo sp_get_image(); ?>" alt="<?php the_title(); ?>" /></a>
							
							<? } ?>

							
							<h3><?php the_title(); ?></h3>
							
							<small><?php _e('Written By ', 'cebolang'); ?><?php the_author(); ?><?php _e(' on ', 'cebolang'); ?><?php the_time('F jS') ?>&nbsp; &nbsp; &nbsp; / &nbsp; &nbsp; &nbsp;<?php comments_popup_link(' No Comments', ' 1 Comment', ' % Comments'); ?></small>
							
							<p><?php echo excerpt(40); ?></p>
							
							<a class="readmore" href="<?php the_permalink(); ?>"><?php _e('Read More', 'cebolang'); ?></a>
						
						</li>
						
						<?php endwhile;  endif; wp_reset_query(); ?>
					
						</ul>
			
			<? } ?>
			
			<?php if(get_option('cebo_fbprojects') == 'true') { ?>
	
			<h2 style="text-align: center; border-top: none; margin-top: -15px;"><?php _e('From Our Portfolio', 'cebolang'); ?></h2>
		
	
			 <div id="thumbnails" style="margin-left: 23px; width: 670px;">
	            <ul>
					<?php query_posts(
						array(
								'post_type' => 'project',
								'posts_per_page' => 2
							)
							); if(have_posts()) : while(have_posts()) : the_post(); ?>
					
	                <li class="<?php $product_terms = wp_get_object_terms($post->ID, 'type'); if(!empty($product_terms)) { if(!is_wp_error( $product_terms )) { echo ''; foreach($product_terms as $term){ echo ''.$term->slug.' '; }  echo ''; } } ?> element   " data-symbol="N" data-category="other">
	                
	                    <a href="<?php the_permalink(); ?>"><img src="<?php bloginfo('template_directory'); ?>/tools/timthumb.php?src=<?php echo sp_get_image(); ?>&amp;h=306&amp;w=300&amp;zc=1" alt="<?php the_title(); ?>"/><span></span></a>
	                    <div class="title"><h4><?php the_title(); ?></h4><p><?php $product_terms = wp_get_object_terms($post->ID, 'type'); if(!empty($product_terms)) { if(!is_wp_error( $product_terms )) { echo ''; $count = 0; foreach($product_terms as $term){ if($count > 0) { echo '+ '; } echo ''.$term->name. ' ';  $count++; }  } } ?></p>
	                    <p><?php echo excerpt(18); ?></p>
	                    <span class="shadow"><img src="<?php bloginfo ('template_url'); ?>/images/smallshadow.png"></span></div>
	                    
	                    <p class="arrowlink"><a href="<?php the_permalink(); ?>"><img src="<?php bloginfo ('template_url'); ?>/images/arrowlink.png"></a></p>
	                    
	                </li>
	
	               <?php endwhile; endif; wp_reset_query(); ?>	
	                
	            </ul>
	            
	            
	            <div class="clear"></div>
	            
	        </div>
	        
	        <?php $projects = get_page_with_template('page-portfolio');
				  $projecturl= get_permalink($projects);	
			?>
	        
	        <a href="<?php echo $projecturl; ?>" class="seeall"><?php _e('See All <span>Projects</span>', 'cebolang'); ?></a>
	        
	        <? } ?>
	        
	        <div class="clear"></div>
	        
	        </article>
	
	</div><!-- end fb container -->
	
	<p class="copyright"><? _e('this wordpress theme was designed, developed and made with care by <a href="http://cebocampbell.com">Cebo Campbell</a>', 'cebolang'); ?></p>
	
</body>
</html>