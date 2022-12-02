<?php

use Timber\Timber;
use Carbon_Fields\Block;
use Carbon_Fields\Field;

Block::make('Lottie')
  ->add_fields( array(
    Field::make( 'text', 'df_asset_link', 'Asset link' ),
    Field::make( 'text', 'df_speed', 'Speed' )->set_attribute( 'type', 'number' ),
    Field::make( 'checkbox', 'df_autoplay', 'Autoplay' ),
    Field::make( 'checkbox', 'df_loop', 'Loop' ),
    Field::make( 'select', 'df_unit', 'Unidad' )
        ->set_options( array(
            'rem'   => 'rem',
            'em'    => 'em',
            'px'    => 'px',
            '%'     => '%',
        ) ),
    Field::make( 'text', 'df_width', 'Ancho' )->set_attribute( 'type', 'number' ),
    Field::make( 'text', 'df_height', 'Alto' )->set_attribute( 'type', 'number' ),
  ) )
  ->set_category( 'widgets' )
  ->set_icon( 'star' )
  ->set_render_callback( function( $fields, $attributes, $inner_blocks ) {
    $context = Timber::context();
    $context['fields'] = $fields;
    $context['attrs'] = join( ' ', $attributes);
    Timber::render('blocks/lottie.twig', $context);
  } );