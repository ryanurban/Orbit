=== Debogger ===
Contributors:  pross
Author URI:  http://www.pross.org.uk
Plugin URL:  http://www.pross.org.uk/plugins/
Requires at Least:  3.0
Tested Up To: 3.1
Tags:  template, debug

== Description ==

Debugging tool for theme authors and reviewers.

This tool intercepts all debug information and prints it all out neatly into the footer. It also checks each page for W3C validation.
This plugin is released as a tool to aid the development of themes and plugins for WordPress and can be used to aid debugging your theme before submission to the themes directory.

== Changelog ==

= 0.71 =
* Bugfix! working now.

= 0.7 =
* Added checks with current_user_can
* Added patch to only show errors from theme ( thx Chris! )
= 0.6 =
* Fixed upgrade bug, added internal version definition to aid future releases.
* Added Trac prefixes and made enable/disable buttons more friendly.
* Added debug info into footer in memory usage.
* Checks for wp_debug and reports if is undefined.
= 0.5 =
* Fixed bug, default settings were not being saved.
= 0.4 =
* Trac formatting now using basic templating, configurable in wp-admin.
= 0.3 =
* Added page caching for W3C function and auto trac formatting.
= 0.2 =
* Added W3C validation function.
= 0.1 =
* First release.