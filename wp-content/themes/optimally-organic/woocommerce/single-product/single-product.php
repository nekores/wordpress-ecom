<?php
/**
 * Modern Single Product Page Template with Tailwind CSS
 * Overrides the default WooCommerce single product output
 */

defined( 'ABSPATH' ) || exit;

global $product;
?>

<div class="single-product-wrapper bg-white rounded-2xl shadow-lg overflow-hidden mb-8">
	<!-- Product Header (Breadcrumbs) -->
	<div class="px-4 sm:px-6 lg:px-8 pt-6 pb-4 border-b border-gray-200">
		<?php woocommerce_breadcrumb(); ?>
	</div>

	<!-- Main Product Content -->
	<div class="p-4 sm:p-6 lg:p-8">
		<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
			<!-- Product Images -->
			<div class="product-images lg:sticky lg:top-8 lg:self-start">
				<?php
				/**
				 * Hook: woocommerce_before_single_product_summary.
				 *
				 * @hooked woocommerce_show_product_sale_flash - 10
				 * @hooked woocommerce_show_product_images - 20
				 */
				do_action( 'woocommerce_before_single_product_summary' );
				?>
			</div>

			<!-- Product Summary -->
			<div class="summary entry-summary space-y-6">
				<?php
				/**
				 * Hook: woocommerce_single_product_summary.
				 *
				 * @hooked woocommerce_template_single_title - 5
				 * @hooked woocommerce_template_single_rating - 10
				 * @hooked woocommerce_template_single_price - 10
				 * @hooked woocommerce_template_single_excerpt - 20
				 * @hooked woocommerce_template_single_add_to_cart - 30
				 * @hooked woocommerce_template_single_meta - 40
				 * @hooked woocommerce_template_single_sharing - 50
				 * @hooked WC_Structured_Data::generate_product_data() - 60
				 */
				do_action( 'woocommerce_single_product_summary' );
				?>
			</div>
		</div>
	</div>
</div>

<!-- Product Tabs & Related Products -->
<div class="mt-8">
	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );
	?>
</div>

<style>
/* Breadcrumb Styling */
.woocommerce-breadcrumb {
	margin-bottom: 0 !important;
	font-size: 0.875rem !important;
	color: #6b7280 !important;
}

.woocommerce-breadcrumb a {
	color: #2d5016 !important;
	text-decoration: none !important;
	transition: color 0.3s ease !important;
}

.woocommerce-breadcrumb a:hover {
	color: #4a7c2a !important;
	text-decoration: underline !important;
}

/* Product Images */
.single-product .woocommerce-product-gallery {
	margin-bottom: 0 !important;
}

.single-product .woocommerce-product-gallery__wrapper {
	border-radius: 1rem !important;
	overflow: hidden !important;
	background: #f9fafb !important;
}

.single-product .woocommerce-product-gallery__image {
	border-radius: 0.5rem !important;
	overflow: hidden !important;
}

.single-product .woocommerce-product-gallery__image img {
	width: 100% !important;
	height: auto !important;
	border-radius: 0.5rem !important;
	transition: transform 0.5s ease !important;
}

.single-product .woocommerce-product-gallery__image:hover img {
	transform: scale(1.05) !important;
}

/* Sale Flash */
.single-product .onsale {
	position: absolute !important;
	top: 1rem !important;
	left: 1rem !important;
	z-index: 10 !important;
	background: #E91E63 !important;
	color: white !important;
	padding: 0.5rem 1rem !important;
	border-radius: 9999px !important;
	font-weight: 700 !important;
	font-size: 0.875rem !important;
	box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
}

/* Product Title */
.single-product .product_title {
	font-size: 1.875rem !important;
	font-weight: 700 !important;
	color: #111827 !important;
	margin-bottom: 1rem !important;
	line-height: 1.2 !important;
}

@media (min-width: 768px) {
	.single-product .product_title {
		font-size: 2.25rem !important;
	}
}

@media (min-width: 1024px) {
	.single-product .product_title {
		font-size: 2.5rem !important;
	}
}

/* Rating */
.single-product .woocommerce-product-rating {
	margin-bottom: 1.5rem !important;
	display: flex !important;
	align-items: center !important;
	gap: 0.5rem !important;
}

.single-product .star-rating {
	color: #FFC107 !important;
	font-size: 1.25rem !important;
}

.single-product .woocommerce-review-link {
	color: #6b7280 !important;
	font-size: 0.875rem !important;
	text-decoration: none !important;
	margin-left: 0.5rem !important;
}

.single-product .woocommerce-review-link:hover {
	color: #2d5016 !important;
	text-decoration: underline !important;
}

/* Price */
.single-product .price {
	font-size: 1.875rem !important;
	font-weight: 700 !important;
	color: #2d5016 !important;
	margin-bottom: 1.5rem !important;
	display: block !important;
}

@media (min-width: 768px) {
	.single-product .price {
		font-size: 2.25rem !important;
	}
}

.single-product .price del {
	color: #9ca3af !important;
	font-weight: 400 !important;
	font-size: 1.5rem !important;
	margin-right: 0.5rem !important;
}

