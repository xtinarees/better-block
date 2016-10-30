<?php
global $paged;

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; 

$context = Timber::get_context();

$post = new TimberTerm();
$context['page'] = $post;


$tax_query = array('relation' => 'AND');

if ($post->taxonomy == 'category') {
    $tax_query[] = array(
        'taxonomy' => 'category',
        'field' => 'term_id',
        'terms' => $post->term_id
    );
}

$args = array(
    'post_type' => 'products',
    'tax_query' => $tax_query,
    'posts_per_page' => 12,
    'paged' => $paged
);

query_posts($args);

$context['products'] = bb_get_products($args);
$context['pagination'] = Timber::get_pagination();
$context['categories'] = Timber::get_terms('category');


Timber::render('archive.twig', $context);

