<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Optimally_Organic
 */

get_header();
?>

<main id="main" class="site-main">
	<div class="container">
		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'optimally-organic' ); ?></h1>
			</header>

			<div class="page-content">
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'optimally-organic' ); ?></p>

				<?php
				get_search_form();
				?>

				<div class="widget">
					<?php
					the_widget( 'WP_Widget_Recent_Posts' );
					?>
				</div>

				<div class="widget widget_categories">
					<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'optimally-organic' ); ?></h2>
					<ul>
						<?php
						wp_list_categories( array(
							'orderby'    => 'count',
							'order'      => 'DESC',
							'show_count' => 1,
							'title_li'   => '',
							'number'     => 10,
						) );
						?>
					</ul>
				</div>
			</div>
		</section>
	</div>
</main>

<?php
get_footer();

