<?php
/**
 * The template for displaying Post Format pages
 *
 * Used to display archive-type pages for posts with a post format.
 * If you'd like to further customize these Post Format views, you may create a
 * new template file for each specific one.
 *
 * @todo http://core.trac.wordpress.org/ticket/23257: Add plural versions of Post Format strings
 * and remove plurals below.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			
			<div id='featured-image-header'>
				<div id='image-container'
					<?php
						$image = '/images/' . get_queried_object()->slug . '-featured.jpg';
			        ?>
				    style='background-image:url("<?php echo bloginfo('template_url') . $image?>")'
		        >
				<!--<?php twentyfourteen_post_thumbnail();?>-->
				</div>
				<h1 class='tax-name'>
					<?php echo get_queried_object()->name; ?>
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

				else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );

				endif;
				get_sidebar('regions');
			?>
			</div>
		</div><!-- #content -->
		<div class='clear'></div>
	</section><!-- #primary -->

<?php
get_footer();
