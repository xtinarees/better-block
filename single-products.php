<?php
	global $paged;
	if (!isset($paged) || !$paged){
		$paged = 1;
	}

$context = Timber::get_context();

$post = new Product();
$context['page'] = $post;

$post_children = $post->child_count();

$post_id = $post->ID;

// if page does not have children
if ($post_children == 0) {
	$context['products'] = bb_get_products_fallback();

	$gallery_images = get_field('gallery', $post_id);
	$gallery_image_count = count($gallery_images);
	$context['gallery_image_count'] = $gallery_image_count;

	Timber::render('product.twig', $context);

} else {

	$args = array(
		'post_type' => 'products',
		'post_parent' => $post_id,
		'posts_per_page' => 12,
		'paged' => $paged
	);

	query_posts($args);

	$context['products'] = Timber::get_posts($args);
	$context['pagination'] = Timber::get_pagination();


	Timber::render('archive.twig', $context);

}


