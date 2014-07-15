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
					<a class='nav-item' style='
						<?php if($p % 3 ==0){
							?>margin-right:0;
						<?php
						}
						?>'
						href='<?php echo get_permalink( $page->ID );?>'>
						<span class='nav-item-title'><?php echo $page->post_title;?></span></a>
					<?php
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
		<div class='category-navigation'>
			<?php
			$regionTerms = get_terms("region");
			$r = 0;
			if ( !empty( $regionTerms ) && !is_wp_error( $regionTerms ) ){
				shuffle($regionTerms);
				foreach ( $regionTerms as $region ) {
					if($r<3){
						?>
						<a class='region' id='<?php echo $region->slug?>' style='background-image:url(<?php bloginfo("template_url")?>/images/<?php echo $region->slug?>-thumb.jpg);' href='/region/<?php echo $region->slug?>'>
							<span style='text-decoration:none;' class='region-title'><?php
							echo $region->name;
							?></span>
						</a>
						<?php
						$r++;
					}
				}
				?> <div class='clear'></div><?php
			}
			?>
		</div>

	</div><!-- #content-sidebar -->

</div>