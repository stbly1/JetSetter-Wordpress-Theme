<?php
/*
Template Name: Two Column Page
*/

get_header(); ?>

<div id="main-content" class="main-content">
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

					// Include the page content template.
					get_template_part( 'content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					
				endwhile;
			?>

		</div><!-- #content -->
		<div class='clear'></div>
	</div><!-- #primary -->
	<?php 
	get_sidebar('destinations');
	?>
</div><!-- #main-content -->

<?php
//get_sidebar();
//get_footer();
