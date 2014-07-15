<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

		</div><!-- #main -->

		<footer id="colophon" class="site-footer" role="contentinfo">
			<!--div class='footer-section' id='stubbly-credit'>
				Site created by <a href='http://www.stbly.com'>Stubbly</a>
			</div-->
			<div class='footer-section'>
				<nav id="secondary-navigation" class="footer-navigation secondary-navigation" role="navigation">
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
							<!--<a class='nav-item' href=''>About Xela and Bert</a>
							<a class='nav-item' href=''>Travel Galleries</a>
							<a class='nav-item' style='margin-right:0;' href=''>Route</a>
							<a class='nav-item' href=''>Gallery</a>
							-->
						</ul>
						<div class='clear'></div>
					</div>
				</nav>
			</div>
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>
</body>
</html>