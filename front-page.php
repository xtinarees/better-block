<?php
$context = Timber::get_context();

$post = new TimberPost();
$context['page'] = $post;

$context['products'] = bb_get_featured_products();

$args = array(
	'post_type' => 'page',
	'posts_per_page' => 2, 
	'meta_query' => bb_is_featured()
);

$context['posts'] = Timber::get_posts($args);
$context['categories'] = Timber::get_terms('category');


Timber::render('front-page.twig', $context);
