<?php
/**
 * Admin Meta Boxes for About, Testimonials, and My Account pages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add Meta Boxes for About Page
 */
function optimally_organic_add_about_meta_box() {
	global $post;
	if ( ! $post ) {
		return;
	}
	
	// Show on all pages, but can be filtered by template
	add_meta_box(
		'about_page_content',
		'About Page Content',
		'optimally_organic_about_meta_box_callback',
		'page',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'optimally_organic_add_about_meta_box' );

/**
 * About Page Meta Box Callback
 */
function optimally_organic_about_meta_box_callback( $post ) {
	wp_nonce_field( 'optimally_organic_save_about_page', 'about_page_nonce' );
	
	$about_title = get_post_meta( $post->ID, '_about_title', true ) ?: 'About Optimally Organic';
	$about_subtitle = get_post_meta( $post->ID, '_about_subtitle', true ) ?: '';
	$about_content = get_post_meta( $post->ID, '_about_content', true ) ?: 'Welcome to Optimally Organic, your trusted source for natural, organic, and bio-active health products. We specialize in premium quality supplements, extracts, and superfoods that are beyond organic, wild-grown, non-GMO, raw, and bioactive.';
	$about_mission = get_post_meta( $post->ID, '_about_mission', true ) ?: 'Our mission is to provide you with the highest quality natural products that support your wellness journey.';
	$about_vision = get_post_meta( $post->ID, '_about_vision', true ) ?: '';
	$about_values = get_post_meta( $post->ID, '_about_values', true ) ?: '';
	$about_image = get_post_meta( $post->ID, '_about_featured_image', true ) ?: '';
	
	?>
	<style>
		.page-content-wrapper { padding: 20px; }
		.form-section { margin-bottom: 25px; padding: 15px; background: #f9f9f9; border: 1px solid #ddd; border-radius: 4px; }
		.form-section h3 { margin-top: 0; color: #23282d; border-bottom: 2px solid #0073aa; padding-bottom: 10px; }
		.form-field { margin-bottom: 15px; }
		.form-field label { display: block; font-weight: 600; margin-bottom: 5px; color: #23282d; }
		.form-field input[type="text"], .form-field input[type="url"], .form-field textarea { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px; }
		.form-field textarea { height: 100px; resize: vertical; }
		.form-field textarea.large { height: 200px; }
	</style>
	
	<div class="page-content-wrapper">
		<div class="form-section">
			<h3>📝 Main Content</h3>
			<div class="form-field">
				<label>Page Title:</label>
				<input type="text" name="about_title" value="<?php echo esc_attr( $about_title ); ?>" placeholder="About Optimally Organic">
			</div>
			<div class="form-field">
				<label>Subtitle:</label>
				<input type="text" name="about_subtitle" value="<?php echo esc_attr( $about_subtitle ); ?>" placeholder="Your subtitle here">
			</div>
			<div class="form-field">
				<label>Main Content:</label>
				<textarea name="about_content" class="large"><?php echo esc_textarea( $about_content ); ?></textarea>
			</div>
		</div>
		
		<div class="form-section">
			<h3>🎯 Mission & Vision</h3>
			<div class="form-field">
				<label>Our Mission:</label>
				<textarea name="about_mission"><?php echo esc_textarea( $about_mission ); ?></textarea>
			</div>
			<div class="form-field">
				<label>Our Vision:</label>
				<textarea name="about_vision"><?php echo esc_textarea( $about_vision ); ?></textarea>
			</div>
			<div class="form-field">
				<label>Our Values:</label>
				<textarea name="about_values" class="large"><?php echo esc_textarea( $about_values ); ?></textarea>
			</div>
		</div>
		
		<div class="form-section">
			<h3>🖼️ Featured Image</h3>
			<div class="form-field">
				<label>Featured Image URL:</label>
				<input type="url" name="about_featured_image" value="<?php echo esc_url( $about_image ); ?>" placeholder="https://example.com/image.jpg">
				<p class="description">Enter URL for featured image or use WordPress featured image option</p>
			</div>
		</div>
	</div>
	<?php
}

/**
 * Save About Page Meta Box
 */
function optimally_organic_save_about_page( $post_id ) {
	if ( ! isset( $_POST['about_page_nonce'] ) || ! wp_verify_nonce( $_POST['about_page_nonce'], 'optimally_organic_save_about_page' ) ) {
		return;
	}
	
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	
	if ( ! current_user_can( 'edit_page', $post_id ) ) {
		return;
	}
	
	$fields = array( 'about_title', 'about_subtitle', 'about_content', 'about_mission', 'about_vision', 'about_values', 'about_featured_image' );
	
	foreach ( $fields as $field ) {
		if ( isset( $_POST[ $field ] ) ) {
			if ( $field === 'about_featured_image' ) {
				update_post_meta( $post_id, '_' . $field, esc_url_raw( $_POST[ $field ] ) );
			} else {
				update_post_meta( $post_id, '_' . $field, sanitize_textarea_field( $_POST[ $field ] ) );
			}
		}
	}
}
add_action( 'save_post', 'optimally_organic_save_about_page' );

/**
 * Add Meta Boxes for Testimonials Page
 */
function optimally_organic_add_testimonials_meta_box() {
	global $post;
	if ( ! $post ) {
		return;
	}
	
	// Show on all pages
	add_meta_box(
		'testimonials_page_content',
		'Testimonials Page Content',
		'optimally_organic_testimonials_meta_box_callback',
		'page',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'optimally_organic_add_testimonials_meta_box' );

/**
 * Get saved testimonials (will be defined in functions.php)
 */

/**
 * Testimonials Page Meta Box Callback
 */
function optimally_organic_testimonials_meta_box_callback( $post ) {
	wp_nonce_field( 'optimally_organic_save_testimonials_page', 'testimonials_page_nonce' );
	
	$testimonials_title = get_post_meta( $post->ID, '_testimonials_title', true ) ?: 'What Our Customers Are Saying';
	$testimonials_subtitle = get_post_meta( $post->ID, '_testimonials_subtitle', true ) ?: 'Read real testimonials from our satisfied customers who have experienced the benefits of our products.';
	
	$testimonials = optimally_organic_get_testimonials( $post->ID );
	if ( empty( $testimonials ) ) {
		$testimonials = array(
			array(
				'name' => '',
				'location' => '',
				'content' => '',
				'rating' => '5',
				'image' => '',
			),
		);
	}
	
	?>
	<style>
		.testimonials-wrapper { padding: 20px; }
		.testimonial-item { background: #fff; border: 1px solid #ccc; padding: 15px; margin-bottom: 15px; border-radius: 4px; }
		.testimonial-item h4 { margin-top: 0; color: #0073aa; }
		.btn-remove-testimonial { background: #dc3232; color: #fff; border: none; padding: 8px 15px; cursor: pointer; border-radius: 3px; float: right; }
		.btn-remove-testimonial:hover { background: #a00; }
		.btn-add-testimonial { background: #0073aa; color: #fff; border: none; padding: 10px 20px; cursor: pointer; border-radius: 3px; font-weight: 600; margin-top: 15px; }
		.btn-add-testimonial:hover { background: #005177; }
	</style>
	
	<div class="testimonials-wrapper">
		<div class="form-section">
			<h3>📝 Page Content</h3>
			<div class="form-field">
				<label>Page Title:</label>
				<input type="text" name="testimonials_title" value="<?php echo esc_attr( $testimonials_title ); ?>" placeholder="What Our Customers Are Saying">
			</div>
			<div class="form-field">
				<label>Subtitle:</label>
				<textarea name="testimonials_subtitle"><?php echo esc_textarea( $testimonials_subtitle ); ?></textarea>
			</div>
		</div>
		
		<div class="form-section">
			<h3>💬 Customer Testimonials</h3>
			<div id="testimonials-list">
				<?php foreach ( $testimonials as $index => $testimonial ) : ?>
					<div class="testimonial-item" data-testimonial-index="<?php echo $index; ?>">
						<h4>Testimonial <?php echo $index + 1; ?> <button type="button" class="btn-remove-testimonial">Remove</button></h4>
						<div class="form-field">
							<label>Customer Name:</label>
							<input type="text" name="testimonials[<?php echo $index; ?>][name]" value="<?php echo esc_attr( $testimonial['name'] ); ?>" placeholder="John Doe">
						</div>
						<div class="form-field">
							<label>Location:</label>
							<input type="text" name="testimonials[<?php echo $index; ?>][location]" value="<?php echo esc_attr( $testimonial['location'] ); ?>" placeholder="New York, USA">
						</div>
						<div class="form-field">
							<label>Testimonial Content:</label>
							<textarea name="testimonials[<?php echo $index; ?>][content]" class="large"><?php echo esc_textarea( $testimonial['content'] ); ?></textarea>
						</div>
						<div class="form-field">
							<label>Rating (1-5 stars):</label>
							<select name="testimonials[<?php echo $index; ?>][rating]">
								<?php for ( $i = 1; $i <= 5; $i++ ) : ?>
									<option value="<?php echo $i; ?>" <?php selected( $testimonial['rating'], $i ); ?>><?php echo $i; ?> Star<?php echo $i > 1 ? 's' : ''; ?></option>
								<?php endfor; ?>
							</select>
						</div>
						<div class="form-field">
							<label>Customer Image URL (optional):</label>
							<input type="url" name="testimonials[<?php echo $index; ?>][image]" value="<?php echo esc_url( $testimonial['image'] ); ?>" placeholder="https://example.com/image.jpg">
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<button type="button" class="btn-add-testimonial" id="add-testimonial-btn">+ Add New Testimonial</button>
		</div>
	</div>
	
	<script>
	jQuery(document).ready(function($) {
		var testimonialIndex = <?php echo count( $testimonials ); ?>;
		
		$('#add-testimonial-btn').on('click', function() {
			var html = `
				<div class="testimonial-item" data-testimonial-index="${testimonialIndex}">
					<h4>Testimonial ${testimonialIndex + 1} <button type="button" class="btn-remove-testimonial">Remove</button></h4>
					<div class="form-field">
						<label>Customer Name:</label>
						<input type="text" name="testimonials[${testimonialIndex}][name]" value="" placeholder="John Doe">
					</div>
					<div class="form-field">
						<label>Location:</label>
						<input type="text" name="testimonials[${testimonialIndex}][location]" value="" placeholder="New York, USA">
					</div>
					<div class="form-field">
						<label>Testimonial Content:</label>
						<textarea name="testimonials[${testimonialIndex}][content]" class="large" placeholder="Enter testimonial text here..."></textarea>
					</div>
					<div class="form-field">
						<label>Rating (1-5 stars):</label>
						<select name="testimonials[${testimonialIndex}][rating]">
							<option value="5" selected>5 Stars</option>
							<option value="4">4 Stars</option>
							<option value="3">3 Stars</option>
							<option value="2">2 Stars</option>
							<option value="1">1 Star</option>
						</select>
					</div>
					<div class="form-field">
						<label>Customer Image URL (optional):</label>
						<input type="url" name="testimonials[${testimonialIndex}][image]" value="" placeholder="https://example.com/image.jpg">
					</div>
				</div>
			`;
			$('#testimonials-list').append(html);
			testimonialIndex++;
		});
		
		$(document).on('click', '.btn-remove-testimonial', function() {
			if ($('.testimonial-item').length > 1) {
				$(this).closest('.testimonial-item').remove();
				updateTestimonialNumbers();
			} else {
				alert('You must have at least one testimonial!');
			}
		});
		
		function updateTestimonialNumbers() {
			$('.testimonial-item').each(function(index) {
				$(this).find('h4').html(`Testimonial ${index + 1} <button type="button" class="btn-remove-testimonial">Remove</button>`);
			});
		}
	});
	</script>
	<?php
}

/**
 * Save Testimonials Page Meta Box
 */
function optimally_organic_save_testimonials_page( $post_id ) {
	if ( ! isset( $_POST['testimonials_page_nonce'] ) || ! wp_verify_nonce( $_POST['testimonials_page_nonce'], 'optimally_organic_save_testimonials_page' ) ) {
		return;
	}
	
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	
	if ( ! current_user_can( 'edit_page', $post_id ) ) {
		return;
	}
	
	if ( isset( $_POST['testimonials_title'] ) ) {
		update_post_meta( $post_id, '_testimonials_title', sanitize_text_field( $_POST['testimonials_title'] ) );
	}
	
	if ( isset( $_POST['testimonials_subtitle'] ) ) {
		update_post_meta( $post_id, '_testimonials_subtitle', sanitize_textarea_field( $_POST['testimonials_subtitle'] ) );
	}
	
	if ( isset( $_POST['testimonials'] ) && is_array( $_POST['testimonials'] ) ) {
		$testimonials = array();
		foreach ( $_POST['testimonials'] as $testimonial ) {
			$testimonials[] = array(
				'name' => sanitize_text_field( $testimonial['name'] ),
				'location' => sanitize_text_field( $testimonial['location'] ),
				'content' => sanitize_textarea_field( $testimonial['content'] ),
				'rating' => absint( $testimonial['rating'] ),
				'image' => esc_url_raw( $testimonial['image'] ),
			);
		}
		update_post_meta( $post_id, '_testimonials_list', $testimonials );
	}
}
add_action( 'save_post', 'optimally_organic_save_testimonials_page' );