.single-product .price ins {
	text-decoration: none !important;
}

/* Short Description */
.single-product .woocommerce-product-details__short-description {
	font-size: 1.125rem !important;
	line-height: 1.75 !important;
	color: #4b5563 !important;
	margin-bottom: 2rem !important;
}

.single-product .woocommerce-product-details__short-description p {
	margin-bottom: 1rem !important;
}

/* Cart Form */
.single-product .cart {
	margin-bottom: 2rem !important;
	display: flex !important;
	flex-direction: column !important;
	gap: 1rem !important;
}

@media (min-width: 640px) {
	.single-product .cart {
		flex-direction: row !important;
		align-items: flex-start !important;
	}
}

/* Quantity Input */
.single-product .quantity {
	margin-bottom: 0 !important;
}

.single-product .quantity input[type="number"] {
	width: 100px !important;
	padding: 0.875rem !important;
	border: 2px solid #e5e7eb !important;
	border-radius: 0.5rem !important;
	font-size: 1.125rem !important;
	text-align: center !important;
	font-weight: 600 !important;
	transition: border-color 0.3s ease !important;
}

.single-product .quantity input[type="number"]:focus {
	outline: none !important;
	border-color: #2d5016 !important;
	box-shadow: 0 0 0 3px rgba(45, 80, 22, 0.1) !important;
}

/* Add to Cart Button */
.single-product .single_add_to_cart_button {
	flex: 1 !important;
	padding: 1rem 2rem !important;
	font-size: 1.125rem !important;
	font-weight: 600 !important;
	background: linear-gradient(135deg, #E91E63 0%, #C2185B 100%) !important;
	color: white !important;
	border: none !important;
	border-radius: 0.75rem !important;
	cursor: pointer !important;
	transition: all 0.3s ease !important;
	box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
	display: flex !important;
	align-items: center !important;
	justify-content: center !important;
	gap: 0.5rem !important;
}

.single-product .single_add_to_cart_button:hover {
	background: linear-gradient(135deg, #C2185B 0%, #A0154A 100%) !important;
	transform: translateY(-2px) !important;
	box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2) !important;
}

.single-product .single_add_to_cart_button:disabled {
	opacity: 0.6 !important;
	cursor: not-allowed !important;
}

/* Product Meta */
.single-product .product_meta {
	padding-top: 1.5rem !important;
	border-top: 1px solid #e5e7eb !important;
	margin-top: 1.5rem !important;
	display: flex !important;
	flex-direction: column !important;
	gap: 0.75rem !important;
}

.single-product .product_meta > span {
	display: flex !important;
	align-items: center !important;
	gap: 0.5rem !important;
	color: #6b7280 !important;
	font-size: 0.875rem !important;
}

.single-product .product_meta strong {
	font-weight: 600 !important;
	color: #111827 !important;
	min-width: 100px !important;
}

.single-product .product_meta a {
	color: #2d5016 !important;
	font-weight: 600 !important;
	text-decoration: none !important;
	transition: color 0.3s ease !important;
}

.single-product .product_meta a:hover {
	color: #4a7c2a !important;
	text-decoration: underline !important;
}

/* Product Tabs */
.single-product .woocommerce-tabs {
	margin-top: 3rem !important;
	background: white !important;
	border-radius: 1rem !important;
	padding: 2rem !important;
	box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1) !important;
}

.single-product .wc-tabs {
	border-bottom: 2px solid #e5e7eb !important;
	padding-bottom: 0 !important;
	margin-bottom: 2rem !important;
	display: flex !important;
	gap: 1rem !important;
	flex-wrap: wrap !important;
	list-style: none !important;
	margin-left: 0 !important;
}

.single-product .wc-tabs li {
	margin: 0 !important;
	padding: 0 !important;
}

.single-product .wc-tabs li a {
	padding: 0.75rem 1.5rem !important;
	color: #6b7280 !important;
	font-weight: 600 !important;
	text-decoration: none !important;
	border-bottom: 3px solid transparent !important;
	transition: all 0.3s ease !important;
	display: block !important;
}

.single-product .wc-tabs li.active a,
.single-product .wc-tabs li a:hover {
	color: #2d5016 !important;
	border-bottom-color: #2d5016 !important;
}

.single-product .woocommerce-Tabs-panel {
	padding-top: 0 !important;
}

.single-product .woocommerce-Tabs-panel h2 {
	font-size: 1.5rem !important;
	font-weight: 700 !important;
	color: #111827 !important;
	margin-bottom: 1rem !important;
}

.single-product .woocommerce-Tabs-panel p {
	color: #4b5563 !important;
	line-height: 1.75 !important;
	margin-bottom: 1rem !important;
}

.single-product .woocommerce-Tabs-panel table {
	width: 100% !important;
	border-collapse: collapse !important;
	margin-top: 1rem !important;
}

.single-product .woocommerce-Tabs-panel table td {
	padding: 0.75rem !important;
	border-bottom: 1px solid #e5e7eb !important;
}

.single-product .woocommerce-Tabs-panel table td:first-child {
	font-weight: 600 !important;
	color: #111827 !important;
	width: 30% !important;
}
</style>

