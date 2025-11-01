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

<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-6 md:py-12">
	<div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
		<!-- Header Section with User Info -->
		<div class="mb-8 md:mb-12">
			<div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 mb-6">
				<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
					<div>
						<h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-primary mb-2">
							My Account
						</h1>
						<div class="flex items-center gap-3">
							<div class="w-12 h-12 md:w-14 md:h-14 rounded-full bg-primary flex items-center justify-center text-white font-bold text-lg md:text-xl">
								<?php echo strtoupper( substr( $current_user->display_name, 0, 1 ) ); ?>
							</div>
							<div>
								<p class="text-base md:text-lg font-semibold text-gray-900">
									<?php echo esc_html( $current_user->display_name ); ?>
								</p>
								<p class="text-sm text-gray-500">
									<?php echo esc_html( $current_user->user_email ); ?>
								</p>
							</div>
						</div>
					</div>
					<a 
						href="<?php echo esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) ); ?>" 
						class="inline-flex items-center gap-2 px-4 py-2 md:px-6 md:py-3 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600 transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-105"
					>
						<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
						</svg>
						<span>Log out</span>
					</a>
				</div>
			</div>
		</div>
		
		<!-- Mobile Menu Toggle Button -->
		<div class="lg:hidden mb-6">
			<button 
				id="mobile-menu-toggle" 
				class="w-full flex items-center justify-between px-4 py-4 bg-white rounded-xl shadow-md border border-gray-200 hover:bg-gray-50 transition-all duration-300 transform hover:scale-[1.02]"
			>
				<span class="text-primary font-bold text-lg">Account Menu</span>
				<svg 
					class="w-6 h-6 text-gray-500 transition-transform duration-300" 
					id="menu-icon" 
					fill="none" 
					stroke="currentColor" 
					viewBox="0 0 24 24"
				>
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
				</svg>
			</button>
		</div>
		
		<!-- Main Content Grid -->
		<div class="grid grid-cols-1 lg:grid-cols-4 gap-6 lg:gap-8">
			<!-- Sidebar Navigation -->
			<aside id="account-sidebar" class="lg:block hidden lg:col-span-1">
				<div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden sticky top-8">
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
				<div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
					<div class="p-6 md:p-8 lg:p-10">
						<div class="woocommerce-MyAccount-content">
							<?php
							/**
							 * My Account content.
							 */
							do_action( 'woocommerce_account_content' );
							?>
						</div>
					</div>
				</div>
				
				<!-- Dashboard Info Cards (only show on dashboard endpoint) -->
				<?php 
				// Check if we're on the dashboard (no endpoint active)
				$is_dashboard = is_account_page() && ! is_wc_endpoint_url();
				?>
				<?php if ( $is_dashboard ) : ?>
				<div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">
					<a 
						href="<?php echo esc_url( wc_get_endpoint_url( 'orders' ) ); ?>" 
						class="group bg-white rounded-xl shadow-md border border-gray-200 p-6 hover:shadow-xl hover:border-primary transition-all duration-300 transform hover:-translate-y-1"
					>
						<div class="flex items-center gap-4">
							<div class="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center text-primary group-hover:bg-primary transition-colors">
								<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
								</svg>
							</div>
							<div class="flex-1">
								<h3 class="font-bold text-gray-900 mb-1 group-hover:text-primary transition-colors">Orders</h3>
								<p class="text-sm text-gray-600">View recent orders</p>
							</div>
						</div>
					</a>
					
					<a 
						href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address' ) ); ?>" 
						class="group bg-white rounded-xl shadow-md border border-gray-200 p-6 hover:shadow-xl hover:border-primary transition-all duration-300 transform hover:-translate-y-1"
					>
						<div class="flex items-center gap-4">
							<div class="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center text-primary group-hover:bg-primary transition-colors">
								<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
								</svg>
							</div>
							<div class="flex-1">
								<h3 class="font-bold text-gray-900 mb-1 group-hover:text-primary transition-colors">Addresses</h3>
								<p class="text-sm text-gray-600">Manage addresses</p>
							</div>
						</div>
					</a>
					
					<a 
						href="<?php echo esc_url( wc_get_endpoint_url( 'edit-account' ) ); ?>" 
						class="group bg-white rounded-xl shadow-md border border-gray-200 p-6 hover:shadow-xl hover:border-primary transition-all duration-300 transform hover:-translate-y-1"
					>
						<div class="flex items-center gap-4">
							<div class="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center text-primary group-hover:bg-primary transition-colors">
								<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
								</svg>
							</div>
							<div class="flex-1">
								<h3 class="font-bold text-gray-900 mb-1 group-hover:text-primary transition-colors">Account</h3>
								<p class="text-sm text-gray-600">Edit account details</p>
							</div>
						</div>
					</a>
				</div>
				<?php endif; ?>
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

