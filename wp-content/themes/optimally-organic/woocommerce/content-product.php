<?php
/**
 * The template for displaying product content within loops
 * Modern Product Card with Tailwind CSS
 *
 * @package Optimally_Organic
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>

<li <?php wc_product_class( 'group', $product ); ?> class="w-full">
	<div class="relative bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden transform hover:-translate-y-2 border border-gray-100 h-full flex flex-col w-full max-w-full">
		<!-- Product Image Container -->
		<div class="relative overflow-hidden bg-gray-100 aspect-square">
			<a href="<?php echo esc_url( $product->get_permalink() ); ?>" class="block relative h-full">
				<?php
				/**
				 * Hook: woocommerce_before_shop_loop_item_title.
				 *
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 * @hooked woocommerce_template_loop_product_thumbnail - 10
				 */
				do_action( 'woocommerce_before_shop_loop_item_title' );
				?>
				
				<!-- Image Overlay on Hover -->
				<div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
			</a>
			
			<!-- Sale Badge -->
			<?php if ( $product->is_on_sale() ) : ?>
				<div class="absolute top-3 left-3 z-10">
					<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold text-white bg-accent-pink shadow-lg animate-pulse-slow">
						<?php echo esc_html__( 'Sale!', 'woocommerce' ); ?>
					</span>
				</div>
			<?php endif; ?>
			
			<!-- Quick View / Add to Cart on Hover -->
			<div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-black/20 backdrop-blur-sm">
				<a 
					href="<?php echo esc_url( $product->get_permalink() ); ?>" 
					class="px-6 py-3 bg-white text-primary font-semibold rounded-full hover:bg-gray-100 transform hover:scale-105 transition-all duration-300 shadow-lg mr-2"
				>
					Quick View
				</a>
			</div>
		</div>

		<!-- Product Info -->
		<div class="p-4 md:p-5 flex-grow flex flex-col">
			<!-- Product Title -->
			<h2 class="woocommerce-loop-product__title text-base md:text-lg font-bold text-gray-900 mb-2 md:mb-3 group-hover:text-primary transition-colors flex-shrink-0">
				<a href="<?php echo esc_url( $product->get_permalink() ); ?>" class="hover:underline block line-clamp-3" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; line-height: 1.5;">
					<?php echo esc_html( $product->get_name() ); ?>
				</a>
			</h2>

			<?php
			/**
			 * Hook: woocommerce_after_shop_loop_item_title.
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );
			?>

			<!-- Product Rating -->
			<?php if ( $product->get_average_rating() ) : ?>
				<div class="flex items-center gap-2 mb-4">
					<div class="flex items-center">
						<?php
						$rating = round( $product->get_average_rating() );
						for ( $i = 1; $i <= 5; $i++ ) :
							?>
							<svg class="w-4 h-4 <?php echo $i <= $rating ? 'text-accent-yellow' : 'text-gray-300'; ?>" fill="currentColor" viewBox="0 0 20 20">
								<path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
							</svg>
						<?php endfor; ?>
					</div>
					<span class="text-sm text-gray-500">(<?php echo esc_html( $product->get_review_count() ); ?>)</span>
				</div>
			<?php endif; ?>

			<!-- Price -->
			<div class="mb-3 md:mb-4 flex items-baseline gap-2">
				<?php
				$price_html = $product->get_price_html();
				if ( $price_html ) {
					// Style the price
					echo '<span class="text-xl md:text-2xl font-bold text-primary">' . wp_kses_post( $price_html ) . '</span>';
				}
				?>
			</div>

			<!-- Add to Cart Button -->
			<div class="mt-auto pt-2 flex-shrink-0">
				<?php
				/**
				 * Hook: woocommerce_after_shop_loop_item.
				 *
				 * @hooked woocommerce_template_loop_add_to_cart - 10
				 */
				do_action( 'woocommerce_after_shop_loop_item' );
				?>
			</div>
		</div>
	</div>
