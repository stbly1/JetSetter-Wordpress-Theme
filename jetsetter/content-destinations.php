<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
<?php if ( is_single() ) : ?>
<div id='featured-image-header'>
	<div id='image-container'
		<?php
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
        ?>            
        style='background-image:url("<?php echo $image[0] ?>")'>
		<!--<?php twentyfourteen_post_thumbnail();?>-->

	</div>
</div>
<?php endif; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	

	<header class="entry-header">
		<?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && twentyfourteen_categorized_blog() ) : ?>
		<div class="entry-meta">
			<span class="cat-links"><?php echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'twentyfourteen' ) ); ?></span>
		</div>
		<?php
			endif;
		?>
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
		endif;
		?>

		<div class="entry-meta">
			<?php
				if ( 'post' == get_post_type() )
					twentyfourteen_posted_on();

				if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
			?>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'twentyfourteen' ), __( '1 Comment', 'twentyfourteen' ), __( '% Comments', 'twentyfourteen' ) ); ?></span>
			<?php
				endif;

				edit_post_link( __( 'Edit', 'twentyfourteen' ), '<span class="edit-link">', '</span>' );
			?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<?php if ( !is_single()) : ?>
		<div class='post-meta'>
			<div style='width:60%;margin-top:0;' class='divider'></div>
			<span class='meta-copy'>POSTED </span><h2 class='date'><?php echo the_date()?></h2><span class='meta-copy'> BY </span><h3 class='author'><?php the_author();?></h3>
		</div>
	<div class="entry-summary">
		<?php the_post_thumbnail(array(140,140),array('class' => 'thumbnail')); ?>
		<?php the_excerpt(); ?>
		<div class='clear'></div>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<div class='post-meta'>
			<h2 class='date'><?php echo the_date()?></h2>
			<?php 
				$regionExists = get_the_term_list( $post->ID, 'region' )!=null;
				$tripTypeExists = get_the_term_list( $post->ID, 'region' )!=null;
				$authorExists = get_the_author();
				if($regionExists || $tripTypeExists || $authorExists){
				?>
				<span class='meta-copy'>POSTED</span>
				<?php if($regionExists || $tripTypeExists){
					?>
					<span class='meta-copy'>IN</span>
					<h3 class='trip-type'>
						<?php
						if ( $regionExists )
							echo get_the_term_list( $post_id->ID, 'region', '',', ',' '  );
						if ( $tripTypeExists )
							echo get_the_term_list( $post_id->ID, 'trip-type', '',', ','' );
						?>
					</h3>
					<?php
				}
			}
			if($authorExists){
				?>
				<span class='meta-copy'>BY</span>
				<h3 class='author'><?php the_author();?></h3>
				<?php
			}
			?>
		</div>
		<?php
			the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyfourteen' ) );
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfourteen' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->
	<div class='entry-footer'>
		<div style='width:60%;margin-top:0;' class='divider'></div>
	    <?php the_tags( '<span class="tag-links">', '', '</span>' );
		twentyfourteen_post_nav();
		?>
	</div>
	<?php endif; ?>
</article><!-- #post-## -->
<?php
	if ( is_single() ) :
	?>
	<?php 
	get_sidebar('destinations');
	?>
    <div class='clear'></div>
    <?php endif;?>