<style>
/* My Account Page Custom Styles */
.woocommerce-MyAccount-content {
	min-height: 400px;
}

/* Forms */
.woocommerce-MyAccount-content form {
	margin-top: 1.5rem;
}

.woocommerce-MyAccount-content .woocommerce-InputWrapper input[type="text"],
.woocommerce-MyAccount-content .woocommerce-InputWrapper input[type="email"],
.woocommerce-MyAccount-content .woocommerce-InputWrapper input[type="password"],
.woocommerce-MyAccount-content .woocommerce-InputWrapper input[type="tel"],
.woocommerce-MyAccount-content .woocommerce-InputWrapper select,
.woocommerce-MyAccount-content .woocommerce-InputWrapper textarea {
	width: 100% !important;
	padding: 0.75rem 1rem !important;
	border: 2px solid #e5e7eb !important;
	border-radius: 0.5rem !important;
	font-size: 1rem !important;
	transition: border-color 0.3s ease !important;
	background: white !important;
}

.woocommerce-MyAccount-content .woocommerce-InputWrapper input:focus,
.woocommerce-MyAccount-content .woocommerce-InputWrapper select:focus,
.woocommerce-MyAccount-content .woocommerce-InputWrapper textarea:focus {
	outline: none !important;
	border-color: #2d5016 !important;
	box-shadow: 0 0 0 3px rgba(45, 80, 22, 0.1) !important;
}

.woocommerce-MyAccount-content button[type="submit"],
.woocommerce-MyAccount-content .button {
	padding: 0.75rem 2rem !important;
	background: linear-gradient(135deg, #2d5016 0%, #4a7c2a 100%) !important;
	color: white !important;
	border: none !important;
	border-radius: 0.5rem !important;
	font-weight: 600 !important;
	font-size: 1rem !important;
	cursor: pointer !important;
	transition: all 0.3s ease !important;
	box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
}

.woocommerce-MyAccount-content button[type="submit"]:hover,
.woocommerce-MyAccount-content .button:hover {
	background: linear-gradient(135deg, #4a7c2a 0%, #6b9e3f 100%) !important;
	transform: translateY(-2px) !important;
	box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2) !important;
}

/* Orders Table */
.woocommerce-MyAccount-content table.woocommerce-orders-table {
	width: 100% !important;
	border-collapse: collapse !important;
	margin-top: 1.5rem !important;
}

.woocommerce-MyAccount-content table.woocommerce-orders-table th,
.woocommerce-MyAccount-content table.woocommerce-orders-table td {
	padding: 1rem !important;
	text-align: left !important;
	border-bottom: 1px solid #e5e7eb !important;
}

.woocommerce-MyAccount-content table.woocommerce-orders-table th {
	background: #f9fafb !important;
	font-weight: 600 !important;
	color: #111827 !important;
}

.woocommerce-MyAccount-content table.woocommerce-orders-table td {
	color: #4b5563 !important;
}

.woocommerce-MyAccount-content table.woocommerce-orders-table tr:hover {
	background: #f9fafb !important;
}

/* Responsive table */
@media (max-width: 768px) {
	.woocommerce-MyAccount-content table.woocommerce-orders-table {
		display: block !important;
		overflow-x: auto !important;
		-webkit-overflow-scrolling: touch !important;
	}
	
	.woocommerce-MyAccount-content table.woocommerce-orders-table th,
	.woocommerce-MyAccount-content table.woocommerce-orders-table td {
		min-width: 120px !important;
	}
}
</style>
