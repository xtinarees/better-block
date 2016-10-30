<?php

function bb_is_featured() {
	return
	array(
		array(
			'key'       => 'featured',
			'value'     => true,
			'compare'   => '=',
		),
	);
}

function bb_get_products($args = '') {
	$posts = Timber::get_posts($args);
	$products = array();
	foreach($posts as &$post) {
		$products[] = new Product($post);
	}

	return $products;
}

function bb_get_category_id() {
	global $post;

	$categories = get_the_category($post);

	foreach($categories as $category) {
		return $category->term_id;
		break;
	}

}

function bb_get_related_products() {
	global $post;

	$args = array(
		'post_type' => 'products',
		'post_parent' => 0,
		'posts_per_page' => 3, 
		'post__not_in' => array($post->ID),
		'tax_query' => array(
			array(
				'taxonomy' => 'category',
				'field' => 'term_id',
				'terms' => bb_get_category_id(),
			),
		),
	);

	$related_products = bb_get_products($args);


	return $related_products;
}

function bb_get_featured_products() {
	$args = array(
		'post_type' => 'products',
		'post_parent' => 0,
		'posts_per_page' => 3,
		'meta_query'	=> bb_is_featured()
	);

	$featured_products = bb_get_products($args);

	return $featured_products;
}

function bb_get_products_fallback() {
	$products = bb_get_related_products();
	if (!empty($products)) {
		return $products;
	} else {
		return bb_get_featured_products();
	}
}


