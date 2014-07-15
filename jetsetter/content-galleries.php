<?php
/**
 * The default template for displaying gallery content
 *
 *
 * @package WordPress
 * @subpackage JetSetter
 * @since JetSetter 1.0
 */
?>
<?php if ( is_single() ) : ?>
	<header class="entry-header">

		<?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && twentyfourteen_categorized_blog() ) : ?>
		<div class="entry-meta">
			<span class="cat-links"><?php echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'twentyfourteen' ) ); ?></span>
		</div>
		<?php
			endif;
		?>
		<a href='/'>
			<img src="<?php header_image(); ?>" height:'auto' width="150px" alt="" id='gallery-header-image'>
		</a>
		<div class='container'>
			<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
			endif;
			?>
			<span id='gallery-description'><?php if($post->post_excerpt){
					$myExcerpt = get_the_excerpt();
					$tags = array("<p>", "</p>");
					$myExcerpt = str_replace($tags, "", $myExcerpt);
					echo $myExcerpt;
				}?></span>
		</div>

	</header><!-- .entry-header -->
	<div id='featured-image-header'>
		<div id='active-container'></div>
		<div id='inactive-container'></div>
	</div>
<?php endif; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	

	<?php if ( !is_single()) : ?>

		<?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && twentyfourteen_categorized_blog() ) : ?>
		<div class="entry-meta">
			<span class="cat-links"><?php echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'twentyfourteen' ) ); ?></span>
		</div>
		<?php
		endif;
		the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
		?>
		<div class="entry-summary">
			<?php the_post_thumbnail('array(100%,auto)',array('class' => 'galleries-thumbnail')); ?>

			<div class='post-meta'>
				<div style='width:60%;margin-top:0;' class='divider'></div>
				<span class='meta-copy'>POSTED </span><h2 class='date'><?php echo the_date()?></h2><span class='meta-copy'> BY </span><h3 class='author'><?php the_author();?></h3>
			</div>

			<div class='clear'></div>
		</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php
		/*
		<div class='post-meta'>
			<h2 class='date'><?php echo the_date()?></h2>
			<?php 
			if(get_the_term_list( $post->ID, 'project-year' )!=null){
				?>
				<span class='meta-copy'>POSTED IN</span>
				<h3 class='trip-type'>
					<?php
					 echo get_the_term_list( $post_id->ID, 'region', '',', ',' '  );
					 echo get_the_term_list( $post_id->ID, 'trip-type', '',', ','' );
					?>
				</h3>
				<?php
			}
			if(get_the_author()){
				?>
				<span class='meta-copy'>BY</span>
				<h3 class='author'><?php the_author();?></h3>
				<?php
			}
			?>
		</div>
		<?php
		*/
			the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyfourteen' ) );
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfourteen' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
		
	</div><!-- .entry-content -->
	<div id='more-galleries'>

		<div class='block-button' id='gallery-toggle' onclick='toggleGalleriesGallery()'>View More Galleries</div>
		<ul id='galleries-navigation'>
			<?php
			$args = array(
				'post_type' => 'galleries',
				'orderby' => 'date',
			    'order' => 'DESC'
			);
			$featuredPosts = get_posts( $args );
			if($featuredPosts != null) :
				foreach($featuredPosts as $post) :
					setup_postdata($post); 
		            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
					?>
					<li>
						<a class='gallery' href='<?php echo the_permalink()?>'>
							<div style='text-decoration:none; text-align:center; margin-bottom:10px' class='gallery-title'><?php
							echo the_title();
							?></div>
							<?php the_post_thumbnail(array(140,140),array('class' => 'thumbnail')); ?>
						</a>
					</li>
			    <? endforeach;
			endif;
			?>
		</ul>
	</div>
	<?php endif; ?>
</article><!-- #post-## -->
<?php 
	if ( is_single() ) :
		?>
        <div class='clear'></div>
    <?php endif;?>
