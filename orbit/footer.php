<?php
/**
 * Footer - Used as the Footer for this theme
 *
 * @package WordPress
 * @subpackage Jigsaw
 * @since Jigsaw 1.0
 */
?>
	<footer role="contentinfo">
	<h6 class="vcard">&copy;<?php echo date('Y'); ?> <span class="org">The Jigsaw Framework</span>. <a href="http://fringewebdevelopment.com/" rel="author">Made by Fringe</a> &amp; <a href="http://ryan-urban.com/" rel="author">Ryan Urban</a>.</h6>	
	</footer>

	<?php wp_footer(); ?>
	
	<!--[if (lt IE 9) & (!IEMobile)]>
	<script src="<?php echo JIGSAW_TEMPLATEPATH; ?>/js/libs/selectivizr.min.js"></script>
	<script src="<?php echo JIGSAW_TEMPLATEPATH; ?>/js/libs/imgsizer.js"></script>
	<![endif]-->
	
	<script>
    var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
    g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g,s)}(document,'script'));
    </script>
	
</body>
</html>