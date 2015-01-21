<?php
/*
	Plugin Name: Genesis Simple Hero Image
	Plugin URI: https://wordpress.org/plugins/genesis-simple-hero-image/
	Description: Adds a hero image to the top of your site using the Genesis Framework.
	Author: Josh Medeski
	Author URI: http://joshmedeski.com/
  Version: 1.1.6
  License: GNU General Public License v2.0 (or later)
  License URI: http://www.opensource.org/licenses/gpl-license.php
*/

  // Customizer Data
  add_action( 'customize_register', 'genesis_simple_hero_image_customize' );

  function genesis_simple_hero_image_customize( $wp_customize ) {

    // Define Customizer Section
    $wp_customize->add_section( 'genesis_hero_image_section' , array(
      'title'       => __( 'Hero Image', 'genesis' ),
      'description' => 'The hero image is displayed between the primary and secondary menu.',
      'priority'    => 100
      ) );


    // Add Hero Image
    $wp_customize->add_setting( 'genesis_hero_image' );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hero_image_control', array(
      'label'       => __( 'Hero Image', 'genesis' ),
      'description' => 'Best image size is 1280px by 360px',
      'section'     => 'genesis_hero_image_section',
      'settings'    => 'genesis_hero_image',
      ) ) );

    // Checkbox: Replace Hero Image with Featured Image
    $wp_customize->add_setting('genesis_hero_image_featured_image');

    $wp_customize->add_control( 'genesis_hero_image_featured_image_control', array(
      'label'       => 'Use Featured Image',
      'description' => 'Replace the hero image with the featured image on pages that apply',
      'section'     => 'genesis_hero_image_section',
      'settings'    => 'genesis_hero_image_featured_image',
      'type'        => 'checkbox',
      ) );

    // Checkbox: Replace Hero Image with Featured Image
    $wp_customize->add_setting('genesis_hero_image_height', array(
      'default' => '300px'
    ));

    $wp_customize->add_control( 'genesis_hero_image_height_control', array(
      'label'       => 'Height',
      'description' => 'Define the hero image height (include px).',
      'section'     => 'genesis_hero_image_section',
      'settings'    => 'genesis_hero_image_height',
      ) );

  };

  // Hero Image Output
  add_action( 'genesis_after_header', 'genesis_simple_hero_image_output', 15 );

  function genesis_simple_hero_image_output() {
    if ( get_theme_mod( 'genesis_hero_image' ) ) {
      echo "<div class=\"hero-image\">";

      echo "</div>";
    }
    else {}
  };

// Hero Image CSS
add_action('wp_head','genesis_hero_image_css');

function genesis_hero_image_css() {

  $image    = esc_url( get_theme_mod( 'genesis_hero_image' ) );
  $height   = esc_attr( get_theme_mod( 'genesis_hero_image_height', '300px' ) );
  $featured = wp_get_attachment_url( get_post_thumbnail_id());
  $position = "center center";
  $repeat   = "no-repeat";

  echo "<style> .hero-image {";

  echo "background: url($image) $repeat $position;";
  echo "background-image: url($image);";
  echo "background-size: cover;";
  echo "min-height: $height;";
  echo "-webkit-background-size: cover;";
  echo "-moz-background-size: cover;";
  echo "-o-background-size: cover;";
  echo "background-size: cover;";

  if ( get_theme_mod('genesis_hero_image_featured_image')) {
    if ( has_post_thumbnail() && is_singular() ) {
      echo "background-image: url($featured);";
    }
    else {}
  }
  else {}

  echo "} </style>";
}
