=== Plugin Name ===

Plugin Name: Block Bad Queries (BBQ)
Plugin URI: http://perishablepress.com/press/2009/12/22/protect-wordpress-against-malicious-url-requests/
Description: Protect WordPress Against Malicious URL Requests silently with a simple script.
Tags: security, protect, firewall, php, eval, malicious, url, request, block, blacklist
Author URI: http://perishablepress.com/
Author: Perishable Press
Donate link: http://digwp.com/book/
Requires at least: 2.3
Tested up to: 3.0.5
Stable tag: 1.0
Version: 1.0

== Description ==

Block Bad Queries (BBQ) helps protect WordPress Against Malicious URL Requests. BBQ checks for excessively long request strings (i.e., greater than 255 characters), as well as the presence of either "eval(" or "base64" in the request URI. These sorts of nefarious requests were implicated in the September 2009 WordPress attacks.

== Installation ==

To protect your site using this lightweight plugin, unzip and upload the "block-bad-queries" folder and contents to your plugin directory and activate via the WP Admin.

Once active, this plugin will silently and effectively close any connections for these sorts of injection-type attacks.

== Upgrade Notice ==

To upgrade BBQ, remove old version and replace with new version. Nothing else needs done.

== Screenshots ==

No screenshots available - code only.

== Changelog ==

2011/02/21 - Updated readme.txt file
2009/12/30 - Additional request strings added
2009/12/30 - Added check for admin users

== Frequently Asked Questions ==

Q: Do I need to do anything else for BBQ to work?
A: Nope, just install and relax knowing that BBQ is protecting your site from bad URL requests.

== Donations ==

To support this and other plugins, consider buying a copy of our book, [Digging into WordPress](http://digwp.com/). Links, tweets and likes also appreciated. Thanks! :)