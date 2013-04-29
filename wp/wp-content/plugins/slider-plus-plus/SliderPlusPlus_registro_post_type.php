<?php
/*
 * 
 *  REGISTRO DE POST TYPE E TAXONOMY
 * 
 */

/*
 * Registra post type
 */
add_action('init', 'SliderPlusPlus_registro_post_type');




/*
 * 
 * Função
 * 
 */
function SliderPlusPlus_registro_post_type(){
    $args = array(
        'public' => true,
        'supports' => array(
            'title',
            'editor',
        ),
        'exclude_from_search' => true,
        'labels' => array(
            'name' => 'Slides',
            'singular_name' => 'Slide',
            'add_new' => 'Add New Slide',
            'add_new_item' => 'Add New Slide',
            'edit_item' => 'Edit Slide',
            'new_item' => 'New Slide',
            'view_item' => 'View Slide',
            'search_items' => 'Search Slides',
            'not_found' => 'No Slides Found',
        ),
        'show_in_nav_menus' => false,
    );
    register_post_type('slider_plus_plus', $args);
    
    $taxonomy = array(
        'hierarchical' => false,
        'show_in_nav_menus'=>false,
        'labels' => array(
            'name' => 'Sliders',
            'edit_item' => 'Edit Slider',
            'add_new_item' => 'Add New Slider',
            'all_items' => 'All Sliders',
            'choose_from_most_used' => 'Escolha entre os sliders mais usados',
        )
    );
    register_taxonomy('slider-plus-plus-taxonomy', 'slider_plus_plus', $taxonomy);
}

?>
