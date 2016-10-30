<?php

$context = Timber::get_context();

$post = new TimberPost();
$context['page'] = $post;

Timber::render('page.twig', $context);
