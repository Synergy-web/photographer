<?php

/* 
* TEMPLATE NAME: Contact Page Template
*/

get_header(); ?>
		 
		

	<div class="widecontainer">		
				
		<div class="pagecontainer lined" style="top: -30px;">
		
		<?php include(TEMPLATEPATH . '/library/lownav_breadcrumbs.php'); ?>
		
			<div class="content">
			
				<article>
					
					<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
					
					<h3 class="mega"><?php the_title(); ?></h3>
				
					<?php the_content(); ?>
					
					
					<?php endwhile; endif; wp_reset_query(); ?>
					
					<form class="inquiryform" action="<?php bloginfo ('template_url'); ?>/library/form.php" method="post">
						<div class="form">
		                	
		                	<div class="primaryinputs">
		                		
		                		<span>
			                		<label><?php _e( 'Your Name (required)', 'cebolang' ); ?></label>
			                		<input type="text" style="line-height: normal;" onfocus="if(this.value == 'Your Name'){this.value = '';}" name="name" onblur="if(this.value == ''){this.value='Your Name';}" value="Your Name"  />
			                	</span>
		                		
		                		<span>
			                		<label><?php _e( 'Your Email (required', 'cebolang' ); ?>)</label>
			                		<input type="text" style="line-height: normal;" onfocus="if(this.value == 'Your Email'){this.value = '';}" name="email" onblur="if(this.value == ''){this.value='Your Email';}"  value="Your Email"  />
			                	</span>
		                		
		                		<span>
			                		<label><?php _e( 'Your Telephone (optional)', 'cebolang' ); ?></label>
			                		<input type="text" style="line-height: normal;" onfocus="if(this.value == 'Your Telephone'){this.value = '';}" name="tel" onblur="if(this.value == ''){this.value='Your Telephone';}" value="Your Telephone"  />
			                		<input name="emailer" type="hidden" value="<?php echo get_option('cebo_email'); ?>"  />
			                	</span>
			                	
			                	<div class="clear"></div>
		                	
		                	
		                	</div>
		                	
		                	<div class="singulartext">
		                		
		                		<span>
			                		<label><?php _e( 'Your Message (required)', 'cebolang' ); ?></label>
			                		<textarea style="line-height: normal;" onfocus="if(this.value == 'Your Message'){this.value = '';}" name="message" onblur="if(this.value == ''){this.value='Your Message';}"></textarea>
			                	</span>
		                	
		                	</div>
		                	
		                	<div class="clear"></div>
		                	
		                	<div class="submitcontain">
		                	
		                		
		                		
		                		<label><img src="<?php bloginfo ('template_url'); ?>/library/captcha.php"></label>
								<input class="cap" type="text" name="code"> <br /> 
				
								<input type="submit" class="submit captain" name="submit" value="<?php _e( 'Send message', 'cebolang' ); ?>" />
		                	
		                	</div>
		                	
						</div>
					</form>
	
				
				</article>
				
				
				
				<?php get_sidebar(); ?>					
				
			</div><!-- end content section -->
			
			<div class="clear"></div>
		
		
		</div><!-- end page section -->
	
	
	</div><!-- end widecontainter -->
	
		
<?php get_footer(); ?>