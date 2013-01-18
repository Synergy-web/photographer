<?php
/**
 * TEMPLATE NAME: Team Page Template
 */

	get_header(); ?>
		 
		</div><!-- end #header -->	
		
	<div class="pagecontainer lined">
	
		<div class="container" id="wider">
			
			<?php include(TEMPLATEPATH . '/library/lownav_breadcrumbs.php'); ?>
			
			<div class="clear"></div>
			
				<div class="hello">
				
				<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				
					<h3 align="center"><?php echo excerpt(9999999); ?></h3>
					
				<?php endwhile; endif; wp_reset_query(); ?>	
					
				</div>
			
			 <div id="thumbnails" class="wider teamwide">
			 
	            <ul>
	            
	            	<?php query_posts(
						array(
								'post_type' => 'team',
								'posts_per_page' => -1
							)
							); if(have_posts()) : while(have_posts()) : the_post(); ?>
							
	
	               <li class="element other nonmetal cherrypick" data-symbol="N" data-category="other">
	                
	                	<span class="socialbar">
	                		
	                		<?php if(get_post_meta ($post->ID, 'twitter', $single = true)) { ?>
	                		
	                		<a href="<?php echo get_post_meta ($post->ID, 'twitter', $single = true); ?>" title="Find Me on Twitter" target="_blank"><img src="<?php bloginfo ('template_directory'); ?>/images/twitter1.png" class="soc"  alt="Find Me on Twitter"/></a>
	                		
	                		<? } ?>
	                		
	                		<?php if(get_post_meta ($post->ID, 'facebook', $single = true)) { ?>
	                		
	                		<a href="<?php echo get_post_meta ($post->ID, 'facebook', $single = true); ?>" title="Find Me on Facebook" target="_blank"><img src="<?php bloginfo ('template_directory'); ?>/images/facebook.png" class="soc" /></a>
	                		
	                		<? } ?>
	                		
	                		<?php if(get_post_meta ($post->ID, 'linkedin', $single = true)) { ?>
	                		
	                		<a href="<?php echo get_post_meta ($post->ID, 'linkedin', $single = true); ?>" title="Find Me on Linkedin" target="_blank"><img src="<?php bloginfo ('template_directory'); ?>/images/linkedin.png" class="soc" /></a>
	                		
	                		<? } ?>
	                		
	                	</span>
	                	
	                	<?php if(sp_get_image()) { ?>
	                	
	                   <img src="<?php bloginfo('template_directory'); ?>/tools/timthumb.php?src=<?php echo sp_get_image(); ?>&amp;h=226&amp;w=220&amp;zc=1" alt="<?php the_title(); ?>"/><span></span>
	                    
	                    <? } else { ?>
	                    
	                    <img src="<?php bloginfo ('template_directory'); ?>/images/silhouette.jpg" width="220" alt="Preview"/><span></span>
	                    
	                    <? } ?>
	                    
	                    <div class="title"><h4><?php the_title(); ?></h4><p style="font-size: 13px"><?php echo get_post_meta ($post->ID, 'title', $single = true); ?></p>
	                    
	                    <p style="max-width: 280px;"><?php echo excerpt(18); ?>...</p>
	                    
	                    </div>
	                    
	                </li>
	                
	                <div class="clear"></div>
	
	                <?php endwhile; endif; wp_reset_query(); ?>	
	            </ul>
	            
	            
	            <div class="clear"></div>
	            
	        </div>
	      
	        
	        
	        <div class="clear"></div>
	        
		
		</div><!-- end container-->	
	
	</div><!-- end widecontainter -->
	
		
<?php get_footer(); ?>