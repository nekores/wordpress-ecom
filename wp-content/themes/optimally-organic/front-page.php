<?php
/**
 * The front page template file
 *
 * @package Optimally_Organic
 */

get_header();
?>

<main id="main" class="site-main">
	
	<!-- Hero Section Slider -->
	<section class="hero-slider">
		<div class="hero-slide active" style="background-image: url('https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=1920&q=80');">
			<div class="hero-slide-overlay"></div>
			<div class="container">
				<div class="hero-content">
					<h1>OPTIMALLY ORGANIC</h1>
					<p>Natural products that work!</p>
					<p><strong>Beyond Organic - Wild Grown - Non GMO - RAW - BIOACTIVE</strong></p>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="btn-primary btn-yellow">Shop Now</a>
				</div>
			</div>
		</div>
		<div class="hero-slide" style="background-image: url('https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=1920&q=80');">
			<div class="hero-slide-overlay"></div>
			<div class="container">
				<div class="hero-content">
					<h1>PREMIUM ORGANIC PRODUCTS</h1>
					<p>Support your wellness journey!</p>
					<p><strong>5 Year Fermented Bio-Active Powerhouse</strong></p>
					<a href="<?php echo esc_url( get_term_link( 'probiotics-enzymes-vegan', 'product_cat' ) ); ?>" class="btn-primary btn-yellow">Explore Products</a>
				</div>
			</div>
		</div>
		<div class="hero-slide" style="background-image: url('https://images.unsplash.com/photo-1530836369250-ef72a3f5cda8?w=1920&q=80');">
			<div class="hero-slide-overlay"></div>
			<div class="container">
				<div class="hero-content">
					<h1>FULVIC IONIC MINERALS™</h1>
					<p>The Secret to Optimal Health & Longevity!</p>
					<p><strong>Bio-Available Ancient Plant Based Minerals</strong></p>
					<a href="<?php echo esc_url( get_term_link( 'fulvic-ionic-minerals', 'product_cat' ) ); ?>" class="btn-primary btn-yellow">View Products</a>
				</div>
			</div>
		</div>
		<div class="hero-slider-controls">
			<button class="hero-prev">‹</button>
			<button class="hero-next">›</button>
		</div>
		<div class="hero-slider-dots">
			<span class="dot active" data-slide="0"></span>
			<span class="dot" data-slide="1"></span>
			<span class="dot" data-slide="2"></span>
		</div>
	</section>

	<!-- Fulvic Ionic Minerals Section -->
	<section class="product-section fulvic-section">
		<div class="container">
			<div class="section-header">
				<h2 class="section-title">Fulvic Ionic Minerals™</h2>
				<p class="section-subtitle">Bio-Available Ancient Plant Based Ionic Fulvic Acid, Humic Acid, Electrolytes, Every Essential Amino Acid, & 77 Trace Minerals in their Ionic (aka nano or angstrom) form.</p>
				<p>Cleanse the body of <strong>Radiation, Heavy Metals</strong> (including Lead, Aluminum & Mercury), <strong>Petrochemicals, Graphene Oxide, Glyphosate (Weedkiller)</strong>, and other unwanted toxins. <strong>Boost Energy Levels</strong> and <strong>Curb Food Cravings</strong>. <strong>The Secret to Optimal Health, a Healthy Weight & Longevity!</strong></p>
				<a href="<?php echo esc_url( get_term_link( 'fulvic-ionic-minerals', 'product_cat' ) ); ?>" class="btn-primary btn-yellow">View All Fulvic Ionic Minerals™ Products</a>
			</div>
			
			<?php
			$fulvic_query = optimally_organic_get_products_by_category( 'fulvic-ionic-minerals', 3 );
			if ( $fulvic_query->have_posts() ) :
				?>
				<div class="products-grid">
					<?php
					while ( $fulvic_query->have_posts() ) :
						$fulvic_query->the_post();
						wc_get_template_part( 'content', 'product' );
					endwhile;
					wp_reset_postdata();
					?>
				</div>
				<?php
			endif;
			?>
		</div>
	</section>

	<!-- BioActive Concentrated Herbal Extracts -->
	<section class="product-section extracts-section">
		<div class="container">
			<h2 class="section-title">Optimally Organic Extracts</h2>
			<p class="section-subtitle">Highly Concentrated Herbal Extracts</p>
			<?php
			$extracts_query = optimally_organic_get_products_by_category( 'optimally-organic-extracts', 9 );
			if ( $extracts_query->have_posts() ) :
				?>
				<div class="products-grid">
					<?php
					while ( $extracts_query->have_posts() ) :
						$extracts_query->the_post();
						wc_get_template_part( 'content', 'product' );
					endwhile;
					wp_reset_postdata();
					?>
				</div>
				<?php
			endif;
			?>
			<div class="text-center">
				<a href="<?php echo esc_url( get_term_link( 'optimally-organic-extracts', 'product_cat' ) ); ?>" class="btn-primary btn-yellow">View all Extracts</a>
			</div>
		</div>
	</section>

	<!-- Red Pine Needle Oil Section -->
	<section class="product-section pine-oil-section">
		<div class="container">
			<div class="section-header">
				<h2 class="section-title">Red Pine Needle Oil Products</h2>
				<p class="section-subtitle"><strong>The Ultimate Plant Based Extract for Immune Defense & Anti-Aging!</strong> Cleanse the body of Viruses, Bacteria, Parasites, Candida, and Plastic Toxins. Cleanse the Arteries of Plaque buildup. Supports Mental Clarity, Energy Levels, Digestion, Peacefulness, Cellular Regeneration & Anti Aging. Contains the C10 Molecule that passes the Blood/Brain barrier.</p>
				<a href="<?php echo esc_url( get_term_link( 'red-pine-needle-oil', 'product_cat' ) ); ?>" class="btn-primary btn-yellow">View All Red Pine Needle Oil Products</a>
			</div>
			
			<?php
			$pine_oil_query = optimally_organic_get_products_by_category( 'red-pine-needle-oil', 3 );
			if ( $pine_oil_query->have_posts() ) :
				?>
				<div class="products-grid">
					<?php
					while ( $pine_oil_query->have_posts() ) :
						$pine_oil_query->the_post();
						wc_get_template_part( 'content', 'product' );
					endwhile;
					wp_reset_postdata();
					?>
				</div>
				<?php
			endif;
			?>
		</div>
	</section>

	<!-- Benefits/Features Section -->
	<section class="benefits-section">
		<div class="container">
			<h2 class="section-title">BENEFITS OF OPTIMALLY ORGANIC</h2>
			<div class="benefits-grid">
				<div class="benefit-card">
					<div class="benefit-icon">
						<svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M30 10C20 10 12 18 12 28C12 38 20 46 30 46C40 46 48 38 48 28C48 18 40 10 30 10Z" fill="#4a7c2a"/>
							<path d="M25 25L28 28L35 21" stroke="white" stroke-width="2" stroke-linecap="round"/>
						</svg>
					</div>
					<h3>Better Sleep & Relaxation</h3>
					<p>Improve your quality of rest with our natural supplements.</p>
				</div>
				<div class="benefit-card">
					<div class="benefit-icon">
						<svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
							<circle cx="30" cy="30" r="20" fill="#4a7c2a"/>
							<path d="M30 15V30L40 35" stroke="white" stroke-width="2" stroke-linecap="round"/>
						</svg>
					</div>
					<h3>Increased Energy & Focus</h3>
					<p>Boost your daily energy levels and mental clarity.</p>
				</div>
				<div class="benefit-card">
					<div class="benefit-icon">
						<svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M30 10L40 25H20L30 10Z" fill="#4a7c2a"/>
							<path d="M20 25V45H40V25" fill="#4a7c2a"/>
						</svg>
					</div>
					<h3>Improved Digestion & Immunity</h3>
					<p>Support your digestive health and immune system naturally.</p>
				</div>
			</div>
			<div class="benefits-dots">
				<span class="dot active"></span>
				<span class="dot"></span>
				<span class="dot"></span>
			</div>
		</div>
	</section>

	<!-- Probiotics & Enzymes Section -->
	<section class="product-section probiotics-section">
		<div class="container">
			<div class="section-header">
				<h2 class="section-title">100 Wild Plant Enzymes & Probiotics</h2>
				<p class="section-subtitle">Vegan Probiotics & Enzymes are the most sought after, and our <strong>5 Year Fermented</strong> Bio-Active Powerhouse combines the <strong>dynamic probiotics strains of 100 different wild plant species</strong>, working synergistically for optimal digestive health & gut flora!</p>
				<a href="<?php echo esc_url( get_term_link( 'probiotics-enzymes-vegan', 'product_cat' ) ); ?>" class="btn-primary btn-yellow">View All Probiotics & Enzymes Products</a>
			</div>
			
			<?php
			$probiotics_query = optimally_organic_get_products_by_category( 'probiotics-enzymes-vegan', 2 );
			if ( $probiotics_query->have_posts() ) :
				?>
				<div class="products-grid">
					<?php
					while ( $probiotics_query->have_posts() ) :
						$probiotics_query->the_post();
						wc_get_template_part( 'content', 'product' );
					endwhile;
					wp_reset_postdata();
					?>
				</div>
				<?php
			endif;
			?>
		</div>
	</section>

	<!-- Supergreens Section -->
	<section class="product-section supergreens-section">
		<div class="container">
			<div class="section-header">
				<h2 class="section-title">Organic USA Grown Supergreens & PhotoBioReactor Grown Marine Phytoplankton</h2>
				<p class="section-subtitle">Raw, Organic & Bio-Active. Never Heated & Free of Chemicals, Carriers & Preservatives. <strong>Juiced for optimal nutrient impact, then freeze dried to retain living enzymes.</strong> Packed with high levels of BioAvailable & BioActive Phytonutrients including Antioxidants and Chlorophyll. The cleanest, most concentrated & impactful supergreens juice powders you will ever encounter!</p>
				<a href="<?php echo esc_url( get_term_link( 'organic-supergreen-powders', 'product_cat' ) ); ?>" class="btn-primary btn-yellow">View All Supergreens Powders</a>
			</div>
			
			<?php
			$supergreens_query = optimally_organic_get_products_by_category( 'organic-supergreen-powders', 4 );
			if ( $supergreens_query->have_posts() ) :
				?>
				<div class="products-grid">
					<?php
					while ( $supergreens_query->have_posts() ) :
						$supergreens_query->the_post();
						wc_get_template_part( 'content', 'product' );
					endwhile;
					wp_reset_postdata();
					?>
				</div>
				<?php
			endif;
			?>
		</div>
	</section>

	<!-- Full Spectrum Daily Section -->
	<section class="product-section full-spectrum-section">
		<div class="container">
			<div class="section-header">
				<h2 class="section-title">Full Spectrum Daily Superfruit & Hempseed powder</h2>
				<p class="section-subtitle"><strong>The Ultimate Raw, Organic, Whole Food Vegan Multi-Vitamin & Protein Powder!</strong></p>
				<p>Raw, Organic, Never Heated, & Free of Chemicals, Carriers and Preservatives. An equal blend of Organic Freeze Dried Acai Berry Powder, Organic Freeze Dried Acerola Cherry Powder, Organic Freeze Dried Maqui Berry Powder, Organic Freeze Dried Camu Camu Powder, Organic Sun Dried Noni Fruit Powder and Organic Shelled Hemp Seeds. Delicious & Nutrient Dense. Kids LOVE it!</p>
			</div>
			
			<?php
			$full_spectrum_query = optimally_organic_get_products_by_category( 'super-fruit-powders', 3 );
			if ( $full_spectrum_query->have_posts() ) :
				?>
				<div class="products-grid">
					<?php
					while ( $full_spectrum_query->have_posts() ) :
						$full_spectrum_query->the_post();
						wc_get_template_part( 'content', 'product' );
					endwhile;
					wp_reset_postdata();
					?>
				</div>
				<?php
			endif;
			?>
		</div>
	</section>

	<!-- Essiac Tea Section -->
	<section class="product-section essiac-section">
		<div class="container">
			<div class="section-header">
				<h2 class="section-title">ESSIAC Tea</h2>
				<p class="section-subtitle"><strong>The Most Impactful Herbal Tea Blend EVER Created!</strong> We offer the <strong>Tried and True 8 Herb Formula</strong>, proven to safely address the most serious health issues. The original 4 Herbs used by Ojibway Indians for hundreds of years developed into <strong>8 Herbs by Nurse Caisse & Dr Charles Brusch</strong> in the treatment of cancer patients. Supports <strong>Lymphatic Drainage</strong>, Optimal <strong>Digestion</strong>, and <strong>Full Body Cleansing</strong>. Adaptogenic Herbs offer <strong>Stress Support</strong>. Available in three Bio-Active forms: <strong>Finely Ground Powder, Loose Tea Cut</strong>, and <strong>Raw Earth Concentrated Live Extract</strong>.</p>
			</div>
			
			<?php
			$essiac_query = optimally_organic_get_products_by_category( 'essiac-tea', 3 );
			if ( $essiac_query->have_posts() ) :
				?>
				<div class="products-grid">
					<?php
					while ( $essiac_query->have_posts() ) :
						$essiac_query->the_post();
						wc_get_template_part( 'content', 'product' );
					endwhile;
					wp_reset_postdata();
					?>
				</div>
				<?php
			endif;
			?>
		</div>
	</section>

	<!-- Extracts Description -->
	<section class="extracts-description-section">
		<div class="container">
			<h2 class="section-title">Delicious & Nutritious alcohol free extracts</h2>
			<p><strong>ALCOHOL FREE - CHEMICAL FREE - NEVER HEATED - FULVIC ACID TRANSPORT</strong></p>
			<p><strong>The Most Bio-Active, Pure and Raw Extracts on Earth!</strong> Our <strong>Patented Cold Water Extraction</strong> process brings our Superfood, Medicinal Herb and Mushroom extracts to <strong>an entirely new performance level</strong>. It ensures finished products that retain their "Beneficial Bio-Markers". This is because they are never heated or boiled, are not chemically extracted, and are not alcohol extracted like our competitors. <strong>This has never been done before</strong>, and our process is patented! <strong>Our Fulvic Acid transport system</strong> ensures maximum absorption potential.</p>
		</div>
	</section>

	<!-- Testimonials Section -->
	<section class="testimonials-section">
		<div class="container">
			<h2 class="section-title">WHAT OUR CUSTOMERS ARE SAYING</h2>
			<div class="testimonials-video-grid">
				<div class="testimonial-video-card">
					<div class="video-thumbnail">
						<div class="video-placeholder">
							<svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
								<circle cx="50" cy="50" r="50" fill="#E53E3E"/>
								<path d="M38 32L38 68L68 50L38 32Z" fill="white"/>
							</svg>
						</div>
					</div>
					<p>Customer Testimonial 1</p>
				</div>
				<div class="testimonial-video-card">
					<div class="video-thumbnail">
						<div class="video-placeholder">
							<svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
								<circle cx="50" cy="50" r="50" fill="#E53E3E"/>
								<path d="M38 32L38 68L68 50L38 32Z" fill="white"/>
							</svg>
						</div>
					</div>
					<p>Customer Testimonial 2</p>
				</div>
				<div class="testimonial-video-card">
					<div class="video-thumbnail">
						<div class="video-placeholder">
							<svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
								<circle cx="50" cy="50" r="50" fill="#E53E3E"/>
								<path d="M38 32L38 68L68 50L38 32Z" fill="white"/>
							</svg>
						</div>
					</div>
					<p>Customer Testimonial 3</p>
				</div>
			</div>
			<div class="testimonials-dots">
				<span class="dot active"></span>
				<span class="dot"></span>
				<span class="dot"></span>
			</div>
		</div>
	</section>

</main>

<?php
get_footer();

