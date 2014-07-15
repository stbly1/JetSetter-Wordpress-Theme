<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage JetSetter
 * @since JetSetter 1.0
 */

get_header(); ?>

<div id="main-content" class="main-content">

<?php
	if ( is_front_page() && twentyfourteen_has_featured_posts() ) {
		// Include the featured content template.
		get_template_part( 'featured-content' );
	}
?>

	<div id='background-image-container'>
		<?php
			$featuredPosts=0;
            $args = array(
                'post_type' => 'destinations',
                'numberposts' => 5,
                'offset' => 0,
                'category' => 0,
                'orderby' => 'post_date',
                'order' => 'DESC'
            );

            $recent_posts = get_posts( $args );
            foreach( $recent_posts as $post ) :
            	$featuredPosts++;
                setup_postdata($post); 
	            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
                ?>            
                <div class='background-image' id='background-image-<?php echo $featuredPosts?>' style='height:auto; background-image:url("<?php echo $image[0] ?>");'>
                </div>
                <?php
            endforeach;
        ?>
	</div>
	<div id="content" class="site-content home-page" role="main" style='opacity:0'>
		<div id='homepage-slider'>
			<div id='image-viewing-window'></div>
			<div id='slider-controls'>
				<div class='slider-button' id='prev' onclick='prevPost()'>Prev Destination</div>
				<ul class='slider-section' id='selector'>
					<?php
					$i = 0;
					foreach( $recent_posts as $post ) :
						$i++;
						?>
						<li class='radio-btn' id='radio-btn-<?php echo $i?>'onclick='sliderButtonClick(<?php echo $i?>)'></li>
						<?php
		            endforeach;
					?>
					<span style='clear:both' class='stretch'></span>
				</ul>
				<div class='slider-button' id='next' onclick='nextPost()'>Next Destination</div>
			</div>
			<div id='post-info'>
				<div id='post-container' style='height:0'>
					<div id='current-post-container'>
					</div>
					<?php
					$i=0;
					foreach( $recent_posts as $post ) :
						$i++;
						?>
						<div class='post-preview' id='post-preview-<?php echo $i?>'>
							<div class='post-preview-section' id='title'>
								<div class='container'>
									<h2 class='title'><?php echo the_title();?></h2>
									<h3 class='country'>
										<?php
	                            		$terms = get_the_terms( $post->ID, 'country' );
										foreach ( $terms as $term ) {
											echo $term->name;
										}
										?>
									</h3>
								</div>
							</div>
							<div class='post-preview-section' id='excerpt'>
								<div class='container'>
									<div class='post-preview-section' id='cta-container'>
										<div id='cta'>
											<a href='<?php echo the_permalink()?>' class='cta-copy'>Read Post</a>
										</div>
									</div>
									<?php echo the_excerpt()?>
									<div class='clear'></div>
								</div>
							</div>
							<div class='clear'></div>
						</div>
							<div class='clear'></div>
						<?php
		            endforeach;
					?>
				</div>
			</div>
		</div>
		<div class='category-navigation'>
			<?php
			$terms = get_terms("region");
			$r=0;
			if ( !empty( $terms ) && !is_wp_error( $terms ) ){
				foreach ( $terms as $term ) {
					?>
					<a class='region' id='<?php echo $term->slug?>' href='region/<?php echo $term->slug?>'>
						<span style='text-decoration:none;' class='region-title'><?php
						echo $term->name;
						?></span>
					</a>
					<?php
				}
				?>
				<div id='category-navigation-clear' class='clear'></div>
				<?php
			}
			?>
		</div>
		<div id='page-navigation'>
			<nav id="primary-navigation" class="site-navigation primary-navigation" role="navigation">
				<!--<button class="menu-toggle"><?php _e( 'Primary Menu', 'twentyfourteen' ); ?></button>
				<a class="screen-reader-text skip-link" href="#content"><?php _e( 'Skip to content', 'twentyfourteen' ); ?></a>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>-->
				<div class='nav-menu'>
					<ul>
						<?php $args = array(
							'sort_order' => 'ASC',
							'sort_column' => 'post_title',
							'hierarchical' => 1,
							'exclude' => '',
							'include' => '',
							'meta_key' => '',
							'meta_value' => '',
							'authors' => '',
							'child_of' => 0,
							'parent' => -1,
							'exclude_tree' => '',
							'number' => '',
							'offset' => 0,
							'post_type' => 'page',
							'post_status' => 'publish'
						); 
						$pages = get_pages($args); 
						$p = 0;
						foreach($pages as $page){
							$p++;
							?>
							<a href='<?php echo get_permalink( $page->ID );?>' class='nav-item' style='
								<?php if($p % 3 ==0){
									?>margin-right:0;
								<?php
								}
								?>'
								href=''>
								<span class='nav-item-title'><?php echo $page->post_title;?></span></a>
							<?php
						}
						?>

						<div id="search-container" class="search-box-wrapper hide">
							<div class="search-box">
								<form role="search" method="get" class="search-form" action="http://localhost:8888/">
								<label>
									<input id='search-input' type="search" class="search-field" placeholder="Search &hellip;" value="Search" name="s" title="Search for:" />
								</label>
								<input type="submit" class="search-submit" value=""/>
							</form>
							</div>
						</div>
						<!--<a class='nav-item' href=''>About Xela and Bert</a>
						<a class='nav-item' href=''>Travel Galleries</a>
						<a class='nav-item' style='margin-right:0;' href=''>Route</a>
						<a class='nav-item' href=''>Gallery</a>
						-->
						<div class='clear'></div>
					</ul>
				</div>
			</nav>
		</div>
		
	<!--?php
		if ( have_posts() ) :
			// Start the Loop.
			while ( have_posts() ) : the_post();

				/*
				 * Include the post format-specific template for the content. If you want to
				 * use this in a child theme, then include a file called called content-___.php
				 * (where ___ is the post format) and that will be used instead.
				 */
				get_template_part( 'content', get_post_format() );

			endwhile;
			// Previous/next post navigation.
			ashland_dispatch_paging_nav();

		else :
			// If no content, include the "No posts found" template.
			get_template_part( 'content', 'none' );

		endif;

	?-->
	</div><!-- #content -->

	<!--
	<?php get_sidebar( 'content' ); ?>
	-->
</div><!-- #main-content -->

<?php
//get_sidebar();
//get_footer();
