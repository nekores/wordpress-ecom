<?php
/**
 * Template Name: Testimonials Page
 * Modern Testimonials Page Template
 */

get_header();
?>

<?php
$testimonials_title = get_post_meta( get_the_ID(), '_testimonials_title', true ) ?: 'What Our Customers Are Saying';
$testimonials_subtitle = get_post_meta( get_the_ID(), '_testimonials_subtitle', true ) ?: 'Read real testimonials from our satisfied customers who have experienced the benefits of our products.';
$testimonials = optimally_organic_get_testimonials( get_the_ID() );
?>

<main id="main" class="site-main testimonials-page">
	<!-- Hero Section -->
	<section class="testimonials-hero">
		<div class="container">
			<div class="testimonials-hero-content">
				<h1 class="page-title"><?php echo esc_html( $testimonials_title ); ?></h1>
				<?php if ( $testimonials_subtitle ) : ?>
					<p class="page-subtitle"><?php echo esc_html( $testimonials_subtitle ); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<!-- Testimonials Grid Section -->
	<section class="testimonials-grid-section">
		<div class="container">
			<?php if ( ! empty( $testimonials ) ) : ?>
				<div class="testimonials-grid">
					<?php foreach ( $testimonials as $testimonial ) : ?>
						<?php if ( ! empty( $testimonial['content'] ) ) : ?>
							<div class="testimonial-card">
								<div class="testimonial-header">
									<?php if ( $testimonial['image'] ) : ?>
										<div class="testimonial-avatar">
											<img src="<?php echo esc_url( $testimonial['image'] ); ?>" alt="<?php echo esc_attr( $testimonial['name'] ); ?>">
										</div>
									<?php else : ?>
										<div class="testimonial-avatar-placeholder">
											<?php echo esc_html( substr( $testimonial['name'], 0, 1 ) ); ?>
										</div>
									<?php endif; ?>
									<div class="testimonial-info">
										<h3 class="testimonial-name"><?php echo esc_html( $testimonial['name'] ); ?></h3>
										<?php if ( $testimonial['location'] ) : ?>
											<p class="testimonial-location"><?php echo esc_html( $testimonial['location'] ); ?></p>
										<?php endif; ?>
									</div>
								</div>
								<div class="testimonial-rating">
									<?php
									$rating = absint( $testimonial['rating'] );
									for ( $i = 1; $i <= 5; $i++ ) :
										?>
										<span class="star <?php echo $i <= $rating ? 'filled' : ''; ?>">★</span>
									<?php endfor; ?>
								</div>
								<div class="testimonial-content">
									<p><?php echo wpautop( esc_html( $testimonial['content'] ) ); ?></p>
								</div>
								<div class="testimonial-quote">"</div>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
			<?php else : ?>
				<div class="no-testimonials">
					<p>No testimonials yet. Add them through the page editor!</p>
				</div>
			<?php endif; ?>
		</div>
	</section>
</main>

<?php
get_footer();

