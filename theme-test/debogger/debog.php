<?php

/*
Plugin Name: DeBogger
Plugin URI: http://www.pross.org.uk
Description: A simple tool for debugging themes.
Author: Simon Prosser
Version: 0.71
Author URI: http://www.pross.org.uk
*/
define('BOGVERSION', '0.71');
add_action('init', 'bog_debug', 5);
if ( is_admin() ):
add_action('admin_footer', 'bog_footer');
add_action('admin_head', 'bog_head');
else:
add_action('wp_footer', 'bog_footer');
add_action('wp_head', 'bog_head');
endif;
add_filter('wp_footer', 'memory');
function memory() {
if( current_user_can('level_10') ) :
global $wpdb;
echo '<span style="text-align:center;display:block;">';
$timer = timer_stop();
echo round(memory_get_peak_usage()/1048576,2) . 'M ' . get_num_queries() . ' queries in '. $timer . ' Seconds.</span>';
endif;
}

// error handler function
function myErrorHandler($errno, $errstr, $errfile, $errline, $errcontext) {
global $debog_notice;
global $_notice_count;
global $debog_warn;
global $_warn_count;
$options = get_option('debog'); //no options...
    switch ($errno) {
    case E_NOTICE:
		if (!preg_match('/\/wp-includes\//',$errfile)):
			$_warn_count++;
			$terrfile = strxchr($errfile, '/wp-content/');
			$errfile = str_replace( $terrfile[0], '', $errfile ) ;
			$debog_msg = $options['notice'] . $errstr . ' on line ' . $errline . ' of ' . $errfile . '<br />';
			// Limit Debogger to the current theme
			$theme_directory = get_stylesheet_directory();
			if (substr($theme_directory, 1, 1) == ':') {
				// local installation
				$theme_directory = str_replace("/", "\\", $theme_directory);
			}
			if (substr_count($debog_msg, basename( $theme_directory ) ) > 0) {
				$debog_warn .= $debog_msg;
			}
			endif;
    break;
    case E_USER_NOTICE:
		$_notice_count++;
		$debog_notice .= $options['u_notice'] . $errstr . '<br />';
    break;
    }
    /* Don't execute PHP internal error handler */
    return true;
}

// set debug on/off
function myblank() {

// do nothing
}

function show_normal() {
	return false;
}

function bog_debug() {
$options = get_option('debog'); // read options
if ( !isset( $options['version'] ) || $options['version'] != BOGVERSION ):
$options = default_bog();
update_option('debog', $options);
endif;


$bogger = $options['active'];
if ($bogger === 'on')	{
	set_error_handler("myErrorHandler");
						}
if ($bogger === 'off')	{
	set_error_handler("show_normal");
						}
if ($bogger === 'sup')	{
	set_error_handler("myblank");
						}
$debog_warn = '';
$debog_notice = '';
$debog = '';
$_notice_count = 0;
$_warn_count = 0;

}

//add links to footer:

