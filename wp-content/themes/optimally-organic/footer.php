	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="container">
			<div class="footer-content">
				<div class="footer-section">
					<h3>Shop</h3>
					<?php
					wp_nav_menu( array(
						'theme_location' => 'footer',
						'menu_class'     => 'footer-menu',
						'container'      => false,
						'fallback_cb'    => false,
					) );
					?>
				</div>

				<div class="footer-section">
					<h3>Info</h3>
					<ul>
						<li><a href="<?php echo esc_url( home_url( '/fulvic-acid-benefits' ) ); ?>">Fulvic Acid Benefits</a></li>
						<li><a href="<?php echo esc_url( home_url( '/total-wellness-protocol' ) ); ?>">The Total Wellness Protocol</a></li>
					</ul>
				</div>

				<div class="footer-section">
					<h3>Company</h3>
					<ul>
						<li><a href="<?php echo esc_url( home_url( '/about' ) ); ?>">About</a></li>
						<li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Contact</a></li>
						<li><a href="<?php echo esc_url( home_url( '/testimonials' ) ); ?>">Testimonials</a></li>
					</ul>
				</div>

				<div class="footer-section">
					<h3>Newsletter</h3>
					<p>Subscribe to get special offers, free giveaways, and once-in-a-lifetime deals.</p>
					<form class="newsletter-form">
						<input type="email" placeholder="Enter your email" required>
						<button type="submit" class="btn-primary">Join now</button>
					</form>
				</div>
			</div>

			<div class="footer-bottom">
				<p>&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.</p>
				<p>The products and statements made about specific products on this web site have not been evaluated by the United States Food and Drug Administration (FDA) and are not intended to diagnose, treat, cure or prevent disease.</p>
			</div>
		</div>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

