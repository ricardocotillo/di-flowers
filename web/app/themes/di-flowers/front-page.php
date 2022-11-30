<?php
$context = Timber::context();

$timber_post     = new Timber\Post();
$context['post'] = $timber_post;
$context['shop_link'] = get_permalink( wc_get_page_id( 'shop' ) );
Timber::render( array( 'front-page.twig' ), $context );