function bog_footer() {
$options = get_option('debog'); // read options
global $my_error;
global $_notice_count;
global $_warn_count;
global $debog_notice;
global $debog_warn;

if (isset($_GET['bog'])):
	$nonce=$_REQUEST['_wpnonce'];
	if (!wp_verify_nonce($nonce, 'bog-nonce') ):
		die('Security check');
	else:
	// security pass! 
	if ($_GET['bog'] === 'on')	{
		$options['active'] = 'on';
		set_error_handler("myErrorHandler");
								}
	if ($_GET['bog'] == 'off')	{
		$options['active'] = 'off';
		set_error_handler("show_normal");
								}
	if ($_GET['bog'] == 'sup') 	{
		$options['active'] = 'sup';
		set_error_handler("myblank");
								}
	update_option('debog', $options);
	endif;
	endif;
global $user_ID; if( $user_ID ) :
	if( current_user_can('level_10') ) :
		echo '</div></div></div></div></div></div></div></div></div>'; // just in case there are unclosed divs!

// ok were ready!
			$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
if ($_SERVER['SERVER_NAME'] == '127.0.0.1' || $_SERVER['SERVER_NAME'] == 'localhost') $local = 'local';
			if (!isset( $local )):
			$w3c =  bog_check_( $url );
			else:
			$w3c = 'local mode no W3C check!';
			endif;
	$color = '99FF99';
	if ( $w3c != 'W3C Valid!(cached)' && $w3c != 'W3C Valid!(not cached)' && $w3c != 'local mode no W3C check!' ) { 
		$color = 'FF9999';
		}	
		if ( $debog_notice ) {
		$color = 'FF9999';
		}
		if ( $debog_warn ) {
		$color = 'FF9999';
		}

		echo '<div style="background-color: #' . $color .'; text-align: left; display: block; clear: both; margin-left: auto; margin-right: auto; border: 1px dashed red; width: 70%; color: #000; padding: 10px;">';
		$nonce= wp_create_nonce('bog-nonce');
if ($options['active'] == 'on') {
		echo '<span style="color: #000;">Activated</span>&nbsp;&nbsp;&nbsp;';
		} else { 
		echo '<a style="color: #000;" href="' . strtok( esc_url( $_SERVER['REQUEST_URI'] ), '?' ) . '?_wpnonce=' . $nonce . '&amp;bog=on">Activate Debog</a>&nbsp;&nbsp;&nbsp;';
		}
if ($options['active'] == 'off') {
		echo '<span style="color: #000;">Bypassing</span>&nbsp;&nbsp;&nbsp;';
		} else { 
		echo '<a style="color: #000;" href="' . strtok( esc_url( $_SERVER['REQUEST_URI'] ), '?' ) . '?_wpnonce=' . $nonce . '&amp;bog=off">Bypass</a>&nbsp;&nbsp;&nbsp;';
		}
if ($options['active'] == 'sup') {
		echo '<span style="color: #000;">Suppressing</span>&nbsp;&nbsp;&nbsp;';
		} else { 
		echo '<a style="color: #000;" href="' . strtok( esc_url( $_SERVER['REQUEST_URI'] ), '?' ) . '?_wpnonce=' . $nonce . '&amp;bog=sup">Suppress Errors</a>&nbsp;&nbsp;&nbsp;';
		}
			$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
			echo $w3c;
if (!defined('WP_DEBUG') || WP_DEBUG == false ) echo '<span><strong> WP_DEBUG is not enabled!</strong></span>';

	echo '<span style="text-align: right; float: right; color: #000;"><small><a href="http://pross.org.uk/">Debogger by Pross</a>&nbsp;&nbsp;&nbsp;bog status: <strong>'. $options['active'] . '</strong>';

echo ( defined('FIXPRESS') ) ? '&nbsp;&nbsp;Using FixPress v' . FIXPRESS : '';
	echo '</span>';
		if ($debog_notice):
		echo "<br /><br /><h3>Need to be fixed: $_notice_count</h3>";
		echo $debog_notice;
		endif;
	if ($debog_warn):
		echo "<br /><h3>Other warnings: $_warn_count</h3>";
		echo $debog_warn;
	endif;

if ($debog_notice || $debog_warn ):
$themedata = get_theme_data( TEMPLATEPATH . '/style.css' );
echo '<a onmouseclick="ShowContent(\'uniquename\'); return true;" href="javascript:ShowContent(\'uniquename\')">[show]</a>';
echo '
<div id="uniquename" 
   style="display:none; 
      border-style: solid; 
      background-color: white; 
      padding: 5px;">';
$data = array('theme' => $themedata[ 'Name' ] . ' v' . $themedata[ 'Version' ], 'warn' => $debog_warn, 'notice' => $debog_notice); 

echo _parse_template($data);

endif;
	echo '</div>';
	endif;
endif;
}

//strxchr(string haystack, string needle [, bool int leftinclusive [, bool int rightinclusive ]])
function strxchr($haystack, $needle, $l_inclusive = 0, $r_inclusive = 0){
   if(strrpos($haystack, $needle)){
       //Everything before last $needle in $haystack.
       $left =  substr($haystack, 0, strrpos($haystack, $needle) + $l_inclusive);
        //Switch value of $r_inclusive from 0 to 1 and viceversa.
       $r_inclusive = ($r_inclusive == 0) ? 1 : 0;
        //Everything after last $needle in $haystack.
       $right =  substr(strrchr($haystack, $needle), $r_inclusive);
       //Return $left and $right into an array.
       return array($left, $right);
   } else {
       if(strrchr($haystack, $needle)) return array('', substr(strrchr($haystack, $needle), $r_inclusive));
       else return false;
   }
}

