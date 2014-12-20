<?php
/*
	Plugin Name: Genesis Simple Hero Image
	Plugin URI: https://wordpress.org/plugins/genesis-simple-hero-image/
	Description: Adds a hero image to the top of your site using the Genesis Framework.
	Author: Josh Medeski
	Author URI: http://joshmedeski.com/

	Version: 1.0.2

	License: GNU General Public License v2.0 (or later)
	License URI: http://www.opensource.org/licenses/gpl-license.php
*/

  // Customizer Data
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

    $wp_customize->add_control( 'hero_post_thumnail_control', array(
      'label'       => 'Use Featured Image',
      'description' => 'Replace the hero image with the featured image on pages that apply',
      'section'     => 'genesis_hero_image_section',
      'settings'    => 'genesis_hero_image_featured_image',
      'type'        => 'checkbox',
      ) );


    // Dropdown: Hero Image Position
    $wp_customize->add_setting(
      'genesis_hero_image_position',
      array (
        'default' => 'above',
        ) );

    $wp_customize->add_control( 'hero_post_thumnail_control', array(
      'label'       => __( 'Image Position', 'genesis' ),
      'description' => 'Decide where the hero image is positioned',
      'section'     => 'genesis_hero_image_section',
      'settings'    => 'genesis_hero_image_position',
      'type'        => 'select',
      'choices'     => array(
        'beforem' => 'Before Menus',
        'afterm' => 'After Menus',
        'betweenm' => 'Between Menus',
        'beforeh' => 'Before Header',
        'beforec' => 'Before Content',
        )
      ) );


  };

  add_action( 'customize_register', 'genesis_simple_hero_image_customize' );





  // Hero Image Output
  function genesis_simple_hero_image_output() {
    if ( get_theme_mod( 'genesis_hero_image' ) ) {
      echo "<img src=\"";
      echo esc_url( get_theme_mod( 'genesis_hero_image' ) );
      echo "\" alt=\"";
      echo esc_attr( get_bloginfo( 'name', 'display' ) );
      echo "\" class=\"hero-image\" style=\"vertical-align:middle\">";
    }
    else {}
  };





// Hero Image Positioning
$image_position = get_theme_mod( 'genesis_hero_image_position' );
if( $image_position != '' ) {
  switch ( $image_position ) {

    // Before Menus
    case 'beforem' :
    add_action( 'genesis_after_header', 'genesis_simple_hero_image_output' );
    break;

    // After Menus
    case 'afterm' :
    add_action( 'genesis_after_header', 'genesis_simple_hero_image_output', 15 );
    break;

    // Between Menus
    case 'betweenm' :
    remove_action( 'genesis_after_header', 'genesis_do_nav' );
    add_action( 'genesis_after_header', 'genesis_do_nav' );

    add_action( 'genesis_after_header', 'genesis_simple_hero_image_output' );

    remove_action( 'genesis_after_header', 'genesis_do_subnav' );
    add_action( 'genesis_after_header', 'genesis_do_subnav' );
    break;

    // Before Header
    case 'beforeh' :
    add_action( 'genesis_before_header', 'genesis_simple_hero_image_output');
    break;

    // Before Content
    case 'beforec' :
    add_action( 'genesis_before_content_sidebar_wrap', 'genesis_simple_hero_image_output' );
    break;
  }
}
