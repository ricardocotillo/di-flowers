<?php

use Timber\Integrations\WooCommerce\WooCommerce;

// $data = carbon_get_theme_option('df_categories');
// $ids = array_map(fn($d) => (int)$d['id'], $data);
// $categories = get_terms(['include' => $ids]);
// wc_add_notice( __("Your payment has been successful", "woocommerce"), "success" );

$facet_cats = facetwp_display('facet','categories');
$reset = facetwp_display('facet', 'reset');
$context = [
  'facet_cats'  => $facet_cats,
  'reset'       => $reset,
];

WooCommerce::render_default_template( $context );