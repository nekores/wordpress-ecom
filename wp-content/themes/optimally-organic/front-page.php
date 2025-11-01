<?php
/**
 * The front page template file
 * Modern Homepage with Tailwind CSS
 *
 * @package Optimally_Organic
 */

get_header();
?>

<main id="main" class="site-main overflow-hidden">
	
	<?php if ( optimally_organic_is_section_enabled( 'hero_slider' ) ) : ?>
	<?php
	$homepage_id = get_option( 'page_on_front' );
	$slides = optimally_organic_get_slides( $homepage_id );
	if ( empty( $slides ) ) {
		// Default fallback
		$slides = array(
			array(
				'title' => 'OPTIMALLY ORGANIC',
				'text' => 'Natural products that work!',
				'subtext' => 'Beyond Organic - Wild Grown - Non GMO - RAW - BIOACTIVE',
				'image' => 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=1920&q=80',
				'button_text' => 'Shop Now',
				'button_link' => wc_get_page_permalink( 'shop' ),
			),
		);
	}
	?>
	<!-- Modern Hero Slider -->
	<section class="relative h-screen md:h-[90vh] lg:h-screen overflow-hidden">
		<?php foreach ( $slides as $index => $slide ) : ?>
			<div class="hero-slide absolute inset-0 transition-opacity duration-1000 ease-in-out <?php echo $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0'; ?>" style="background-image: url('<?php echo esc_url( $slide['image'] ); ?>'); background-size: cover; background-position: center;">
				<div class="absolute inset-0 bg-gradient-to-br from-primary/80 via-primary/70 to-primary/60"></div>
				<div class="relative z-10 h-full flex items-center justify-center">
					<div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl text-center text-white">
						<div class="max-w-4xl mx-auto space-y-6 animate-fade-in-up">
							<h1 class="text-4xl md:text-6xl lg:text-7xl font-bold mb-6 tracking-tight drop-shadow-lg animate-fade-in-down">
								<?php echo esc_html( $slide['title'] ); ?>
							</h1>
							<p class="text-xl md:text-2xl lg:text-3xl mb-4 text-yellow-300 font-semibold animate-fade-in-up animation-delay-200">
								<?php echo esc_html( $slide['text'] ); ?>
							</p>
							<p class="text-lg md:text-xl lg:text-2xl mb-8 font-medium animate-fade-in-up animation-delay-400">
								<?php echo esc_html( $slide['subtext'] ); ?>
							</p>
							<?php
							$button_link = $slide['button_link'] ? esc_url( $slide['button_link'] ) : wc_get_page_permalink( 'shop' );
							?>
							<a 
								href="<?php echo $button_link; ?>" 
								class="inline-block px-8 py-4 md:px-10 md:py-5 bg-accent-yellow text-primary font-bold text-lg md:text-xl rounded-full hover:bg-yellow-400 transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl animate-scale-in animation-delay-600"
							>
								<?php echo esc_html( $slide['button_text'] ?: 'Shop Now' ); ?>
							</a>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
		
		<!-- Slider Controls -->
		<?php if ( count( $slides ) > 1 ) : ?>
			<button class="hero-prev absolute left-4 md:left-8 top-1/2 -translate-y-1/2 z-20 bg-white/20 backdrop-blur-sm text-white p-3 md:p-4 rounded-full hover:bg-white/30 transition-all duration-300 text-2xl md:text-4xl shadow-lg">
				‹
			</button>
			<button class="hero-next absolute right-4 md:right-8 top-1/2 -translate-y-1/2 z-20 bg-white/20 backdrop-blur-sm text-white p-3 md:p-4 rounded-full hover:bg-white/30 transition-all duration-300 text-2xl md:text-4xl shadow-lg">
				›
			</button>
			
			<!-- Slider Dots -->
			<div class="absolute bottom-6 md:bottom-8 left-1/2 -translate-x-1/2 z-20 flex gap-3">
				<?php foreach ( $slides as $index => $slide ) : ?>
					<button 
						class="dot w-3 h-3 md:w-4 md:h-4 rounded-full transition-all duration-300 <?php echo $index === 0 ? 'bg-accent-yellow scale-125' : 'bg-white/50 hover:bg-white/80'; ?>" 
						data-slide="<?php echo $index; ?>"
					></button>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</section>
	<?php endif; ?>

	<?php if ( optimally_organic_is_section_enabled( 'fulvic_section' ) ) : ?>
	<?php
	$homepage_id = get_option( 'page_on_front' );
	$fulvic_title = get_post_meta( $homepage_id, '_fulvic_title', true ) ?: 'Fulvic Ionic Minerals™';
	$fulvic_description = get_post_meta( $homepage_id, '_fulvic_description', true ) ?: 'Bio-Available Ancient Plant Based Ionic Fulvic Acid, Humic Acid, Electrolytes, Every Essential Amino Acid, & 77 Trace Minerals in their Ionic (aka nano or angstrom) form.';
	?>
	<!-- Fulvic Section -->
	<section class="py-16 md:py-24 bg-gradient-to-b from-gray-50 to-white scroll-mt-16">
		<div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
			<div class="text-center mb-12 md:mb-16 animate-fade-in-up">
				<h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-primary mb-6"><?php echo esc_html( $fulvic_title ); ?></h2>
				<p class="text-lg md:text-xl text-gray-700 max-w-3xl mx-auto mb-8"><?php echo esc_html( $fulvic_description ); ?></p>
				<a 
					href="<?php echo esc_url( get_term_link( 'fulvic-ionic-minerals', 'product_cat' ) ); ?>" 
					class="inline-block px-8 py-4 bg-primary text-white font-semibold rounded-full hover:bg-primary-light transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl"
				>
					View All Fulvic Ionic Minerals™ Products
				</a>
			</div>
			
			<?php
			$fulvic_query = optimally_organic_get_products_by_category( 'fulvic-ionic-minerals', 3 );
			if ( $fulvic_query->have_posts() ) :
				?>
				<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
					<?php
					$delay = 0;
					while ( $fulvic_query->have_posts() ) :
						$fulvic_query->the_post();
						$delay += 100;
						?>
						<div class="animate-fade-in-up" style="animation-delay: <?php echo $delay; ?>ms;">
							<?php wc_get_template_part( 'content', 'product' ); ?>
						</div>
					<?php
					endwhile;
					wp_reset_postdata();
					?>
				</div>
			<?php endif; ?>
		</div>
	</section>
	<?php endif; ?>

	<?php if ( optimally_organic_is_section_enabled( 'extracts_section' ) ) : ?>
	<?php
	$homepage_id = get_option( 'page_on_front' );
	$extracts_title = get_post_meta( $homepage_id, '_extracts_title', true ) ?: 'Optimally Organic Extracts';
	$extracts_subtitle = get_post_meta( $homepage_id, '_extracts_subtitle', true ) ?: 'Highly Concentrated Herbal Extracts';
	?>
	<!-- Extracts Section -->
	<section class="py-16 md:py-24 bg-white scroll-mt-16">
		<div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
			<div class="text-center mb-12 md:mb-16 animate-fade-in-up">
				<h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-primary mb-6"><?php echo esc_html( $extracts_title ); ?></h2>
				<p class="text-lg md:text-xl text-gray-700 max-w-3xl mx-auto"><?php echo esc_html( $extracts_subtitle ); ?></p>
			</div>
			
			<?php
			$extracts_query = optimally_organic_get_products_by_category( 'optimally-organic-extracts', 9 );
			if ( $extracts_query->have_posts() ) :
				?>
				<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 mb-10">
					<?php
					$delay = 0;
					while ( $extracts_query->have_posts() ) :
						$extracts_query->the_post();
						$delay += 50;
						?>
						<div class="animate-scale-in" style="animation-delay: <?php echo $delay; ?>ms;">
							<?php wc_get_template_part( 'content', 'product' ); ?>
						</div>
					<?php
					endwhile;
					wp_reset_postdata();
					?>
				</div>
				<div class="text-center">
					<a 
						href="<?php echo esc_url( get_term_link( 'optimally-organic-extracts', 'product_cat' ) ); ?>" 
						class="inline-block px-8 py-4 bg-accent-yellow text-primary font-semibold rounded-full hover:bg-yellow-400 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl"
					>
						View All Extracts
					</a>
				</div>
			<?php endif; ?>
		</div>
	</section>
	<?php endif; ?>

	<?php if ( optimally_organic_is_section_enabled( 'benefits_section' ) ) : ?>
	<?php
	$homepage_id = get_option( 'page_on_front' );
	$benefits_title = get_post_meta( $homepage_id, '_benefits_title', true ) ?: 'BENEFITS OF OPTIMALLY ORGANIC';
	?>
	<!-- Benefits Section -->
	<section class="py-16 md:py-24 bg-gradient-to-br from-primary via-primary-light to-accent text-white scroll-mt-16">
		<div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
			<h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-center mb-12 md:mb-16 animate-fade-in-up">
				<?php echo esc_html( $benefits_title ); ?>
			</h2>
			<div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">
				<div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 text-center hover:bg-white/20 transition-all duration-300 transform hover:scale-105 animate-float">
					<div class="w-20 h-20 mx-auto mb-6 bg-white/20 rounded-full flex items-center justify-center text-4xl">
						✓
					</div>
					<h3 class="text-2xl font-bold mb-4">Better Sleep & Relaxation</h3>
					<p class="text-lg opacity-90">Improve your quality of rest with our natural supplements.</p>
				</div>
				<div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 text-center hover:bg-white/20 transition-all duration-300 transform hover:scale-105 animate-float" style="animation-delay: 0.5s;">
					<div class="w-20 h-20 mx-auto mb-6 bg-white/20 rounded-full flex items-center justify-center text-4xl">
						⚡
					</div>
					<h3 class="text-2xl font-bold mb-4">Increased Energy & Focus</h3>
					<p class="text-lg opacity-90">Boost your daily energy levels and mental clarity.</p>
				</div>
				<div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 text-center hover:bg-white/20 transition-all duration-300 transform hover:scale-105 animate-float" style="animation-delay: 1s;">
					<div class="w-20 h-20 mx-auto mb-6 bg-white/20 rounded-full flex items-center justify-center text-4xl">
						🌿
					</div>
					<h3 class="text-2xl font-bold mb-4">Improved Digestion & Immunity</h3>
					<p class="text-lg opacity-90">Support your digestive health and immune system naturally.</p>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php if ( optimally_organic_is_section_enabled( 'probiotics_section' ) ) : ?>
	<?php
	$homepage_id = get_option( 'page_on_front' );
	$probiotics_title = get_post_meta( $homepage_id, '_probiotics_title', true ) ?: '100 Wild Plant Enzymes & Probiotics';
	$probiotics_description = get_post_meta( $homepage_id, '_probiotics_description', true ) ?: 'Vegan Probiotics & Enzymes are the most sought after, and our 5 Year Fermented Bio-Active Powerhouse combines the dynamic probiotics strains of 100 different wild plant species, working synergistically for optimal digestive health & gut flora!';
	?>
	<!-- Probiotics Section -->
	<section class="py-16 md:py-24 bg-gradient-to-b from-white to-gray-50 scroll-mt-16">
		<div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
			<div class="text-center mb-12 md:mb-16 animate-fade-in-up">
				<h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-primary mb-6"><?php echo esc_html( $probiotics_title ); ?></h2>
				<p class="text-lg md:text-xl text-gray-700 max-w-3xl mx-auto mb-8"><?php echo esc_html( $probiotics_description ); ?></p>
				<a 
					href="<?php echo esc_url( get_term_link( 'probiotics-enzymes-vegan', 'product_cat' ) ); ?>" 
					class="inline-block px-8 py-4 bg-primary text-white font-semibold rounded-full hover:bg-primary-light transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl"
				>
					View All Probiotics & Enzymes Products
				</a>
			</div>
			
			<?php
			$probiotics_query = optimally_organic_get_products_by_category( 'probiotics-enzymes-vegan', 2 );
			if ( $probiotics_query->have_posts() ) :
				?>
				<div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
					<?php
					$delay = 0;
					while ( $probiotics_query->have_posts() ) :
						$probiotics_query->the_post();
						$delay += 150;
						?>
						<div class="animate-slide-in-left" style="animation-delay: <?php echo $delay; ?>ms;">
							<?php wc_get_template_part( 'content', 'product' ); ?>
						</div>
					<?php
					endwhile;
					wp_reset_postdata();
					?>
				</div>
			<?php endif; ?>
		</div>
	</section>
	<?php endif; ?>

	<?php if ( optimally_organic_is_section_enabled( 'testimonials_section' ) ) : ?>
	<?php
	$homepage_id = get_option( 'page_on_front' );
	$testimonials_title = get_post_meta( $homepage_id, '_testimonials_title', true ) ?: 'WHAT OUR CUSTOMERS ARE SAYING';
	?>
	<!-- Testimonials Section -->
	<section class="py-16 md:py-24 bg-gray-100 scroll-mt-16">
		<div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
			<h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-center text-primary mb-12 md:mb-16 animate-fade-in-up">
				<?php echo esc_html( $testimonials_title ); ?>
			</h2>
			<div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
				<?php for ( $i = 1; $i <= 3; $i++ ) : ?>
					<div class="bg-white rounded-2xl p-6 md:p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 animate-fade-in-up" style="animation-delay: <?php echo $i * 100; ?>ms;">
						<div class="w-16 h-16 mx-auto mb-6 bg-red-500 rounded-full flex items-center justify-center">
							<svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
								<path d="M6.3 2.841A1.5 1.5 0 004 4.11V11a1 1 0 001.555.832L10 10.202l4.445 1.63A1 1 0 0016 11V4.11a1.5 1.5 0 00-2.3-1.269l-3.7 2.7-3.7-2.7z"/>
							</svg>
						</div>
						<p class="text-gray-700 text-center mb-4">Customer Testimonial <?php echo $i; ?></p>
					</div>
				<?php endfor; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

