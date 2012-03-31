# WordPress Setup

## Setup

* Download WordPress (pick your poison: from [WordPress](http://wordpress.org/), from [GitHub](https://github.com/WordPress/WordPress/zipball/master), or from your terminal)
* Setup database locally or with your hosting company
* [Install WordPress](http://codex.wordpress.org/Installing_WordPress#Famous_5-Minute_Install)

_At this point, are theme (orbit) should be activated and you shouldn't need to spend any time on cleaning up or setting options!_

### Wait, what do I do with your framework files?

* mu-plugins: goes in your wp-content folder
* theme-test: contains plugins for final theme testing (read included readme)
* orbit: is the actual WordPress theme, drop it in the Themes folder
* wp-plugins: pick and choose what plugins you want from these and drop them in your wp-plugins folder
* htaccess.txt: look for the .htaccess file in your server's root directory and add the bits from htaccess.txt to this file and save (you may need to set a View hidden files option to see the file)
* wp-config.php: feel free to basically take the portion of snippets beginning with "Extra bits for
  speed & optimization" and add them to your wp-config.php file

## Security

Various tips for hardening WordPress taken from around the web and WordPress

* Delete install.php file from wp-admin & wp-content folder
* Change default database prefix in wp-config.php (so that it is not wp_) (do this during the install step)
* Make sure wp-config.php has Authentication Keys / Salts
* Add the extra optimization bits from wp-config.php included in framework
* Move wp-config.php file up one directory
* Delete wp-config-sample.php file
* Add htaccess.txt file to your root directory (there you can turn it into .htaccess)

## Customize

* Upload and choose plugins
* Setup development files, mu-plugin functions, etc
* Get to work

## Pre-Launch

* Final theme test (utilize the plugins in the theme-test folder along with WP debug, which can be turned on in your wp-config.php file)

## Post-Launch

* Setup CDN (I use Cloudflare for my clients, with the free version)
* Ensure that gzip is working (if hosting company allows this module)
* Uncomment http expires headers in htaccess
* Setup backups