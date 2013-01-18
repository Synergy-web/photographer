<?php

/* 
	Standard Page Template
*/

get_header(); ?>
		 
		</div><!-- end #header -->

	<div class="widecontainer">		
				
		<div class="pagecontainer lined">
		
		<?php include(TEMPLATEPATH . '/library/lownav_breadcrumbs.php'); ?>
		
			<div class="content">
			
				<article>
				
				<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				
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
							
							<?php } ?>
							
							
				
					<h1><?php the_title(); ?></h1>
					
							<?php the_content(); ?>
							
							
					        <div class="clear"></div>
					        
					       <?php if (get_option('cebo_socialshare') == 'true') { ?>
				
							<!-- AddThis Button BEGIN -->
								<div class="addthis_toolbox addthis_default_style ">
								<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
								    <a href="https://twitter.com/share" class="twitter-share-button" data-lang="en">Tweet</a>
									<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
									<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
								</div>
								<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4fe9e0b650672f1a"></script>
								<div class="clear"></div>
								<!-- AddThis Button END -->
								
							<? } ?>
							
							
							<div class="authorbox">
							
										<?php
											$user_info = get_the_author_meta('user_nicename',$post->post_author);
											$author_url=get_author_posts_url($post->post_author,$user_info);
											?>
								
										<a href="<?php echo $author_url; ?>"><?php echo get_avatar( get_the_author_meta('email'), '70' ); ?></a>
									
										<h5><a href="<?php echo $author_url; ?>"><?php the_author_link(); ?></a></h5>
										<p><?php the_author_meta('description'); ?></p>
							
							</div>
							
					        <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'cebolang' ), 'after' => '</div>' ) ); ?>
					        
            				
            				<?php comments_template( '', true ); ?>
					
							
							<?php endwhile; endif; wp_reset_query(); ?>
					

						
				        <?php edit_post_link( __( 'Edit', 'cebolang' ), '<span class="edit-link">', '</span>' ); ?>
				        
				    </article><!-- #post-## -->
				    
				    
				    <?php get_sidebar(); ?>					
				
			</div><!-- end content section -->
			
			<div class="clear"></div>
		
		
		</div><!-- end page section -->
	
	
	</div><!-- end widecontainter -->
	
		
<?php get_footer(); ?>


				    
				    
				
				</div>
				
				<?php get_sidebar(); ?>

			</div><!-- end pagecontent-->
			
		</div><!-- end container-->
		
<?php get_footer(); ?>