</main>

<style>
.animation-delay-200 {
	animation-delay: 200ms;
}
.animation-delay-400 {
	animation-delay: 400ms;
}
.animation-delay-600 {
	animation-delay: 600ms;
}

/* Intersection Observer for scroll animations */
.fade-in-on-scroll {
	opacity: 0;
	transform: translateY(30px);
	transition: opacity 0.8s ease-out, transform 0.8s ease-out;
}

.fade-in-on-scroll.visible {
	opacity: 1;
	transform: translateY(0);
}
</style>

<script>
// Hero Slider Functionality
document.addEventListener('DOMContentLoaded', function() {
	const slides = document.querySelectorAll('.hero-slide');
	const dots = document.querySelectorAll('.hero-slider-dots .dot, .dot[data-slide]');
	const prevBtn = document.querySelector('.hero-prev');
	const nextBtn = document.querySelector('.hero-next');
	let currentSlide = 0;
	let slideInterval;

	function showSlide(index) {
		slides.forEach((slide, i) => {
			if (i === index) {
				slide.classList.remove('opacity-0', 'z-0');
				slide.classList.add('opacity-100', 'z-10');
			} else {
				slide.classList.remove('opacity-100', 'z-10');
				slide.classList.add('opacity-0', 'z-0');
			}
		});

		dots.forEach((dot, i) => {
			if (i === index) {
				dot.classList.add('bg-accent-yellow', 'scale-125');
				dot.classList.remove('bg-white/50');
			} else {
				dot.classList.remove('bg-accent-yellow', 'scale-125');
				dot.classList.add('bg-white/50');
			}
		});

		currentSlide = index;
	}

	function nextSlide() {
		const next = (currentSlide + 1) % slides.length;
		showSlide(next);
	}

	function prevSlide() {
		const prev = (currentSlide - 1 + slides.length) % slides.length;
		showSlide(prev);
	}

	function startSlider() {
		slideInterval = setInterval(nextSlide, 5000);
	}

	function stopSlider() {
		clearInterval(slideInterval);
	}

	// Event Listeners
	if (nextBtn) nextBtn.addEventListener('click', () => { stopSlider(); nextSlide(); startSlider(); });
	if (prevBtn) prevBtn.addEventListener('click', () => { stopSlider(); prevSlide(); startSlider(); });

	dots.forEach((dot, index) => {
		dot.addEventListener('click', () => {
			stopSlider();
			showSlide(index);
			startSlider();
		});
	});

	// Auto-start slider
	if (slides.length > 1) {
		startSlider();
	}

	// Pause on hover
	const heroSection = document.querySelector('section.relative.h-screen');
	if (heroSection) {
		heroSection.addEventListener('mouseenter', stopSlider);
		heroSection.addEventListener('mouseleave', startSlider);
	}

	// Scroll animations
	const observerOptions = {
		threshold: 0.1,
		rootMargin: '0px 0px -100px 0px'
	};

	const observer = new IntersectionObserver(function(entries) {
		entries.forEach(entry => {
			if (entry.isIntersecting) {
				entry.target.classList.add('visible');
			}
		});
	}, observerOptions);

	document.querySelectorAll('.animate-fade-in-up, .animate-scale-in, .animate-slide-in-left, .animate-slide-in-right').forEach(el => {
		el.classList.add('fade-in-on-scroll');
		observer.observe(el);
	});
});
</script>

<?php
get_footer();
