<?php
/*
Plugin Name: Ingeni Masonry Carousel
Version: 2019.01
Plugin URI: http://ingeni.net
Author: Bruce McKinnon - ingeni.net
Author URI: http://ingeni.net
Description: Replaces standard Wordpress post galleries with Masonry galleries. Based on https://masonry.desandro.com by David DeSandro
*/

/*
Copyright (c) 2019 Ingeni Web Solutions
Released under the GPL license
http://www.gnu.org/licenses/gpl.txt

Disclaimer: 
	Use at your own risk. No warranty expressed or implied is provided.
	This program is free software; you can redistribute it and/or modify 
	it under the terms of the GNU General Public License as published by 
	the Free Software Foundation; either version 2 of the License, or (at your option) any later version.
 	See the GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA


Requires : Wordpress 3.x or newer ,PHP 5 +

v2019.01 - Initial version, using https://masonry.desandro.com v4.2.2

*/


//Init hook
add_action('init', 'masonry_override_wp_gallery');
 
//Override function
function masonry_override_wp_gallery()
{
    remove_shortcode('gallery');
    add_shortcode('gallery', 'ingeni_masonry_gallery_shortcode');
}
 
//Custom gallery shortcode
function ingeni_masonry_gallery_shortcode($atts, $content) {
	$retHtml = '';

	$params = shortcode_atts( array(
		'ids' => '',
		'orderby' => 'post__in',
		'columns' => '3',
		'container_class' => '',
		'link' => 'file' //file | link | <empty string> (for linking to attachment page)
	), $atts );


	if ($params['ids'] != '') {
		$retHtml = '</div></div></div>';
		$retHtml .= '<div class="grid-container full '.$params['container_class'].' masonry-wrap"><div class="grid-x grid-margin-x"><div class="cell small-12">';
		$retHtml .= '<div class="grid-container top-bottom-30"><div class="grid-x grid-padding-x"><div class="cell small-12"><div class="photo_grid"><div class="photo_grid_sizer"></div>';

		$imgIds = explode(",",$params['ids']);

		foreach( $imgIds as $imgId ) {
			$img_url = wp_get_attachment_image_src( $imgId, "large" );
			if ($img_url !== false) {
				$retHtml .= '<div class="photo_grid_item">';
					$retHtml .= '<img src="'.$img_url[0].'">';
				$retHtml .= '</div>';
			}
		}
		$retHtml .= '</div>';
		$retHtml .= '</div></div></div>';
		$retHtml .= '</div></div></div>';
	}

	return $retHtml;
}



function ingeni_load_masonry() {
	$dir = plugins_url( '', __FILE__ );

	//Masonry gallery
	if ( is_singular( 'post' ) || is_singular( 'page' ) ) {
		wp_enqueue_style( 'ingeni-masonry-css', $dir . '/ingeni-masonry-gallery.css' );

		wp_register_script( 'masonry_js', $dir .'/masonry/masonry.pkgd.min.js', false, '4.2', true );
		wp_enqueue_script( 'masonry_js' );
		
		wp_register_script( 'ingeni_masonry_js', $dir .'/ingeni-masonry-gallery.js', false, '0.1', true );
		wp_enqueue_script( 'ingeni_masonry_js' );
	}
		
		
	// Init auto-update from GitHub repo
	require 'plugin-update-checker/plugin-update-checker.php';
	$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
		'https://github.com/BruceMcKinnon/ingeni-masonry-gallery',
		__FILE__,
		'ingeni-masonry-gallery'
	);
}
add_action( 'wp_enqueue_scripts', 'ingeni_load_masonry' );


// Plugin activation/deactivation hooks
function ingeni_masonry_activation() {
	flush_rewrite_rules( false );
}
register_activation_hook(__FILE__, 'ingeni_masonry_activation');

function ingeni_masonry_deactivation() {
  flush_rewrite_rules( false );
}
register_deactivation_hook( __FILE__, 'ingeni_masonry_deactivation' );

?>