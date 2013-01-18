<?php
/**
 * The template for displaying Author Archive pages.
 * * @package WordPress
 */

get_header(); ?>
		 
		</div><!-- end #header -->

	<div class="widecontainer">		
				
		<div class="pagecontainer lined">
		
		<?php include(TEMPLATEPATH . '/library/lownav_breadcrumbs.php'); ?>
		
			<div class="content">
			
				<article>
			

	<?php
        /* Queue the first post, that way we know who
         * the author is when we try to get their name,
         * URL, description, avatar, etc.
         *
         * We reset this later so we can run the loop
         * properly with a call to rewind_posts().
         */
        if ( have_posts() )
            the_post();
    ?>

	<h1><?php printf( __( 'Author Archives: %s', 'cebolang' ), "<span class='vcard'><a class='url fn n' href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "' rel='me'>" . get_the_author() . "</a></span>" ); ?></h1>

	
	<div class="page_authorbox"><?php echo get_avatar( get_the_author_meta('email'), '150' ); ?>
	
	<?php
	// If a user has filled out their description, show a bio on their entries.
	if ( get_the_author_meta( 'description' ) ) : ?>
    
	
    <h2><?php printf( __( 'About %s', 'cebolang' ), get_the_author() ); ?></h2>
   <p><?php the_author_meta('description'); ?></p>
    
    </div>
	<?php endif; ?>
	
	<ul class="postlings">
					
					
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
		
			<li>
				
				<?php if(get_post_meta($post->ID, 'embed', $single = true)) { ?>
					            				
		            <?php echo get_post_meta($post->ID, 'embed', $single = true); ?>
		            			
		     <?php } elseif(get_post_meta($post->ID, 'youtube', $single = true)) { ?>
							
				<iframe width="630" height="360" src="http://www.youtube.com/embed/<?php echo get_post_meta($post->ID, 'youtube', $single = true); ?>" frameborder="0" allowfullscreen></iframe>	
				
				<? } elseif (get_post_meta($post->ID, 'vimeo', $single = true)) { ?>
				
				<iframe src="http://player.vimeo.com/video/<?php echo get_post_meta($post->ID, 'vimeo', $single = true); ?>" width="630" height="360" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
				
				<?php } elseif(sp_get_image()) { ?> 
				
				<a href="<?php the_permalink(); ?>"><img src="<?php echo sp_get_image(); ?>" alt="<?php the_title(); ?>" /></a>
				
				<? } ?>

				
				<h3><?php the_title(); ?></h3>
				
				<small><?php _e('Written By ', 'cebolang'); ?><?php the_author(); ?><?php _e(' on ', 'cebolang'); ?><?php the_time('F jS') ?>&nbsp; &nbsp; &nbsp; &bull; &nbsp; &nbsp; &nbsp;<?php comments_popup_link(' No Comments', ' 1 Comment', ' % Comments'); ?>&nbsp; &nbsp; &nbsp; &bull; &nbsp; &nbsp; &nbsp;<?php the_category('+, ') ?></small>
				
				<p><?php echo excerpt(40); ?></p>
				
				<a class="readmore" href="<?php the_permalink(); ?>"><?php _e('Read More', 'cebolang'); ?></a>
			
			</li>

		<?php endwhile; ?>
		
			<div class="navigation">
                        <div class="alignleft"><?php next_posts_link('&laquo;' .   __(' Older Entries' , 'cebolang')) ?></div>
                        <div class="alignright"><?php previous_posts_link( __('Newer Entries ', 'cebolang') .  '&raquo;') ?></div>
                        <div class="clear"></div>
                    </div>
		
		<?php else: ?>
	        <p><?php _e('No posts by this author.'); ?></p>
	
	    <?php endif; ?>
	
		
		</ul>
		
	</article>
				
				
				
				<?php get_sidebar(); ?>					
				
			</div><!-- end content section -->
			
			<div class="clear"></div>
		
		
		</div><!-- end page section -->
	
	
	</div><!-- end widecontainter -->
	
		
<?php get_footer(); ?>
