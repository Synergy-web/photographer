<?php

/* 
	Single Portfolio
*/

get_header(); ?>
		 
		</div><!-- end #header -->

	<div class="widecontainer">		
		
		<div class="topshadow"></div>	
			
		<div class="pagecontainer lined">
		
		
		<?php include(TEMPLATEPATH . '/library/lownav_breadcrumbs.php'); ?>
		
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>	 
         
         
        <!-- ============================ IF YOU HAVE MORE THAN FIVE IMAGEs, THE GALLERY WILL DISPLAY ================== -->
        
          	
		<?php if(sp_get_image(1)): ?>   
		<?php $i = 0; while($i <= 4) : ?>
    	<?php if(sp_get_image($i)) : ?>   
        
        
          <!-- ============================ BEGIN GALLERY ================== -->   	    		
		<div id="carousel-gallery" class="touchcarousel  black-and-white">       			
    		<ul class="touchcarousel-container">
    		
    			<?php if(sp_get_image(1)): ?>   
				<?php $i = 0; while($i <= 20) : ?>
            	<?php if(sp_get_image($i)) : ?>                       	
            		
            		<li class="touchcarousel-item">
			         <span class="expand"><a rel="shadowbox[group]" style="lightbox" href="<?php echo sp_get_image($i); ?>"></a></span><img src="<?php echo sp_get_image($i); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
			        </li>
			         	
            	<?php else : break; endif; ?>
                <?php $i++; ?>
				<?php endwhile; ?>
                <?php endif; ?>	 
			                	
    		</ul>
    	</div>
    	
    	<!-- ============================ END GALLERY ================== -->
		<?php else : break; endif; ?>
                <?php $i++; ?>
				<?php endwhile; ?>
                <?php endif; ?>	 
                
		  <!-- ============================ END QUERY ================== -->
			<div class="content">
			
				<article>
				
					<h1><?php the_title(); ?></h1>
					
					<?php the_content(); ?>
					
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
							
							
					<?php comments_template( '', true ); ?>
					
					<?php endwhile; endif; wp_reset_query(); ?>	
					
					
				</article>
				
		
		
		<!-- ======================================   SIDEBAR ==================================== -->
		
				
		<?php get_sidebar(); ?>
							
				
			</div><!-- end content section -->
			
			<div class="clear"></div>
		
		
		</div><!-- end page section -->
	
	
	</div><!-- end widecontainter -->
	
		
	<?php get_footer(); ?>