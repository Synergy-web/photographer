<?php
/**

 Functions
 
 */
 
 
//.................. BASIC FUNCTIONS .................. //

/* language include.*/
$lang = TEMPLATE_PATH . '/languages';
load_theme_textdomain('cebolang', $lang);

//.................. BASIC FUNCTIONS .................. //

/* Below is an include to default custom fields for the posts.*/
include(TEMPLATEPATH . '/library/simple_functions.php');


/* Include Super Furu Custom Options Panel*/
require_once(TEMPLATEPATH .  '/options/options_panel.php');


 /* ................. CUSTOM POST TYPES .................... */
/* Below is an include to a default custom post type.*/
include(TEMPLATEPATH . '/library/post_types.php');


/* .................. CUSTOM FIELDS FOR POSTS/PAGES ......... */
/* Below is an include to default custom fields for the posts.*/
include(TEMPLATEPATH . '/library/custom_fields.php');

/* .................. CUSTOM FIELDS FOR POSTS/PAGES ......... */
/* Below is an include to default custom fields for the posts.*/
include(TEMPLATEPATH . '/library/videobox.php');



?>