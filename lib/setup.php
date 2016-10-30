<?php

namespace Roots\Sage\Setup;

use Roots\Sage\Assets;

/**
 * Theme setup
 */
function setup() {
  // Make theme available for translation
  // Community translations can be found at https://github.com/roots/sage-translations
  load_theme_textdomain('sage', get_template_directory() . '/lang');

  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support('title-tag');

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus([
    'primary_navigation' => __('Primary Navigation', 'sage'),
    'products_navigation' => __('Products Navigation', 'sage'),
  ]);

  // Enable post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size

  add_theme_support('post-thumbnails');


  // Enable post formats
  // http://codex.wordpress.org/Post_Formats
  // Other available post formats: aside, image, quote
  // add_theme_support('post-formats', ['gallery', 'link', 'video', 'audio']);

  // Enable HTML5 markup support
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', ['caption', 'gallery']);

  // add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

  // Use main stylesheet for visual editor
  // To add custom styles edit /assets/styles/layouts/_tinymce.scss
  add_editor_style(Assets\asset_path('styles/editor-styles.css'));
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');


// add product custom post type
add_action( 'init', __NAMESPACE__ . '\\create_post_type');
function create_post_type() {
  register_post_type( 'products',
    array(
      'labels' => array(
        'name' => __( 'Products' ),
        'singular_name' => __( 'Product' )
      ),
      'public' => true,
      'has_archive' => true,
      'hierarchical'        => true,
      'taxonomies'  => array( 'category' ),
      'supports' => array('title', 'template', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
      'rewrite' => array( 'slug' => 'designs'),
      'query_var' => true,
    )
  );
}



// add image crops
add_action( 'init', __NAMESPACE__ . '\\add_custom_image_sizes');
function add_custom_image_sizes() {
  if ( function_exists( 'add_image_size' ) ) {

    // inline image sizes
    add_image_size('wide_4-12', 330, 220, true);
    add_image_size('wide_6-12', 504, 336, true);
    add_image_size('wide_8-12', 677, 451, true);
    add_image_size('wide_12-12', 1024, 683, true);

  }
}






/**
 * Theme assets
 */


function assets() {
  wp_enqueue_style('sage/css', Assets\asset_path('styles/main.css'), false, null);
  wp_enqueue_style('fonts-text', 'https://fonts.googleapis.com/css?family=Open+Sans', false, null);
  wp_enqueue_script('sage/js', Assets\asset_path('scripts/main.js'), ['jquery'], null, true);
}

add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);



/**
 * Enqueue jQuery and jQuery Migrate in Footer
 */
// function move_scripts_to_footer( &$scripts ) {
   
//   if ( ! is_admin() ) {
//     $scripts->add_data( 'jquery-core', 'group', 1 );
//     $scripts->add_data( 'jquery', 'group', 1 );
//     $scripts->add_data( 'jquery-migrate', 'group', 1 );
//   }
// }
// add_action( 'wp_default_scripts', __NAMESPACE__ . '\\move_scripts_to_footer' );

/**
 * Async Script Loading
 * http://matthewhorne.me/add-defer-async-attributes-to-wordpress-scripts/
 */
// add_filter('script_loader_tag', __NAMESPACE__ .'\\add_async_attribute', 10, 2);
// function add_async_attribute($tag, $handle) {
//     if ( 'sage/js' !== $handle )
//         return $tag;
//     return str_replace( ' src', ' async="async" src', $tag );
// }
