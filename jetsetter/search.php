<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<div id='featured-image-header'>
				<div id='image-container'>
					<!--<?php twentyfourteen_post_thumbnail();?>-->
				</div>
				<h1 class='tax-name'>
					<?php printf( __( 'Search Results for: %s', 'twentyfourteen' ), get_search_query() ); ?>
				</h1>
			</div>

			<?php if ( have_posts() ) : ?>

			<div class='posts-container'>

			<?php
					// Start the Loop.
					while ( have_posts() ) : the_post();

						/*
						 * Include the post format-specific template for the content. If you want to
						 * use this in a child theme, then include a file called called content-___.php
						 * (where ___ is the post format) and that will be used instead.
						 */
						get_template_part( 'content-destinations', get_post_format() );

					endwhile;
					// Previous/next page navigation.
					ashland_dispatch_paging_nav();
					?>

			</div>
				<?php
				else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );

				endif;
			?>
		</div><!-- #content -->
	</section><!-- #primary -->
	<?php 
	get_sidebar('destinations');
	?>

<?php
//get_sidebar( 'content' );
//get_sidebar();
//get_footer();
