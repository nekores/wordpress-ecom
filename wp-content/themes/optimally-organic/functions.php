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
	// Enqueue Tailwind CSS
	wp_enqueue_style( 'optimally-organic-tailwind', get_template_directory_uri() . '/assets/css/tailwind.css', array(), '1.0.1' );
	
	// Enqueue custom CSS (for legacy support)
	wp_enqueue_style( 'optimally-organic-custom', get_template_directory_uri() . '/assets/css/custom.css', array(), '1.0.1' );
	
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
		'name'          => __( 'Shop Sidebar', 'optimally-organic' ),
		'id'            => 'sidebar-shop',
		'description'   => __( 'Widgets for shop page filters.', 'optimally-organic' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s mb-6">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wide mb-4">',
		'after_title'   => '</h3>',
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
 * Include admin meta boxes
 */
require_once get_template_directory() . '/includes/admin-meta-boxes.php';

/**
 * Include admin pages meta boxes
 */
require_once get_template_directory() . '/includes/admin-pages-meta-boxes.php';

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

/**
 * Add Homepage Sections Meta Box
 */
function optimally_organic_add_homepage_meta_boxes() {
	add_meta_box(
		'homepage_sections',
		'Homepage Sections Control',
		'optimally_organic_homepage_sections_callback',
		'page',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'optimally_organic_add_homepage_meta_boxes' );


/**
 * Save Homepage Sections Meta Box
 */
function optimally_organic_save_homepage_sections( $post_id ) {
	// Check nonce
	if ( ! isset( $_POST['homepage_sections_nonce'] ) || ! wp_verify_nonce( $_POST['homepage_sections_nonce'], 'optimally_organic_save_homepage_sections' ) ) {
		return;
	}
	
	// Check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	
	// Check permissions
	if ( ! current_user_can( 'edit_page', $post_id ) ) {
		return;
	}
	
	// Save checkbox values
	$sections = array(
		'hero_slider_enabled',
		'fulvic_section_enabled',
		'extracts_section_enabled',
		'pine_oil_section_enabled',
		'probiotics_section_enabled',
		'supergreens_section_enabled',
		'full_spectrum_section_enabled',
		'essiac_section_enabled',
		'testimonials_section_enabled',
		'benefits_section_enabled',
	);
	
	foreach ( $sections as $section ) {
		$value = isset( $_POST[ $section ] ) ? '1' : '0';
		update_post_meta( $post_id, '_' . $section, $value );
	}
	
	// Save hero slides
	if ( isset( $_POST['hero_slides'] ) && is_array( $_POST['hero_slides'] ) ) {
		$slides = array();
		foreach ( $_POST['hero_slides'] as $slide ) {
			$slides[] = array(
				'title' => sanitize_text_field( $slide['title'] ),
				'text' => sanitize_text_field( $slide['text'] ),
				'subtext' => sanitize_text_field( $slide['subtext'] ),
				'image' => esc_url_raw( $slide['image'] ),
				'button_text' => sanitize_text_field( $slide['button_text'] ),
				'button_link' => esc_url_raw( $slide['button_link'] ),
			);
		}
		update_post_meta( $post_id, '_hero_slides', $slides );
	}
	
	// Save section content
	$content_fields = array(
		'fulvic_title', 'fulvic_description',
		'extracts_title', 'extracts_subtitle',
		'pine_oil_title', 'pine_oil_description',
		'benefits_title',
		'probiotics_title', 'probiotics_description',
		'supergreens_title', 'supergreens_description',
		'full_spectrum_title', 'full_spectrum_description',
		'essiac_title', 'essiac_description',
		'testimonials_title',
	);
	
	foreach ( $content_fields as $field ) {
		if ( isset( $_POST[ $field ] ) ) {
			update_post_meta( $post_id, '_' . $field, sanitize_textarea_field( $_POST[ $field ] ) );
		}
	}
}
add_action( 'save_post', 'optimally_organic_save_homepage_sections' );

/**
 * Check if section is enabled
 */
function optimally_organic_is_section_enabled( $section_name, $post_id = null ) {
	if ( ! $post_id ) {
		$post_id = get_option( 'page_on_front' );
	}
	if ( ! $post_id ) {
		return true; // Default to enabled if no homepage set
	}
	$value = get_post_meta( $post_id, '_' . $section_name . '_enabled', true );
	return $value !== '0'; // Default to enabled
}

/**
 * Get hero content
 */
function optimally_organic_get_hero_content( $field, $post_id = null, $default = '' ) {
	if ( ! $post_id ) {
		$post_id = get_option( 'page_on_front' );
	}
	if ( ! $post_id ) {
		return $default;
	}
	$value = get_post_meta( $post_id, '_hero_' . $field, true );
	return $value ? $value : $default;
}

/**
 * Get saved slides
 */
function optimally_organic_get_slides( $post_id = null ) {
	if ( ! $post_id ) {
		$post_id = get_option( 'page_on_front' );
	}
	if ( ! $post_id ) {
		return array();
	}
	$slides = get_post_meta( $post_id, '_hero_slides', true );
	if ( ! is_array( $slides ) ) {
		$slides = array();
	}
	return $slides;
}

/**
 * Get saved testimonials
 */
function optimally_organic_get_testimonials( $post_id = null ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}
	if ( ! $post_id ) {
		return array();
	}
	$testimonials = get_post_meta( $post_id, '_testimonials_list', true );
	if ( ! is_array( $testimonials ) ) {
		$testimonials = array();
	}
	return $testimonials;
}

/**
 * Add page templates to dropdown
 */
function optimally_organic_add_page_templates( $templates ) {
	$templates['templates/page-about.php'] = 'About Page';
	$templates['templates/page-testimonials.php'] = 'Testimonials Page';
	return $templates;
}
add_filter( 'theme_page_templates', 'optimally_organic_add_page_templates' );

/**
 * Customize WooCommerce Product Loop
 */
function optimally_organic_product_loop_setup() {
	// Change products per row
	add_filter( 'loop_shop_columns', function() {
		return 3;
	} );
	
	// Change products per page
	add_filter( 'loop_shop_per_page', function() {
		return 12;
	}, 20 );
}
add_action( 'woocommerce_before_shop_loop', 'optimally_organic_product_loop_setup' );

/**
 * Customize Add to Cart Button Text
 */
function optimally_organic_custom_add_to_cart_text() {
	return __( 'Add to Cart', 'woocommerce' );
}
add_filter( 'woocommerce_product_add_to_cart_text', 'optimally_organic_custom_add_to_cart_text' );
add_filter( 'woocommerce_product_single_add_to_cart_text', 'optimally_organic_custom_add_to_cart_text' );

/**
 * Remove WooCommerce sidebar from single product page
 */
function optimally_organic_remove_single_product_sidebar() {
	if ( is_product() ) {
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
	}
}
add_action( 'woocommerce_before_main_content', 'optimally_organic_remove_single_product_sidebar' );

/**
 * Remove WooCommerce default shop sidebar
 */
function optimally_organic_remove_default_shop_sidebar() {
	if ( is_shop() || is_product_category() || is_product_tag() ) {
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
	}
}
add_action( 'woocommerce_before_main_content', 'optimally_organic_remove_default_shop_sidebar' );

/**
 * Customize WooCommerce result count and ordering output
 */
function optimally_organic_shop_toolbar_wrapper_start() {
	if ( is_shop() || is_product_category() || is_product_tag() ) {
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
		
		// Custom wrapper
		add_action( 'woocommerce_before_shop_loop', function() {
			?>
			<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 mb-6 flex flex-col sm:flex-row items-center justify-between gap-4">
				<div class="woocommerce-result-count-wrapper">
					<?php woocommerce_result_count(); ?>
				</div>
				<div class="woocommerce-ordering-wrapper">
					<?php woocommerce_catalog_ordering(); ?>
				</div>
			</div>
			<?php
		}, 25 );
	}
}
add_action( 'template_redirect', 'optimally_organic_shop_toolbar_wrapper_start' );

/**
 * Customize single product layout
 */
function optimally_organic_single_product_layout() {
	if ( is_product() ) {
		// Change single product wrapper classes
		add_filter( 'woocommerce_output_content_wrapper', function() {
			return '<div class="bg-white rounded-2xl shadow-lg overflow-hidden">';
		} );
	}
}
add_action( 'woocommerce_before_single_product', 'optimally_organic_single_product_layout' );

