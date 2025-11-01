<?php
/**
 * Setup script to populate Optimally Organic website with products, categories, and pages
 * 
 * To run this, add this to functions.php temporarily or execute via WP-CLI
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function optimally_organic_setup_data() {
	
	// Check if WooCommerce is active
	if ( ! class_exists( 'WooCommerce' ) ) {
		return new WP_Error( 'woocommerce_not_active', 'WooCommerce is not active.' );
	}
	
	// Create Product Categories
	$categories = array(
		'fulvic-ionic-minerals' => array(
			'name' => 'Fulvic Ionic Minerals',
			'slug' => 'fulvic-ionic-minerals',
			'description' => 'Bio-Available Ancient Plant Based Ionic Fulvic Acid, Humic Acid, Electrolytes, Every Essential Amino Acid, & 77 Trace Minerals'
		),
		'red-pine-needle-oil' => array(
			'name' => 'Red Pine Needle Oil',
			'slug' => 'red-pine-needle-oil',
			'description' => 'The Ultimate Plant Based Extract for Immune Defense & Anti-Aging!'
		),
		'probiotics-enzymes-vegan' => array(
			'name' => 'Probiotics & Enzymes - Vegan',
			'slug' => 'probiotics-enzymes-vegan',
			'description' => '100 Wild Plant Enzymes & Probiotics - 5 Year Fermented Bio-Active Powerhouse'
		),
		'organic-supergreen-powders' => array(
			'name' => 'Organic Supergreen Powders',
			'slug' => 'organic-supergreen-powders',
			'description' => 'Raw, Organic & Bio-Active Supergreens Juice Powders'
		),
		'super-fruit-powders' => array(
			'name' => 'Super-Fruit Powders',
			'slug' => 'super-fruit-powders',
			'description' => 'Raw, Organic, Whole Food Vegan Multi-Vitamin & Protein Powder'
		),
		'optimally-organic-extracts' => array(
			'name' => 'Optimally Organic Extracts',
			'slug' => 'optimally-organic-extracts',
			'description' => 'Alcohol Free - Chemical Free - Never Heated - Fulvic Acid Transport'
		),
		'essiac-tea' => array(
			'name' => 'Essiac Tea',
			'slug' => 'essiac-tea',
			'description' => 'The Most Impactful Herbal Tea Blend EVER Created!'
		),
		'chaga-mushroom' => array(
			'name' => 'Chaga Mushroom',
			'slug' => 'chaga-mushroom',
			'description' => 'Organic & Wild Crafted Canadian Chaga Mushroom Products'
		),
	);
	
	$category_ids = array();
	foreach ( $categories as $key => $cat_data ) {
		$term = wp_insert_term(
			$cat_data['name'],
			'product_cat',
			array(
				'slug' => $cat_data['slug'],
				'description' => $cat_data['description'],
			)
		);
		
		if ( ! is_wp_error( $term ) ) {
			$category_ids[$key] = $term['term_id'];
		} else {
			$existing_term = get_term_by( 'slug', $cat_data['slug'], 'product_cat' );
			if ( $existing_term ) {
				$category_ids[$key] = $existing_term->term_id;
			}
		}
	}
	
	// Create Products
	$products = array(
		// Fulvic Ionic Minerals
		array(
			'name' => 'Fulvic Ionic Minerals X100',
			'price' => '39.95',
			'category' => 'fulvic-ionic-minerals',
			'description' => 'Water-Extracted Fulvic Acid® X100',
		),
		array(
			'name' => 'Fulvic Ionic Minerals X200',
			'price' => '49.95',
			'category' => 'fulvic-ionic-minerals',
			'description' => 'Water-Extracted Fulvic Acid® X200',
		),
		array(
			'name' => 'Fulvic Ionic Minerals X350',
			'price' => '59.95',
			'category' => 'fulvic-ionic-minerals',
			'description' => 'Water-Extracted Fulvic Acid® X350',
		),
		// Red Pine Needle Oil
		array(
			'name' => 'Red Pine Needle Oil 2oz',
			'price' => '47.95',
			'category' => 'red-pine-needle-oil',
			'description' => 'Liquid Red Pine Needle Oil 2oz',
		),
		array(
			'name' => 'Red Pine Needle Oil - Vegan Capsules (30)',
			'price' => '47.95',
			'category' => 'red-pine-needle-oil',
			'description' => 'Vegan Capsules - 30 Count',
		),
		array(
			'name' => 'Red Pine Needle Oil - Glycerin Soap',
			'price' => '24.95',
			'category' => 'red-pine-needle-oil',
			'description' => 'Glycerin Soap with Red Pine Needle Oil',
		),
		// Extracts
		array(
			'name' => 'Testosterone Boost Extract 2oz',
			'price' => '47.95',
			'category' => 'optimally-organic-extracts',
			'description' => 'BioActive Concentrated Herbal Extract',
		),
		array(
			'name' => 'Prostate Relief Extract 2oz',
			'price' => '47.95',
			'category' => 'optimally-organic-extracts',
			'description' => 'BioActive Concentrated Herbal Extract',
		),
		array(
			'name' => 'Natural Energy Extract 2oz',
			'price' => '47.95',
			'category' => 'optimally-organic-extracts',
			'description' => 'BioActive Concentrated Herbal Extract',
		),
		array(
			'name' => 'Menopause Comfort Extract 2oz',
			'price' => '47.95',
			'category' => 'optimally-organic-extracts',
			'description' => 'BioActive Concentrated Herbal Extract',
		),
		array(
			'name' => 'Weight-loss Accelerator Extract 2oz',
			'price' => '47.95',
			'category' => 'optimally-organic-extracts',
			'description' => 'BioActive Concentrated Herbal Extract',
		),
		array(
			'name' => 'Candida Cleanse Extract 2oz',
			'price' => '47.95',
			'category' => 'optimally-organic-extracts',
			'description' => 'BioActive Concentrated Herbal Extract',
		),
		array(
			'name' => 'Breath Easy Extract 2oz',
			'price' => '47.95',
			'category' => 'optimally-organic-extracts',
			'description' => 'BioActive Concentrated Herbal Extract',
		),
		array(
			'name' => 'Lymph Cleanse Extract 2oz',
			'price' => '47.95',
			'category' => 'optimally-organic-extracts',
			'description' => 'BioActive Concentrated Herbal Extract',
		),
		array(
			'name' => 'Purify Extract 2oz',
			'price' => '47.95',
			'category' => 'optimally-organic-extracts',
			'description' => 'BioActive Concentrated Herbal Extract',
		),
		array(
			'name' => 'Ginger Root Extract 2oz',
			'price' => '47.95',
			'category' => 'optimally-organic-extracts',
			'description' => 'BioActive Concentrated Herbal Extract',
		),
		array(
			'name' => 'Ginkgo Biloba Extract 2oz',
			'price' => '47.95',
			'category' => 'optimally-organic-extracts',
			'description' => 'BioActive Concentrated Herbal Extract',
		),
		array(
			'name' => 'Heart Health Extract 2oz',
			'price' => '47.95',
			'category' => 'optimally-organic-extracts',
			'description' => 'BioActive Concentrated Herbal Extract',
		),
		array(
			'name' => 'Sleep Wellness Extract 2oz',
			'price' => '47.95',
			'category' => 'optimally-organic-extracts',
			'description' => 'BioActive Concentrated Herbal Extract',
		),
		array(
			'name' => 'Turmeric Root Extract 2oz',
			'price' => '47.95',
			'category' => 'optimally-organic-extracts',
			'description' => 'BioActive Concentrated Herbal Extract',
		),
		array(
			'name' => 'Milk Thistle Seed Extract 2oz',
			'price' => '47.95',
			'category' => 'optimally-organic-extracts',
			'description' => 'BioActive Concentrated Herbal Extract',
		),
		array(
			'name' => 'Siberian Ginseng Extract 2oz',
			'price' => '47.95',
			'category' => 'optimally-organic-extracts',
			'description' => 'BioActive Concentrated Herbal Extract',
		),
		array(
			'name' => 'Ceylon Cinnamon Extract 2oz',
			'price' => '47.95',
			'category' => 'optimally-organic-extracts',
			'description' => 'BioActive Concentrated Herbal Extract',
		),
		array(
			'name' => 'Pau D\' Arco Extract 2oz',
			'price' => '47.95',
			'category' => 'optimally-organic-extracts',
			'description' => 'BioActive Concentrated Herbal Extract',
		),
		array(
			'name' => 'Chaga Mushroom Extract 2oz',
			'price' => '47.95',
			'category' => 'optimally-organic-extracts',
			'description' => 'BioActive Concentrated Herbal Extract',
		),
		// Probiotics
		array(
			'name' => '100 Wild Plant Enzymes & Probiotics',
			'price' => '59.95',
			'category' => 'probiotics-enzymes-vegan',
			'description' => '5 Year Fermented Bio-Active Powerhouse',
		),
		array(
			'name' => 'Chaga Mushroom and Wild Herb Concentrated Probiotics',
			'price' => '54.95',
			'category' => 'probiotics-enzymes-vegan',
			'description' => 'Concentrated Probiotics with Chaga Mushroom',
		),
		// Supergreens
		array(
			'name' => 'SuperGreens Powder (1/2 lb)',
			'price' => '39.95',
			'category' => 'organic-supergreen-powders',
			'description' => 'Raw, Organic & Bio-Active Supergreens Juice Powder',
		),
		array(
			'name' => 'Wheatgrass Juice Powder (1/2 LB)',
			'price' => '34.95',
			'category' => 'organic-supergreen-powders',
			'description' => 'Raw, Organic & Bio-Active Wheatgrass Juice Powder',
		),
		array(
			'name' => 'Barley Grass Juice Powder (1/2 lb)',
			'price' => '34.95',
			'category' => 'organic-supergreen-powders',
			'description' => 'Raw, Organic & Bio-Active Barley Grass Juice Powder',
		),
		array(
			'name' => 'Marine Phytoplankton (25 g) - Photobioreactor Grown',
			'price' => '44.95',
			'category' => 'organic-supergreen-powders',
			'description' => 'Photobioreactor Grown Marine Phytoplankton',
		),
		// Super Fruits
		array(
			'name' => 'Full Spectrum Daily (1/2 lb)',
			'price' => '49.95',
			'category' => 'super-fruit-powders',
			'description' => 'Raw, Organic, Whole Food Vegan Multi-Vitamin & Protein Powder',
		),
		array(
			'name' => 'Acerola Cherry Powder (1/2 lb)',
			'price' => '39.95',
			'category' => 'super-fruit-powders',
			'description' => 'Organic Freeze Dried Acerola Cherry Powder',
		),
		// Essiac Tea
		array(
			'name' => 'Essiac Tea (Powder, 1/2 lb)',
			'price' => '39.95',
			'category' => 'essiac-tea',
			'description' => 'Finely Ground Powder - 8 Herb Formula',
		),
		array(
			'name' => 'Essiac Tea (Tea Bag Cut, 1/2 lb)',
			'price' => '39.95',
			'category' => 'essiac-tea',
			'description' => 'Loose Tea Cut - 8 Herb Formula',
		),
		array(
			'name' => 'Essiac Tea Extract 2oz',
			'price' => '47.95',
			'category' => 'essiac-tea',
			'description' => 'Raw Earth Concentrated Live Extract',
		),
		// Chaga Mushroom
		array(
			'name' => 'Chaga Mushroom (Granules) 1/2 lb',
			'price' => '54.95',
			'category' => 'chaga-mushroom',
			'description' => 'Organic & Wild Crafted Canadian Chaga Mushroom',
		),
		// Bee Products
		array(
			'name' => 'YS Eco Bee Farms Bee Propolis Capsules',
			'price' => '29.95',
			'category' => 'optimally-organic-extracts',
			'description' => 'Bee Propolis Capsules',
		),
		array(
			'name' => 'YS Eco Bee Farms Royal Jelly Capsules',
			'price' => '34.95',
			'category' => 'optimally-organic-extracts',
			'description' => 'Royal Jelly Capsules',
		),
		// Package Deals
		array(
			'name' => 'Cleansing Kit # 1 - 60 Day Supply - 10% Off!!!',
			'price' => '199.95',
			'category' => 'optimally-organic-extracts',
			'description' => 'Complete 60 Day Cleansing Kit',
		),
	);
	
	foreach ( $products as $product_data ) {
		// Check if product already exists
		$existing_product = get_page_by_title( $product_data['name'], OBJECT, 'product' );
		
		if ( $existing_product ) {
			continue; // Skip if product already exists
		}
		
		$product = new WC_Product_Simple();
		$product->set_name( $product_data['name'] );
		$product->set_regular_price( $product_data['price'] );
		$product->set_description( $product_data['description'] );
		$product->set_short_description( $product_data['description'] );
		$product->set_status( 'publish' );
		$product->set_catalog_visibility( 'visible' );
		$product->set_manage_stock( false );
		
		if ( isset( $category_ids[ $product_data['category'] ] ) ) {
			$product->set_category_ids( array( $category_ids[ $product_data['category'] ] ) );
		}
		
		$product_id = $product->save();
		
		if ( is_wp_error( $product_id ) ) {
			continue; // Skip on error
		}
	}
	
	// Create Pages
	$pages = array(
		'about' => array(
			'title' => 'About',
			'content' => '<h2>About Optimally Organic</h2><p>Welcome to Optimally Organic, your trusted source for natural, organic, and bio-active health products. We specialize in premium quality supplements, extracts, and superfoods that are beyond organic, wild-grown, non-GMO, raw, and bioactive.</p><p>Our mission is to provide you with the highest quality natural products that support your wellness journey. All our products are carefully sourced and processed using our patented cold water extraction method to preserve maximum nutritional value.</p>',
		),
		'contact' => array(
			'title' => 'Contact',
			'content' => '<h2>Contact Us</h2><p>We\'d love to hear from you! Please reach out to us with any questions, concerns, or feedback.</p><p><strong>Email:</strong> info@optimallyorganic.com</p><p><strong>Phone:</strong> Available via contact form</p>',
		),
		'testimonials' => array(
			'title' => 'Testimonials',
			'content' => '<h2>What Our Customers Are Saying</h2><p>Read real testimonials from our satisfied customers who have experienced the benefits of our products.</p>',
		),
		'fulvic-acid-benefits' => array(
			'title' => 'Fulvic Acid Benefits',
			'content' => '<h2>Fulvic Acid Benefits</h2><p>Fulvic Acid is one of nature\'s most powerful antioxidants and nutrient transporters. Our patented cold water extraction process ensures maximum bioavailability.</p><h3>Key Benefits:</h3><ul><li>Detoxification of heavy metals and toxins</li><li>Enhanced nutrient absorption</li><li>Improved energy levels</li><li>Better digestion and gut health</li><li>Immune system support</li><li>Anti-aging properties</li></ul>',
		),
		'total-wellness-protocol' => array(
			'title' => 'The Total Wellness Protocol',
			'content' => '<h2>The Total Wellness Protocol</h2><p>Our comprehensive approach to wellness combines multiple bio-active supplements to support your body\'s natural healing processes.</p><h3>Protocol Components:</h3><ul><li>Fulvic Ionic Minerals for daily detoxification and nutrient support</li><li>Red Pine Needle Oil for immune defense and cellular regeneration</li><li>Probiotics & Enzymes for optimal gut health</li><li>Organic Supergreens for daily nutrition</li><li>Herbal Extracts for targeted support</li></ul>',
		),
	);
	
	foreach ( $pages as $slug => $page_data ) {
		$page = get_page_by_path( $slug );
		if ( ! $page ) {
			wp_insert_post( array(
				'post_title'   => $page_data['title'],
				'post_content' => $page_data['content'],
				'post_status'  => 'publish',
				'post_type'    => 'page',
				'post_name'    => $slug,
			) );
		}
	}
	
	return true;
}

// Uncomment to run setup (run once, then comment out)
// add_action( 'init', 'optimally_organic_setup_data' );

