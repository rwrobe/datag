# Da Tag

Da Tag allows you to highlight any tag for a given post and make it available for your theme! You will see the highlighter in the tags metabox after activating the plugin.

## Usage

Da Tag includes two template tags: `datag_get_tag()` and `datag_the_tag()`. `datag_get_tag()` will not print anything, but will return the value of the tag you selected. `datag_the_tag()` will print the tag wrapped in a `.datag` div.

Simply use one or the other of these functions where you would like to display or use the highlighted tag in your theme. Don't forget to wrap them in an `if( function_exists() )` test!

## Changelog

### v1.0

* Added the template-tags file to the main plugin file and tested 

### v0.4

* Revised and renamed temp_append()
* Built out the draggable/droppable JS
* Created a hidden field and hooked into post_submitbox_misc_actions to hold the highlighted tag
* Style tweaks

### v0.3

* Added a temporary function to append the tag selector droplet to the Tags metabox
* Styled the droplet, howto text, highlighted tag
* Added admin notices, clear the user meta on deactivation
* Still searching for the filter to add this to the tag metabox without having to use JS

### v0.2

* Added directories for the CSS, JS, classes and includes
* Created mostly-empty CSS file for the styles
* Created basic functions.js file and created the drag-and-drop functions
* Created the plugin file, mostly used to instantiated the Da_Tag object
* Created Da_Tag class and filled in some of the basic functions needed to create a drag/droppable highlighter to the tags metabox
* Created template tags to return and echo the tag name for use in a theme
* Removed some of the unnecessary bits and bobs from the WP-CLI scaffolding, including unit testing apparatus

### v0.1

* Scaffolded the plugin using WP-CLI