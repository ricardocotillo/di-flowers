<?php

use Timber\Timber;
use Timber\Term;
use Timber\Image;
use Carbon_Fields\Block;
use Carbon_Fields\Field;

Block::make('Categories Grid')
  ->add_fields( array(
    Field::make( 'association', 'df_categories_grid', 'Categories Grid' )
      ->set_types( array(
          array(
              'type'		  => 'term',
              'taxonomy' => 'product_cat',
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
    $ids = array_map( function($c) {
        return $c['id'];
    }, $fields[ 'df_categories_grid' ] );
    $context['categories'] = array_map( function($id) {
      $thumb_id = get_woocommerce_term_meta( $id, 'thumbnail_id', true );
      return [
        'category'  => new Term($id),
        'image'     => new Image($thumb_id),
      ];
    }, $ids );
    $context['template_cols'] = join( ' ' , array_map( function() {
      return '1fr';
    }, range( 0, (int)$fields[ 'df_grid_cols' ] - 1 ) ) );
    Timber::render('blocks/categories-grid.twig', $context);
  } );