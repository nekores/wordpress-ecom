<?php
/**
 * Template Name: About Page
 * Modern About Page Template
 */

get_header();
?>

<?php
$about_title = get_post_meta( get_the_ID(), '_about_title', true ) ?: 'About Optimally Organic';
$about_subtitle = get_post_meta( get_the_ID(), '_about_subtitle', true ) ?: '';
$about_content = get_post_meta( get_the_ID(), '_about_content', true ) ?: '';
$about_mission = get_post_meta( get_the_ID(), '_about_mission', true ) ?: '';
$about_vision = get_post_meta( get_the_ID(), '_about_vision', true ) ?: '';
$about_values = get_post_meta( get_the_ID(), '_about_values', true ) ?: '';
$about_image = get_post_meta( get_the_ID(), '_about_featured_image', true ) ?: '';
?>

<main id="main" class="site-main about-page">
	<!-- Luxury Hero Section -->
	<section class="about-hero-luxury">
		<div class="about-hero-overlay"></div>
		<div class="about-hero-pattern"></div>
		<div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
			<div class="about-hero-content">
				<div class="about-hero-text">
					<div class="luxury-accent-line"></div>
					<h1 class="page-title luxury-title"><?php echo esc_html( $about_title ); ?></h1>
					<?php if ( $about_subtitle ) : ?>
						<p class="page-subtitle luxury-subtitle"><?php echo esc_html( $about_subtitle ); ?></p>
					<?php endif; ?>
					<div class="luxury-accent-line"></div>
				</div>
				<?php if ( $about_image ) : ?>
					<div class="about-hero-image luxury-image">
						<div class="luxury-image-frame">
							<img src="<?php echo esc_url( $about_image ); ?>" alt="<?php echo esc_attr( $about_title ); ?>">
							<div class="luxury-image-overlay"></div>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<div class="luxury-divider">
			<svg viewBox="0 0 1200 120" preserveAspectRatio="none">
				<path d="M0,0 L1200,0 L1200,120 Q600,60 0,120 Z" fill="currentColor"></path>
			</svg>
		</div>
	</section>

	<!-- Main Content Section -->
	<section class="about-content-section-luxury">
		<div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
			<div class="luxury-content-wrapper">
				<div class="luxury-content-left">
					<div class="luxury-ornament">❊</div>
				</div>
				<div class="luxury-content-center">
					<?php if ( $about_content ) : ?>
						<div class="about-main-content luxury-text">
							<?php echo wpautop( esc_html( $about_content ) ); ?>
						</div>
					<?php endif; ?>
					
					<?php if ( have_posts() ) : ?>
						<div class="about-wp-content luxury-text">
							<?php
							while ( have_posts() ) :
								the_post();
								if ( get_the_content() ) {
									the_content();
								}
							endwhile;
							?>
						</div>
					<?php endif; ?>
				</div>
				<div class="luxury-content-right">
					<div class="luxury-ornament">❊</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Mission, Vision, Values Section -->
	<?php if ( $about_mission || $about_vision || $about_values ) : ?>
	<section class="about-mvv-section-luxury">
		<div class="luxury-divider-top">
			<svg viewBox="0 0 1200 120" preserveAspectRatio="none">
				<path d="M0,120 L1200,120 L1200,0 Q600,60 0,0 Z" fill="currentColor"></path>
			</svg>
		</div>
		<div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
			<div class="mvv-grid-luxury">
				<?php if ( $about_mission ) : ?>
					<div class="mvv-card-luxury mission-card">
						<div class="luxury-card-header">
							<div class="luxury-icon-wrapper">
								<svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
									<circle cx="30" cy="30" r="28" stroke="#d4af37" stroke-width="2" fill="none"/>
									<path d="M30 10 L30 30 L40 35" stroke="#d4af37" stroke-width="3" stroke-linecap="round"/>
								</svg>
							</div>
							<div class="luxury-ornament-small">✦</div>
						</div>
						<h2 class="luxury-card-title">Our Mission</h2>
						<div class="luxury-divider-small"></div>
						<div class="luxury-card-content">
							<?php echo wpautop( esc_html( $about_mission ) ); ?>
						</div>
					</div>
				<?php endif; ?>
				
				<?php if ( $about_vision ) : ?>
					<div class="mvv-card-luxury vision-card">
						<div class="luxury-card-header">
							<div class="luxury-icon-wrapper">
								<svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
									<circle cx="30" cy="30" r="25" stroke="#d4af37" stroke-width="2" fill="none"/>
									<circle cx="30" cy="30" r="10" fill="#d4af37"/>
								</svg>
							</div>
							<div class="luxury-ornament-small">✦</div>
						</div>
						<h2 class="luxury-card-title">Our Vision</h2>
						<div class="luxury-divider-small"></div>
						<div class="luxury-card-content">
							<?php echo wpautop( esc_html( $about_vision ) ); ?>
						</div>
					</div>
				<?php endif; ?>
				
				<?php if ( $about_values ) : ?>
					<div class="mvv-card-luxury values-card">
						<div class="luxury-card-header">
							<div class="luxury-icon-wrapper">
								<svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M30 5 L35 20 L50 22 L38 32 L40 47 L30 40 L20 47 L22 32 L10 22 L25 20 Z" stroke="#d4af37" stroke-width="2" fill="none"/>
									<circle cx="30" cy="30" r="3" fill="#d4af37"/>
								</svg>
							</div>
							<div class="luxury-ornament-small">✦</div>
						</div>
						<h2 class="luxury-card-title">Our Values</h2>
						<div class="luxury-divider-small"></div>
						<div class="luxury-card-content">
							<?php echo wpautop( esc_html( $about_values ) ); ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>
</main>

<?php
get_footer();

