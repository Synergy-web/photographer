<?php
/**
 * The Sidebar 
 */
?>

		<!-- this is the sidebar -->
				
				<aside>
				
					<!--+++++++++======================================= IF IS ON THE PROJECT PAGE TEMPLATE ===================================++++++ -->
						
						
					<?php if(get_post_type() == 'project')  { ?>
					
					<?php if(get_post_meta ($post->ID, 'cebo_dater', $single = true ) || get_post_meta ($post->ID, 'cebo_link', $single = true )) { ?>
					
					
						<div class="projectinfo">
						
						<?php if(get_post_meta ($post->ID, 'cebo_dater', $single = true )) { ?>
					
						<p class="date"><?php echo get_post_meta ($post->ID, 'cebo_dater', $single = true ); ?></p>
						
						<? } ?>
						
						<?php if(get_post_meta ($post->ID, 'cebo_link', $single = true )) { ?>
						
						<p class="captain"><a href="<?php echo get_post_meta ($post->ID, 'cebo_link', $single = true ); ?>"><?php _e('View Project', 'cebolang'); ?></a></p>
						
						<? } ?>
						
						<div class="clear"></div>
						
					
					</div>
					
					<? } ?>
					
					<? } ?>
					
					
					<!--+++++++++======================================= IF IS ON THE CONTACT US PAGE TEMPLATE ===================================++++++ -->
					
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
					
					
					
					<div class="searchcontainer">
						
						<!--BEGIN #searchform-->
						<form class="searchform" method="get" action="<?php bloginfo( 'url' ); ?>">
							<input class="search" name="s" type="text" value="<?php _e('Search…', 'cebolang'); ?>"  onfocus="if(this.value==this.defaultValue){this.value='';}" onblur="if(this.value==''){this.value=this.defaultValue;}" tabindex="1" />
						    <button class="search-btn" type="submit" tabindex="2"></button>
						</form>
						<!--END #searchform-->
					
					</div>
					
				<!-- begin side tabs -->
				
				<?php if (get_option('cebo_tabs') == 'true') { ?>
				
				
				<div class="sidetabs">

					<ul class="tabs">
					    <li><a href="#tab1"><?php _e('Comments', 'cebolang'); ?></a></li>
					    <li><a href="#tab2"><?php _e('Recent', 'cebolang'); ?></a></li>
					    <li><a href="#tab3"><?php _e('Popular', 'cebolang'); ?></a></li>
					</ul>

					<div class="tab_container">
					
						<!--=======================================  GRABS THE MOST RECENT COMMENT AND POST LINK ===========================-->
					
						<div id="tab1" class="tab_content">
							<?php $comments = get_comments('status=approve&number=1'); ?>
							<?php foreach ($comments as $comment) { ?>
							    <?php
							        $title = get_the_title($comment->comment_post_ID);
							        echo get_avatar( $comment, '53' );
							        echo '<p class="quoter">' . ($comment->comment_author) . '';
							        ?><?php _e(' said: ', 'cebolang'); ?></p><div class="clear"></div><p class="quote"> "<?php
							        echo wp_html_excerpt( $comment->comment_content, 72 ); ?>…"<br><a  class="slicker" href="<?php echo get_permalink($comment->comment_post_ID); ?>"
							           rel="external nofollow" title="<?php echo $title; ?>">
							           <?php echo $title; ?> </a></p>
							   
							<?php }  ?> 
					       
					    </div>
					    <div id="tab2" class="tab_content">
					       <div class="tabcontain">
					       
					       <!--=======================================  GRABS THE MOST RECENT POSTS  ===========================-->
					       
					      		<ul>
					      			<?php query_posts('posts_per_page=5'); if(have_posts()) : while(have_posts()) : the_post(); ?>
					      			
					      			<li>
					      				<?php if(sp_get_image()) { ?>
					      				<a href="<?php the_permalink(); ?>"><img src="<?php bloginfo('template_directory'); ?>/tools/timthumb.php?src=<?php echo sp_get_image(); ?>&amp;h=50&amp;w=60&amp;zc=1" alt="<?php the_title(); ?>" /></a>
					      				<? } ?>
					      				<a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>					      																		<p><?php echo excerpt(8); ?></p>
					      			
					      			</li>
					      			
					      			<?php endwhile; endif; wp_reset_query(); ?>	
					      			
					      		</ul>
					      		
					       </div>
					    </div>
					    <div id="tab3" class="tab_content">
					      
					      <div class="tabcontain">
					      	
					      	<!--=======================================  GRABS THE MOST POPULAR POSTS ===========================-->
					       
					      		<ul>
					      			
					      			<?php
										$popular_posts = new WP_Query('orderby=comment_count&posts_per_page=5');
										while ($popular_posts->have_posts()) : $popular_posts->the_post(); ?>

					      			<li>
					      				<?php if(sp_get_image()) { ?>
					      				<a href="<?php the_permalink(); ?>"><img src="<?php bloginfo('template_directory'); ?>/tools/timthumb.php?src=<?php echo sp_get_image(); ?>&amp;h=50&amp;w=60&amp;zc=1" alt="<?php the_title(); ?>" /></a>
					      				<? } ?>
					      				<a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>					      																		<p><?php echo excerpt(8); ?></p>
					      				
					      			</li>
					      			
					      			<?php endwhile; ?>

					      								      			
					      		</ul>
					      		
					       </div>
					    </div>
					</div>
				
					<div class="clear"></div>

				</div><!-- end side tabs -->
				
				<? } ?>
				
				<?php if (get_option('cebo_tweets')) { ?>
				
				<div class="tweetbox">
					
					<div class="tweet"></div>
					
					
					<a class="followbird" href="http://twitter.com/<?php echo get_option('cebo_tweets'); ?>"><?php _e('Follow us on <span>Twitter</span>', 'cebolang'); ?></a>
				
				</div>
				
				<? } ?>
				
				<!-- widgetized  -->

		     		<?php if ( !function_exists('dynamic_sidebar')
							|| !dynamic_sidebar('Sidebar') ) : ?>
					<?php endif; ?>  
		
		     	<!-- widgetized  -->
				
				</aside>
				
				<div class="clear"></div>
				
				
				<!-- end this sidebar -->		