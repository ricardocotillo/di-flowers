<?php

use Timber\Integrations\WooCommerce\WooCommerce;
use Timber\Post;
$sidebar_opt = carbon_get_theme_option('df_sidebar');
$context = [];
if (count($sidebar_opt) > 0) {
  $sidebar = new Post((int)$sidebar_opt[0]['id']);
  $context['sidebar'] = $sidebar;
} 

WooCommerce::render_default_template( $context );