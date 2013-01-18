<?php 

	/* Primary Header File */
	
	get_header(); 
	
?>

	<?php if(get_option('cebo_boxes') == 'true') { ?>
	
	<div id="smartbar">
	
		
	
		<ul id="widenav">

			<li>
			<h2><?php echo get_option('cebo_box1title'); ?></h2>
				
				<p><?php echo get_option('cebo_box1info'); ?></p>
			</li>
			<li>
				<h2><?php echo get_option('cebo_box2title'); ?></h2>
				
				<p><?php echo get_option('cebo_box2info'); ?></p>
			</li>
			<li>
				<h2><?php echo get_option('cebo_box3title'); ?></h2>
				
				<p><?php echo get_option('cebo_box3info'); ?></p>
			</li>
		</ul>
	
	</div>
	
	<? } ?>

	<div class="widecontainer">
	
	<?php if(get_option('cebo_showprojects') == 'true') { ?>
	
		<div style="padding-top: 20px;" class="container" id="wider">
			
			
		
			<?php include(TEMPLATEPATH . '/library/filter.php'); ?>
			
			<div class="clear"></div>
		
			
			 <div id="thumbnails" class="wider">
	            <ul>
					<?php 
						$pcount = get_option('cebo_projectcount');
						
						query_posts(
						array(
								'post_type' => 'project',
								'posts_per_page' => $pcount
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
	        
	        <?php if($projects) { ?>
	        
	        <a href="<?php echo $projecturl; ?>" class="seeall"><?php _e('See All <span>Projects</span>', 'cebolang'); ?></a>
	        
	        <? } ?>
	        
	        
	        <div class="clear"></div>
	        
		
		
		
		</div><!-- end container-->
		
		<? } ?>
		
		<div class="pagecontainer">
		
			<div class="content">
			
				<article>
				
					<h3 class="mega"><?php _e('Recent Updates', 'cebolang'); ?></h3>
				
					<ul class="postlings">
							
						<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
						
						
						<li>
						
						<?php if(get_post_meta($post->ID, 'embed', $single = true)) { ?>
						
						<div class="video-container">
			            				
			            <?php echo get_post_meta($post->ID, 'embed', $single = true); ?>
			            
			            </div>
			            			
			            <?php } elseif(get_post_meta($post->ID, 'youtube', $single = true)) { ?>
						
						<div class="video-container">
							
							<iframe width="630" height="360" src="http://www.youtube.com/embed/<?php echo get_post_meta($post->ID, 'youtube', $single = true); ?>"></iframe>	
						</div>	
							<? } elseif (get_post_meta($post->ID, 'vimeo', $single = true)) { ?>
							
							<div class="video-container">
							
							<iframe src="http://player.vimeo.com/video/<?php echo get_post_meta($post->ID, 'vimeo', $single = true); ?>" width="630" height="360"></iframe>
							</div>
							
							<?php } elseif(sp_get_image()) { ?> 
							
							<a href="<?php the_permalink(); ?>"><img src="<?php echo sp_get_image(); ?>" alt="<?php the_title(); ?>" /></a>
							
							<? } ?>

							
							<h3><?php the_title(); ?></h3>
							
							<small><?php _e('Written By ', 'cebolang'); ?><?php the_author(); ?><?php _e(' on ', 'cebolang'); ?><?php the_time('F jS') ?>&nbsp; &nbsp; &nbsp; &bull; &nbsp; &nbsp; &nbsp;<?php comments_popup_link(' No Comments', ' 1 Comment', ' % Comments'); ?>&nbsp; &nbsp; &nbsp; &bull; &nbsp; &nbsp; &nbsp;<?php the_category(' + ') ?></small>
							
							<p><?php echo excerpt(40); ?></p>
							
							<a class="readmore" href="<?php the_permalink(); ?>"><?php _e('Read More', 'cebolang'); ?></a>
						
						</li>
						
						<?php endwhile; ?>
					
						</ul>
						
						
                    <div class="navigation">
                        <div class="alignleft"><?php next_posts_link('&laquo;' .   __(' Older Entries' , 'cebolang')) ?></div>
                        <div class="alignright"><?php previous_posts_link( __('Newer Entries ', 'cebolang') .  '&raquo;') ?></div>
                        <div class="clear"></div>
                    </div>
					<?php else : ?>
					
					<p><?php _e('Sorry, no posts in this category' , 'cebolang'); ?></p>
					
					 <?php endif; ?>	

					
					
					
					
				
				</article>

				<?php get_sidebar(); ?>
				
				
			</div><!-- end content section -->
			
			<div class="clear"></div>
		
		
		</div><!-- end page section -->
	
		
	</div><!-- end widecontainter -->
	
	<?php get_footer(); ?>	