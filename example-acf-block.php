<?php
/**
 * Plugin Name:       ACF Loop Block
 * Description:       An example of how to user ACF to build custom blocks for the WordPress editor
 * Version:           1.0
 * Plugin URI :       https://github.com/vincedubroeucq/example-acf-block
 * Author:            Vincent Dubroeucq
 * Author URI:        https://vincentdubroeucq.com/
 * License:           GPL v3 or later
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       example
 * Domain Path:       languages/
 */
defined( 'ABSPATH' ) || die();

add_action( 'acf/init', 'example_register_acf_block' );
/**
 * Registers our new block
 * 
 * @return  array  $data  Array of registered block data
 */
function example_register_acf_block(){

    if( function_exists( 'acf_register_block_type' ) ) {


        acf_register_block_type( array(
            'name'              => 'gp_post_loop',                                         // Unique slug for the block
            'title'             => __( 'GP Post Loop', 'example' ),                  // Diplay title for the block
            'description'       => __( 'Sdd s Post loop using GP Elements', 'example' ), // Optional
            'category'          => 'layout',                                       // Inserter category
            // 'icon'              => 'carrot',                                       // Optional. Custom SVG or dashicon slug.
            'example'           => 'true',                                         // Determines whether to show an example in the inserter or not
            'keywords'          => array( __( 'hero', 'example' ), __( 'header', 'example' ) ), // Optional. Useful to find the block in the inserter
            // 'post_types'        => array( 'post', 'page' ),                        // Optional. Default posts, pages
            'mode'              => 'preview',                                      // Optional. Default value of 'preview'
            'align'             => 'full',                                         // Default alignment. Default empty string
            'render_template'   => plugin_dir_path( __FILE__ ) . 'post-loop/block.php', // Path to template file. Default false
            // 'render_callback'   => 'example_block_markup',                      // Callback function to display the block if you prefer.
            'enqueue_style'     => plugins_url( '/post-loop/block.css', __FILE__ ),     // URL to CSS file. Enqueued on both frontend and backend
            // 'enqueue_script'    => plugins_url( '/hero/block.js', __FILE__ ),      // URL to JS file. Enqueued on both frontend and backend
            // 'enqueue_assets'    => 'example_block_assets',                      // Callback to enqueue your scripts
            'supports'          => array(                                          // Optional. Array of standard editor supports
                'align'           => array( 'full', 'wide' ),                      // Toolbar alignment supports
                'anchor'          => true,                                         // Allows for a custom ID.
                // 'customClassName' => true,                                         // Allows for a custom CSS class name
                // 'mode'            => true,                                         // Allows for toggling between edit/preview modes. Default true.
                'multiple'        => false,                                        // Allows for multiple instances of the block. Default true.
            ),
        ) );
    }



}
