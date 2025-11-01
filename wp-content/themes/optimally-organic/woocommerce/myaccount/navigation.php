<?php
/**
 * My Account Navigation
 *
 * Modern WooCommerce My Account Navigation Template with Tailwind CSS
 *
 * @package Optimally_Organic
 */

defined( 'ABSPATH' ) || exit;
?>

<nav class="woocommerce-MyAccount-navigation">
	<ul class="space-y-2 p-4 md:p-6">
		<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			<?php
			$classes = wc_get_account_menu_item_classes( $endpoint );
			$is_active = strpos( $classes, 'is-active' ) !== false;
			?>
			<li class="<?php echo esc_attr( $classes ); ?>">
				<a 
					href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>" 
					class="flex items-center gap-4 px-4 py-3 md:py-4 text-sm md:text-base font-semibold rounded-xl transition-all duration-300 group <?php echo $is_active ? 'bg-primary text-white shadow-lg scale-[1.02]' : 'text-gray-700 hover:bg-gray-50 hover:text-primary hover:shadow-md'; ?>"
				>
					<?php
					// SVG Icons for different menu items
					$icons = array(
						'dashboard' => '<svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>',
						'orders' => '<svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>',
						'downloads' => '<svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>',
						'edit-address' => '<svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>',
						'edit-account' => '<svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>',
						'customer-logout' => '<svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>',
					);
					$icon = isset( $icons[ $endpoint ] ) ? $icons[ $endpoint ] : '<svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>';
					?>
					<span class="flex-shrink-0"><?php echo $icon; ?></span>
					<span class="flex-1"><?php echo esc_html( $label ); ?></span>
					<?php if ( $is_active ) : ?>
						<svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
						</svg>
					<?php else : ?>
						<svg class="w-5 h-5 flex-shrink-0 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
						</svg>
					<?php endif; ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>

<style>
/* Navigation Custom Styles */
.woocommerce-MyAccount-navigation ul {
	list-style: none !important;
	margin: 0 !important;
	padding: 0 !important;
}

.woocommerce-MyAccount-navigation li {
	margin: 0 !important;
	padding: 0 !important;
}

.woocommerce-MyAccount-navigation a {
	text-decoration: none !important;
	display: flex !important;
	align-items: center !important;
}

.woocommerce-MyAccount-navigation a:hover {
	text-decoration: none !important;
}
</style>
