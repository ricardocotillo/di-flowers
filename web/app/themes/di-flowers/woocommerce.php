<?php

use Timber\Integrations\WooCommerce\WooCommerce;

$facet_cats = facetwp_display('facet','categories');
$reset = facetwp_display('facet', 'reset');
$context = [
  'facet_cats'  => $facet_cats,
  'reset'       => $reset,
];

WooCommerce::render_default_template( $context );