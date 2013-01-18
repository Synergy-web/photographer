<?php
/**
 * TEMPLATE NAME: Portfolio Template
 */

	get_header(); ?>
		 
		</div><!-- end #header -->	
		
	<div class="pagecontainer lined">
	
		<div class="container" id="wider">
			
			<?php include(TEMPLATEPATH . '/library/lownav_breadcrumbs.php'); ?>
			
			<div class="hello">
				
				<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				
					<h3><?php echo excerpt(9999999); ?></h3>
					
				<?php endwhile; endif; wp_reset_query(); ?>	
					
				</div>
				
		
			<?php include(TEMPLATEPATH . '/library/filter.php'); ?>
			
			<div class="clear"></div>
		
			
			
			<div id="thumbnails" class="wider">
			
	            <ul>
					<?php query_posts(
						array(
								'post_type' => 'project',
								'posts_per_page' => -1
							)
							); if(have_posts()) : while(have_posts()) : the_post(); ?>
					
	                <li class="<?php $project_terms = wp_get_object_terms($post->ID, 'type'); if(!empty($project_terms)) { if(!is_wp_error( $project_terms )) { echo ''; foreach($project_terms as $term){ echo ''.$term->slug.' '; }  echo ''; } } ?> element   " data-symbol="N" data-category="other">
	                
	                    <a href="<?php the_permalink(); ?>"><img src="<?php bloginfo('template_directory'); ?>/tools/timthumb.php?src=<?php echo sp_get_image(); ?>&amp;h=306&amp;w=300&amp;zc=1" alt="<?php the_title(); ?>"/><span></span></a>
	                    <div class="title"><h4><?php the_title(); ?></h4><p><?php $project_terms = wp_get_object_terms($post->ID, 'type'); if(!empty($project_terms)) { if(!is_wp_error( $project_terms )) { echo ''; $count = 0; foreach($project_terms as $term){ if($count > 0) { echo '+ '; } echo ''.$term->name. ' ';  $count++; }  } } ?></p>
	                    <p><?php echo excerpt(18); ?></p>
	                    <span class="shadow"><img src="<?php bloginfo ('template_url'); ?>/images/smallshadow.png"></span></div>
	                    
	                    <p class="arrowlink"><a href="<?php the_permalink(); ?>"><img src="<?php bloginfo ('template_url'); ?>/images/arrowlink.png"></a></p>
	                    
	                </li>
	
	               <?php endwhile; endif; wp_reset_query(); ?>	
	                
	            </ul>
	            
	            
	            <div class="clear"></div>
	            
	        </div>	        
	        
	        <div class="clear"></div>
	        
		
		</div><!-- end container-->	
	
	</div><!-- end widecontainter -->
	
		
	<?php get_footer(); ?>