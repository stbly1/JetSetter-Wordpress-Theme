<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>


	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<div id='featured-image-header'>
				<div id='image-container'>
					<!--<?php twentyfourteen_post_thumbnail();?>-->
				</div>
				<h1 class='tax-name'>
					<?php echo get_queried_object()->name; ?>
				</h1>
			</div>
			<header class="page-header">
				<h1 class="page-title"><?php _e( 'Not Found', 'twentyfourteen' ); ?></h1>
			</header>

			<div class="page-content">
				<p><?php _e( "Looks like you may have followed our travels to a non-existant place! Either that, or we're just lost. Let's hope it isn't the latter. In any case, just use the navigation below to get back on the path or use the search bar to try to find something a little closer to home.", 'twentyfourteen' ); ?></p>

				<?php get_search_form(); ?>
			</div><!-- .page-content -->

		</div><!-- #content -->
		<div class='clear'></div>
	</div><!-- #primary -->

<?php
get_footer();
