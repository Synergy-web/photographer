<?php

/* 
	404
*/

get_header(); ?>
		 
		</div><!-- end #header -->

	<div class="widecontainer">		
				
		<div class="pagecontainer lined">
		
		<?php include(TEMPLATEPATH . '/library/lownav_breadcrumbs.php'); ?>
		
			<div class="content">
			
				<article>

					<h1><?php _e( 'Ooops, my friend.', 'cebolang' ); ?></h1>
					
					<p><?php _e( 'It looks as though the page you requested could not be found. Please use the navigation above to find what you are looking for.', 'cebolang' ); ?></p>

				</article>
				
				
				
				<?php get_sidebar(); ?>					
				
			</div><!-- end content section -->
			
			<div class="clear"></div>
		
		
		</div><!-- end page section -->
	
	
	</div><!-- end widecontainter -->
	
		
<?php get_footer(); ?>