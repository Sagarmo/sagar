<?php
/**
 * Plugin Name: Custom Timeline Slider
 * Description: A custom Elementor widget for an interactive timeline slider.
 * Version: 1.0
 * Author: Your Name
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Register the Elementor Timeline Slider Widget
function cts_register_timeline_slider_widget( $widgets_manager ) {

    require_once( __DIR__ . '/widgets/timeline-slider-widget.php' );

    $widgets_manager->register( new \Elementor_Timeline_Slider_Widget() );

}
add_action( 'elementor/widgets/register', 'cts_register_timeline_slider_widget' );

// Enqueue Styles and Scripts
function cts_enqueue_scripts() {
    wp_enqueue_style( 'cts-slider-style', plugins_url( 'assets/css/style.css', __FILE__ ) );
    wp_enqueue_script( 'cts-slider-script', plugins_url( 'assets/js/slider.js', __FILE__ ), array('jquery'), null, true );
}
add_action( 'wp_enqueue_scripts', 'cts_enqueue_scripts' );
