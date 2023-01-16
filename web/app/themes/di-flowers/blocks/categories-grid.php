<?php

use Timber\Timber;
use Timber\Term;
use Timber\Post;
use Timber\Image;
use Carbon_Fields\Block;
use Carbon_Fields\Field;

Block::make('Categories Grid')
  ->add_fields( array(
    Field::make( 'association', 'df_categories_grid', 'Items Grid' )
      ->set_types( array(
          array(
              'type'  => 'term',
          ),
          array(
              'type'  => 'post',
          ),
      ) ),
    Field::make( 'text', 'df_grid_cols', 'Columns Number' )
      ->set_attribute( 'type', 'number' )
      ->set_attribute( 'min', '1' )
      ->set_attribute( 'max', '4' ),
  ) )
  ->set_category( 'widgets' )
  ->set_icon( 'grid-view' )
  ->set_render_callback( function( $fields, $attributes, $inner_blocks ) {
    $context = Timber::context();
    $context['attrs'] = join( ' ', $attributes);
    $context['categories'] = array_map( function($c) {
      switch ($c['type']) {
        case 'term':
          $obj = new Term( $c['id'] );
          return [
            'obj'   => $obj,
            'image' => new Image( $obj->meta( 'thumbnail_id' ) ),
          ];
          break;
        default:
          $obj = new Post( $c['id'] );
          return [
            'obj'   => $obj,
            'image' => $obj->thumbnail(),
          ];
          break;
      }
    }, $fields[ 'df_categories_grid' ] );
    $context['template_cols'] = join( ' ' , array_map( function() {
      return '1fr';
    }, range( 0, (int)$fields[ 'df_grid_cols' ] - 1 ) ) );
    Timber::render('blocks/categories-grid.twig', $context);
  } );