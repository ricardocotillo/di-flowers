<?php
/**
 * Timber starter-theme
 * https://github.com/timber/starter-theme
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

use Carbon_Fields\Container;
use Carbon_Fields\Block;
use Carbon_Fields\Field;

$composer_autoload = __DIR__ . '/vendor/autoload.php';
if ( file_exists( $composer_autoload ) ) {
	require_once $composer_autoload;
	$timber = new Timber\Timber();
}

/**
 * This ensures that Timber is loaded and available as a PHP class.
 * If not, it gives an error message to help direct developers on where to activate
 */
include 'inc/inc.vite.php';
if ( ! class_exists( 'Timber' ) ) {

	add_action(
		'admin_notices',
		function() {
			echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
		}
	);

	add_filter(
		'template_include',
		function( $template ) {
			return get_stylesheet_directory() . '/static/no-timber.html';
		}
	);
	return;
}

/**
 * Sets the directories (inside your theme) to find .twig files
 */
Timber::$dirname = array( 'templates', 'views' );

/**
 * By default, Timber does NOT autoescape values. Want to enable Twig's autoescape?
 * No prob! Just set this value to true
 */
Timber::$autoescape = false;


/**
 * We're going to configure our theme inside of a subclass of Timber\Site
 * You can move this to its own file and include here via php's include("MySite.php")
 */
class StarterSite extends Timber\Site {
	/** Add timber support. */
	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'theme_supports' ) );
		add_filter( 'timber/context', array( $this, 'add_to_context' ) );
		add_filter( 'timber/twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		add_action( 'wp_enqueue_scripts', [ $this, 'disable_woocommerce_block_styles' ] );
		add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
		add_filter( 'woocommerce_product_tabs', [ $this, 'my_remove_description_tab' ] );
		parent::__construct();
	}
	/** This is where you can register custom post types. */
	public function register_post_types() {

	}
	/** This is where you can register custom taxonomies. */
	public function register_taxonomies() {

	}

	function disable_woocommerce_block_styles() {
		wp_deregister_style( 'wc-blocks-style' );
		wp_dequeue_style( 'wc-blocks-style' );
	}
 
	function my_remove_description_tab( $tabs ) {
		unset( $tabs['additional_information'] );
		return $tabs;
	}

	/** This is where you add some context
	 *
	 * @param string $context context['this'] Being the Twig's {{ this }}.
	 */
	public function add_to_context( $context ) {
		$context['menu']  = new Timber\Menu('main');
		$context['footer_menu'] = new Timber\Menu('footer');
		$context['cart_link'] = get_permalink( wc_get_page_id( 'cart' ) );
		$context['social'] = [
			'phone'		=> carbon_get_theme_option( 'phone' ),
			'whatsapp' 	=> carbon_get_theme_option( 'whatsapp' ),
			'email' 	=> carbon_get_theme_option( 'email' ),
			'facebook' 	=> carbon_get_theme_option( 'facebook' ),
			'instagram' => carbon_get_theme_option( 'instagram' ),
		];
		$context['site']  = $this;
		return $context;
	}

	public function theme_supports() {
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'audio',
			)
		);

		add_theme_support( 'menus' );

		add_theme_support( 'woocommerce' );
	}

	/** This Would return 'foo bar!'.
	 *
	 * @param string $text being 'foo', then returned 'foo bar!'.
	 */
	public function myfoo( $text ) {
		$text .= ' bar!';
		return $text;
	}

	/** This is where you can add your own functions to twig.
	 *
	 * @param string $twig get extension.
	 */
	public function add_to_twig( $twig ) {
		$twig->addExtension( new Twig\Extension\StringLoaderExtension() );
		$twig->addFilter( new Twig\TwigFilter( 'myfoo', array( $this, 'myfoo' ) ) );
		return $twig;
	}

}

new StarterSite();

if ( class_exists( 'WooCommerce' ) ) {
    Timber\Integrations\WooCommerce\WooCommerce::init();
}

add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );

function crb_attach_theme_options() {
	Container::make( 'theme_options', 'Información de Contacto' )
		->set_icon( 'dashicons-carrot' )
		->add_fields( array(
			Field::make( 'text', 'phone', 'Teléfono' )->set_attribute('type', 'tel'),
			Field::make( 'text', 'whatsapp', 'Whatsapp' )->set_attribute('type', 'tel'),
			Field::make( 'text', 'email', 'Correo Electrónico' )->set_attribute('type', 'email'),
			Field::make( 'text', 'facebook', 'Facebook' )->set_attribute('type', 'url'),
			Field::make( 'text', 'instagram', 'Instagram' )->set_attribute('type', 'url'),
		) );

	Container::make( 'post_meta', 'Hero' )
		->where( 'post_id', '=', get_option( 'page_on_front' ) )
		->add_fields( array(
			Field::make( 'image', 'df_hero_image', 'Imagen' ),
			Field::make( 'text', 'df_hero_text', 'Texto' ),
			Field::make( 'text', 'df_hero_button_text', 'Texto de botón' ),
			Field::make( 'association', 'df_link_to_page', 'Link a post/página' )
				->set_types( array(
					array(
						'type' => 'post',
					),
				) )
				->set_min( 1 )
				->set_max( 1 ),
		) );

	include 'blocks/categories-grid.php';
	include 'blocks/subscribe-block.php';
	include 'blocks/lottie.php';
}

add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
    \Carbon_Fields\Carbon_Fields::boot();
}