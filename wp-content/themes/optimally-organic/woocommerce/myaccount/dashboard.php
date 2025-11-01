<?php
/**
 * My Account Dashboard Template
 * Modern Dashboard with Tailwind CSS
 *
 * @package Optimally_Organic
 */

defined( 'ABSPATH' ) || exit;

/**
 * My Account dashboard.
 *
 * @since 2.6.0
 */
do_action( 'woocommerce_account_dashboard' );

?>

<style>
/* Dashboard Welcome Message */
.woocommerce-MyAccount-content > p {
	font-size: 1rem !important;
	line-height: 1.75 !important;
	color: #4b5563 !important;
	margin-bottom: 1.5rem !important;
}

.woocommerce-MyAccount-content > p strong {
	color: #111827 !important;
	font-weight: 600 !important;
}

.woocommerce-MyAccount-content > p a {
	color: #2d5016 !important;
	font-weight: 600 !important;
	text-decoration: none !important;
	transition: color 0.3s ease !important;
}

.woocommerce-MyAccount-content > p a:hover {
	color: #4a7c2a !important;
	text-decoration: underline !important;
}
</style>

