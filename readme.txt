=== Ingeni Masonry Gallery ===

Contributors: Bruce McKinnon
Tags: gallery, masonry
Requires at least: 4.8
Tested up to: 5.1.1
Stable tag: 2019.04

Replaces standard Wordpress post galleries with Masonry galleries.

Based on https://masonry.desandro.com by David DeSandro.



== Description ==

* - Replaces the standard Wordpress photo gallery with a masonry-style gallery

* - Based on https://masonry.desandro.com by David DeSandro.




== Installation ==

1. Upload the 'ingeni-masonry-gallery' folder to the '/wp-content/plugins/' directory.

2. Activate the plugin through the 'Plugins' menu in WordPress.

3. Display the gallery using the standard Gallery shortcode within Wordpress.



== Frequently Asked Questions ==



= How do a display the gallery? =

Use the stock-standard Wordpress gallerty shortcode.

The following parameters may be included:


ids: Comma-seperated list of image ids.

container_class: Extra class that is applied to the container class.



== Changelog ==

v2019.01 - Initial version
v2019.02 - Added imagesLoaded to handle dynamic or slow loading of images
v2019.03 - Added the 'close_grid_container' param. Defaults to 1. Set to zero to keep the gallery in the same grid-container as the test of the post.
v2019.04 - Removed a top-bottom-30 class from a grid-container. Provides greater individual control via CSS.

