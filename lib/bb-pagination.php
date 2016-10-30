<?php


// fixes pagination on archive pages
add_action( 'parse_query','changept' );
function changept() {
    if( is_category() && !is_admin() )
        set_query_var( 'post_type', array( 'post', 'products' ) );
    return;
}


// fix redirect permalink issue in pages
add_action('template_redirect', function() {
  if ( is_singular('products') ) {
    global $wp_query;
    $page = (int) $wp_query->get('page');
    if ( $page > 1 ) {
      // convert 'page' to 'paged'
      $query->set( 'page', 1 );
      $query->set( 'paged', $page );
    }
    // prevent redirect
    remove_action( 'template_redirect', 'redirect_canonical' );
  }
}, 0 ); // on priority 0 to be able removing 'redirect_canonical' added with priority 10