	</div><!-- #content -->

	<footer id="colophon" class="site-footer bg-primary text-white mt-auto">
		<div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl py-12 md:py-16">
			<!-- Footer Content Grid -->
			<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 md:gap-12 mb-8 md:mb-12">
				<!-- Shop Section -->
				<div class="footer-section">
					<h3 class="text-xl font-bold mb-4 md:mb-6">Shop</h3>
					<?php
					wp_nav_menu( array(
						'theme_location' => 'footer',
						'menu_class'     => 'footer-menu space-y-2 list-none m-0 p-0',
						'container'      => false,
						'fallback_cb'    => false,
						'link_before'    => '<span class="text-white/80 hover:text-white transition-colors">',
						'link_after'     => '</span>',
					) );
					
					if ( ! has_nav_menu( 'footer' ) && class_exists( 'WooCommerce' ) ) {
						?>
						<ul class="space-y-2 list-none m-0 p-0">
							<li><a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="text-white/80 hover:text-white transition-colors">All Products</a></li>
							<li><a href="<?php echo esc_url( get_term_link( 'fulvic-ionic-minerals', 'product_cat' ) ); ?>" class="text-white/80 hover:text-white transition-colors">Fulvic Minerals</a></li>
							<li><a href="<?php echo esc_url( get_term_link( 'optimally-organic-extracts', 'product_cat' ) ); ?>" class="text-white/80 hover:text-white transition-colors">Extracts</a></li>
						</ul>
						<?php
					}
					?>
				</div>

				<!-- Info Section -->
				<div class="footer-section">
					<h3 class="text-xl font-bold mb-4 md:mb-6">Info</h3>
					<ul class="space-y-2 list-none m-0 p-0">
						<li><a href="<?php echo esc_url( home_url( '/fulvic-acid-benefits' ) ); ?>" class="text-white/80 hover:text-white transition-colors">Fulvic Acid Benefits</a></li>
						<li><a href="<?php echo esc_url( home_url( '/total-wellness-protocol' ) ); ?>" class="text-white/80 hover:text-white transition-colors">The Total Wellness Protocol</a></li>
					</ul>
				</div>

				<!-- Company Section -->
				<div class="footer-section">
					<h3 class="text-xl font-bold mb-4 md:mb-6">Company</h3>
					<ul class="space-y-2 list-none m-0 p-0">
						<li><a href="<?php echo esc_url( home_url( '/about' ) ); ?>" class="text-white/80 hover:text-white transition-colors">About</a></li>
						<li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="text-white/80 hover:text-white transition-colors">Contact</a></li>
						<li><a href="<?php echo esc_url( home_url( '/testimonials' ) ); ?>" class="text-white/80 hover:text-white transition-colors">Testimonials</a></li>
					</ul>
				</div>

				<!-- Newsletter Section -->
				<div class="footer-section">
					<h3 class="text-xl font-bold mb-4 md:mb-6">Newsletter</h3>
					<p class="text-white/80 mb-4 text-sm md:text-base">Subscribe to get special offers, free giveaways, and once-in-a-lifetime deals.</p>
					<form class="newsletter-form flex flex-col sm:flex-row gap-2">
						<input 
							type="email" 
							placeholder="Enter your email" 
							required
							class="flex-1 px-4 py-3 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-accent-yellow"
						>
						<button 
							type="submit" 
							class="px-6 py-3 bg-accent-yellow text-primary font-semibold rounded-lg hover:bg-yellow-400 transform hover:scale-105 transition-all duration-300 shadow-lg whitespace-nowrap"
						>
							Join now
						</button>
					</form>
				</div>
			</div>

			<!-- Footer Bottom -->
			<div class="footer-bottom border-t border-white/20 pt-8 mt-8">
				<div class="text-center space-y-4">
					<p class="text-white/80 text-sm md:text-base">
						&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.
					</p>
					<p class="text-white/60 text-xs md:text-sm max-w-4xl mx-auto">
						The products and statements made about specific products on this web site have not been evaluated by the United States Food and Drug Administration (FDA) and are not intended to diagnose, treat, cure or prevent disease.
					</p>
				</div>
			</div>
		</div>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
