<?php
use Timber\Image;
use Timber\Post;

$context = Timber::context();
$context['post'] = new Post();
$img_id = carbon_get_post_meta( get_the_ID(), 'df_hero_image' );
$hero_post = carbon_get_post_meta( get_the_ID(), 'df_link_to_page' );

$context['hero_image'] = new Image( $img_id );
$context['hero_txt'] = carbon_get_post_meta( get_the_ID(), 'df_hero_text' );
$context['hero_btn_txt'] = carbon_get_post_meta( get_the_ID(), 'df_hero_button_text' );
$context['hero_post'] = new Post( (int)$hero_post[0]['id'] );

Timber::render( array( 'front-page.twig' ), $context );
