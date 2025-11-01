<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site min-h-screen flex flex-col">
	<header id="masthead" class="site-header bg-white shadow-md sticky top-0 z-50">
		<!-- Top Bar -->
		<div class="bg-primary text-white py-2 hidden md:block">
			<div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
				<div class="flex justify-between items-center text-sm">
					<div class="header-top-left">
						<span class="font-medium">Free Shipping on all USA orders over $100!</span>
					</div>
					<div class="header-top-right">
						<span>Language: English</span>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Main Header -->
		<div class="header-main bg-white">
			<div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
				<div class="flex items-center justify-between py-4 md:py-6">
					<!-- Logo/Branding -->
					<div class="site-branding flex-shrink-0">
						<?php
						if ( has_custom_logo() ) {
							the_custom_logo();
						} else {
							?>
							<h1 class="site-title text-2xl md:text-3xl font-bold">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="text-primary hover:text-primary-light transition-colors">
									<?php bloginfo( 'name' ); ?>
								</a>
							</h1>
							<?php
							$description = get_bloginfo( 'description', 'display' );
							if ( $description || is_customize_preview() ) :
								?>
								<p class="site-description text-sm text-gray-600"><?php echo $description; ?></p>
							<?php endif; ?>
							<?php
						}
						?>
					</div>

					<!-- Desktop Navigation -->
					<nav id="site-navigation" class="main-navigation hidden lg:flex flex-1 justify-center items-center gap-6 xl:gap-8">
						<?php
						wp_nav_menu( array(
							'theme_location' => 'primary',
							'menu_id'        => 'primary-menu',
							'container'      => false,
							'fallback_cb'    => false,
							'menu_class'     => 'flex items-center gap-6 xl:gap-8 list-none m-0 p-0',
							'link_before'    => '<span class="text-gray-700 hover:text-primary transition-colors font-medium text-base">',
							'link_after'     => '</span>',
						) );
						
						// Fallback menu if no menu is set
						if ( ! has_nav_menu( 'primary' ) ) {
							?>
							<ul class="flex items-center gap-6 xl:gap-8 list-none m-0 p-0">
								<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-gray-700 hover:text-primary transition-colors font-medium text-base">Home</a></li>
								<li><a href="<?php echo esc_url( get_term_link( 'fulvic-acid-benefits' ) ); ?>" class="text-gray-700 hover:text-primary transition-colors font-medium text-base">Fulvic Acid Benefits</a></li>
								<li><a href="<?php echo esc_url( home_url( '/testimonials' ) ); ?>" class="text-gray-700 hover:text-primary transition-colors font-medium text-base">Testimonials</a></li>
								<li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="text-gray-700 hover:text-primary transition-colors font-medium text-base">Contact</a></li>
								<li><a href="<?php echo esc_url( home_url( '/about' ) ); ?>" class="text-gray-700 hover:text-primary transition-colors font-medium text-base">About</a></li>
								<?php if ( class_exists( 'WooCommerce' ) ) : ?>
									<li><a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="text-gray-700 hover:text-primary transition-colors font-medium text-base">My Account</a></li>
									<li><a href="<?php echo esc_url( wc_get_page_permalink( 'checkout' ) ); ?>" class="text-gray-700 hover:text-primary transition-colors font-medium text-base">Checkout</a></li>
									<li><a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="text-gray-700 hover:text-primary transition-colors font-medium text-base">Cart</a></li>
									<li><a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="text-gray-700 hover:text-primary transition-colors font-medium text-base">Shop</a></li>
								<?php endif; ?>
							</ul>
							<?php
						}
						?>
					</nav>

					<!-- Header Actions (Cart, User, Search) -->
					<div class="header-actions flex items-center gap-4 md:gap-6">
						<?php if ( class_exists( 'WooCommerce' ) ) : ?>
							<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="cart-icon relative flex items-center text-gray-700 hover:text-primary transition-colors">
								<svg class="w-6 h-6 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
								</svg>
								<?php $cart_count = WC()->cart->get_cart_contents_count(); ?>
								<?php if ( $cart_count > 0 ) : ?>
									<span class="cart-count absolute -top-2 -right-2 bg-accent-pink text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center"><?php echo $cart_count; ?></span>
								<?php endif; ?>
							</a>
							<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="user-icon hidden sm:block text-gray-700 hover:text-primary transition-colors">
								<svg class="w-6 h-6 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
								</svg>
							</a>
							<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="shop-link hidden sm:block text-gray-700 hover:text-primary transition-colors font-medium">Shop</a>
						<?php endif; ?>
						<a href="#" class="search-icon text-gray-700 hover:text-primary transition-colors">
							<svg class="w-6 h-6 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
							</svg>
						</a>
						
						<!-- Mobile Menu Toggle -->
						<button id="mobile-menu-toggle" class="lg:hidden text-gray-700 hover:text-primary transition-colors" aria-label="Toggle menu">
							<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
							</svg>
						</button>
					</div>
				</div>
			</div>
			
			<!-- Mobile Navigation -->
			<div id="mobile-menu" class="lg:hidden hidden border-t border-gray-200 bg-white">
				<div class="container mx-auto px-4 sm:px-6 py-4">
					<nav class="mobile-navigation">
						<?php
						wp_nav_menu( array(
							'theme_location' => 'primary',
							'menu_id'        => 'mobile-menu-items',
							'container'      => false,
							'fallback_cb'    => false,
							'menu_class'     => 'flex flex-col gap-4 list-none m-0 p-0',
							'link_before'    => '<span class="text-gray-700 hover:text-primary transition-colors font-medium text-base block py-2">',
							'link_after'     => '</span>',
						) );
						
						// Fallback menu if no menu is set
						if ( ! has_nav_menu( 'primary' ) ) {
							?>
							<ul class="flex flex-col gap-4 list-none m-0 p-0">
								<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-gray-700 hover:text-primary transition-colors font-medium text-base block py-2">Home</a></li>
								<li><a href="<?php echo esc_url( get_term_link( 'fulvic-acid-benefits' ) ); ?>" class="text-gray-700 hover:text-primary transition-colors font-medium text-base block py-2">Fulvic Acid Benefits</a></li>
								<li><a href="<?php echo esc_url( home_url( '/testimonials' ) ); ?>" class="text-gray-700 hover:text-primary transition-colors font-medium text-base block py-2">Testimonials</a></li>
								<li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="text-gray-700 hover:text-primary transition-colors font-medium text-base block py-2">Contact</a></li>
								<li><a href="<?php echo esc_url( home_url( '/about' ) ); ?>" class="text-gray-700 hover:text-primary transition-colors font-medium text-base block py-2">About</a></li>
								<?php if ( class_exists( 'WooCommerce' ) ) : ?>
									<li><a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="text-gray-700 hover:text-primary transition-colors font-medium text-base block py-2">My Account</a></li>
									<li><a href="<?php echo esc_url( wc_get_page_permalink( 'checkout' ) ); ?>" class="text-gray-700 hover:text-primary transition-colors font-medium text-base block py-2">Checkout</a></li>
									<li><a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="text-gray-700 hover:text-primary transition-colors font-medium text-base block py-2">Cart</a></li>
									<li><a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="text-gray-700 hover:text-primary transition-colors font-medium text-base block py-2">Shop</a></li>
								<?php endif; ?>
							</ul>
							<?php
						}
						?>
					</nav>
				</div>
			</div>
		</div>
	</header>

	<div id="content" class="site-content flex-grow">

<script>
document.addEventListener('DOMContentLoaded', function() {
	const mobileToggle = document.getElementById('mobile-menu-toggle');
	const mobileMenu = document.getElementById('mobile-menu');
	
	if (mobileToggle && mobileMenu) {
		mobileToggle.addEventListener('click', function() {
			mobileMenu.classList.toggle('hidden');
		});
	}
});
</script>
