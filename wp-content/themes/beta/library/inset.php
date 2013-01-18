<?php

$bgcolor = get_option('cebo_background_color');
$bgimg = get_option('cebo_background_image');
$bgrepeat = get_option('cebo_background_repeat');
$bgpos = get_option('cebo_background_position');
$accent = get_option('cebo_accent_color');
$nav = get_option('cebo_nav_color');
			
// Add CSS to output
if ($bgcolor) echo 'body {background:'.$bgcolor.'}' . "\n";
if ($bgcolor) echo '.widecontainer {background:'.$bgcolor.'}' . "\n";
if ($bgcolor) echo '.footer {background:'.$bgcolor.'}' . "\n";
if ($bgimg) echo 'body {background-image: url('.$bgimg.')}' . "\n";
if ($bgimg) echo '.widecontainer {background-image: url('.$bgimg.')}' . "\n";
if ($bgimg) echo '.footer {background-image: url('.$bgimg.')}' . "\n";
if ($bgrepeat && $bgpos) echo 'body {background-repeat:'.$bgrepeat.'}' . "\n";
if ($bgrepeat && $bgpos) echo '.widecontainer {background-repeat:'.$bgrepeat.'}' . "\n";
if ($bgrepeat && $bgpos) echo '.footer {background-repeat:'.$bgrepeat.'}' . "\n";
if ($bgimg && $bgpos) echo 'body {background-position:'.$bgpos.'}' . "\n";
if ($bgimg && $bgpos) echo '.widecontainer {background-position:'.$bgpos.'}' . "\n";
if ($bgimg && $bgpos) echo '.footer {background-position:'.$bgpos.'}' . "\n";


if(get_option('cebo_accent_color')) {
	
	echo '
	
	a {
	color: '. $accent . ';
	}

	.hellobox {
		background: '. $accent . ';
	}
	nav a:hover {
		color: '. $accent . ';
	}
	nav li .sub-menu li:hover {
		background: '. $accent . ';
	}
	
	#widenav li h2 .wordlast {
		color: '. $accent . ';
	}
	.filter a.selected {
		background: '. $accent . ';
	}
	.filter a:hover {
		background: '. $accent . ';
	}
	.readmore {
		background: none repeat scroll 0 0 '. $accent . ';
	}
	article .seeall {
		background: '. $accent . ';
	}
	article .seeall:hover {
		background: '. $accent . ';
	}
	article .seeall:before {
    	border-left: 17px solid '. $accent . ';
	}
	article .seeall:hover:before {
		border-left: 17px solid '. $accent . ';	
	}
	article h1 {
		color: '. $accent . ';
	}
	article h4 {
		color: '. $accent . ';
	}
	article h5 {
		color: '. $accent . ';
	}
	article ul li {
		color: '. $accent . ';
	}
	article ol li {
		color: '. $accent . ';
	}
	ul.tabs li.active a:after {
	    border-bottom: 20px solid '. $accent . ';
	}
	.tab_container {
		background: '. $accent . ';
	}	
		
	#thumbnails ul li .title p {
	    color: '. $accent . ';
	}	
	.seeall:hover {
		background: '. $accent . ';
	}	
	.seeall:hover:before {
		border-left: 17px solid '. $accent . ';
	}
	.panel {
		background: '. $accent . ';
	}
	.foot h3 {
		color: '. $accent . ';
	}
	.foot h3 .wordfirst, .foot h3 .wordlast {
		color: '. $accent . ';
	}
	.fb-main .hellobox {
	    background: none repeat scroll 0 0 '. $accent . ';
	}	
	.touchcarousel .scrollbar.dark {
    	background-color: '. $accent . ';
	}
	.content article h1 {
    	color: '. $accent . ';
	}
	article blockquote {
		border-left: 5px solid '. $accent . ';
	}
	';

}

if(get_option('cebo_accent_color')) {
	
	echo '
	
	nav .nav-primary li a {
	color: '. $nav . ';
	}
	
	';
}

 echo stripslashes(get_option('cebo_custom_css'));  




?>