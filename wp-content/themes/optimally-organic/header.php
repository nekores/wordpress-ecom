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

<div id="page" class="site">
	<header id="masthead" class="site-header">
		<div class="header-top">
			<div class="container">
				<div class="header-top-left">
					<span>Free Shipping on all USA orders over $100!</span>
				</div>
				<div class="header-top-right">
					<span>Language: English</span>
				</div>
			</div>
		</div>
		
		<div class="header-main">
			<div class="container">
				<div class="site-branding">
					<?php
					if ( has_custom_logo() ) {
						the_custom_logo();
					} else {
						?>
						<h1 class="site-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<?php bloginfo( 'name' ); ?>
							</a>
						</h1>
						<?php
					}
					?>
				</div>

				<nav id="site-navigation" class="main-navigation">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
						'container'      => false,
						'fallback_cb'    => false,
					) );
					?>
				</nav>

				<div class="header-actions">
					<?php if ( class_exists( 'WooCommerce' ) ) : ?>
						<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="cart-icon">
							<span class="cart-icon-text">🛒</span>
							<span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
						</a>
						<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="user-icon">👤</a>
					<?php endif; ?>
					<a href="#" class="search-icon">🔍</a>
				</div>
			</div>
		</div>
	</header>

	<div id="content" class="site-content">