function bog_check_($url) {

		function checkcache($url) {
				$w3c_url = 'http://validator.w3.org/check?uri=' .$url. '&charset=%28detect+automatically%29&doctype=Inline';
				$result = array();
				$timeout = 60; // cache timeout
				$cache_dir = WP_PLUGIN_DIR . '/debogger/cache/';
				
				$cache_file = $cache_dir . md5($url) . '.cache';;
				if(!file_exists($cache_file) OR filemtime($cache_file) < (time() - $timeout)){
				if( !class_exists( 'WP_Http' ) )
				include_once( ABSPATH . WPINC. '/class-http.php' );
				$result_1 = wp_remote_retrieve_body( wp_remote_get($w3c_url) );
				$result[0] =  $result_1;
				$result[1] = '(not cached)';
				file_put_contents($cache_file, $result_1, LOCK_EX);
				} else {
					$result[0] = file_get_contents($cache_file);
					$result[1] = '(cached)';
					}
				return $result;
				}

$html = array();
$html = checkcache($url);
if (empty($html)) {
	return 'error';
	}
$doc = new DOMDocument();
$doc->loadHTML($html[0]);
$res = $doc->getElementById('congrats');
if (isset($res)) { $res = $doc->getElementById('congrats')->nodeValue; }
  if($res == 'Congratulations') {
	return 'W3C Valid!' . $html[1];
  } else {
	return 'Not W3C valid (<a href="http://validator.w3.org/check?uri=' . $url . '&charset=%28detect+automatically%29&doctype=Inline">errors</a>)' . $html[1];
  }
}



function bog_head() {
global $user_ID;
if( $user_ID ) :
        if( current_user_can('level_10') ) :
echo '
<script type="text/javascript"><!--
function HideContent(d) {
if(d.length < 1) { return; }
document.getElementById(d).style.display = "none";
}
function ShowContent(d) {
if(d.length < 1) { return; }
document.getElementById(d).style.display = "block";
}
function ReverseContentDisplay(d) {
if(d.length < 1) { return; }
if(document.getElementById(d).style.display == "none") { document.getElementById(d).style.display = "block"; }
else { document.getElementById(d).style.display = "none"; }
}
//--></script>
';
endif;
endif;
}

function _parse_template($data) {
// example template variables {a} and {bc}
// example $data array
// $data = Array("a" => 'one', "bc" => 'two');
$options = get_option('debog');
if ( empty($options['sometext']) ) $options['sometext'] = trac_template();
    $q = $options['sometext'];
    foreach ($data as $key => $value) {
        $q = str_replace('{'.$key.'}', $value, $q);
    }
    return $q;
}




add_action('admin_init', 'debogoptions_init' );
add_action('admin_menu', 'debogoptions_add_page');

// Init plugin options to white list our options
function debogoptions_init(){
	register_setting( 'debogoptions_options', 'debog' );
}

// Add menu page
function debogoptions_add_page() {
add_options_page('Debogger Options', 'Debogger Options', 'manage_options', 'debogoptions', 'debogoptions_do_page');
}

// Draw the menu page itself
function debogoptions_do_page() {
	?>
	<div class="wrap">
		<h2>Debogger Options</h2>
		<form method="post" action="options.php">
			<?php settings_fields('debogoptions_options'); ?>
			<?php $options = get_option('debog'); ?>
			<?php if ( empty($options['sometext']) ) $options['sometext'] = trac_template(); ?>
			<table class="form-table">
				<tr valign="top"><th scope="row">Template values:<br />{theme}<br />{warn}<br />{notice}</th>
					<td><textarea cols="60" rows="20" name="debog[sometext]"><?php echo $options['sometext']; ?></textarea></td>
				</tr>
				<tr valign="top"><th scope="row">Trac Prefixes:</th>
					<td><input type="text" name="debog[notice]" value="<?php echo $options['notice']; ?>" /> Notices (normal PHP errors)<br />
					<input type="text" name="debog[u_notice]" value="<?php echo $options['u_notice']; ?>" /> User_Notices (Wordpress errors)</td>
				</tr>
			</table>
			<p class="submit">
<input type="hidden" name="debog[version]" value="<?php echo $options['version']; ?>" />
<input type="hidden" name="debog[active]" value="<?php echo $options['active']; ?>" />
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
			</p>
		</form>
	</div>
	<?php	
}

function trac_template() {
return "Theme Review: '''{theme}'''<br />
=> Themes should be reviewed using '''define('WP_DEBUG', true);''' in wp-config.php<br />
=> Themes should be reviewed using the test data from the [http://codex.wordpress.org/Theme_Unit_Test Theme Checklists]<br />
----<br />
'''WP_DEBUG et al.:'''<br />
{warn}
{notice}
----<br />
'''Theme Test Data:'''<br />
{ INSERT REVIEW }<br />
----<br />
Overall: '''not-accepted'''<br />
- Items marked (=>) '''must''' be addressed.<br />
- Other items noted should be addressed and corrected as needed.<br />
- Additional review may be required once the above issues are resolved.";
}

function default_bog() {
$options = array();
$options['notice'] = '<strong>-- Debug: </strong>';
$options['u_notice'] = '<strong>=> Error: </strong>';
$options['sometext'] = trac_template();
$options['active'] = 'on';
$options['version'] = BOGVERSION;
return $options;
}
