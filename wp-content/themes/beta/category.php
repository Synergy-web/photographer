<?php 

	/*
		Category Template
		
	*/

get_header(); ?>

	<div class="widecontainer">		
				
		<div class="pagecontainer">
		
			<div class="content">
			
				<article>
					
					
					<?php if (have_posts()) : ?>

				    <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
                    <?php /* If this is a category archive */ if (is_category()) { ?>
                    <h1><?php _e('Results for the &#8216;', 'cebolang'); ?><?php single_cat_title(); ?>&#8217; <?php _e('Category', 'cebolang'); ?></h1>
                    <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
                    <h1><?php _e('Posts Tagged &#8216;', 'cebolang'); ?><?php single_tag_title(); ?>&#8217;<span></span></h1>
                    <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
                    <h1><?php _e('Results for', 'cebolang'); ?> <?php the_time('F jS, Y'); ?></h1>
                    <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
                    <h1><?php _e('Results for', 'cebolang'); ?> <?php the_time('F, Y'); ?></h1>
                    <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
                    <h1><?php _e('Results for', 'cebolang'); ?> <?php the_time('Y'); ?></h1>
                    <?php /* If this is an author archive */ } elseif (is_author()) { ?>
                    <h1><?php _e('Results Archive', 'cebolang'); ?></h1>
                    <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
                    <h1><?php _e('Results', 'cebolang'); ?></h1>
                    <?php } ?>
                    
					<ul class="postlings">
					
					
						<?php while(have_posts()) : the_post(); ?>
					
					
						<li>
						
							<?php if(get_post_meta($post->ID, 'embed', $single = true)) { ?>
							
							<div class="video-container">
		            				
		            				<?php echo get_post_meta($post->ID, 'embed', $single = true); ?>
		            		
		            		</div>
		            			
		            			<?php } elseif(get_post_meta($post->ID, 'youtube', $single = true)) { ?>
		            			
		            		<div class="video-container">
							
							<iframe width="630" height="360" src="http://www.youtube.com/embed/<?php echo get_post_meta($post->ID, 'youtube', $single = true); ?>" frameborder="0" allowfullscreen></iframe>	
							
							</div>
							
							<? } elseif (get_post_meta($post->ID, 'vimeo', $single = true)) { ?>
							
							<div class="video-container">
							
							<iframe src="http://player.vimeo.com/video/<?php echo get_post_meta($post->ID, 'vimeo', $single = true); ?>" width="630" height="360" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
							
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
					

                    <div class="navigation">
                        <div class="alignleft"><?php next_posts_link('&laquo;' .   __(' Older Entries' , 'cebolang')) ?></div>
                        <div class="alignright"><?php previous_posts_link( __('Newer Entries ', 'cebolang') .  '&raquo;') ?></div>
                        <div class="clear"></div>
                    </div>
					<?php else : ?>
					
					<p><?php _e('Sorry, no posts in this category' , 'cebolang'); ?></p>
					
					 <?php endif; ?>
					 
					 
					 </ul>
					 
				</article>
				
				
				
				<?php get_sidebar(); ?>
					
				
			</div><!-- end content section -->
			
			<div class="clear"></div>
		
		
		</div><!-- end page section -->
	
	
	</div><!-- end widecontainter -->
	
		
<?php get_footer(); ?>