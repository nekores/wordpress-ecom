<?php
/**
 * One-time script to run the Optimally Organic setup
 * 
 * Access this file directly in your browser: http://localhost:8888/wordpress-ecom/run-setup.php
 * Or run via command line: php run-setup.php
 * 
 * IMPORTANT: Delete this file after running for security!
 */

// Load WordPress
require_once( dirname( __FILE__ ) . '/wp-load.php' );

// Check if user is admin (for browser access)
if ( php_sapi_name() !== 'cli' && ! current_user_can( 'manage_options' ) ) {
    die( 'Access denied. You must be an administrator to run this script.' );
}

// Check if WooCommerce is active
if ( ! class_exists( 'WooCommerce' ) ) {
    die( 'ERROR: WooCommerce is not active. Please activate WooCommerce plugin first.' );
}

// Include the setup function
require_once( get_template_directory() . '/setup-data.php' );

echo "Starting Optimally Organic setup...\n\n";

// Run the setup
$result = optimally_organic_setup_data();

if ( $result === true ) {
    echo "SUCCESS! Setup completed successfully!\n\n";
    echo "Created:\n";
    echo "- Product Categories\n";
    echo "- 40+ Products\n";
    echo "- 5 Pages (About, Contact, Testimonials, etc.)\n\n";
    echo "You can now visit your shop page: http://localhost:8888/wordpress-ecom/shop/\n";
    echo "\nIMPORTANT: Please delete this file (run-setup.php) for security!\n";
} else {
    echo "ERROR: Setup failed. Please check the error above.\n";
    if ( is_wp_error( $result ) ) {
        echo "Error: " . $result->get_error_message() . "\n";
    }
}

