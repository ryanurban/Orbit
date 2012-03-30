<?php
/**
 * Header - Used as the Header for this theme
 *
 * @package WordPress
 * @subpackage Orbit
 * @since Orbit 1.0
 */
?>
	<!DOCTYPE html>
	<!--[if IEMobile 7 ]><html class="no-js iem7"><![endif]-->
	<!--[if lte IE 7]> <html class="no-js ie-dead" lang="en"> <![endif]-->
	<!--[if IE 8]>    <html class="no-js ie8" lang="en"> <![endif]-->
	<!--[if (gte IE 9)|(gt IEMobile 7)]><!--><html class="no-js" lang="en"><!--<![endif]-->
<head>
	
	<!-- TITLE -->  
	<title><?php wp_title('|', true, 'right'); ?> <?php bloginfo('name'); ?></title>

	<!-- MISC META -->
	<meta charset="utf-8">
	<meta name="author" content="Ryan Urban @ Fringe Development & /humans.txt">
	
	<!-- MOBILE META -->
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width">
	
	<!-- CSS -->	
	<!--[if ! lte IE 7]><!--><link href="<?php echo ORBIT_STYLESHEETPATH; ?>" rel="stylesheet" /><!--<![endif]-->
	<!--[if (IE 8) & (!IEMobile)]><link href="<?php echo ORBIT_TEMPLATEPATH; ?>/css/ie.css" rel="stylesheet" /><![endif]-->
	<!--[if (lte IE 7) & (!IEMobile)]><link href="<?php echo ORBIT_TEMPLATEPATH; ?>/css/universal-ie.css" rel="stylesheet" /><![endif]-->

	<!-- JAVASCRIPT -->
	<script src="<?php echo ORBIT_TEMPLATEPATH; ?>/js/libs/modernizr-2.5.3.min.js"></script>
	
	<!-- Home screen icon  Mathias Bynens mathiasbynens.be/notes/touch-icons -->
	<!-- For iPad with high-resolution Retina display: -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo ORBIT_TEMPLATEPATH; ?>/images/schwag/apple-touch-icon-144x144-precomposed.png" />
	<!-- For iPhone with high-resolution Retina display: -->
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo ORBIT_TEMPLATEPATH; ?>/images/schwag/apple-touch-icon-114x114-precomposed.png" />
	<!-- For first-generation iPad: -->
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo ORBIT_TEMPLATEPATH; ?>/images/schwag/apple-touch-icon-72x72-precomposed.png" />
	<!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
	<link rel="apple-touch-icon-precomposed" href="<?php echo ORBIT_TEMPLATEPATH; ?>/images/schwag/apple-touch-icon-precomposed.png" />
	<!-- For nokia devices: -->
	<link rel="shortcut icon" href="<?php echo ORBIT_TEMPLATEPATH; ?>/images/schwag/apple-touch-icon.png" />
	<!-- For everything else -->
	<link rel="shortcut icon" href="<?php echo ORBIT_TEMPLATEPATH; ?>/images/schwag/favicon.ico" type="image/x-icon" />
	
	<!-- iOS -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<script>(function(){var p,l,r=window.devicePixelRatio;if(navigator.platform==="iPad"){p=r===2?"startup-tablet-portrait-retina.png":"startup-tablet-portrait.png";l=r===2?"startup-tablet-landscape-retina.png":"startup-tablet-landscape.png";document.write('<link rel="apple-touch-startup-image" href="<?php echo ORBIT_TEMPLATEPATH; ?>/images/schwag/'+l+'" media="screen and (orientation: landscape)"/><link rel="apple-touch-startup-image" href="'+p+'" media="screen and (orientation: portrait)"/>');}else{p=r===2?"startup-retina.png":"startup.png";document.write('<link rel="apple-touch-startup-image" href="<?php echo ORBIT_TEMPLATEPATH; ?>/images/schwag/'+p+'"/>');}})()</script>

	<!-- Microsoft -->
	<meta http-equiv="cleartype" content="on">
	
	<!-- Wordpress -->
	<?php wp_head(); ?>

</head>
<body>
<!--[if (lte IE 7) & (!IEMobile)]><p id="heads-up">You&#8217;re viewing this site in a version of IE that Microsoft has deemed as being expired and insecure. If you would like to see this site in its full glory, upgrade to <a href="http://www.microsoft.com/download/en/details.aspx?id=43" rel="external">IE8</a> or <a href="http://www.beautyoftheweb.com/" rel="external">IE9</a>, or view it in Firefox, Safari, or Chrome. Thanks for visiting!</p><![endif]-->

<header role="banner">
	<h1 class="vcard"><a class="org url" href="<?php echo home_url(); ?>">The Orbit Framework</a></h1>

	<nav role="navigation">
		<ol>
		<li><a href="<?php // orbit_dynamic_url( 8 ); ?>">Page Link</a></li>
		</ol>
	</nav>
</header>