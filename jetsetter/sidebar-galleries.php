<?php
/**
 * The Content Sidebar
 *
 * @package WordPress
 * @subpackage JetSetter
 * @since JetSetter 1.0
 */
?>
<div id='secondary'>

<div id="content-sidebar" class="content-sidebar widget-area" role="complementary">
	<div class='nav-menu'>
		<ul>
			<a class='nav-item' href='/travel-galleries/' style='margin-bottom:0;'>
				<span class='nav-item-title'>Travel Galleries</span>
			</a>
		</ul>
	</div>
	<div class='category-navigation'>
		
		<?php
		$args = array(
			'post_type' => 'galleries',
			'orderby' => 'date',
		    'order' => 'DESC',
			'posts_per_page' => 4
		);
		$featuredPosts = get_posts( $args );
		foreach($featuredPosts as $post) :
			setup_postdata($post); 
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
			?>
			<div class='container'>
				<a class='region' href='<?php echo the_permalink()?>' style='background-image:url("<?php echo $image[0] ?>")'>
					<span style='text-decoration:none;' class='region-title'><?php
					echo the_title();
					?></span>
				</a>
			</div>
	    <? endforeach;
		?>
		<div class='clear'></div>
	</div>
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
				if($page->post_title != 'Travel Galleries') :
				$p++;
				?>
				<a class='nav-item' style='
					<?php if($p % 3 ==0){
						?>margin-right:0;
					<?php
					}
					?>'
					href='<?php echo get_permalink( $page->ID );?>'>
					<span class='nav-item-title'><?php echo $page->post_title;?></span>
				</a>
				<?php
				endif;
			}
			?>

			<div id="search-container" class="search-box-wrapper hide">
				<div class="search-box">
					<form role="search" method="get" class="search-form" action="http://localhost:8888/">
					<label>
						<input type="search" class="search-field" placeholder="Search &hellip;" value="Search" name="s" title="Search for:" />
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

</div><!-- #content-sidebar -->

</div>