</li>

<style>
/* WooCommerce Product Loop Styles - Override default WooCommerce styles */
.woocommerce ul.products.columns-3,
.woocommerce ul.products.columns-2,
.woocommerce ul.products.columns-4,
.woocommerce ul.products {
	display: grid !important;
	grid-template-columns: repeat(1, 1fr) !important;
	gap: 1rem !important;
	list-style: none !important;
	padding: 0 !important;
	margin: 0 0 2rem 0 !important;
	width: 100% !important;
	clear: both !important;
	float: none !important;
	overflow: visible !important;
}

/* Remove ::before pseudo-element that takes up space */
.woocommerce ul.products::before,
.woocommerce ul.products.columns-3::before,
.woocommerce ul.products.columns-2::before,
.woocommerce ul.products.columns-4::before {
	display: none !important;
	content: none !important;
	width: 0 !important;
	height: 0 !important;
	margin: 0 !important;
	padding: 0 !important;
}

/* Remove ::after pseudo-element as well */
.woocommerce ul.products::after,
.woocommerce ul.products.columns-3::after,
.woocommerce ul.products.columns-2::after,
.woocommerce ul.products.columns-4::after {
	display: none !important;
	content: none !important;
	width: 0 !important;
	height: 0 !important;
	margin: 0 !important;
	padding: 0 !important;
}

.woocommerce ul.products li.product,
.woocommerce ul.products.columns-3 li.product,
.woocommerce ul.products.columns-2 li.product,
.woocommerce ul.products.columns-4 li.product {
	float: none !important;
	clear: none !important;
	width: 100% !important;
	margin: 0 !important;
	position: relative !important;
	padding: 0 !important;
	margin-left: 0 !important;
	margin-right: 0 !important;
	margin-bottom: 0 !important;
}

@media (min-width: 640px) {
	.woocommerce ul.products.columns-3,
	.woocommerce ul.products.columns-2,
	.woocommerce ul.products.columns-4,
	.woocommerce ul.products {
		grid-template-columns: repeat(2, 1fr) !important;
		gap: 1rem !important;
	}
}

@media (min-width: 1024px) {
	.woocommerce ul.products.columns-3,
	.woocommerce ul.products.columns-2,
	.woocommerce ul.products.columns-4,
	.woocommerce ul.products {
		grid-template-columns: repeat(3, 1fr) !important;
		gap: 1.5rem !important;
	}
}

.woocommerce ul.products li.product {
	list-style: none !important;
	margin: 0 !important;
	width: 100% !important;
	max-width: 100% !important;
	min-width: 0 !important;
	float: none !important;
	clear: none !important;
	position: relative !important;
	padding: 0 !important;
}

.woocommerce ul.products li.product > div,
.woocommerce ul.products.columns-3 li.product > div,
.woocommerce ul.products.columns-2 li.product > div,
.woocommerce ul.products.columns-4 li.product > div {
	height: 100% !important;
	display: flex !important;
	flex-direction: column !important;
	width: 100% !important;
	max-width: 100% !important;
	min-width: 0 !important;
}

/* Product Image Styling */
.woocommerce ul.products li.product .attachment-woocommerce_thumbnail,
.woocommerce ul.products li.product img {
	width: 100% !important;
	height: 100% !important;
	object-fit: cover !important;
	transition: transform 0.5s ease !important;
}

.woocommerce ul.products li.product:hover img {
	transform: scale(1.1) !important;
}

/* Sale Flash */
.woocommerce span.onsale {
	display: none !important;
}

/* Price Styling */
.woocommerce ul.products li.product .price {
	color: #2d5016 !important;
	font-weight: 700 !important;
	display: block !important;
	margin-bottom: 1rem !important;
}

.woocommerce ul.products li.product .price del {
	color: #9ca3af !important;
	font-weight: 400 !important;
	font-size: 1rem !important;
	margin-right: 0.5rem !important;
}

