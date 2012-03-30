=== Login LockDown ===
Developer: Michael VanDeMar (michael@endlesspoetry.com)
Tags: security, login
Requires at least: 2.5
Tested up to: 2.8.4
Stable Tag: 1.5

Limits the number of login attempts from a given IP range within a certain time period.

== Description ==

Login LockDown records the IP address and timestamp of every failed login attempt. If more than a 
certain number of attempts are detected within a short period of time from the same
IP range, then the login function is disabled for all requests from that range.
This helps to prevent brute force password discovery. Currently the plugin defaults
to a 1 hour lock out of an IP block after 3 failed login attempts within 5 minutes. This can be modified
via the Options panel. Admisitrators can release locked out IP ranges manually from the panel.

== Installation ==

1. Extract the zip file into your plugins directory into its own folder.
2. Activate the plugin in the Plugin options.
3. Customize the settings from the Options panel, if desired.

Enjoy.
