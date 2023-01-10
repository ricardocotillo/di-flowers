<?php
use Timber\Image;
use Timber\Post;
use Timber\Term;

$context = Timber::context();
$context['post'] = new Post();
$img_id = carbon_get_post_meta( get_the_ID(), 'df_hero_image' );
$link = carbon_get_post_meta( get_the_ID(), 'df_link_to_page', );

$context['hero_image'] = new Image( $img_id );
$context['hero_txt'] = carbon_get_post_meta( get_the_ID(), 'df_hero_text' );
$context['hero_btn_txt'] = carbon_get_post_meta( get_the_ID(), 'df_hero_button_text' );
switch ($link[0]['type']) {
    case 'term':
        $context['hero_link'] = new Term( (int)$link[0]['id'] );
        break;
    default:
        $context['hero_link'] = new Post( (int)$link[0]['id'] );
        break;
}

Timber::render( array( 'front-page.twig' ), $context );
