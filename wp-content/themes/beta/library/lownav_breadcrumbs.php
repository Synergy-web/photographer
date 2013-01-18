<div class="lownav">
	<div class="lefty">
		
		<a href="<?php bloginfo('url'); ?>" class="home">All</a>
		
		<?php if(get_post_type() == 'project')  { ?>
		
		<?php $projects = get_page_with_template('page-portfolio');
				  $projecturl= get_permalink($projects);	
			?>
	        
	    <a href="<?php echo $projecturl; ?>"><?php _e('See All', 'cebolang'); ?></a>
		<span class="current"><?php the_title(); ?></span>
		
		<?php } else { ?> 
		
		<?php breadcrumbs(); ?>
		
		<? } ?>
	
	</div>
	
	<a class="trigger" href="#"><img style="float: right; padding: 5px 0 0 0; margin: 0 4px; opacity: 0.5; position: relative; width: 23px;" src="<?php bloginfo ('template_url'); ?>/images/contact_bubble_light.png" alt="" /></a>
	
</div>