.woocommerce ul.products li.product .price ins {
	text-decoration: none !important;
}

/* Add to Cart Button Styling */
.woocommerce ul.products li.product .button,
.woocommerce ul.products li.product .add_to_cart_button,
.woocommerce ul.products li.product a.button,
.woocommerce ul.products li.product button.button {
	width: 100% !important;
	padding: 0.75rem 1rem !important;
	background: linear-gradient(135deg, #E91E63 0%, #C2185B 100%) !important;
	color: white !important;
	border: none !important;
	border-radius: 0.5rem !important;
	font-weight: 600 !important;
	font-size: 0.875rem !important;
	text-align: center !important;
	text-decoration: none !important;
	display: flex !important;
	align-items: center !important;
	justify-content: center !important;
	gap: 0.5rem !important;
	transition: all 0.3s ease !important;
	cursor: pointer !important;
	box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
	white-space: normal !important;
	word-wrap: break-word !important;
	overflow: visible !important;
	text-overflow: clip !important;
	min-height: 44px !important;
	line-height: 1.4 !important;
	flex-shrink: 0 !important;
}

.woocommerce ul.products li.product .button:hover,
.woocommerce ul.products li.product .add_to_cart_button:hover,
.woocommerce ul.products li.product a.button:hover {
	background: linear-gradient(135deg, #C2185B 0%, #A0154A 100%) !important;
	transform: translateY(-2px) !important;
	box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2) !important;
}

/* Remove checkmark icon from button when added */
.woocommerce ul.products li.product .button.added::after {
	display: none !important;
	content: none !important;
}

/* Remove checkmark icon completely */
.woocommerce ul.products li.product .button.added::before,
.woocommerce ul.products li.product .button.added::after {
	display: none !important;
	content: none !important;
}

/* Hide "View cart" link after adding to cart */
.woocommerce ul.products li.product .added_to_cart,
.woocommerce ul.products li.product a.added_to_cart,
.woocommerce ul.products li.product .wc-forward,
.woocommerce ul.products li.product .added_to_cart.wc-forward {
	display: none !important;
	visibility: hidden !important;
	opacity: 0 !important;
	height: 0 !important;
	width: 0 !important;
	padding: 0 !important;
	margin: 0 !important;
	overflow: hidden !important;
	position: absolute !important;
	pointer-events: none !important;
}

/* Product Title */
.woocommerce ul.products li.product .woocommerce-loop-product__title {
	font-size: 0.9375rem !important;
	font-weight: 700 !important;
	color: #111827 !important;
	margin-bottom: 0.75rem !important;
	line-height: 1.5 !important;
	min-height: 4.5rem !important;
	height: auto !important;
	max-height: 4.5rem !important;
	overflow: hidden !important;
	display: block !important;
	width: 100% !important;
	min-width: 0 !important;
}

.woocommerce ul.products li.product .woocommerce-loop-product__title a {
	color: inherit !important;
	text-decoration: none !important;
	transition: color 0.3s ease !important;
	display: -webkit-box !important;
	-webkit-line-clamp: 3 !important;
	-webkit-box-orient: vertical !important;
	overflow: hidden !important;
	text-overflow: ellipsis !important;
	word-wrap: break-word !important;
	overflow-wrap: break-word !important;
	line-height: 1.5 !important;
	width: 100% !important;
	min-width: 0 !important;
}

.woocommerce ul.products li.product:hover .woocommerce-loop-product__title a {
	color: #2d5016 !important;
}

/* Star Rating */
.woocommerce .star-rating {
	color: #FFC107 !important;
	font-size: 1rem !important;
	letter-spacing: 0.25rem !important;
}

/* Line clamp utility */
.line-clamp-2 {
	display: -webkit-box !important;
	-webkit-line-clamp: 2 !important;
	-webkit-box-orient: vertical !important;
	overflow: hidden !important;
}

/* Aspect ratio */
.aspect-square {
	aspect-ratio: 1 / 1 !important;
}
</style>
