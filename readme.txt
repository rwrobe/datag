=== Da Tag ===
Contributors: @robsward1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Da Tag allows you to highlight any tag for a given post and make it available for your theme!

== Installation ==

1. Upload `datag` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Da Tag includes two template tags: `datag_get_tag()` and `datag_the_tag()`. `datag_get_tag()` will not print anything, but will return the value of the tag you selected. `datag_the_tag()` will print the tag wrapped in a `#datag` div.


== Changelog (Time is cumulative) ==

= v1.0 (03:00:00) =

* Added the template-tags file to the main plugin file and tested

= v0.4 (02:30:00) =

* Revised and renamed temp_append()
* Built out the draggable/droppable JS
* Created a hidden field and hooked into post_submitbox_misc_actions to hold the highlighted tag
* Style tweaks

= v0.3 (01:50:00) =

* Added a temporary function to append the tag selector droplet to the Tags metabox
* Styled the droplet, howto text, highlighted tag
* Added admin notices, clear the user meta on deactivation
* Still searching for the filter to add this to the tag metabox without having to use JS

= v0.2 (01:00:00) =

* Added directories for the CSS, JS, classes and includes
* Created mostly-empty CSS file for the styles
* Created basic functions.js file and created the drag-and-drop functions
* Created the plugin file, mostly used to instantiated the Da_Tag object
* Created Da_Tag class and filled in some of the basic functions needed to create a drag/droppable highlighter to the tags metabox
* Created template tags to return and echo the tag name for use in a theme
* Removed some of the unnecessary bits and bobs from the WP-CLI scaffolding, including unit testing apparatus

= v0.1 (00:02:00) =

* Scaffolded the plugin using WP-CLI