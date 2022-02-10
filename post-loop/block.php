<?php
defined( 'ABSPATH' ) || die();

/**
 * Hero Block Template.
 *
 * @param  array       $block       The block settings and attributes.
 * @param  string      $content     The block inner HTML (empty).
 * @param  bool        $is_preview  True during AJAX preview.
 * @param  int|string  $post_id     The post ID this block is saved to.
 */ 

// Build the basic block id and class 
$block_id     = ! empty( $block['anchor'] ) ? sanitize_title( $block['anchor'] ) : 'block-hero-' . $block['id'];
$block_class  = 'block-hero';
$block_class .= ! empty( $block['className'] ) ? ' ' . sanitize_html_class( $block['className'] ) : '';
$block_class .= ! empty( $block['align'] ) ? ' align' . sanitize_key( $block['align'] ) : '';

//set defaults
$heading      = 'Heading';
$post_type_slug      = 'post';
$hook_name      = 'articles_loop';
$number_of_posts      = '3';
$number_of_columns      = '3';

// Get our data
if(get_field( 'heading' )){           $heading              = get_field( 'heading' ) ?: __( 'Hero Heading', 'example' );}
if(get_field( 'post_type_slug' )){    $post_type_slug       = get_field( 'post_type_slug' ) ?: __( 'Hero Heading', 'example' );}
if(get_field( 'hook_name' )){         $hook_name            = get_field( 'hook_name' ) ?: __( 'Hero Heading', 'example' );}
if(get_field( 'number_of_posts' )){   $number_of_posts      = get_field( 'number_of_posts' ) ?: __( 'Hero Heading', 'example' );}
if(get_field( 'number_of_columns' )){ $number_of_columns    = get_field( 'number_of_columns' ) ?: __( 'Hero Heading', 'example' );}

$column_width = floor(100/$number_of_columns);

// Let's display our block !
$selector = '#' . sanitize_html_class( $block_id );

?>

<div id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $block_class ); ?>">
    <div class="wrapper">
        <div class="POST-LOOP-content">

            <?php

                global $post;


                // Set query args
                $args = array(
                    'post_type' => $post_type_slug,
                    'posts_per_page' => $number_of_posts,
                    'post__not_in' => array( $post->ID ), // don't display current post
                );

                // Optional arguments for setting category term relationship on single post
                if ( is_single() && has_category() ) {  
                    $category = get_the_category($post->ID);
                    $category_id = $category[0]->cat_ID;
                    $category_count = $category[0]->count;
                    if ( $category_count > 1 ) {
                        $args['category__in'] = array($category_id);
                    }
                } 
                $latest = new WP_Query($args);


                // Output loop
                if ( $latest->have_posts() ) {
                    // ob_start();
                    
                    echo '<div class="gb-grid-wrapper gb-grid-wrapper-global">';     
                    while ($latest->have_posts()) : $latest->the_post();
                        echo '<div class="gb-grid-column" style="width:'.$column_width.'%;">';
                        do_action($hook_name); // Hook name for content template
                        echo '</div>';
                    endwhile;
                    echo '</div>';
                    wp_reset_postdata();

                    // return ob_get_clean();
                }
    ?>

        </div>
    </div>
</div>

<?php return;
