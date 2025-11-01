<?php
/**
 * Admin Meta Boxes for Homepage Sections
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Homepage Sections Meta Box Callback
 */
function optimally_organic_homepage_sections_callback( $post ) {
	wp_nonce_field( 'optimally_organic_save_homepage_sections', 'homepage_sections_nonce' );
	
	// Get saved values
	$hero_slider_enabled = get_post_meta( $post->ID, '_hero_slider_enabled', true ) !== '0';
	$fulvic_section_enabled = get_post_meta( $post->ID, '_fulvic_section_enabled', true ) !== '0';
	$extracts_section_enabled = get_post_meta( $post->ID, '_extracts_section_enabled', true ) !== '0';
	$pine_oil_section_enabled = get_post_meta( $post->ID, '_pine_oil_section_enabled', true ) !== '0';
	$probiotics_section_enabled = get_post_meta( $post->ID, '_probiotics_section_enabled', true ) !== '0';
	$supergreens_section_enabled = get_post_meta( $post->ID, '_supergreens_section_enabled', true ) !== '0';
	$full_spectrum_section_enabled = get_post_meta( $post->ID, '_full_spectrum_section_enabled', true ) !== '0';
	$essiac_section_enabled = get_post_meta( $post->ID, '_essiac_section_enabled', true ) !== '0';
	$testimonials_section_enabled = get_post_meta( $post->ID, '_testimonials_section_enabled', true ) !== '0';
	$benefits_section_enabled = get_post_meta( $post->ID, '_benefits_section_enabled', true ) !== '0';
	
	// Get section content
	$fulvic_title = get_post_meta( $post->ID, '_fulvic_title', true ) ?: 'Fulvic Ionic Minerals™';
	$fulvic_description = get_post_meta( $post->ID, '_fulvic_description', true ) ?: 'Bio-Available Ancient Plant Based Ionic Fulvic Acid, Humic Acid, Electrolytes, Every Essential Amino Acid, & 77 Trace Minerals in their Ionic (aka nano or angstrom) form.';
	
	$extracts_title = get_post_meta( $post->ID, '_extracts_title', true ) ?: 'Optimally Organic Extracts';
	$extracts_subtitle = get_post_meta( $post->ID, '_extracts_subtitle', true ) ?: 'Highly Concentrated Herbal Extracts';
	
	$pine_oil_title = get_post_meta( $post->ID, '_pine_oil_title', true ) ?: 'Red Pine Needle Oil Products';
	$pine_oil_description = get_post_meta( $post->ID, '_pine_oil_description', true ) ?: 'The Ultimate Plant Based Extract for Immune Defense & Anti-Aging!';
	
	$benefits_title = get_post_meta( $post->ID, '_benefits_title', true ) ?: 'BENEFITS OF OPTIMALLY ORGANIC';
	
	$probiotics_title = get_post_meta( $post->ID, '_probiotics_title', true ) ?: '100 Wild Plant Enzymes & Probiotics';
	$probiotics_description = get_post_meta( $post->ID, '_probiotics_description', true ) ?: 'Vegan Probiotics & Enzymes are the most sought after, and our 5 Year Fermented Bio-Active Powerhouse combines the dynamic probiotics strains of 100 different wild plant species, working synergistically for optimal digestive health & gut flora!';
	
	$supergreens_title = get_post_meta( $post->ID, '_supergreens_title', true ) ?: 'Organic USA Grown Supergreens & PhotoBioReactor Grown Marine Phytoplankton';
	$supergreens_description = get_post_meta( $post->ID, '_supergreens_description', true ) ?: 'Raw, Organic & Bio-Active. Never Heated & Free of Chemicals, Carriers & Preservatives.';
	
	$full_spectrum_title = get_post_meta( $post->ID, '_full_spectrum_title', true ) ?: 'Full Spectrum Daily Superfruit & Hempseed powder';
	$full_spectrum_description = get_post_meta( $post->ID, '_full_spectrum_description', true ) ?: 'The Ultimate Raw, Organic, Whole Food Vegan Multi-Vitamin & Protein Powder!';
	
	$essiac_title = get_post_meta( $post->ID, '_essiac_title', true ) ?: 'ESSIAC Tea';
	$essiac_description = get_post_meta( $post->ID, '_essiac_description', true ) ?: 'The Most Impactful Herbal Tea Blend EVER Created!';
	
	$testimonials_title = get_post_meta( $post->ID, '_testimonials_title', true ) ?: 'WHAT OUR CUSTOMERS ARE SAYING';
	
	// Get slides
	$slides = optimally_organic_get_slides( $post->ID );
	
	// Enqueue scripts for slider management
	wp_enqueue_script( 'jquery' );
	?>
	<style>
		.homepage-sections-wrapper { padding: 20px; }
		.section-control { margin-bottom: 30px; padding: 15px; background: #f9f9f9; border: 1px solid #ddd; border-radius: 4px; }
		.section-control h3 { margin-top: 0; color: #23282d; border-bottom: 2px solid #0073aa; padding-bottom: 10px; }
		.slides-container { margin-top: 15px; }
		.slide-item { background: #fff; border: 1px solid #ccc; padding: 15px; margin-bottom: 15px; border-radius: 4px; }
		.slide-item h4 { margin-top: 0; color: #0073aa; }
		.slide-item .form-field { margin-bottom: 15px; }
		.slide-item .form-field label { display: block; font-weight: 600; margin-bottom: 5px; }
		.slide-item .form-field input[type="text"], .slide-item .form-field textarea { width: 100%; padding: 8px; }
		.slide-item .form-field textarea { height: 60px; }
		.btn-remove-slide { background: #dc3232; color: #fff; border: none; padding: 8px 15px; cursor: pointer; border-radius: 3px; }
		.btn-remove-slide:hover { background: #a00; }
		.btn-add-slide { background: #0073aa; color: #fff; border: none; padding: 10px 20px; cursor: pointer; border-radius: 3px; font-weight: 600; }
		.btn-add-slide:hover { background: #005177; }
		.form-field label { font-weight: 600; margin-bottom: 5px; display: block; }
		.form-field input[type="text"], .form-field textarea { width: 100%; padding: 8px; margin-top: 5px; }
		.form-field textarea { height: 80px; resize: vertical; }
	</style>
	
	<div class="homepage-sections-wrapper">
		<!-- Hero Slider Section -->
		<div class="section-control">
			<h3>🎠 Hero Slider</h3>
			<label>
				<input type="checkbox" name="hero_slider_enabled" value="1" <?php checked( $hero_slider_enabled, true ); ?>>
				<strong>Enable Hero Slider Section</strong>
			</label>
			
			<div class="slides-container">
				<div id="slides-list">
					<?php foreach ( $slides as $index => $slide ) : ?>
						<div class="slide-item" data-slide-index="<?php echo $index; ?>">
							<h4>Slide <?php echo $index + 1; ?> <button type="button" class="btn-remove-slide">Remove Slide</button></h4>
							<div class="form-field">
								<label>Title:</label>
								<input type="text" name="hero_slides[<?php echo $index; ?>][title]" value="<?php echo esc_attr( $slide['title'] ); ?>" placeholder="OPTIMALLY ORGANIC">
							</div>
							<div class="form-field">
								<label>Subtitle:</label>
								<input type="text" name="hero_slides[<?php echo $index; ?>][text]" value="<?php echo esc_attr( $slide['text'] ); ?>" placeholder="Natural products that work!">
							</div>
							<div class="form-field">
								<label>Bold Text:</label>
								<input type="text" name="hero_slides[<?php echo $index; ?>][subtext]" value="<?php echo esc_attr( $slide['subtext'] ); ?>" placeholder="Beyond Organic - Wild Grown...">
							</div>
							<div class="form-field">
								<label>Background Image URL:</label>
								<input type="text" name="hero_slides[<?php echo $index; ?>][image]" value="<?php echo esc_attr( $slide['image'] ); ?>" placeholder="https://example.com/image.jpg">
							</div>
							<div class="form-field">
								<label>Button Text:</label>
								<input type="text" name="hero_slides[<?php echo $index; ?>][button_text]" value="<?php echo esc_attr( $slide['button_text'] ); ?>" placeholder="Shop Now">
							</div>
							<div class="form-field">
								<label>Button Link URL:</label>
								<input type="text" name="hero_slides[<?php echo $index; ?>][button_link]" value="<?php echo esc_attr( $slide['button_link'] ); ?>" placeholder="/shop/">
							</div>
						</div>
					<?php endforeach; ?>
				</div>
				<button type="button" class="btn-add-slide" id="add-slide-btn">+ Add New Slide</button>
			</div>
		</div>
		
		<!-- Fulvic Ionic Minerals Section -->
		<div class="section-control">
			<h3>💎 Fulvic Ionic Minerals</h3>
			<label>
				<input type="checkbox" name="fulvic_section_enabled" value="1" <?php checked( $fulvic_section_enabled, true ); ?>>
				<strong>Enable Section</strong>
			</label>
			<div class="form-field" style="margin-top: 15px;">
				<label>Section Title:</label>
				<input type="text" name="fulvic_title" value="<?php echo esc_attr( $fulvic_title ); ?>">
			</div>
			<div class="form-field">
				<label>Description:</label>
				<textarea name="fulvic_description"><?php echo esc_textarea( $fulvic_description ); ?></textarea>
			</div>
		</div>
		
		<!-- Optimally Organic Extracts Section -->
		<div class="section-control">
			<h3>🌿 Optimally Organic Extracts</h3>
			<label>
				<input type="checkbox" name="extracts_section_enabled" value="1" <?php checked( $extracts_section_enabled, true ); ?>>
				<strong>Enable Section</strong>
			</label>
			<div class="form-field" style="margin-top: 15px;">
				<label>Section Title:</label>
				<input type="text" name="extracts_title" value="<?php echo esc_attr( $extracts_title ); ?>">
			</div>
			<div class="form-field">
				<label>Subtitle:</label>
				<input type="text" name="extracts_subtitle" value="<?php echo esc_attr( $extracts_subtitle ); ?>">
			</div>
		</div>
		
		<!-- Red Pine Needle Oil Section -->
		<div class="section-control">
			<h3>🌲 Red Pine Needle Oil</h3>
			<label>
				<input type="checkbox" name="pine_oil_section_enabled" value="1" <?php checked( $pine_oil_section_enabled, true ); ?>>
				<strong>Enable Section</strong>
			</label>
			<div class="form-field" style="margin-top: 15px;">
				<label>Section Title:</label>
				<input type="text" name="pine_oil_title" value="<?php echo esc_attr( $pine_oil_title ); ?>">
			</div>
			<div class="form-field">
				<label>Description:</label>
				<textarea name="pine_oil_description"><?php echo esc_textarea( $pine_oil_description ); ?></textarea>
			</div>
		</div>
		
		<!-- Benefits Section -->
		<div class="section-control">
			<h3>✨ Benefits Section</h3>
			<label>
				<input type="checkbox" name="benefits_section_enabled" value="1" <?php checked( $benefits_section_enabled, true ); ?>>
				<strong>Enable Section</strong>
			</label>
			<div class="form-field" style="margin-top: 15px;">
				<label>Section Title:</label>
				<input type="text" name="benefits_title" value="<?php echo esc_attr( $benefits_title ); ?>">
			</div>
		</div>
		
		<!-- Probiotics & Enzymes Section -->
		<div class="section-control">
			<h3>🦠 Probiotics & Enzymes</h3>
			<label>
				<input type="checkbox" name="probiotics_section_enabled" value="1" <?php checked( $probiotics_section_enabled, true ); ?>>
				<strong>Enable Section</strong>
			</label>
			<div class="form-field" style="margin-top: 15px;">
				<label>Section Title:</label>
				<input type="text" name="probiotics_title" value="<?php echo esc_attr( $probiotics_title ); ?>">
			</div>
			<div class="form-field">
				<label>Description:</label>
				<textarea name="probiotics_description"><?php echo esc_textarea( $probiotics_description ); ?></textarea>
			</div>
		</div>
		
		<!-- Supergreens Powders Section -->
		<div class="section-control">
			<h3>🥬 Supergreens Powders</h3>
			<label>
				<input type="checkbox" name="supergreens_section_enabled" value="1" <?php checked( $supergreens_section_enabled, true ); ?>>
				<strong>Enable Section</strong>
			</label>
			<div class="form-field" style="margin-top: 15px;">
				<label>Section Title:</label>
				<input type="text" name="supergreens_title" value="<?php echo esc_attr( $supergreens_title ); ?>">
			</div>
			<div class="form-field">
				<label>Description:</label>
				<textarea name="supergreens_description"><?php echo esc_textarea( $supergreens_description ); ?></textarea>
			</div>
		</div>
		
		<!-- Full Spectrum Daily Section -->
		<div class="section-control">
			<h3>🌈 Full Spectrum Daily</h3>
			<label>
				<input type="checkbox" name="full_spectrum_section_enabled" value="1" <?php checked( $full_spectrum_section_enabled, true ); ?>>
				<strong>Enable Section</strong>
			</label>
			<div class="form-field" style="margin-top: 15px;">
				<label>Section Title:</label>
				<input type="text" name="full_spectrum_title" value="<?php echo esc_attr( $full_spectrum_title ); ?>">
			</div>
			<div class="form-field">
				<label>Description:</label>
				<textarea name="full_spectrum_description"><?php echo esc_textarea( $full_spectrum_description ); ?></textarea>
			</div>
		</div>
		
		<!-- Essiac Tea Section -->
		<div class="section-control">
			<h3>🍵 Essiac Tea</h3>
			<label>
				<input type="checkbox" name="essiac_section_enabled" value="1" <?php checked( $essiac_section_enabled, true ); ?>>
				<strong>Enable Section</strong>
			</label>
			<div class="form-field" style="margin-top: 15px;">
				<label>Section Title:</label>
				<input type="text" name="essiac_title" value="<?php echo esc_attr( $essiac_title ); ?>">
			</div>
			<div class="form-field">
				<label>Description:</label>
				<textarea name="essiac_description"><?php echo esc_textarea( $essiac_description ); ?></textarea>
			</div>
		</div>
		
		<!-- Testimonials Section -->
		<div class="section-control">
			<h3>💬 Testimonials</h3>
			<label>
				<input type="checkbox" name="testimonials_section_enabled" value="1" <?php checked( $testimonials_section_enabled, true ); ?>>
				<strong>Enable Section</strong>
			</label>
			<div class="form-field" style="margin-top: 15px;">
				<label>Section Title:</label>
				<input type="text" name="testimonials_title" value="<?php echo esc_attr( $testimonials_title ); ?>">
			</div>
		</div>
		
		<p class="description" style="margin-top: 20px; padding: 10px; background: #fff3cd; border-left: 4px solid #ffc107;">
			<strong>Note:</strong> Make sure this page is set as your homepage in <strong>Settings > Reading</strong>
		</p>
	</div>
	
	<script>
	jQuery(document).ready(function($) {
		var slideIndex = <?php echo count( $slides ); ?>;
		
		// Add new slide
		$('#add-slide-btn').on('click', function() {
			var slideHtml = `
				<div class="slide-item" data-slide-index="${slideIndex}">
					<h4>Slide ${slideIndex + 1} <button type="button" class="btn-remove-slide">Remove Slide</button></h4>
					<div class="form-field">
						<label>Title:</label>
						<input type="text" name="hero_slides[${slideIndex}][title]" value="" placeholder="OPTIMALLY ORGANIC">
					</div>
					<div class="form-field">
						<label>Subtitle:</label>
						<input type="text" name="hero_slides[${slideIndex}][text]" value="" placeholder="Natural products that work!">
					</div>
					<div class="form-field">
						<label>Bold Text:</label>
						<input type="text" name="hero_slides[${slideIndex}][subtext]" value="" placeholder="Beyond Organic - Wild Grown...">
					</div>
					<div class="form-field">
						<label>Background Image URL:</label>
						<input type="text" name="hero_slides[${slideIndex}][image]" value="" placeholder="https://example.com/image.jpg">
					</div>
					<div class="form-field">
						<label>Button Text:</label>
						<input type="text" name="hero_slides[${slideIndex}][button_text]" value="Shop Now" placeholder="Shop Now">
					</div>
					<div class="form-field">
						<label>Button Link URL:</label>
						<input type="text" name="hero_slides[${slideIndex}][button_link]" value="" placeholder="/shop/">
					</div>
				</div>
			`;
			$('#slides-list').append(slideHtml);
			slideIndex++;
			updateSlideNumbers();
		});
		
		// Remove slide
		$(document).on('click', '.btn-remove-slide', function() {
			if ($('.slide-item').length > 1) {
				$(this).closest('.slide-item').remove();
				updateSlideNumbers();
			} else {
				alert('You must have at least one slide!');
			}
		});
		
		// Update slide numbers
		function updateSlideNumbers() {
			$('.slide-item').each(function(index) {
				$(this).find('h4').html(`Slide ${index + 1} <button type="button" class="btn-remove-slide">Remove Slide</button>`);
				// Update input names
				$(this).find('input, textarea').each(function() {
					var name = $(this).attr('name');
					if (name) {
						name = name.replace(/hero_slides\[\d+\]/, 'hero_slides[' + index + ']');
						$(this).attr('name', name);
					}
				});
			});
		}
	});
	</script>
	<?php
}

