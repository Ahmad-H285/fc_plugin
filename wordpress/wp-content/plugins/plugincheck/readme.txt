=== Plugin Check ===
Contributors: manojtd
Donate link: http://buy.thulasidas.com/plugin-check
Tags: check, checker, guideline, review, template, test, plugin, tool, upload, uploader, wordpress, wordpress.org
Requires at least: 4.2
Tested up to: 4.4
Stable tag: 2.77
License: GPL2 or later

Plugin Check is a validation tool for PHP developers (and a quality checker for end users) to locate undefined functions and methods.

== Description ==

*Plugin Check* is a developer tool. It scans the plugin or application you specify (or upload) and determines whether you have undefined functions or methods in it.

PHP is not a compiled language. It looks for functions during runtime. So if you have a segment of code not covered by your normal testing, and you have an undefined function in there, you will never know of the undefined function until it hits production when the particular conditions activating that particular code segment are met. This tool will prove especially useful during large scale refactoring, or for quality checking for submission to sites like CodeCanyon.

= Live Demo =

**Plugin Check has a beautifully designed admin interface, which is feature-rich, user-friendly and functional. Please visit this fully operational [live demo site](http://demo.thulasidas.com/plugin-check "Play with Plugin Check Pro") to see it in action.**

 **Now available in your language using Google Translate.**

= Features =

* *Ability to Validate Plugins*: Plugin Check can detect undefined functions and methods in your plugin.
* *Modern Admin Interface*: Plugin Check sports a modern and beautiful admin interface based on the twitter bootstrap framework. Fully responsive.
* *Admin Interface Tour*: A slick tour will take you around the admin page and familiarize you with its features.
* *Generous Help*: Whenever you need help, the information and hint is only a click away in Plugin Check. (In fact, it is only a mouseover away.)
* *Standalone Mode*: Plugin Check  works as a WordPress plugin if uploaded to the `wp-content/plugins` folder of your blog, or as a standalone application if uploaded to your server. What's more, you can switch to the standalone mode from the WordPress plugin admin page of this plugin, while still using the WordPress authentication mechanism and database.

= Pro Version =

In addition to the fully functional Lite version, *Plugin Check*  also has a [Pro version](http://buy.thulasidas.com/plugin-check "Plugin Check to detect undefined functions and methods, $5.95") with many more features. These features are highlighted by a red icon in the menus of the lite version.

* *Upload and Check PHP packages*: In the *Pro* version, you can upload a plugin or a package as a zip file and check for missing function/method definitions.
* *Automated Checks*: With the *Pro* version, you can run a suite of checks (adapted and further developed from the excellent Theme Check plugin) on the plugin as well.
* *WordPress Aware*: The *Pro* version is aware of WordPress functions and their deprecation status. It also knows the common global variables in WordPress.
* *Skinnable Admin Interface*: In the *Pro* version, you can select the color schemes of your admin pages from nine different skins.
* *Advanced Options*: The Pro version lets you configure advanced options like suppressing duplicates, displaying all detected tokens etc.
* *Execution Parameters*: Ability to specify the maximum execution time and memory size for large compilation jobs.

== Upgrade Notice ==

Changes in the DB interface to handle the case where native drivers are not installed. Restricting Google Translate not to translate user-editable strings. Optimizing screenshots.

== Screenshots ==

1. Plugin Check admin page, with quick start, help and support info.
2. Plugin Check - how to launch it.
3. Plugin Check output.
4. App Check launch page.
5. Automated Checks launch page.
6. Advanced Options in the Pro version showing a dark theme.

== Installation ==

To install it as a WordPress plugin, please use the plugin installation interface.

1. Search for the plugin Plugin Check from your admin menu Plugins -> Add New.
2. Click on install.

It can also be installed from a downloaded zip archive.

1. Go to your admin menu Plugins -> Add New, and click on "Upload Plugin" near the top.
2. Browse for the zip file and click on upload.

Once uploaded and activated,

1. Visit the Plugin Check plugin admin page to run it.
2. Take a tour of the plugin features from the Plugin Check admin menu Tour and Help.

If you would like to temporarily switch to the standalone mode of the plugin, click on the "Standalone Mode" button near the top right corner of Plugin Check screens. You can install it permanently in standalone mode (using its own database and authentication) by uploading the zip archive to your server.

1. Upload the contents of the archive `plugin-check` to your server.
2. Browse to the location where your uploaded the package (`http://yourserver/plugin-check`, for instance) using your web browser, and click on the green "Launch Installer" button.
3. Follow wizard to visit the admin page, login, configure basic options.

== Frequently Asked Questions ==

= What does this program do? =

*Plugin Check* is a developer tool. It scans the plugin you specify and determines whether you have undefined functions or methods. In the Pro version, you can also run it on plugins or applications by uploading them (without having to install them). Furthermore, you can run a suite of checks (adapted from the excellent Theme Check plugin) on the code as well.

= What are the tabs Plugin Checker, App Checker and Run Checks? =

Plugin Checker is to look for undefined functions and methods in a plugin installed on your blog.

App Checker does the same, but for applications or files already on your server or by uploading a plugin or an application as a zip file. Note that uploaded plugin or app is not installed and will be cleaned up after validation.

Run Checks is to run a set of automated checks (copied from the excellent Theme Check plugin) on your plugin (either on your blog or uploaded).

= What do I enter in "List of Files"? =

You enter the path names of the files you would like to validate. Note that *Plugin Check* runs on your server, and the files need to be accessible by your web server. Please specify the files relative to your `wp-content/plugins` directory, or by typing in their full path names. You can enter multiple file names separated by commas.

= What do I enter in "Folder Location"? =

*Plugin Check* can recursively load an entire folder on your server to validate the files therein. Specify a path relative to your `wp-content/plugins`  location (as shown in the help bubble), or as an absolute path.

= What about "Upload Application"? =

Using this file upload method, you can upload an entire PHP application (as a ZIP file) to your server and validate it by pseudo-compiling it. The uploaded ZIP file will be unpacked into a temporary folder and scanned for undefined functions and methods. Since the temporary locations have random names and cannot execute PHP files through external invocations, the security risk is believed to be non-existent.

= How do I use the "Select a Plugin" dropdown menu? =

Similar to the file upload method, you can validate any plugin installed on your WordPress server (both active and inactive ones) by pseudo-compiling it. Select a plugin and wait for the output.

== Change Log ==

* V2.77: Changes in the DB interface to handle the case where native drivers are not installed. Restricting Google Translate not to translate user-editable strings. Optimizing screenshots. [Feb 7, 2016]
* V2.75: Adding diagnostic information on the update page. Fixing a bug in the update module. [Jan 20, 2015]
* V2.74: Adding a dev-friendly include to introduce local settings, if any. [Dec 30, 2015]
* V2.73: Adding a new option to use a temporary file for dynamic code analysis. [Dec 23, 2015]
* V2.72: Refactoring changes in admin footer rendering. [Dec 15, 2015]
* V2.71: Implementing a global-to-classname lookup to resolve WordPress global objects. [Dec 12, 2015]
* V2.70: Compatibility with WordPress 4.4. [Dec 5, 2015]
* V2.63: Making the admin menu dynamic (optionally) in standalone mode. Fixing a DB error handling bug. Improving Windows IIS compatibility. [Nov 29, 2015]
* V2.62: Warning about PHP V5.4 requirement on the admin page. [Nov 8, 2015]
* V2.61: Enforcing PHP V5.4 requirement at activation time. [Oct 27, 2015]
* V2.60: Admin pages in your language using Google translation. [Oct 22, 2015]
* V2.50: Exposing an option to suppress error messages in AJAX calls. [Oct 10, 2015]
* V2.42: Improving the speed of admin page loading. [Sep 30, 2015]
* V2.41: Killing the option to allow update checks. [Sep 26, 2015]
* V2.40: Changes to make the plugin work on nginx and Microsoft servers. [Sep 20, 2015]
* V2.33: Removing an unused ajax handler. [Sep 17, 2015]
* V2.32: Ensuring usability on touch-screen devices. Removing an unused class and file. [Sep 17, 2015]
* V2.31: Reinstating the option to force the admin page loading, moving to a less colorful default theme. [Sep 14, 2015]
* V2.30: Adding better error handling on invalid requests, adding a link to the plugin admin page on WP plugins page, adding the ability to rerun the installer. [Sep 12, 2015]
* V2.20: Adding the ability to check plugins when installed as a web app. [Sep 9, 2015]
* V2.10: Removing WP core file loading and refactoring header and menus. [Sep 4, 2015]
* V2.02: NEW BRANCH BACK MERGE: About to release a twitter-bootstrap version. [Sep 10, 2015]
* V1.10: Implementing WP function list. [Aug 26, 2015]
* V1.00: Initial release. [Aug 23, 2015]
