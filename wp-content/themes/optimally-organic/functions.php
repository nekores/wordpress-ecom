<?php
/**
 * Optimally Organic Theme Functions
 *
 * @package Optimally_Organic
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme Setup
 */
function optimally_organic_setup() {
	// Add theme support
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	
	// WooCommerce support
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	
	// Register navigation menus
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'optimally-organic' ),
		'footer'  => __( 'Footer Menu', 'optimally-organic' ),
	) );
	
	// Set image sizes
	set_post_thumbnail_size( 800, 600, true );
	add_image_size( 'product-thumb', 400, 400, true );
}
add_action( 'after_setup_theme', 'optimally_organic_setup' );

/**
 * Enqueue Scripts and Styles
 */
function optimally_organic_scripts() {
	// Enqueue stylesheet
	wp_enqueue_style( 'optimally-organic-style', get_stylesheet_uri(), array(), '1.0.0' );
	
	// Enqueue custom CSS
	wp_enqueue_style( 'optimally-organic-custom', get_template_directory_uri() . '/assets/css/custom.css', array(), '1.0.0' );
	
	// Enqueue scripts
	wp_enqueue_script( 'optimally-organic-script', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), '1.0.0', true );
	
	// Localize script for AJAX
	wp_localize_script( 'optimally-organic-script', 'ajax_object', array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'nonce'    => wp_create_nonce( 'optimally_organic_nonce' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'optimally_organic_scripts' );

/**
 * Register Widget Areas
 */
function optimally_organic_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'optimally-organic' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here.', 'optimally-organic' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer 1', 'optimally-organic' ),
		'id'            => 'footer-1',
		'description'   => __( 'Add widgets here.', 'optimally-organic' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer 2', 'optimally-organic' ),
		'id'            => 'footer-2',
		'description'   => __( 'Add widgets here.', 'optimally-organic' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer 3', 'optimally-organic' ),
		'id'            => 'footer-3',
		'description'   => __( 'Add widgets here.', 'optimally-organic' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'optimally_organic_widgets_init' );

/**
 * Custom Excerpt Length
 */
function optimally_organic_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'optimally_organic_excerpt_length' );

/**
 * Posted on function
 */
function optimally_organic_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( DATE_W3C ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'optimally-organic' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span>';
}

/**
 * Posted by function
 */
function optimally_organic_posted_by() {
	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'optimally-organic' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="byline"> ' . $byline . '</span>';
}

/**
 * Remove WooCommerce Wrapper
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

/**
 * Add Custom WooCommerce Wrapper
 */
function optimally_organic_wrapper_start() {
	echo '<div class="woocommerce-wrapper"><div class="container">';
}
add_action( 'woocommerce_before_main_content', 'optimally_organic_wrapper_start', 10 );

function optimally_organic_wrapper_end() {
	echo '</div></div>';
}
add_action( 'woocommerce_after_main_content', 'optimally_organic_wrapper_end', 10 );

/**
 * Get Featured Products
 */
function optimally_organic_get_featured_products( $limit = 8 ) {
	$args = array(
		'post_type'      => 'product',
		'posts_per_page' => $limit,
		'orderby'        => 'date',
		'order'          => 'DESC',
	);
	return new WP_Query( $args );
}

/**
 * Get Products by Category
 */
function optimally_organic_get_products_by_category( $category_slug, $limit = 4 ) {
	$args = array(
		'post_type'      => 'product',
		'posts_per_page' => $limit,
		'tax_query'      => array(
			array(
				'taxonomy' => 'product_cat',
				'field'    => 'slug',
				'terms'    => $category_slug,
			),
		),
	);
	return new WP_Query( $args );
}

/**
 * Include setup data file
 */
require_once get_template_directory() . '/setup-data.php';

/**
 * Add admin menu for setup
 */
function optimally_organic_add_admin_menu() {
	add_theme_page(
		'Setup Optimally Organic',
		'Setup Site Data',
		'manage_options',
		'optimally-organic-setup',
		'optimally_organic_setup_page'
	);
}
add_action( 'admin_menu', 'optimally_organic_add_admin_menu' );

/**
 * Setup page callback
 */
function optimally_organic_setup_page() {
	if ( isset( $_POST['run_setup'] ) && check_admin_referer( 'optimally_organic_setup' ) ) {
		$result = optimally_organic_setup_data();
		if ( $result === true ) {
			echo '<div class="notice notice-success"><p>Setup completed successfully!</p></div>';
			update_option( 'optimally_organic_setup_complete', true );
		} else {
			echo '<div class="notice notice-error"><p>Setup failed. Please check if WooCommerce is active.</p></div>';
		}
	}
	
	$setup_complete = get_option( 'optimally_organic_setup_complete', false );
	?>
	<div class="wrap">
		<h1>Optimally Organic Setup</h1>
		<?php if ( $setup_complete ) : ?>
			<div class="notice notice-info">
				<p>Setup has already been completed. If you need to run it again, you can do so below.</p>
			</div>
		<?php endif; ?>
		<form method="post">
			<?php wp_nonce_field( 'optimally_organic_setup' ); ?>
			<p>This will create all product categories, products, and pages for the Optimally Organic website.</p>
			<p><strong>Note:</strong> Make sure WooCommerce is installed and activated before running this setup.</p>
			<?php submit_button( 'Run Setup', 'primary', 'run_setup' ); ?>
		</form>
	</div>
	<?php
}

