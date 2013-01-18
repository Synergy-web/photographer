<?php 
/*

This is the template for your individual Agents Pages

*/

get_header(); ?>
		
		<div class="page">
		
		<div class="content">
		
		<div class="vline"></div>
		
		<div class="intro">
		
		<?php include  ( TEMPLATEPATH . '/includes/breadcrumbs.php'); ?>
		
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
		
			<h1><?php the_title(); ?></h1>
			
			<div class="fullagent">
			
				<?php if (sp_get_image()) { ?>
				
					<img src="<?php bloginfo('template_directory'); ?>/tools/timthumb.php?src=<?php echo sp_get_image(); ?>&amp;h=240&amp;w=220&amp;zc=1"/>
				
				<? } ?>
				
					<ul class="agent_information">
					
						<li><p>Office Phone: <?php echo get_post_meta ($post->ID, 'cellnumber', $single = true); ?></p></li>
						<li><p>Cell Phone: <?php echo get_post_meta ($post->ID, 'cellnumber', $single = true); ?></p></li>
						<li><p>Email: <a href="mailto:<?php echo get_post_meta ($post->ID, 'email', $single = true); ?>"><?php echo get_post_meta ($post->ID, 'email', $single = true); ?></a></li></p>
						
						<li><p>Website: <?php echo get_post_meta ($post->ID, 'cellnumber', $single = true); ?></p></li>
						
						<li><p>Phone: <?php echo get_post_meta ($post->ID, 'cellnumber', $single = true); ?></p></li>
						<li><p>ID #: <?php echo get_post_meta ($post->ID, 'agentid', $single = true); ?></p></li>
						<div class="clear"></div>
						<center><a href="#listings" class="anchorLink"><p class="mediumbutton">View My Listings</p></a></center>

					</ul>
									<div class="clear"></div>
			</div>

			
			<?php the_content(); ?>			
			
			
			<?php endwhile; endif; ?>
			
			<?php if (get_post_meta ($post->ID, 'agentid', $single = true)) { ?>
	
	
			<ul class="agentprops">
			
			<a name="listings" id="listings" ></a>
			
			<h2>My Listings</h2>
		
			<?php $agentid = (get_post_meta ($post->ID, 'agentid', $single = true) ); ?>
	
			<?php query_posts(
				array (
					'post_type' => 'property',
					'meta_key' => 'furu_agentid', 
					'meta_value' => $agentid,
					'posts_per_page' => '-1'
				)
			);
			if(have_posts()) : while(have_posts()) : the_post(); ?>
			
				<li>
					<a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
					<div class="agentproperty">
					<a href="<?php the_permalink(); ?>"><img src="<?php bloginfo('template_directory'); ?>/tools/timthumb.php?src=<?php echo sp_get_image(); ?>&amp;h=200&amp;w=260&amp;zc=1"/></a>
					<?php $numbers = get_post_meta ($post->ID, 'furu_price', $single = true);
					 $price_commas = number_format($numbers); ?>
					<a href="<?php the_permalink(); ?>"><p class="mediumbutton">$<?php echo $price_commas; ?></p></a></center>
					</div>	
				</li>
				
				<?php endwhile; endif; wp_reset_query(); ?>
				

				<div class="clear"></div>
				
			</ul><!--end agent properties-->
			
			<? } ?>
		
		</div><!--end intro-->
		
		<?php get_sidebar(); ?>
			
		</div><!--end content-->
		
		<div class="line"></div>
		
		
	</div><!--end page-containter -->
	</div><!-- end container -->
	
	

</div><!--end wrap -->
<?php get_footer(); ?>