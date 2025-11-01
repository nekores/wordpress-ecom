<?php
/**
 * Template part for displaying posts
 *
 * @package Optimally_Organic
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				optimally_organic_posted_on();
				optimally_organic_posted_by();
				?>
			</div>
			<?php
		endif;
		?>
	</header>

	<?php if ( has_post_thumbnail() && ! is_singular() ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'large' ); ?>
			</a>
		</div>
	<?php endif; ?>

	<div class="entry-content">
		<?php
		if ( is_singular() ) {
			the_content();
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'optimally-organic' ),
				'after'  => '</div>',
			) );
		} else {
			the_excerpt();
		}
		?>
	</div>
</article>

