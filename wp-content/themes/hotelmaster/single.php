<?php get_header(); ?>
<div class="gdlr-content">

	<?php 
		global $gdlr_sidebar, $theme_option;
		if( empty($gdlr_post_option['sidebar']) || $gdlr_post_option['sidebar'] == 'default-sidebar' ){
			$gdlr_sidebar = array(
				'type'=>$theme_option['post-sidebar-template'],
				'left-sidebar'=>$theme_option['post-sidebar-left'], 
				'right-sidebar'=>$theme_option['post-sidebar-right']
			); 
		}else{
			$gdlr_sidebar = array(
				'type'=>$gdlr_post_option['sidebar'],
				'left-sidebar'=>$gdlr_post_option['left-sidebar'], 
				'right-sidebar'=>$gdlr_post_option['right-sidebar']
			); 				
		}
		$gdlr_sidebar = gdlr_get_sidebar_class($gdlr_sidebar);
	?>
	<div class="with-sidebar-wrapper">
		<div class="with-sidebar-container container">
			<div class="with-sidebar-left <?php echo esc_attr($gdlr_sidebar['outer']); ?> columns">
				<div class="with-sidebar-content <?php echo esc_attr($gdlr_sidebar['center']); ?> columns">
					<div class="gdlr-item gdlr-blog-full gdlr-item-start-content">
					<?php
						while ( have_posts() ){ the_post();
							if( !empty($theme_option['single-blog-style']) && $theme_option['single-blog-style'] == 'v4' ){
								get_template_part('single/content-full-v4'); 
							}else{
								get_template_part('single/content'); 
							}

							if( !empty($theme_option['single-bottom-style']) && $theme_option['single-bottom-style'] == 'v4' ){
								get_template_part('single/content-bottom-v4'); 
							}else{
								get_template_part('single/content-bottom'); 
							}
						} 
					?>
					</div>
				</div>
				<?php get_sidebar('left'); ?>
				<div class="clear"></div>
			</div>
			<?php get_sidebar('right'); ?>
			<div class="clear"></div>
		</div>				
	</div>				

</div><!-- gdlr-content -->
<?php get_footer(); ?>