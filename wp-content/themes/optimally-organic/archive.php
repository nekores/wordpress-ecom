<?php
/**
 * The template for displaying archive pages
 *
 * @package Optimally_Organic
 */

get_header();
?>

<main id="main" class="site-main">
	<div class="container">
		<?php
		if ( have_posts() ) :
			?>
			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header>

			<div class="products-wrapper">
				<?php
				if ( function_exists( 'woocommerce_content' ) && is_shop() ) {
					woocommerce_content();
				} else {
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content', get_post_type() );
					endwhile;
					
					the_posts_navigation();
				}
				?>
			</div>
			<?php
		else :
			?>
			<p><?php esc_html_e( 'No content found.', 'optimally-organic' ); ?></p>
			<?php
		endif;
		?>
	</div>
</main>

<?php
get_footer();

