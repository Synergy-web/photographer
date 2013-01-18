<?php
/**
 * The template for displaying Search Results pages.
 */

get_header(); ?>

	<div class="widecontainer">		
				
		<div class="pagecontainer">
		
			<div class="content">
			
				<article>


					<?php if ( have_posts() ) : ?>
					
					    <h1><?php printf( __( 'Search Results for: %s', 'cebolang' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
					    
					    
					    <ul class="postlings">
					    
					    <?php while(have_posts()) : the_post(); ?>
					    
					    
					    <li>
							
							<?php if(get_post_meta($post->ID, 'youtube', $single = true)) { ?>
							
							<iframe width="630" height="360" src="http://www.youtube.com/embed/<?php echo get_post_meta($post->ID, 'youtube', $single = true); ?>" frameborder="0" allowfullscreen></iframe>	
							
							<? } elseif (get_post_meta($post->ID, 'vimeo', $single = true)) { ?>
							
							<iframe src="http://player.vimeo.com/video/<?php echo get_post_meta($post->ID, 'vimeo', $single = true); ?>" width="630" height="360" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
							
							<?php } elseif(sp_get_image()) { ?> 
							
							<a href="<?php the_permalink(); ?>"><img src="<?php echo sp_get_image(); ?>" alt="<?php the_title(); ?>" /></a>
							
							<? } ?>

							
							<h3><?php the_title(); ?></h3>
							
							<small><?php _e('Written By ', 'cebolang'); ?><?php the_author(); ?><?php _e(' on ', 'cebolang'); ?><?php the_time('F jS') ?>&nbsp; &nbsp; &nbsp; / &nbsp; &nbsp; &nbsp;<?php comments_popup_link(' No Comments', ' 1 Comment', ' % Comments'); ?></small>
							
							<p><?php echo excerpt(40); ?></p>
							
							<a class="readmore" href="<?php the_permalink(); ?>"><?php _e('Read More', 'cebolang'); ?></a>
						
						</li>
						
						
					    
				<?php endwhile; ?>
					

                    <div class="navigation">
                        <div class="alignleft"><?php next_posts_link('&laquo;' .   __(' Older Entries' , 'cebolang')) ?></div>
                        <div class="alignright"><?php previous_posts_link( __('Newer Entries ', 'cebolang') .  '&raquo;') ?></div>
                        <div class="clear"></div>
                    </div>
					<?php else : ?>
					
					<p><?php _e('Sorry, no posts in this search' , 'cebolang'); ?></p>
					
					 <?php endif; ?>
					 
					 
					 </ul>
					 
				</article>
				
				
				
				<?php get_sidebar(); ?>
					
				
			</div><!-- end content section -->
			
			<div class="clear"></div>
		
		
		</div><!-- end page section -->
	
	
	</div><!-- end widecontainter -->
	
		
<?php get_footer(); ?>