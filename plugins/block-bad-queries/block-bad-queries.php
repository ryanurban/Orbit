<?php 
/* 
Plugin Name: Block Bad Queries (BBQ)
Plugin URI: http://perishablepress.com/press/2009/12/22/protect-wordpress-against-malicious-url-requests/
Tags: security, protect, firewall, php, eval, malicious, url, request, block
Author URI: http://perishablepress.com/
Author: Perishable Press
Version: 1.0
  
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

global $user_ID; if($user_ID) {
	if(!current_user_can('level_10')) {
		if (strlen($_SERVER['REQUEST_URI']) > 255 || 
			stripos($_SERVER['REQUEST_URI'], "eval(") || 
			stripos($_SERVER['REQUEST_URI'], "CONCAT") || 
			stripos($_SERVER['REQUEST_URI'], "UNION+SELECT") || 
			stripos($_SERVER['REQUEST_URI'], "base64")) {
				@header("HTTP/1.1 414 Request-URI Too Long");
				@header("Status: 414 Request-URI Too Long");
				@header("Connection: Close");
				@exit;
		}
	}
} ?>