<?php
/**
 * The template for displaying search results pages
 *
 * @package Optimally_Organic
 */

get_header();
?>

<main id="main" class="site-main">
	<div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl py-8 md:py-12">
		<?php
		if ( have_posts() ) :
			?>
			<header class="page-header">
				<h1 class="page-title">
					<?php
					printf(
						esc_html__( 'Search Results for: %s', 'optimally-organic' ),
						'<span>' . get_search_query() . '</span>'
					);
					?>
				</h1>
			</header>

			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', 'search' );
			endwhile;

			the_posts_navigation();
		else :
			?>
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'optimally-organic' ); ?></h1>
			</header>

			<div class="page-content">
				<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'optimally-organic' ); ?></p>
				<?php get_search_form(); ?>
			</div>
			<?php
		endif;
		?>
	</div>
</main>

<?php
get_footer();

