<?php

use Timber\Integrations\WooCommerce\WooCommerce;

$context = [
    // 'shop_data' => 'Add data that will be added to WooCommerce shop pages only',
];

WooCommerce::render_default_template( $context );