<?php
/**
 * The Template for displaying product archives, including the main shop page
 * Modern Shop Page with Filter Sidebar using Tailwind CSS
 *
 * @package Optimally_Organic
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );
?>

<div class="min-h-screen bg-gray-50 py-4 md:py-8">
	<div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
		
		<?php
		/**
		 * Hook: woocommerce_before_main_content.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
		?>

		<!-- Page Header -->
		<header class="woocommerce-products-header mb-6 md:mb-8">
			<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
				<h1 class="woocommerce-products-header__title page-title text-2xl md:text-3xl lg:text-4xl font-bold text-primary mb-3 md:mb-4">
					<?php woocommerce_page_title(); ?>
				</h1>
			<?php endif; ?>

			<?php
			/**
			 * Hook: woocommerce_archive_description.
			 *
			 * @hooked woocommerce_taxonomy_archive_description - 10
			 * @hooked woocommerce_product_archive_description - 10
			 */
			do_action( 'woocommerce_archive_description' );
			?>
		</header>

		<!-- Main Content Grid -->
		<div class="grid grid-cols-1 lg:grid-cols-4 gap-4 md:gap-6 lg:gap-8">
			
			<!-- Filter Sidebar -->
			<aside id="shop-sidebar" class="lg:block hidden lg:col-span-1">
				<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden sticky top-8">
					<div class="p-4 md:p-6 border-b border-gray-200 bg-primary">
						<h2 class="text-lg font-bold text-white">Filters</h2>
					</div>
					
					<div class="p-4 md:p-6 space-y-6">
						<?php
						/**
						 * Hook: woocommerce_sidebar.
						 *
						 * @hooked woocommerce_get_sidebar - 10
						 */
						do_action( 'woocommerce_sidebar' );
						?>
						
						<!-- Price Filter -->
						<?php if ( is_active_sidebar( 'sidebar-shop' ) ) : ?>
							<?php dynamic_sidebar( 'sidebar-shop' ); ?>
						<?php else : ?>
							<div class="mb-6">
								<h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wide mb-4">Price</h3>
								<?php the_widget( 'WC_Widget_Price_Filter' ); ?>
							</div>
						<?php endif; ?>
						
						<!-- Category Filter -->
						<div class="mb-6">
							<h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wide mb-4">Categories</h3>
							<?php
							$categories = get_terms( array(
								'taxonomy'   => 'product_cat',
								'hide_empty' => true,
							) );
							
							if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) :
								?>
								<ul class="space-y-2">
									<?php foreach ( $categories as $category ) : ?>
										<li>
											<a 
												href="<?php echo esc_url( get_term_link( $category ) ); ?>" 
												class="flex items-center justify-between px-3 py-2 text-sm text-gray-700 hover:text-primary hover:bg-gray-50 rounded-lg transition-colors"
											>
												<span><?php echo esc_html( $category->name ); ?></span>
												<span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">
													<?php echo esc_html( $category->count ); ?>
												</span>
											</a>
										</li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</aside>
			
			<!-- Products Grid -->
			<div class="lg:col-span-3">
				
				<?php
				/**
				 * Hook: woocommerce_before_shop_loop.
				 *
				 * @hooked woocommerce_output_all_notices - 10
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
				?>

				<?php
				if ( woocommerce_product_loop() ) {

					woocommerce_product_loop_start();
					?>

					<?php
					if ( wc_get_loop_prop( 'is_shortcode' ) ) {
						$columns = absint( wc_get_loop_prop( 'columns' ) );
						$GLOBALS['woocommerce_loop']['columns'] = $columns;
					}

					while ( have_posts() ) {
						the_post();

						/**
						 * Hook: woocommerce_shop_loop.
						 */
						do_action( 'woocommerce_shop_loop' );

						wc_get_template_part( 'content', 'product' );
					}
					?>

					<?php
					woocommerce_product_loop_end();

					/**
					 * Hook: woocommerce_after_shop_loop.
					 *
					 * @hooked woocommerce_pagination - 10
					 */
					do_action( 'woocommerce_after_shop_loop' );
				} else {
					/**
					 * Hook: woocommerce_no_products_found.
					 *
					 * @hooked wc_no_products_found - 10
					 */
					do_action( 'woocommerce_no_products_found' );
				}
				?>
			</div>
		</div>
	</div>
</div>

<!-- Mobile Filter Toggle Button -->
<div class="lg:hidden fixed bottom-6 right-6 z-50">
	<button id="mobile-filter-toggle" class="bg-primary text-white p-4 rounded-full shadow-xl hover:bg-primary-light transition-all duration-300 transform hover:scale-110">
		<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
		</svg>
	</button>
</div>

