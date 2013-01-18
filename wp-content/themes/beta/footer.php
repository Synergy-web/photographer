<?php
/**
 * The template for displaying the footer.
 *
**/
?>


	<div class="footer">
		
		<ul class="foot">
		
			<li>
				<?php

				if ( !function_exists('dynamic_sidebar')
					|| !dynamic_sidebar('Footer Column 1') ) : ?>
					
					<h2><?php echo get_option('cebo_company'); ?></h2>

					<h3><?php echo get_option('cebo_quote'); ?></h3>	
				
				<?php endif; ?>	
			
			</li>
			
			<li>
			
				<?php
	
				if ( !function_exists('dynamic_sidebar')
					|| !dynamic_sidebar('Footer Column 2') ) : ?>
					
					<h2><?php _e( 'Find What You Need', 'cebolang' ); ?></h2>
				
					<ul id="master" style="footlinks">
						<?php wp_list_pages('title_li=&depth=0'); ?>
						
					</ul>
					
					<?php endif; ?>	

			</li>
			
			<li>
				<?php

				if ( !function_exists('dynamic_sidebar')
					|| !dynamic_sidebar('Footer Column 3') ) : ?>
					
					<h2><?php _e( 'Contact Us Today', 'cebolang' ); ?></h2>
						<ul>
							<li style="margin: 3px 0 0 0;"><span style="margin: 8px 0; font-family: 'HelveticaLTStdBold'; font-size: 14px; display: block;"><?php _e( 'Address:', 'cebolang' ); ?> </span><?php echo get_option('cebo_address'); ?></li>
							<li style="margin: 3px 0 0 0;"><span style="margin: 8px 0; font-family: 'HelveticaLTStdBold'; font-size: 14px; display: block;"><?php _e( 'Phone:', 'cebolang' ); ?> </span><?php echo get_option('cebo_phone'); ?></li>
							<li style="margin: 3px 0 0 0;"><span style="margin: 8px 0; font-family: 'HelveticaLTStdBold'; font-size: 14px; display: block;"><?php _e( 'Email:', 'cebolang' ); ?> </span><a href="mailto:<?php echo get_option('cebo_email'); ?>"><?php echo get_option('cebo_email'); ?></a></li>
						</ul>
					<?php endif; ?>		
			
			</li>

		</ul><!--end foot-->
		<div class="clear"></div>
		
		<p class="copyright"><? _e('this wordpress theme was designed, developed and made with care by <a href="http://cebocampbell.com">Cebo Campbell</a>', 'cebolang'); ?></p>
	
	</div><!-- end footer -->
	
		
<script src="js/jquery.isotope.min.js"></script>
  <script type="text/javascript">
    $(function(){
      
      var $container = $('#thumbnails');

      $container.isotope({
        itemSelector : '.element'
      });
      
      
      var $optionSets = $('.container .option-set'),
          $optionLinks = $optionSets.find('a');

      $optionLinks.click(function(){
        var $this = $(this);
        // don't proceed if already selected
        if ( $this.hasClass('selected') ) {
          return false;
        }
        var $optionSet = $this.parents('.option-set');
        $optionSet.find('.selected').removeClass('selected');
        $this.addClass('selected');
  
        // make option object dynamically, i.e. { filter: '.my-filter-class' }
        var options = {},
            key = $optionSet.attr('data-option-key'),
            value = $this.attr('data-option-value');
        // parse 'false' as false boolean
        value = value === 'false' ? false : value;
        options[ key ] = value;
        if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
          // changes in layout modes need extra logic
          changeLayoutMode( $this, options )
        } else {
          // otherwise, apply new options
          $container.isotope( options );
        }
        
        return false;
      });

      
    });
  </script>
	<?php if ( get_option('cebo_tracking_code') <> "" ) { echo stripslashes(get_option('cebo_tracking_code')); } ?>
	<?php wp_footer(); ?>
</body>
</html>