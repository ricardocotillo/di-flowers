<?php

use Timber\Timber;
use Carbon_Fields\Block;
use Carbon_Fields\Field;

Block::make('Productos Destacados')
  ->add_fields( array(
    Field::make( 'text', 'df_button_text', 'Texto de botón' ),
  ) )
  ->set_category( 'widgets' )
  ->set_icon( 'star' )
  ->set_render_callback( function( $fields, $attributes, $inner_blocks ) {
    $context = Timber::context();
    $context['fields'] = $fields;
    $context['attrs'] = join( ' ', $attributes);
    Timber::render('blocks/featured-mosaic.twig', $context);
  } );