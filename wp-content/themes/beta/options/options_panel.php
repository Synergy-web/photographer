<?php

/*-----------------------------------------------------------------------------------*/
/* Add default options after activation */
/*-----------------------------------------------------------------------------------*/
if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php?page=cebo" ) {
	//Call action that sets
	add_action('admin_head','tt_option_setup');
}

function tt_option_setup(){

	//Update EMPTY options
	$tt_array = array();
	add_option('tt_options',$tt_array);

	$template = get_option('tt_template');
	$saved_options = get_option('tt_options');
	
	foreach($template as $option) {
		if($option['type'] != 'heading'){
			$id = $option['id'];
			$std = $option['std'];
			$db_option = get_option($id);
			if(empty($db_option)){
				if(is_array($option['type'])) {
					foreach($option['type'] as $child){
						$c_id = $child['id'];
						$c_std = $child['std'];
						update_option($c_id,$c_std);
						$tt_array[$c_id] = $c_std; 
					}
				} else {
					update_option($id,$std);
					$tt_array[$id] = $std;
				}
			}
			else { //So just store the old values over again.
				$tt_array[$id] = $db_option;
			}
		}
	}
	update_option('tt_options',$tt_array);
}





/*-----------------------------------------------------------------------------------*/
/* Admin Backend */
/*-----------------------------------------------------------------------------------*/
function cebo_admin_head() { ?>

<script type="text/javascript">
jQuery(function(){
var message = '<p><strong>Activation Successful!</strong> This theme\'s settings are located under <a href="<?php echo admin_url('options_panel.php?page=cebo'); ?>">Appearance > Site Options</a>.</p>';
jQuery('.themes-php #message2').html(message);
});
</script>
    
    
    <?php }

add_action('admin_head', 'cebo_admin_head');



/*-----------------------------------------------------------------------------------*/
/* Admin Interface
/*-----------------------------------------------------------------------------------*/
$functions_path = THEME_ADMIN . '/';
$themename = "Beta Options";
function cebo_add_admin() {

    global $themename, $shortname, $query_string;
   
    if ( isset($_REQUEST['page']) && $_REQUEST['page'] == 'cebo' ) {
		if (isset($_REQUEST['of_save']) && 'reset' == $_REQUEST['of_save']) {
			$options =  get_option('of_template'); 
			of_reset_options($options,'cebo');
			header("Location: options_panel.php?page=cebo&reset=true");
			die;
		}
    }
		
    $tt_page = add_object_page($themename, $themename, 'administrator', 'cebo','cebo_options_page','../wp-content/themes/beta/options/images/icon_options.png');

	add_action("admin_print_scripts-$tt_page", 'of_load_only');
	add_action("admin_print_styles-$tt_page",'of_style_only');
} 

add_action('admin_menu', 'cebo_add_admin');







/*-----------------------------------------------------------------------------------*/
/* Reset Function
/*-----------------------------------------------------------------------------------*/

function of_reset_options($options,$page = ''){

	global $wpdb;
	$query_inner = '';
	$count = 0;
	
	$excludes = array( 'blogname' , 'blogdescription' );
	
	foreach($options as $option){			
		if(isset($option['id'])){ 
			$count++;
			$option_id = $option['id'];
			$option_type = $option['type'];
			
			//Skip assigned id's
			if(in_array($option_id,$excludes)) { continue; }
			
			if($count > 1){ $query_inner .= ' OR '; }
			if($option_type == 'multicheck'){
				$multicount = 0;
				foreach($option['options'] as $option_key => $option_option){
					$multicount++;
					if($multicount > 1){ $query_inner .= ' OR '; }
					$query_inner .= "option_name = '" . $option_id . "_" . $option_key . "'";
					
				}
				
			} else if(is_array($option_type)) {
				$type_array_count = 0;
				foreach($option_type as $inner_option){
					$type_array_count++;
					$option_id = $inner_option['id'];
					if($type_array_count > 1){ $query_inner .= ' OR '; }
					$query_inner .= "option_name = '$option_id'";
				}
				
			} else {
				$query_inner .= "option_name = '$option_id'";
			}
		}
			
	}
	
	//When Theme Options page is reset - Add the of_options option
	if($page == 'cebo'){
		$query_inner .= " OR option_name = 'of_options'";
	}
	
	//echo $query_inner;
	
	$query = "DELETE FROM $wpdb->options WHERE $query_inner";
	$wpdb->query($query);
		
}










/*-----------------------------------------------------------------------------------*/
/* Build the Options Page
/*-----------------------------------------------------------------------------------*/

function cebo_options_page(){
    $options =  get_option('of_template');      
    $themename =  get_option('of_themename');
?>

<div class="wrap" id="msn_container">
  <div id="of-popup-save" class="of-save-popup">
    <div class="of-save-save">Options Updated</div>
  </div>
  <div id="of-popup-reset" class="of-save-popup">
    <div class="of-save-reset">Options Reset</div>
  </div>
  <form action="" enctype="multipart/form-data" id="ofform">
    <div id="header">
    
        <div class="options_header">
	<a href="http://cebocampbell.com" target="_blank"  class="options_header_logo" title="Go to cebocampbell.com">Cebo Campbell</a>
    <ul>
    	<li><a href="http://cebocampbell.com/support-documents/beta/" class="options_header_docs" title="View <?php echo $themename; ?> Documentation">Theme Documentation</a></li>
        <li><a href="http://www.cebocampbell.com/support/" target="_blank" class="options_header_support" title="<?php echo $themename; ?> Support">Support And FAQs</a></li>
        <li class="hi"><a href="http://www.cebocampbell.com/" target="_blank" class="options_header_morethemes" title="View more themes.">Meet Me and Say Hi!</a></li>
        <div class="clear"></div>
    </ul>
    <div class="theme_name"><span><?php echo $themename; ?> <small>1.2</span><strong>Framework 2.0</strong></small></div>
</div>

<div class="options_twitter">
	<div class="twitter-box">
		<a class="gotweet" href="http://twitter.com/cebocampbell" target="_blank"></a>
       <div class="tweet"></div>  
          </div><!-- end twitter-box-->
			<script type="text/javascript">

            jQuery(function($){
        $(".tweet").tweet({
          join_text: "auto",
          username: "cebocampbell",
          avatar_size: 0,
          count: 1,
          auto_join_text_default: "",
          auto_join_text_ed: "",
          auto_join_text_ing: "",
          auto_join_text_reply: "",
          auto_join_text_url: "",
          loading_text: "loading tweets..."
        });
      });

</script>

</div>
      
      <div class="icon-option"> </div>
      <div class="clear"></div>
    </div>
    <?php 
		// Rev up the Options Machine
        $return = cebo_machine($options);
        ?>
    <div id="main">
      <div id="of-nav">
        <ul>
          <?php echo $return[1] ?>
        </ul>
      </div>
      <div id="content"> <?php echo $return[0]; /* Settings */ ?> </div>
      <div class="clear"></div>
    </div>
    <div class="save_bar_top">
    <img style="display:none;" src="<?php echo get_template_directory_uri() ?>/options/images/wpspin_light.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />
    <input type="submit" value="Save All Changes" class="button-primary" />
  </form>
  <form action="<?php echo esc_attr( $_SERVER['REQUEST_URI'] ) ?>" method="post" style="display:inline" id="ofform-reset">
    <span class="submit-footer-reset">
    <input name="reset" type="submit" value="Reset Options" class="button submit-button reset-button" onclick="return confirm('CAUTION: Any and all settings will be lost! Click OK to reset.');" />
    <input type="hidden" name="of_save" value="reset" />
    </span>
  </form>
</div>
<?php  if (!empty($update_message)) echo $update_message; ?>
<div style="clear:both;"></div>
</div>
<!--wrap-->
<?php
}








