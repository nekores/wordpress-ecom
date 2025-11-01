<?php
/**
 * My Account Page Template
 * 
 * Modern WooCommerce My Account Template with Tailwind CSS
 *
 * @package Optimally_Organic
 */

defined( 'ABSPATH' ) || exit;

$current_user = wp_get_current_user();
?>

<div class="min-h-screen bg-gray-50 py-8 md:py-12">
	<div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
		<!-- Header Section -->
		<div class="text-center mb-8 md:mb-12">
			<h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-primary mb-4">
				My Account
			</h1>
			<p class="text-base md:text-lg text-gray-600">
				<?php
				printf(
					esc_html__( 'Hello %1$s (not %1$s? %2$s)', 'woocommerce' ),
					'<strong class="text-primary font-semibold">' . esc_html( $current_user->display_name ) . '</strong>',
					'<a href="' . esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) ) . '" class="text-primary hover:text-primary-light transition-colors underline">' . esc_html__( 'Log out', 'woocommerce' ) . '</a>'
				);
				?>
			</p>
		</div>
		
		<!-- Mobile Menu Toggle Button -->
		<div class="lg:hidden mb-6">
			<button id="mobile-menu-toggle" class="w-full flex items-center justify-between px-4 py-3 bg-white rounded-lg shadow-sm border border-gray-200 hover:bg-gray-50 transition-colors">
				<span class="text-primary font-semibold">Account Menu</span>
				<svg class="w-5 h-5 text-gray-500 transition-transform" id="menu-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
				</svg>
			</button>
		</div>
		
		<!-- Main Content Grid -->
		<div class="grid grid-cols-1 lg:grid-cols-4 gap-6 lg:gap-8">
			<!-- Sidebar Navigation -->
			<aside id="account-sidebar" class="lg:block hidden lg:col-span-1">
				<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden sticky top-8">
					<?php
					/**
					 * My Account navigation.
					 */
					do_action( 'woocommerce_account_navigation' );
					?>
				</div>
			</aside>
			
			<!-- Main Content Area -->
			<div class="lg:col-span-3">
				<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 md:p-8">
					<div class="woocommerce-MyAccount-content">
						<?php
						/**
						 * My Account content.
						 */
						do_action( 'woocommerce_account_content' );
						?>
					</div>
				</div>
				
				<!-- Dashboard Info -->
				<div class="mt-6 bg-white rounded-xl shadow-sm border border-gray-200 p-6 md:p-8 text-center text-sm md:text-base text-gray-600">
					<p>
						<?php echo esc_html__( 'From your account dashboard you can view your', 'woocommerce' ); ?> 
						<a href="<?php echo esc_url( wc_get_endpoint_url( 'orders' ) ); ?>" class="text-primary hover:text-primary-light transition-colors font-medium underline">
							<?php echo esc_html__( 'recent orders', 'woocommerce' ); ?>
						</a>, 
						<?php echo esc_html__( 'manage your', 'woocommerce' ); ?> 
						<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address' ) ); ?>" class="text-primary hover:text-primary-light transition-colors font-medium underline">
							<?php echo esc_html__( 'shipping and billing addresses', 'woocommerce' ); ?>
						</a>, 
						<?php echo esc_html__( 'and', 'woocommerce' ); ?> 
						<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-account' ) ); ?>" class="text-primary hover:text-primary-light transition-colors font-medium underline">
							<?php echo esc_html__( 'edit your password and account details', 'woocommerce' ); ?>
						</a>.
					</p>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
	const mobileToggle = document.getElementById('mobile-menu-toggle');
	const sidebar = document.getElementById('account-sidebar');
	const menuIcon = document.getElementById('menu-icon');
	
	if (mobileToggle && sidebar) {
		mobileToggle.addEventListener('click', function() {
			sidebar.classList.toggle('hidden');
			sidebar.classList.toggle('block');
			menuIcon.classList.toggle('rotate-180');
		});
	}
});
</script>

