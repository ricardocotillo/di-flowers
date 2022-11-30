<?php

use Timber\Timber;
use Carbon_Fields\Block;
use Carbon_Fields\Field;

Block::make('Subscripción')
  ->add_fields( array(
    Field::make( 'text', 'df_subscribe_title', 'Título' ),
    Field::make( 'text', 'df_button_text', 'Texto de botón' ),
  ) )
  ->set_category( 'widgets' )
  ->set_icon( 'text' )
  ->set_render_callback( function( $fields, $attributes, $inner_blocks ) {
    $context = Timber::context();
    $context['fields'] = $fields;
    $context['attrs'] = $attributes;
    Timber::render('blocks/subscribe-block.twig', $context);
  } );