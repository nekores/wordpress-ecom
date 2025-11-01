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
	<ul class="space-y-1 p-2">
		<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			<?php
			$classes = wc_get_account_menu_item_classes( $endpoint );
			$is_active = strpos( $classes, 'is-active' ) !== false;
			?>
			<li class="<?php echo esc_attr( $classes ); ?>">
				<a 
					href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>" 
					class="flex items-center px-4 py-3 text-sm md:text-base font-medium rounded-lg transition-all duration-200 <?php echo $is_active ? 'bg-primary text-white shadow-md' : 'text-gray-700 hover:bg-gray-100 hover:text-primary'; ?>"
				>
					<?php
					// Add icons for different menu items
					$icons = array(
						'dashboard' => '📊',
						'orders' => '📦',
						'downloads' => '⬇️',
						'edit-address' => '📍',
						'edit-account' => '👤',
						'customer-logout' => '🚪',
					);
					$icon = isset( $icons[ $endpoint ] ) ? $icons[ $endpoint ] : '•';
					?>
					<span class="mr-3 text-lg"><?php echo $icon; ?></span>
					<span><?php echo esc_html( $label ); ?></span>
					<?php if ( $is_active ) : ?>
						<svg class="ml-auto w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
						</svg>
					<?php endif; ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>

