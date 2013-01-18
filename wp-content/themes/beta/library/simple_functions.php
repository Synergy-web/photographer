<?php

register_nav_menus( array(
	'primary' => __( 'Primary Navigation', 'furu' ),
) );


// Sidebar Activation

if ( function_exists('register_sidebar') )
register_sidebar(array('name'=>'Sidebar',
'before_widget' => '<div class="sidewidgets">',
'after_widget' => '</div>',
'before_title' => '<h2>',
'after_title' => '</h2>',
));

if ( function_exists('register_sidebar') )
register_sidebar(array('name'=>'Footer Column 1',
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h2>',
'after_title' => '</h2>',
));


if ( function_exists('register_sidebar') )
register_sidebar(array('name'=>'Footer Column 2',
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h1>',
'after_title' => '</h1>',
));

if ( function_exists('register_sidebar') )
register_sidebar(array('name'=>'Footer Column 3',
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h1>',
'after_title' => '</h1>',
));

/* this is for the image grabber 

*/
// Pull an image/post ID from the media gallery
function sp_get_image_id($num = 0) {
	global $post;
	$children = get_children(array(
		'post_parent' => $post->ID,
		'post_type' => 'attachment',
		'post_mime_type' => 'image',
		'orderby' => 'menu_order',
		'order' => 'ASC'
	));

	$count = 0;
    foreach ((array)$children as $key => $value) {
        $images[$count] = $value;
        $count++;
    }
	if(isset($images[$num]))
		return $images[$num]->ID;
	else
		return false;
}

// Pull an image URL from the media gallery
function sp_get_image($num = 0) {
	global $post;
	$children = get_children(array(
		'post_parent' => $post->ID,
		'post_type' => 'attachment',
		'post_mime_type' => 'image',
		'orderby' => 'menu_order',
		'order' => 'ASC'
	));

	$count = 0;
    foreach ((array)$children as $key => $value) {
        $images[$count] = $value;
        $count++;
    }
	if(isset($images[$num]))
		return wp_get_attachment_url($images[$num]->ID);
	else
		return false;
}
/* Determine how many words are in an excerpt and what the (Read More) link looks like */

function new_excerpt_length($length) {
	return 70;
}
add_filter('excerpt_length', 'new_excerpt_length');

function new_excerpt_more($post) {
	return '... <a href="'. get_permalink($post->ID) . '">' . '(Read More)' . '</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }	
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}

function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  }	
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content); 
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}



function getPostViews($postID){
$count_key = 'post_views_count';
$count = get_post_meta($postID, $count_key, true);
if($count==''){
    delete_post_meta($postID, $count_key);
    add_post_meta($postID, $count_key, '0');
    return "0 View";
}
return $count.' Views';
}
function setPostViews($postID) {
$count_key = 'post_views_count';
$count = get_post_meta($postID, $count_key, true);
if($count==''){
    $count = 0;
    delete_post_meta($postID, $count_key);
    add_post_meta($postID, $count_key, '0');
}else{
    $count++;
    update_post_meta($postID, $count_key, $count);
}
}


function breadcrumbs() {
 
  $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $delimiter = ''; // delimiter between crumbs
  $home = 'Home'; // text for the 'Home' link
  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $before = '<span class="current">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb
 
  global $post;
  $homeLink = get_bloginfo('url');
 
  if (is_home() || is_front_page()) {
 
    
 
  } else {
 
    
 
    if ( is_category() ) {
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
      echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
 
    } elseif ( is_search() ) {
      echo $before . 'Search results for "' . get_search_query() . '"' . $after;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
        echo $cats;
        if ($showCurrent == 1) echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      if ($showCurrent == 1) echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      for ($i = 0; $i < count($breadcrumbs); $i++) {
        echo $breadcrumbs[$i];
        if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
      }
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
 
    } elseif ( is_tag() ) {
      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . 'Articles posted by ' . $userdata->display_name . $after;
 
    } elseif ( is_404() ) {
      echo $before . 'Error 404' . $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '';
 
  }
}




/* ==================================== */

if ( function_exists( 'add_theme_support' ) ) { // WP 2.9 Post Thumbnail Feature
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 115, 115, true ); // Normal Post Thumbnail
    add_image_size( 'featured-properties-thumbnail', 290, 200, true ); // Home Page Featured Property Thumbnail
    add_image_size( 'listing-photo-thumbnail', 110, 80, true ); // Property Listing Thumbnail
    add_image_size( 'archive-photo-thumbnail', 225, 150, true ); // Archive Listing Thumbnail
}

function get_page_with_template($template) {
	$pages = get_pages();
	foreach($pages as $p) {
		$meta = get_post_custom_values("_wp_page_template",$p->ID);
		if($meta[0] == $template.".php") {
			return $p->ID;
		}
	}
	return false;
}

function url_get_contents ($Url) {
    if (!function_exists('curl_init')){ 
        die('CURL is not installed!');
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $Url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

function feedFilter($query) {
	if ($query->is_feed) {
		add_filter('rss2_item', 'feedContentFilter');
		}
	return $query;
}
add_filter('pre_get_posts','feedFilter');
 
function feedContentFilter($item) {

	global $post;

	$args = array(
		'order'          => 'ASC',
		'post_type'      => 'attachment',
		'post_parent'    => $post->ID,
		'post_mime_type' => 'image',
		'post_status'    => null,
		'numberposts'    => 1,
	);
	$attachments = get_posts($args);
	if ($attachments) {
		foreach ($attachments as $attachment) {
			$image = wp_get_attachment_image_src($attachment->ID, 'large');
			$mime = get_post_mime_type($attachment->ID);
		}
	}

	if ($image) {
		echo '<enclosure url="'.$image[0].'" length="" type="'.$mime.'"/>';
	} 
	return $item;
}
if( !is_admin()){
	wp_deregister_script('jquery');
	wp_register_script('jquery', (" "), false, '1.6.2');
	wp_enqueue_script('jquery');
}
?>