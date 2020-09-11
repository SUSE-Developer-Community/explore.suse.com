=== Sandbox Onboarding ===
Contributors: Andrew Gracey, Ferenc Székely
Tags: SUSE, Sandbox, Developers
Requires at least: 5.3
Tested up to: 5.5
Stable tag: 0.2
Requires PHP: 7.2
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0

Sandbox Onboarding is a tool for Wordpress administrators to connect Wordpress 
with other web based developer tools, such as various sandboxes, playgrounds 
and such.

== Description ==

== Installation ==

== Frequently Asked Questions ==

= Why is the plugin needed? =
	
This plugin implements the CAP Sandbox Onboarding API. It provides a place
for Wordpress admin to configure various aspects of the process as well as 
for users a rather easy UI to manage sandbox accounts, which is not possible
in upstream CAP yet.

More on the onboarding API can be found here:
https://github.com/SUSE-Developer-Community/cap-sandbox-onboarding

= Where is the plugin used? =
	
The plugin is installed and used at SUSE Developer Portal, where users can 
request access for sandboxes, such as SUSE's Cloud Application Platform. 

= How can I contribute? =
	
Please check out the functionality of the dev portal and file issues at github.
We also welcome translations or any other contributions. Welcome!

== Screenshots ==

== Changelog ==
	
= 0.2 =
	
* Implemented new onboarding API

= 0.1 =
	
* Initial plugin based on Andrew's cap-sandbox-onboard code. 

== Upgrade Notice

= 0.2 =

There are new config options, so please do check out the settings page.

= 0.1 =
 
The original cap-sandbox-onboard plugin got extended due to GDPR requirements. 
Users can read the terms and conditions and need to give their consent before
they are given an account at the CAP Sandbox.