<!-- Mobile Filter Overlay -->
<div id="mobile-filter-overlay" class="lg:hidden fixed inset-0 bg-black bg-opacity-50 z-40 hidden transition-opacity duration-300">
	<div class="absolute right-0 top-0 h-full w-4/5 max-w-sm bg-white shadow-2xl overflow-y-auto transform transition-transform duration-300">
		<div class="p-6 border-b border-gray-200 bg-primary flex items-center justify-between sticky top-0 z-10">
			<h2 class="text-lg font-bold text-white">Filters</h2>
			<button id="close-mobile-filter" class="text-white hover:text-gray-200 transition-colors">
				<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
				</svg>
			</button>
		</div>
		<div class="p-6">
			<?php
			do_action( 'woocommerce_sidebar' );
			
			// Price Filter
			if ( is_active_sidebar( 'sidebar-shop' ) ) {
				dynamic_sidebar( 'sidebar-shop' );
			}
			
			// Category Filter
			$categories = get_terms( array(
				'taxonomy'   => 'product_cat',
				'hide_empty' => true,
			) );
			
			if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) :
				?>
				<div class="mb-6">
					<h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wide mb-4">Categories</h3>
					<ul class="space-y-2">
						<?php foreach ( $categories as $category ) : ?>
							<li>
								<a 
									href="<?php echo esc_url( get_term_link( $category ) ); ?>" 
									class="flex items-center justify-between px-3 py-2 text-sm text-gray-700 hover:text-primary hover:bg-gray-50 rounded-lg transition-colors"
								>
									<span><?php echo esc_html( $category->name ); ?></span>
									<span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">
										<?php echo esc_html( $category->count ); ?>
									</span>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
	const filterToggle = document.getElementById('mobile-filter-toggle');
	const filterOverlay = document.getElementById('mobile-filter-overlay');
	const closeFilter = document.getElementById('close-mobile-filter');
	
	if (filterToggle && filterOverlay) {
		filterToggle.addEventListener('click', function() {
			filterOverlay.classList.remove('hidden');
			setTimeout(() => {
				filterOverlay.style.opacity = '1';
			}, 10);
		});
	}
	
	if (closeFilter && filterOverlay) {
		closeFilter.addEventListener('click', function() {
			filterOverlay.style.opacity = '0';
			setTimeout(() => {
				filterOverlay.classList.add('hidden');
			}, 300);
		});
	}
	
	if (filterOverlay) {
		filterOverlay.addEventListener('click', function(e) {
			if (e.target === filterOverlay) {
				filterOverlay.style.opacity = '0';
				setTimeout(() => {
					filterOverlay.classList.add('hidden');
				}, 300);
			}
		});
	}
});
</script>

<style>
/* Hide default WooCommerce shop loop wrapper */
.woocommerce ul.products {
	display: grid !important;
	grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)) !important;
	gap: 1.5rem !important;
	list-style: none !important;
	padding: 0 !important;
	margin: 0 !important;
}

@media (min-width: 640px) {
	.woocommerce ul.products {
		grid-template-columns: repeat(2, 1fr) !important;
	}
}

@media (min-width: 1024px) {
	.woocommerce ul.products {
		grid-template-columns: repeat(3, 1fr) !important;
	}
}

/* Result Count & Ordering */
.woocommerce-result-count {
	margin: 0 !important;
	padding: 1rem !important;
	font-size: 0.875rem !important;
	color: #6b7280 !important;
}

.woocommerce-ordering {
	margin: 0 !important;
	padding: 1rem !important;
}

.woocommerce-ordering select {
	padding: 0.5rem 2rem 0.5rem 1rem !important;
	border: 1px solid #e5e7eb !important;
	border-radius: 0.5rem !important;
	font-size: 0.875rem !important;
	background: white !important;
	color: #374151 !important;
	appearance: none !important;
	background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3E%3Cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3E%3C/svg%3E") !important;
	background-position: right 0.5rem center !important;
	background-repeat: no-repeat !important;
	background-size: 1.5em 1.5em !important;
	padding-right: 2.5rem !important;
}

.woocommerce-ordering select:focus {
	outline: none !important;
	border-color: #2d5016 !important;
	box-shadow: 0 0 0 3px rgba(45, 80, 22, 0.1) !important;
}

/* Breadcrumbs */
.woocommerce-breadcrumb {
	margin-bottom: 1rem !important;
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

/* Pagination */
.woocommerce nav.woocommerce-pagination {
	text-align: center !important;
	margin-top: 2rem !important;
	padding-top: 2rem !important;
	border-top: 1px solid #e5e7eb !important;
}

.woocommerce nav.woocommerce-pagination ul {
	list-style: none !important;
	display: inline-flex !important;
	gap: 0.5rem !important;
	padding: 0 !important;
	margin: 0 !important;
}

.woocommerce nav.woocommerce-pagination ul li {
	margin: 0 !important;
	padding: 0 !important;
}

.woocommerce nav.woocommerce-pagination ul li a,
.woocommerce nav.woocommerce-pagination ul li span {
	display: block !important;
	padding: 0.5rem 1rem !important;
	border: 1px solid #e5e7eb !important;
	border-radius: 0.5rem !important;
	color: #374151 !important;
	text-decoration: none !important;
	transition: all 0.3s ease !important;
}

.woocommerce nav.woocommerce-pagination ul li a:hover {
	background: #2d5016 !important;
	color: white !important;
	border-color: #2d5016 !important;
}

.woocommerce nav.woocommerce-pagination ul li span.current {
	background: #2d5016 !important;
	color: white !important;
	border-color: #2d5016 !important;
}
</style>

<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

get_footer( 'shop' );
