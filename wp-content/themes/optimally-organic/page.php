<?php
/**
 * The template for displaying all pages
 *
 * @package Optimally_Organic
 */

get_header();
?>

<main id="main" class="site-main">
	<div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl py-8 md:py-12">
		<?php
		while ( have_posts() ) :
			the_post();
			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header>

				<div class="entry-content">
					<?php
					the_content();

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'optimally-organic' ),
						'after'  => '</div>',
					) );
					?>
				</div>
			</article>

			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		endwhile;
		?>
	</div>
</main>

<?php
get_footer();