/*-----------------------------------------------------------------------------------*/
/* Load required styles for Options Page
/*-----------------------------------------------------------------------------------*/

function of_style_only() {
	wp_enqueue_style('admin-style', get_template_directory_uri().'/options/admin-style.css');
	wp_enqueue_style('color-picker', get_template_directory_uri().'/options/colorpicker.css');
	wp_enqueue_style('scrollToStyle', get_template_directory_uri().'/options/options_panel.css');
	$color = get_user_option('admin_color');
	if ($color == "fresh")
		{
		wp_enqueue_style('admin-style-grey', get_template_directory_uri().'/options/admin-style-grey.css');
		wp_enqueue_style('color-picker', get_template_directory_uri().'/options/colorpicker.css');
		}
}





/*-----------------------------------------------------------------------------------*/
/* Load required javascripts for Options Page
/*-----------------------------------------------------------------------------------*/

function of_load_only() {

	add_action('admin_head', 'of_admin_head');
	
	wp_enqueue_script('jquery-ui-core');
	wp_register_script('jquery-input-mask', get_template_directory_uri().'/options/js/jquery.maskedinput-1.2.2.js', array( 'jquery' ));
	wp_enqueue_script('jquery-input-mask');
	wp_enqueue_script('color-picker', get_template_directory_uri().'/options/js/colorpicker.js', array('jquery'));
	wp_enqueue_script('ajaxupload', get_template_directory_uri().'/options/js/ajaxupload.js', array('jquery'));
	wp_enqueue_script("checkboxesiphone", get_template_directory_uri()."/options/iphone-style-checkboxes.js", false, "");
	wp_enqueue_script("twitterscript",  get_template_directory_uri()."/options/jquery.tweet.js", array( 'jquery' ));
	
	
	function of_admin_head() { 
	?>
    
    
<script type="text/javascript" language="javascript">

		jQuery(document).ready(function(){
		
		// Race condition to make sure js files are loaded
		if (typeof AjaxUpload != 'function') { 
			return ++counter < 6 && window.setTimeout(init, counter * 500);
		}
		
			//Color Picker
			<?php $options = get_option('of_template');
			
			foreach($options as $option){ 
			if($option['type'] == 'color' OR $option['type'] == 'typography' OR $option['type'] == 'border'){
				if($option['type'] == 'typography' OR $option['type'] == 'border'){
					$option_id = $option['id'];
					$temp_color = get_option($option_id);
					$option_id = $option['id'] . '_color';
					$color = $temp_color['color'];
				}
				else {
					$option_id = $option['id'];
					$color = get_option($option_id);
				}
				?>
				 jQuery('#<?php echo $option_id; ?>_picker').children('div').css('backgroundColor', '<?php echo $color; ?>');    
				 jQuery('#<?php echo $option_id; ?>_picker').ColorPicker({
					color: '<?php echo $color; ?>',
					onShow: function (colpkr) {
						jQuery(colpkr).fadeIn(500);
						return false;
					},
					onHide: function (colpkr) {
						jQuery(colpkr).fadeOut(500);
						return false;
					},
					onChange: function (hsb, hex, rgb) {
						//jQuery(this).css('border','1px solid red');
						jQuery('#<?php echo $option_id; ?>_picker').children('div').css('backgroundColor', '#' + hex);
						jQuery('#<?php echo $option_id; ?>_picker').next('input').attr('value','#' + hex);
						
					}
				  });
			  <?php } } ?>
		 
		});
		
		</script>
		
		<?php
		//AJAX Upload
		?>
<script type="text/javascript">
			jQuery(document).ready(function(){
				
				var i = 0;
				jQuery('#of-nav li a').attr('id', function() {
				   i++;
				   return 'item'+i;
				});

			
			var flip = 0;
				
			jQuery('#expand_options').click(function(){
				if(flip == 0){
					flip = 1;
					jQuery('#msn_container #of-nav').hide();
					jQuery('#msn_container #content').width(755);
					jQuery('#msn_container .group').add('#msn_container .group h2').show();
	
					jQuery(this).text('[-]');
					
				} else {
					flip = 0;
					jQuery('#msn_container #of-nav').show();
					jQuery('#msn_container #content').width(579);
					jQuery('#msn_container .group').add('#msn_container .group h2').hide();
					jQuery('#msn_container .group:first').show();
					jQuery('#msn_container #of-nav li').removeClass('current');
					jQuery('#msn_container #of-nav li:first').addClass('current');
					
					jQuery(this).text('[+]');
				
				}
			
			});
			
				jQuery('.group').hide();
				jQuery('.group:first').fadeIn();
				
				jQuery('.group .collapsed').each(function(){
					jQuery(this).find('input:checked').parent().parent().parent().nextAll().each( 
						function(){
           					if (jQuery(this).hasClass('last')) {
           						jQuery(this).removeClass('hidden');
           						return false;
           					}
           					jQuery(this).filter('.hidden').removeClass('hidden');
           				});
           		});
           					
				jQuery('.group .collapsed input:checkbox').click(unhideHidden);
				
				function unhideHidden(){
					if (jQuery(this).attr('checked')) {
						jQuery(this).parent().parent().parent().nextAll().removeClass('hidden');
					}
					else {
						jQuery(this).parent().parent().parent().nextAll().each( 
							function(){
           						if (jQuery(this).filter('.last').length) {
           							jQuery(this).addClass('hidden');
									return false;
           						}
           						jQuery(this).addClass('hidden');
           					});
           					
					}
				}
				
				jQuery('.of-radio-img-img').click(function(){
					jQuery(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
					jQuery(this).addClass('of-radio-img-selected');
					
				});
				jQuery('.of-radio-img-label').hide();
				jQuery('.of-radio-img-img').show();
				jQuery('.of-radio-img-radio').hide();
				jQuery('#of-nav li:first').addClass('current');
				jQuery('#of-nav li a').click(function(evt){
				
						jQuery('#of-nav li').removeClass('current');
						jQuery(this).parent().addClass('current');
						
						var clicked_group = jQuery(this).attr('href');
		 
						jQuery('.group').hide();
						
							jQuery(clicked_group).fadeIn();
		
						evt.preventDefault();
						
					});
				
				if('<?php if(isset($_REQUEST['reset'])) { echo $_REQUEST['reset'];} else { echo 'false';} ?>' == 'true'){
					
					var reset_popup = jQuery('#of-popup-reset');
					reset_popup.fadeIn();
					window.setTimeout(function(){
						   reset_popup.fadeOut();                        
						}, 2000);
						//alert(response);
					
				}
					
			//Update Message popup
			jQuery.fn.center = function () {
				this.animate({"top":( jQuery(window).height() - this.height() - 200 ) / 2+jQuery(window).scrollTop() + "px"},100);
				this.css("left", 250 );
				return this;
			}
		
			
			jQuery('#of-popup-save').center();
			jQuery('#of-popup-reset').center();
			jQuery(window).scroll(function() { 
			
				jQuery('#of-popup-save').center();
				jQuery('#of-popup-reset').center();
			
			});
			
			
		
			//AJAX Upload
			jQuery('.image_upload_button').each(function(){
			
			var clickedObject = jQuery(this);
			var clickedID = jQuery(this).attr('id');	
			new AjaxUpload(clickedID, {
				  action: '<?php echo admin_url("admin-ajax.php"); ?>',
				  name: clickedID, // File upload name
				  data: { // Additional data to send
						action: 'of_ajax_post_action',
						type: 'upload',
						data: clickedID },
				  autoSubmit: true, // Submit file after selection
				  responseType: false,
				  onChange: function(file, extension){},
				  onSubmit: function(file, extension){
						clickedObject.text('Uploading'); // change button text, when user selects file	
						this.disable(); // If you want to allow uploading only 1 file at time, you can disable upload button
						interval = window.setInterval(function(){
							var text = clickedObject.text();
							if (text.length < 13){	clickedObject.text(text + '.'); }
							else { clickedObject.text('Uploading'); } 
						}, 200);
				  },
				  onComplete: function(file, response) {
				   
					window.clearInterval(interval);
					clickedObject.text('Upload Image');	
					this.enable(); // enable upload button
					
					// If there was an error
					if(response.search('Upload Error') > -1){
						var buildReturn = '<span class="upload-error">' + response + '</span>';
						jQuery(".upload-error").remove();
						clickedObject.parent().after(buildReturn);
					
					}
					else{
						var buildReturn = '<img class="hide of-option-image" id="image_'+clickedID+'" src="'+response+'" alt="" />';

						jQuery(".upload-error").remove();
						jQuery("#image_" + clickedID).remove();	
						clickedObject.parent().after(buildReturn);
						jQuery('img#image_'+clickedID).fadeIn();
						clickedObject.next('span').fadeIn();
						clickedObject.parent().prev('input').val(response);
					}
				  }
				});
			
			});
			
			//AJAX Remove (clear option value)
			jQuery('.image_reset_button').click(function(){
			
					var clickedObject = jQuery(this);
					var clickedID = jQuery(this).attr('id');
					var theID = jQuery(this).attr('title');	
	
					var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
				
					var data = {
						action: 'of_ajax_post_action',
						type: 'image_reset',
						data: theID
					};
					
					jQuery.post(ajax_url, data, function(response) {
						var image_to_remove = jQuery('#image_' + theID);
						var button_to_hide = jQuery('#reset_' + theID);
						image_to_remove.fadeOut(500,function(){ jQuery(this).remove(); });
						button_to_hide.fadeOut();
						clickedObject.parent().prev('input').val('');
						
						
						
					});
					
					return false; 
					
				});
				
				
				

/* Top save button	 
jQuery(document).ready( function(){
  // bind "click" event for links with title="submit" 
  jQuery("a[title=submit]").click( function(){
    // it submits the form it is contained within
    jQuery(this).parents("form").submit();
  });
}); */
				   	 	
			
			//Save everything else
			jQuery('#ofform').submit(function(){
				
					function newValues() {
					  var serializedValues = jQuery("#ofform").serialize();
					  return serializedValues;
					}
					jQuery(":checkbox, :radio").click(newValues);
					jQuery("select").change(newValues);
					jQuery('.ajax-loading-img').fadeIn();
					var serializedReturn = newValues();
					 
					var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
				
					 //var data = {data : serializedReturn};
					var data = {
						<?php if(isset($_REQUEST['page']) && $_REQUEST['page'] == 'cebo'){ ?>
						type: 'options',
						<?php } ?>

						action: 'of_ajax_post_action',
						data: serializedReturn
					};
					
					jQuery.post(ajax_url, data, function(response) {
						var success = jQuery('#of-popup-save');
						var loading = jQuery('.ajax-loading-img');
						loading.fadeOut();  
						success.fadeIn();
						window.setTimeout(function(){
						   success.fadeOut(); 
						   
												
						}, 2000);
					});
					
					return false; 
					
				});   	 	
				
			});
		</script>
<?php }
}











/*-----------------------------------------------------------------------------------*/
/* Ajax Save Action
/*-----------------------------------------------------------------------------------*/

add_action('wp_ajax_of_ajax_post_action', 'of_ajax_callback');

function of_ajax_callback() {
	global $wpdb; // this is how you get access to the database
	
		
	$save_type = $_POST['type'];
	//Uploads
	if($save_type == 'upload'){
		
		$clickedID = $_POST['data']; // Acts as the name
		$filename = $_FILES[$clickedID];
       	$filename['name'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', $filename['name']); 
		
		$override['test_form'] = false;
		$override['action'] = 'wp_handle_upload';    
		$uploaded_file = wp_handle_upload($filename,$override);
		 
				$upload_tracking[] = $clickedID;
				update_option( $clickedID , $uploaded_file['url'] );
				
		 if(!empty($uploaded_file['error'])) {echo 'Upload Error: ' . $uploaded_file['error']; }	
		 else { echo $uploaded_file['url']; } // Is the Response
	}
	elseif($save_type == 'image_reset'){
			
			$id = $_POST['data']; // Acts as the name
			global $wpdb;
			$query = "DELETE FROM $wpdb->options WHERE option_name LIKE '$id'";
			$wpdb->query($query);
	
	}	
	elseif ($save_type == 'options' OR $save_type == 'framework') {
		$data = $_POST['data'];
		
		parse_str($data,$output);
		//print_r($output);
		
		//Pull options
        	$options = get_option('of_template');
		
		foreach($options as $option_array){

			$id = $option_array['id'];
			$old_value = get_option($id);
			$new_value = '';
			
			if(isset($output[$id])){
				$new_value = $output[$option_array['id']];
			}
	
			if(isset($option_array['id'])) { // Non - Headings...

			
					$type = $option_array['type'];
					
					if ( is_array($type)){
						foreach($type as $array){
							if($array['type'] == 'text'){
								$id = $array['id'];
								$std = $array['std'];
								$new_value = $output[$id];
								if($new_value == ''){ $new_value = $std; }
								update_option( $id, stripslashes($new_value));
							}
						}                 
					}
					elseif($new_value == '' && $type == 'checkbox'){ // Checkbox Save
						
						update_option($id,'false');
					}
					elseif ($new_value == 'true' && $type == 'checkbox'){ // Checkbox Save
						
						update_option($id,'true');
					}
					elseif($type == 'multicheck'){ // Multi Check Save
						
						$option_options = $option_array['options'];
						
						foreach ($option_options as $options_id => $options_value){
							
							$multicheck_id = $id . "_" . $options_id;
							
							if(!isset($output[$multicheck_id])){
							  update_option($multicheck_id,'false');
							}
							else{
							   update_option($multicheck_id,'true'); 
							}
						}
					} 
	
					elseif($type != 'upload_min'){
					
						update_option($id,stripslashes($new_value));
					}
				}
			}	
	
	}

  die();

}



/*-----------------------------------------------------------------------------------*/
/* Cases fpr various option types
/*-----------------------------------------------------------------------------------*/

function cebo_machine($options) {
        
    $counter = 0;
	$menu = '';
	$output = '';
	foreach ($options as $value) {
	   
		$counter++;
		$val = '';
		//Start Heading
		 if ( $value['type'] != "heading" )
		 {
		 	$class = ''; if(isset( $value['class'] )) { $class = $value['class']; }
			//$output .= '<div class="section section-'. $value['type'] .'">'."\n".'<div class="option-inner">'."\n";
			$output .= '<div class="section section-'.$value['type'].' '. $class .'">'."\n";
			$output .= '<h3 class="heading">'. $value['name'] .'</h3>'."\n";
			$output .= '<div class="option">'."\n" . '<div class="controls">'."\n";

		 } 
		 //End Heading
		$select_value = '';                                   
		switch ( $value['type'] ) {
		
		case 'text':
			$val = $value['std'];
			$std = get_option($value['id']);
			if ( $std != "") { $val = $std; }
			$output .= '<input class="of-input" name="'. $value['id'] .'" id="'. $value['id'] .'" type="'. $value['type'] .'" value="'. $val .'" />';
		break;
		
		
		
		case 'fburl':

		$val = $value['std'];
			$std = get_option($value['id']);
			if ( $std != "") { $val = $std; }
	    $facebook = get_page_with_template('page-facebook');
		$facebook_url = get_permalink($facebook);	
		
		if($facebook) {
			
 		$output .= '<input style="width: 285px;" name="'. $value['id'] .'" id="'. $value['id'] .'" type="'. $value['type'] .'" value="' . $facebook_url .'" />';
 		
 		} else {
 		
 		$output .= '<input style="width: 285px;" name="'. $value['id'] .'" id="'. $value['id'] .'" type="'. $value['type'] .'" value="No Page Template Selected" />';
 		
 		}
 		
		break;
		
		
		
		
		case 'select':

			$output .= '<select  class="of-input" name="'. $value['id'] .'" id="'. $value['id'] .'">';
		
			$select_value = get_option($value['id']);
			 
			foreach ($value['options'] as $option) {
				
				$selected = '';
				
				 if($select_value != '') {
					 if ( $select_value == $option) { $selected = ' selected="selected"';} 
			     } else {
					 if ( isset($value['std']) )
						 if ($value['std'] == $option) { $selected = ' selected="selected"'; }
				 }
				  
				 $output .= '<option'. $selected .'>';
				 $output .= $option;
				 $output .= '</option>';
			 
			 } 
			 $output .= '</select>';

			
		break;
		
		
		
		
		
		
		case 'fontsize':
		
		/* Font Size */
			$val = $default['size'];
			if ( $typography_stored['size'] != "") { $val = $typography_stored['size']; }
			$output .= '<select class="of-typography of-typography-size" name="'. $value['id'].'_size" id="'. $value['id'].'_size">';
				for ($i = 9; $i < 71; $i++){ 
					if($val == $i){ $active = 'selected="selected"'; } else { $active = ''; }
					$output .= '<option value="'. $i .'" ' . $active . '>'. $i .'px</option>'; }
			$output .= '</select>';
		
		
		break;
		
		
		
		
		
		
		
		case "multicheck":
		
			$std =  $value['std'];         
			
			foreach ($value['options'] as $key => $option) {
											 
			$tt_key = $value['id'] . '_' . $key;
			$saved_std = get_option($tt_key);
					
			if(!empty($saved_std)) 
			{ 
				  if($saved_std == 'true'){
					 $checked = 'checked="checked"';  
				  } 
				  else{
					  $checked = '';     
				  }    
			} 
			elseif( $std == $key) {
			   $checked = 'checked="checked"';
			}
			else {
				$checked = '';                                                                                    }
			$output .= '<input type="checkbox" class="checkbox of-input" name="'. $tt_key .'" id="'. $tt_key .'" value="true" '. $checked .' /><label for="'. $tt_key .'">'. $option .'</label><br />';
										
			}
		break;
		
		
		
		
		
		
		
		
		case 'textarea':
			
			$cols = '8';
			$ta_value = '';
			
			if(isset($value['std'])) {
				
				$ta_value = $value['std']; 
				
				if(isset($value['options'])){
					$ta_options = $value['options'];
					if(isset($ta_options['cols'])){
					$cols = $ta_options['cols'];
					} else { $cols = '8'; }
				}
				
			}
				$std = get_option($value['id']);
				if( $std != "") { $ta_value = stripslashes( $std ); }
				$output .= '<textarea class="of-input" name="'. $value['id'] .'" id="'. $value['id'] .'" cols="'. $cols .'" rows="8">'.$ta_value.'</textarea>';
			
			
		break;
		
		
		
		
		
		
		
		
		case "radio":
			
			 $select_value = get_option( $value['id']);
				   
			 foreach ($value['options'] as $key => $option) 
			 { 

				 $checked = '';
				   if($select_value != '') {
						if ( $select_value == $key) { $checked = ' checked'; } 
				   } else {
					if ($value['std'] == $key) { $checked = ' checked'; }
				   }
				$output .= '<input class="of-input of-radio" type="radio" name="'. $value['id'] .'" value="'. $key .'" '. $checked .' />' . $option .'<br />';
			
			}
			 
		break;
		
		
		
		
		case 'codeblock':


		
			$block_value = '';
			$template = get_template_directory_uri();
			
			
			if (plugin_basename($_GET['page']) == 'cebo') { 
			
			
			$facebook = get_page_with_template('page-facebook');
			$facebook_url = get_permalink($facebook);	
				if($facebook) {
					$facebook_code = file_get_contents($facebook_url);
				} else { 
					$facebook_code = file_get_contents($template . "/options/nothinghere.htm");
				}
			
			
			}
			
			$code = htmlentities($facebook_code);
			if(isset($value['std'])) {
				
				$block_value = $value['std']; 
				
				if(isset($value['options'])){
					$ta_options = $value['options'];
					if(isset($ta_options['cols'])){
					$cols = $ta_options['cols'];
					} else { $cols = '8'; }
				}
				
			}
				$std = get_option($value['std']);
				if( $std != "") { $block_value = stripslashes( $std ); }
				$output .= '<script type="text/javascript">
    function selectText() {
        if (document.selection) {
        var range = document.body.createTextRange();
            range.moveToElementText(document.getElementById("blocker"));
        range.select();
        }
        else if (window.getSelection) {
        var range = document.createRange();
        range.selectNode(document.getElementById("blocker"));
        window.getSelection().addRange(range);
        }
    }
    </script>
<div id="blocker" onclick="selectText()">' . htmlentities($facebook_code)  . '</div>
			 	

			     <div class="fielddescription"><p class="wpbutton"><a href="' . $facebook_url . '" target="_blank">See Preview</a></p><p class="wpbutton"><a href="http://cebocampbell.com/facebook-app-landing-page/" target="_blank">Learn More</a></p></div>';
			 
			 
			break;

		
		
			case 'codeblocktwo':


		
			$block_value = '';
			$template = get_template_directory_uri();
			
			
			if (plugin_basename($_GET['page']) == 'cebo') { 
			
			
			$mailchimp = get_page_with_template('page-mailchimp');
			$mailchimp_url = get_permalink($mailchimp);	
				if($mailchimp) {
					$mailchimp_code = file_get_contents($mailchimp_url);
				} else { 
					$mailchimp_code = file_get_contents($template . "/options/nothinghere.htm");
				}

			
			
			}
			
		
			if(isset($value['std'])) {
				
				$block_value = $value['std']; 
				
				if(isset($value['options'])){
					$ta_options = $value['options'];
					if(isset($ta_options['cols'])){
					$cols = $ta_options['cols'];
					} else { $cols = '8'; }
				}
				
			}
				$std = get_option($value['std']);
				if( $std != "") { $block_value = stripslashes( $std ); }
				$output .= '<script type="text/javascript">
    function selectTexts() {
        if (document.selection) {
        var range = document.body.createTextRange();
            range.moveToElementText(document.getElementById("blockers"));
        range.select();
        }
        else if (window.getSelection) {
        var range = document.createRange();
        range.selectNode(document.getElementById("blockers"));
        window.getSelection().addRange(range);
        }
    }
    </script>
<div id="blockers" onclick="selectTexts()">' . htmlentities($mailchimp_code)  . '</div>
			 	

			     <div class="fielddescription"><p class="wpbutton"><a href="' . $mailchimp_url . '" target="_blank">See Preview</a></p><p class="wpbutton"><a href="http://cebocampbell.com/wordpress-mailchimp-ready-newsletter/" target="_blank">Learn More</a></p></div>';
			 
			 
			break;




	case 'codeblockthree':


		
			$block_value = '';
			$template = get_template_directory_uri();
			
			
			if (plugin_basename($_GET['page']) == 'cebo') { 
			
			
			$newsletter = get_page_with_template('page-newsletter');
			$newsletter_url = get_permalink($newsletter);	
				if($newsletter) {
					$newsletter_code = file_get_contents($newsletter_url);
				} else { 
					$newsletter_code = file_get_contents($template . "/options/nothinghere.htm");
				}
			
			
			}
			
			$code = htmlentities($newsletter_code);
			if(isset($value['std'])) {
				
				$block_value = $value['std']; 
				
				if(isset($value['options'])){
					$ta_options = $value['options'];
					if(isset($ta_options['cols'])){
					$cols = $ta_options['cols'];
					} else { $cols = '8'; }
				}
				
			}
				$std = get_option($value['std']);
				if( $std != "") { $block_value = stripslashes( $std ); }
				$output .= '<script type="text/javascript">
    function selectText() {
        if (document.selection) {
        var range = document.body.createTextRange();
            range.moveToElementText(document.getElementById("blockest"));
        range.select();
        }
        else if (window.getSelection) {
        var range = document.createRange();
        range.selectNode(document.getElementById("blockest"));
        window.getSelection().addRange(range);
        }
    }
    </script>
<div id="blockest" onclick="selectText()">' . htmlentities($newsletter_code)  . '</div>
			 	

			     <div class="fielddescription"><p class="wpbutton"><a href="' . $newsletter_url . '" target="_blank">See Preview</a></p><p class="wpbutton"><a href="http://cebocampbell.com/wordpress-mailchimp-ready-newsletter/" target="_blank">Learn More</a></p></div>';
			 
			 
			break;

		
		
		
		case "checkbox": 
		
		   $std = $value['std'];  
		   
		   $saved_std = get_option($value['id']);
		   
		   $checked = '';
			
			if(!empty($saved_std)) {
				if($saved_std == 'true') {
				$checked = 'checked="checked"';
				}
				else{
				   $checked = '';
				}
			}
			elseif( $std == 'true') {
			   $checked = 'checked="checked"';
			}
			else {
				$checked = '';
			}
			$output .= '<input type="checkbox" class="checkbox of-input" name="'.  $value['id'] .'" id="'. $value['id'] .'" value="true" '. $checked .' />';

		break;
	
		
		
		
		
		
		
		
		case "upload":
			
			$output .= cebo_uploader_function($value['id'],$value['std'],null);
			
		break;
		
		
		
		
		
		
		
		
		
		case "upload_min":
			
			$output .= cebo_uploader_function($value['id'],$value['std'],'min');
			
		break;
		
		
		case "color":
			$val = $value['std'];
			$stored  = get_option( $value['id'] );
			if ( $stored != "") { $val = $stored; }
			$output .= '<div id="' . $value['id'] . '_picker" class="colorSelector"><div></div></div>';
			$output .= '<input class="of-color" name="'. $value['id'] .'" id="'. $value['id'] .'" type="text" value="'. $val .'" />';
		break;   
		
		
		
		
		
		
		
		 
		
		case "images":
			$i = 0;
			$select_value = get_option( $value['id']);
				   
			foreach ($value['options'] as $key => $option) 
			 { 
			 $i++;

				 $checked = '';
				 $selected = '';
				   if($select_value != '') {
						if ( $select_value == $key) { $checked = ' checked'; $selected = 'of-radio-img-selected'; } 
				    } else {
						if ($value['std'] == $key) { $checked = ' checked'; $selected = 'of-radio-img-selected'; }
						elseif ($i == 1  && !isset($select_value)) { $checked = ' checked'; $selected = 'of-radio-img-selected'; }
						elseif ($i == 1  && $value['std'] == '') { $checked = ' checked'; $selected = 'of-radio-img-selected'; }
						else { $checked = ''; }
					}	
				
				$output .= '<span>';
				$output .= '<input type="radio" id="of-radio-img-' . $value['id'] . $i . '" class="checkbox of-radio-img-radio" value="'.$key.'" name="'. $value['id'].'" '.$checked.' />';
				$output .= '<div class="of-radio-img-label">'. $key .'</div>';
				$output .= '<img src="'.$option.'" alt="" class="of-radio-img-img '. $selected .'" onClick="document.getElementById(\'of-radio-img-'. $value['id'] . $i.'\').checked = true;" />';
				$output .= '</span>';
				
			}
		
		break; 
		
		
		
		
		
		
		
		
		case "info":
			$default = $value['std'];
			$output .= $default;
		break;
		
		
		
		

	                                 
		
		case "heading":
			
			if($counter >= 2){
			   $output .= '</div>'."\n";
			}
			$jquery_click_hook = ereg_replace("[^A-Za-z0-9]", "", strtolower($value['name']) );
			$jquery_click_hook = "of-option-" . $jquery_click_hook;
			$menu .= '<li><a title="'.  $value['name'] .'" href="#'.  $jquery_click_hook  .'">'.  $value['name'] .'</a></li>';
			$output .= '<div class="group" id="'. $jquery_click_hook  .'"><h2>'.$value['name'].'</h2>'."\n";
		break;                                  
		} 
		
		// if TYPE is an array, formatted into smaller inputs... ie smaller values
		if ( is_array($value['type'])) {
			foreach($value['type'] as $array){
			
					$id = $array['id']; 
					$std = $array['std'];
					$saved_std = get_option($id);
					if($saved_std != $std){$std = $saved_std;} 
					$meta = $array['meta'];
					
					if($array['type'] == 'text') { // Only text at this point
						 
						 $output .= '<input class="input-text-small of-input" name="'. $id .'" id="'. $id .'" type="text" value="'. $std .'" />';  
						 $output .= '<span class="meta-two">'.$meta.'</span>';
					}
				}
		}
		if ( $value['type'] != "heading" ) { 
			if ( $value['type'] != "checkbox" ) 
				{ 
				$output .= '<br/>';
				}
			if(!isset($value['desc'])){ $explain_value = ''; } else{ $explain_value = $value['desc']; } 
			$output .= '</div><div class="explain">'. $explain_value .'</div>'."\n";
			$output .= '<div class="clear"> </div></div></div>'."\n";
			}
	   
	}
    $output .= '</div>';
    return array($output,$menu);

}










/*-----------------------------------------------------------------------------------*/
/* File Uploading
/*-----------------------------------------------------------------------------------*/

function cebo_uploader_function($id,$std,$mod){
    
	$uploader = '';
    $upload = get_option($id);
	
	if($mod != 'min') { 
			$val = $std;
            if ( get_option( $id ) != "") { $val = get_option($id); }
            $uploader .= '<input class="of-input" name="'. $id .'" id="'. $id .'_upload" type="text" value="'. $val .'" />';
	}
	
	$uploader .= '<div class="upload_button_div"><span class="button image_upload_button" id="'.$id.'">Upload Image</span>';
	
	if(!empty($upload)) {$hide = '';} else { $hide = 'hide';}
	
	$uploader .= '<span class="button image_reset_button '. $hide.'" id="reset_'. $id .'" title="' . $id . '">Remove</span>';
	$uploader .='</div>' . "\n";
    $uploader .= '<div class="clear"></div>' . "\n";
	if(!empty($upload)){
    	$uploader .= '<a class="of-uploaded-image" href="'. $upload . '">';
    	$uploader .= '<img class="of-option-image" id="image_'.$id.'" src="'.$upload.'" alt="" />';
    	$uploader .= '</a>';
		}
	$uploader .= '<div class="clear"></div>' . "\n"; 


return $uploader;
}


add_action('init','of_options');

if (!function_exists('of_options')) {
function of_options(){

//Theme Shortname
$themename = "Beta Options";
$shortname = "cebo";


$template = get_bloginfo('template_directory');

if (plugin_basename($_GET['page']) == 'cebo') { 

$facebook = get_page_with_template('page-facebook');
$facebook_url = get_permalink($facebook);	
	if($facebook) {
		$facebook_code = file_get_contents($facebook_url);
	} else { 
		$facebook_code = file_get_contents($template . "/options/nothinghere.htm");
	}
$mailchimp = get_page_with_template('page-mailchimp');
$mailchimp_url = get_permalink($mailchimp);	
	if($mailchimp) {
		$mailchimp_code = file_get_contents($mailchimp_url);
	} else { 
		$mailchimp_code = file_get_contents($template . "/options/nothinghere.htm");
	}
$newsletter = get_page_with_template('page-newsletter');
$newsletter_url = get_permalink($newsletter);	
	if($newsletter) {
		$newsletter_code = file_get_contents($newsletter_url);
	} else { 
		$newsletter_code = file_get_contents($template . "/options/nothinghere.htm");
	}
	
}
$repeat = array("", "no-repeat","repeat-x","repeat-y","repeat");
$pos = array("", "top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
$categories = get_categories('hide_empty=0&orderby=name');


//Populate the options array
global $tt_options;
$tt_options = get_option('of_options');


//Access the WordPress Pages via an Array
$tt_pages = array();
$tt_pages_obj = get_pages('sort_column=post_parent,menu_order');    
foreach ($tt_pages_obj as $tt_page) {
$tt_pages[$tt_page->ID] = $tt_page->post_name; }
$tt_pages_tmp = array_unshift($tt_pages, "Select a page:"); 


//Access the WordPress Categories via an Array
$tt_categories = array();  
$tt_categories_obj = get_categories('hide_empty=0');
foreach ($tt_categories_obj as $tt_cat) {
$tt_categories[$tt_cat->cat_ID] = $tt_cat->cat_name;}
$categories_tmp = array_unshift($tt_categories, "");


//Sample Array for demo purposes
$sample_array = array("1","2","3","4","5");


//Sample Advanced Array - The actual value differs from what the user sees
$sample_advanced_array = array("image" => "The Image","post" => "The Post"); 


//Folder Paths for "type" => "images"
$sampleurl =  get_template_directory_uri() . '/options/images/sample-layouts/';










/*-----------------------------------------------------------------------------------*/
/* Create The Custom Site Options Panel
/*-----------------------------------------------------------------------------------*/
$options = array(); // do not delete this line - sky will fall
			
			

/* Option Page 2 - Sample Page */
$options[] = array( "name" => __('Pesonalization Options','cebolang'),
			"type" => "heading");
			

$options[] = array( "name" => __('Website Logo','cebolang'),
			"desc" => __('Upload and insert your sparkling new logo here. Good dimensions would be 320w x 120h. If blank, the theme logo will display, which can be used as well.','cebolang'),
			"id" => $shortname."_logo",
			"std" => "",
			"type" => "upload");
			
			
$options[] = array( "name" => __('Custom Favicon','cebolang'),
			"desc" => __('Have a favorite favicon? Upload and insert your favorite 16px x 16px Png/Gif that will hang out next to the address bar.','cebolang'),
			"id" => $shortname."_custom_favicon",
			"std" => "",
			"type" => "upload");
			

$options[] = array( "name" => __('Your Company Name','cebolang'),
			"desc" => "Your Company Name will be put in various places throughout site.",
			"id" => $shortname."_company",
			"std" => "",
			"type" => "text");
	
$options[] = array( "name" =>  __('Your Company Address','cebolang'),
			"desc" => "Your Company Address will be put in various places throughout site and used to create contact page map, i.e 350 5th Ave, New York, NY 10118, USA",
			"id" => $shortname."_address",
			"std" => "",
			"type" => "text");
	
$options[] = array( "name" =>  __('Your Company Contact Email"','cebolang'),
			"desc" => "This email will be used in various places as well as used to create the built in contact forms",
			"id" => $shortname."_email",
			"std" => "",
			"type" => "text");
	
$options[] = array( "name" =>  __('Your Company Phone','cebolang'),
			"desc" => "Give them your number, in case they want to talk, i.e 000-000-0000",
			"id" => $shortname."_phone",
			"std" => "",
			"type" => "text");
			
$options[] = array( "name" =>  __('Your Company Blurp','cebolang'),
			"desc" => "In a short paragraph, tell the world who you are. Displayed in various places throughout the site",
			"id" => $shortname."_quote",
			"std" => "",
			"type" => "textarea");
			
									   
$options[] = array( "name" => __('Tracking Code','cebolang'),
			"desc" => __('If you would like to add your tracking code into the footer, please put it here.','cebolang'),
			"id" => $shortname."_tracking_code",
			"std" => "",
			"type" => "textarea");




/* Option Page 2 - Sample Page */
$options[] = array( "name" => __('Home Page','cebolang'),
			"type" => "heading");


$options[] = array( "name" => __('Number of Slides','cebolang'), 
		"desc" => "Choose How Many Slides will be displayed, up to 5.",  
		"id" => $shortname."_slidecount",  
		"type" => "select",  
		"std" => "3",
		"options" => array("1", "2", "3","4","5"));	

$options[] = array( "name" => __('Home Page Intro Boxes','cebolang'),
			"desc" => "Choose to display three home page intro boxes",
			"id" => $shortname."_boxes",
			"std" => "true",
			"type" => "checkbox");
			
	
$options[] = array( "name" => __('Home Page Intro Box One Title','cebolang'),
			"desc" => "Type the intro box title here. Please keep it short for symmetry's sake.",
			"id" => $shortname."_box1title",
			"std" => "",
			"type" => "text");
			
$options[] = array( "name" => __('Home Page Intro Box One Info Text','cebolang'),
			"desc" => "Type the intro box welcome text here. Three lines of text is where it cuts off, just FYI",
			"id" => $shortname."_box1info",
			"std" => "",
			"type" => "textarea");
	
$options[] = array( "name" => __('Home Page Intro Box Two Title','cebolang'),
			"desc" => "Type the intro box title here. Please keep it short for symmetry's sake.",
			"id" => $shortname."_box2title",
			"std" => "",
			"type" => "text");
			
$options[] = array( "name" => __('Home Page Intro Box Two Info Text','cebolang'),
			"desc" => "Type the intro box welcome text here. Three lines of text is where it cuts off, just FYI",
			"id" => $shortname."_box2info",
			"std" => "",
			"type" => "textarea");		
	
$options[] = array( "name" => __('Home Page Intro Box Three Title','cebolang'),
			"desc" => "Type the intro box title here. Please keep it short for symmetry's sake.",
			"id" => $shortname."_box3title",
			"std" => "",
			"type" => "text");
			
$options[] = array( "name" => __('Home Page Intro Box Three Info Text','cebolang'),
			"desc" => "Type the intro box welcome text here. Three lines of text is where it cuts off, just FYI",
			"id" => $shortname."_box3info",
			"std" => "",
			"type" => "textarea");
				
$options[] = array( "name" => __('Would you like to show projects on the home page?','cebolang'),
			"desc" => "Disabling this option will remove all projects from the home page",
			"id" => $shortname."_showprojects",
			"std" => "true",
			"type" => "checkbox");
					
$options[] = array( "name" => __('Number of projects to display on home page','cebolang'),
			"id" => $shortname."_projectcount",
			"std" => "",
			"type" => "select",
			"desc" => "If you have chosen to display your projects on the home page, choose how many.",
			"options" => array("1", "2", "3", "4", "5","6", "7", "8","9","10","11","12"));


/* Option Page 2 - Sample Page */
$options[] = array( "name" => __('Styling Options','cebolang'),
			"type" => "heading");
			

$options[] = array( "name" => __('Use A Background Color','cebolang'),
			"desc" => __('If you would like to add a color to your background, select your color here.','cebolang'),
			"id" => $shortname."_background_color",
			"std" => "",
			"type" => "color");	
			
$options[] = array( "name" => __('Change accent color','cebolang'),
			"desc" => __('If you would like to change the current accent color select your color here.','cebolang'),
			"id" => $shortname."_accent_color",
			"std" => "",
			"type" => "color");	
			
$options[] = array( "name" => __('Primary Navigation Color','cebolang'),
			"desc" => __('If you would like to change the navigation color (black) select your color here.','cebolang'),
			"id" => $shortname."_nav_color",
			"std" => "",
			"type" => "color");	
			
			
$options[] = array( "name" => __('Change Background Image','cebolang'),
			"desc" => "If you would like to use another image for the background, upload an image and insert here. Be sure on upload to scroll down and check it at full size.",
			"id" => $shortname."_background_image",
			"std" => "",
			"type" => "upload");	
	

$options[] = array( "name" => __('Would you like your background image to repeat?','cebolang'),
			"id" => $shortname."_background_repeat",
			"std" => "",
			"type" => "select",
			"desc" => "Choose how you would like your image to repeat",
			"options" => $repeat);
		

$options[] = array( "name" => __('Choose background image position','cebolang'),
			"id" => $shortname."_background_position",
			"std" => "",
			"type" => "select",
			"desc" => "How you would like that image positioned?",
			"options" => $pos);
			
$options[] = array( "name" => __('Sidebar tabs','cebolang'),
		"desc" => "Would You like to remove the sidebar tabs? Uncheck it right here, dude.",
		"id" => $shortname."_tabs",
		"std" => "true",
		"type" => "checkbox");
		
					
$options[] = array( "name" => __('Custom CSS','cebolang'),
			"desc" => __('Want to add any custom CSS code? Put in here, and the rest is taken care of. This overrides any other stylesheets. eg: a.button{color:green}','cebolang'),
			"id" => $shortname."_custom_css",
			"std" => "",
			"type" => "textarea");
			
			
/* Option Page 2 - Sample Page */
$options[] = array( "name" => __('Social Options','cebolang'),
			"type" => "heading");
			

$options[] = array( "name" => __('Social Share on Posts ','cebolang'),
		"desc" => "This will add three social sharing buttons, facebook, twitter and google + on the top of the posts and project pages",
		"id" => $shortname."_socialshare",
		"std" => "true",
		"type" => "checkbox");	
		
$options[] = array(	"name" => __('Your Business Facebook Page link ex: "http://facebook.com/yourbusinessname" ','cebolang'),
		"desc" => "By entering your facebook link, you create the links to all facebook icons",
		"id" => $shortname."_fb",
		"std" => "",
		"type" => "text");	
		
$options[] = array(	"name" => __('Twitter ID, no @ ex: "cebocampbell" ','cebolang'),
		"desc" => "By entering your twitter ID you activate the twitter updates on the sidebar and various links to twitter",
		"id" => $shortname."_tweets",
		"std" => "",
		"type" => "text"); 
		
		
$options[] = array( "name" => __('Number of Tweets to Display in Sidebar','cebolang'),  
		"desc" => "Choose How Many Tweets will be displayed on the sidebar, up to 5.",  
		"id" => $shortname."_tweetcount",  
		"type" => "select",  
		"std" => "1",
		"options" => array("1", "2", "3","4","5"));		
	
$options[] = array(	"name" => __('Your current Facebook Landing Page URL','cebolang'),
		"desc" => "If you would like to use Facebook Developer APP for your landing page, copy and use this URL. The app allows your page to update automatically. To learn more about this option, <a href=\"http://cebocampbell.com/facebook-app-landing-page\" target=\"_blank\">click here</a>.",
		"id" => $shortname."_fburl",
		"std" => $facebook_url,
		"type" => "fburl"); 
	
			
$options[] = array( "name" => __('Show Welcome Box on Facebook Page','cebolang'),
		"desc" => "If you would like to remove the welcome box on the facebook page that displays your company blurp uncheck this.",
		"id" => $shortname."_welcomebox",
		"std" => "true",
		"type" => "checkbox");
		
			
$options[] = array( "name" => __('Show Recent Posts On Facebook Page','cebolang'),
		"desc" => "If you would like to remove the recent blog posts from displaying on your facebook landing page uncheck here. ",
		"id" => $shortname."_fbposts",
		"std" => "true",
		"type" => "checkbox");	
	
$options[] = array( "name" => __('Number of Posts to Display in Facebook page','cebolang'),  
		"desc" => "Choose How many of your recent posts will be displayed on the sidebar, up to 5.",  
		"id" => $shortname."_fbcount",  
		"type" => "select",  
		"std" => "1",
		"options" => array("1", "2", "3","4","5"));	
	
			
$options[] = array( "name" => __('Show Recent Projects on Facebook Page"','cebolang'),
		"desc" => "If you would like to remove your 2 most recent projects to display on your newsletter, please uncheck this",
		"id" => $shortname."_fbprojects",
		"std" => "true",
		"type" => "checkbox");
			
	
$options[] = array( "name" => __('Facebook Landing Page','cebolang'),
		"desc" => "Copy and paste code into Facebook to make an updateable Facebook landing page if you are using iframe tabs. This can be a powerful tool for your business. Just create a page, put the content you would like on it and copy and paste into facebook. To learn more about this option, <a href=\"http://cebocampbell.com/facebook-iframe-landing-page\" target=\"_blank\">click here</a>.",
		"id" => $shortname."_facebook_page",
		"std" => $facebook_code,
		"type" => "codeblock");
											


/* Option Page 2 - Sample Page */
$options[] = array( "name" => __('Newsletter Options','cebolang'),
			"type" => "heading");



$options[] = array( "name" => __('Your Greeting','cebolang'),
		"desc" => "By Default, the newsletter says Hi 'Person's Name'. If you don't wish to just say Hi, change it here. ",
		"id" => $shortname."_mailchimpgreet",
		"std" => "",
		"type" => "text");  
	
$options[] = array( "name" => __('Email Newsletter Code','cebolang'),
		"desc" => "This code will generate an Email Newsletter that you can edit, copy and paste into any mail service and start sending out emails to your peeps. Learn more about this newsletter feature, <a href=\"http://cebocampbell.com/wordpress-mailchimp-ready-newsletter\" target=\"_blank\">click here</a>",
		"id" => $shortname."_newsletter",
		"std" => $newsletter_code,
		"type" => "codeblockthree");
		
$options[] = array( "name" => __('Show Page Template as Heading','cebolang'),
		"desc" => "If you would like to use the page template as the header for the newsletter, please check here.",
		"id" => $shortname."_heading",
		"std" => "false",
		"type" => "checkbox");
	
$options[] = array( "name" => __('Show Recent Projects','cebolang'),
		"desc" => "If you would like your 3 most recent projects to display on your newsletter, please check here",
		"id" => $shortname."_recentprojects",
		"std" => "false",
		"type" => "checkbox");
		
$options[] = array( "name" => __('Show Recent Blog Posts','cebolang'),
		"desc" => "If you would like your remove your recent blog posts from displaying on your newsletter, please uncheck here",
		"id" => $shortname."_recentposts",
		"std" => "true",
		"type" => "checkbox");
		
$options[] = array( "name" => __('Number of Blog Posts to Display','cebolang'),  
		"desc" => "Choose How Many Blog Posts will be displayed, up to 10.",  
		"id" => $shortname."_newsletterpostcount",  
		"type" => "select",  
		"std" => "3",
		"options" => array("1", "2", "3", "4", "5","6", "7", "8","9","10"));
	
$options[] = array( "name" => __('Mailchimp RSS Email Newsletter Code','cebolang'),
		"desc" => "This code will generate an Email Newsletter that you can edit, copy and paste into Mailchimp and start sending out emails to your peeps. Learn more about this newsletter feature, <a href=\"http://cebocampbell.com/wordpress-mailchimp-ready-newsletter\" target=\"_blank\">click here</a>",
		"id" => $shortname."_mailchimp",
		"std" => $mailchimp_code,
		"type" => "codeblocktwo");
		


update_option('of_template',$options); 					  
update_option('of_themename',$themename);   
update_option('of_shortname',$shortname);

}
}

?>