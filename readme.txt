=== Plugin Name ===
Contributors: joshmedeski
Tags: genesis, genesiswp, studiopress, customizer
Requires at least: 3.2
Tested up to: 4.1
Stable tag: 1.1.6

This plugin adds a hero image to your Genesis theme.

== Description ==

This plugin creates a hero image for the top of your site using the Genesis framework. Using the WordPress customizer, you can upload a hero image for your site. You can also have the option to display featured images in place of the hero image. These features work using the Genesis framework, you do not need to learn PHP or write any functions, filters, or hooks.

== Installation ==

1. Upload the entire `genesis-simple-hero-image` folder to the `/wp-content/plugins/` directory
1. DO NOT change the name of the `genesis-simple-hero-image` folder
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Navigate to `Appearance > Customize > Hero Image`
1. Upload your hero image and update the settings to your needs.
1. Save the changes

== Frequently Asked Questions ==

= What is Genesis? =

Genesis is a WordPress parent theme designed by Studiopress.

= Will this plugin work with Genesis child themes? =

Yes, however each child theme has it's own settings, hooks, and layout decisions. Although this plugin is functional with any Genesis child theme, it may not look 100% awesome on all of them.

= Where does the hero image display? = 

There are multiple options for where to display the hero image: before the menus, after the menus, between the menus, before the header, before the content. Genesis hooks are used to position the hero image.

= The plugin won't activate =

You must have Genesis (2.0) or a Genesis child theme installed and activated on your site.

== Changelog ==

= 1.1 =
* Removed: image positioning options
* Update: the hero image is now a background image using CSS
* New option: image height
* New feature: allow featured image to override hero image

= 1.0 =
* Initial Release
