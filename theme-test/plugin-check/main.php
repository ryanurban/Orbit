<?php
function plugin_check_main( ) {
	global $themechecks, $data, $themename;


	$files = listdir( WP_PLUGIN_DIR );


	if ( $files ) {
		$css = array();
		$php = array();
		$other = array();
		foreach( $files as $key => $filename ) {
			if ( substr( $filename, -4 ) == '.php' ) {
				if ( strpos( $filename, 'plugins/theme-check' ) == false && strpos( $filename, 'plugins/akismet' ) == false && strpos( $filename, 'plugins/plugin-check' ) == false)
					$php[$filename] = php_strip_whitespace( $filename );
			}
			else if ( substr( $filename, -4 ) == '.css' ) {
				if ( strpos( $filename, 'plugins/theme-check' ) == false && strpos( $filename, 'plugins/akismet' ) == false && strpos( $filename, 'plugins/plugin-check' ) == false)
					$css[$filename] = file_get_contents( $filename );
			}
			else {
				if ( strpos( $filename, 'plugins/theme-check' ) == false && strpos( $filename, 'plugins/akismet' ) == false && strpos( $filename, 'plugins/plugin-check' ) == false)
					$other[$filename] = file_get_contents( $filename );
			}
		}

		// run the checks
		$failed = !run_themechecks($php, $css, $other);

		global $checkcount;

		// second loop, to display the errors

		
		$plugins = get_plugins( '/theme-check' );
		$version = explode( '.', $plugins['theme-check.php']['Version'] );
		echo '<p>Running <strong>' . $checkcount . '</strong> tests against <strong>All Plugins</strong> using Theme-check Guidelines Version: <strong>'. $version[0] . '</strong> Plugin revision: <strong>'. $version[1] .'</strong></p>';
		$results = display_themechecks();
		$success = true;
		if (strpos( $results, 'WARNING') !== false) $success = false;
		if (strpos( $results, 'REQUIRED') !== false) $success = false;
		if ( $success === false ) {
			echo '<h2>' . __( 'One or more errors were found</h2>', 'themecheck' );
		} else {
			echo '<h2>' . __( 'Your plugins have passed all the tests!', 'themecheck' ) . '</h2>';
			tc_success();
		}

		echo '<div class="tc-box">';
		echo '<ul class="tc-result">';
		echo $results;
		echo '</ul></div>';
	}
}


function tc_intro() {
	_e( '<h2>About</h2>', 'themecheck' );
	_e( '<p>Plugin-Check uses some of the Theme-Check tests to check all your plugins for bad code.<br />', 'themecheck' );
	_e( '<h2>Contact</h2>', 'themecheck' );
	_e( '<p>Theme-Check is maintained by <a href="http://profiles.wordpress.org/users/pross/">Pross</a> and <a href="http://profiles.wordpress.org/users/otto42/">Otto42</a><br />', 'themecheck' );
	_e( 'If you have found a bug or would like to make a suggestion or contribution why not join the <a href="http://wordpress.org/extend/themes/contact/">theme-reviewers mailing list</a><br />', 'themecheck' );
	_e( 'or leave a post on the <a href="http://wordpress.org/tags/theme-check?forum_id=10">WordPress forums</a>.<br /></p>', 'themecheck' );
	echo '<form action="https://www.paypal.com/cgi-bin/webscr" method="post"><input type="hidden" name="cmd" value="_s-xclick" /><input type="hidden" name="hosted_button_id" value="2V7F4QYMWMBL6" /><input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif" name="submit" alt="PayPal - The safer, easier way to pay online!" /><img alt="" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1" /></form>';
	_e( '<h2>Contributors</h2>', 'themecheck' );
	_e( '<h3>localization</h3>', 'themecheck' );
	echo '<ul>';
	echo '<li><a href="http://www.onedesigns.com/">Daniel Tara</a></li>';
	echo '<li><a href="http://themeid.com/">Emil Uzelac</a></li>';
	echo '</ul>';
	_e( '<h3>Testers</h3>', 'themecheck' );
	_e( '<p><a href="http://make.wordpress.org/themes/">The WordPress Theme Review Team</a></p>', 'themecheck' ); 
}

function tc_success() {
	_e( '<div class="tc-success"><p>If you found this tool in any way useful, why not donate? One person did!</p>', 'themecheck' );
	echo '<form action="https://www.paypal.com/cgi-bin/webscr" method="post"><input type="hidden" name="cmd" value="_s-xclick" /><input type="hidden" name="hosted_button_id" value="2V7F4QYMWMBL6" /><input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif" name="submit" alt="PayPal - The safer, easier way to pay online!" /><img alt="" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1" /></form>';
	echo '</div>';
}

function tc_form() {
	
		echo '<form action="plugins.php?page=plugincheck" method="post">';
		echo '<input type="hidden" name="plugincheck" />';
		echo '<input class="button" type="submit" value="' . __( 'Check them all!!', 'themecheck' ) . '" />';
		echo ' <input name="s_info" type="checkbox" /> ' . __( 'Suppress INFO.', 'themecheck' );
		echo '</form>';
}



function tc_form_() {
	$themes = get_themes();
	echo '<form action="themes.php?page=themecheck" method="post">';
	echo '<select name="themename">';
	foreach( $themes as $name => $location ) {
		echo '<option ';
		if ( isset( $_POST['themename'] ) ) {
			echo ( $location['Stylesheet'] === $_POST['themename'] ) ? 'selected="selected" ' : ''; 
		} else {
			echo ( basename( STYLESHEETPATH ) === $location['Stylesheet'] ) ? 'selected="selected" ' : '';
		}
		echo ( basename( STYLESHEETPATH ) === $location['Stylesheet'] ) ? 'value="' . $location['Stylesheet'] . '" style="font-weight:bold;">' . $name . '</option>' : 'value="' . $location['Stylesheet'] . '">' . $name . '</option>';
	}
	echo '</select>';
	echo '<input class="button" type="submit" value="' . __( 'Check it!', 'themecheck' ) . '" />';
	if ( defined( 'TC_PRE' ) || defined( 'TC_POST' ) ) echo ' <input name="trac" type="checkbox" /> ' . __( 'Output in Trac format.', 'themecheck' );
	echo ' <input name="s_info" type="checkbox" /> ' . __( 'Suppress INFO.', 'themecheck' );
	echo '</form>';
}