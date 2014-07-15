<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

<div id='featured-image-header'>
	<div id='image-container'
		<?php
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
		if($image) :
        ?>            
        style='background-image:url("<?php echo $image[0] ?>")'
        <?php 
        endif;
        ?>
        >
		<!--<?php twentyfourteen_post_thumbnail();?>-->

	</div>
</div>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' );?>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php
			the_content();
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfourteen' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );

			edit_post_link( __( 'Edit', 'twentyfourteen' ), '<span class="edit-link">', '</span>' );
		?>
	</div>
	<div class='entry-footer'>
		<div style='width:60%;margin-top:0;' class='divider'></div>
	    <?php the_tags( '<span class="tag-links">', '', '</span>' );
		twentyfourteen_page_nav();
		?>
	</div>
</article>
<?php 
//get_sidebar('galleries');
?>
