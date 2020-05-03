<?php
/**
 * The default template for displaying standard post format
 */

	global $gdlr_post_settings, $theme_option;
	$gdlr_post_settings['content'] = get_the_content();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="gdlr-standard-style">
		
		<div class="blog-content-wrapper" >
			<?php 
				echo '<div class="gdlr-blog-content">';
				echo gdlr_content_filter($gdlr_post_settings['content'], true);
				wp_link_pages( array( 
					'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'gdlr_translate' ) . '</span>', 
					'after' => '</div>', 
					'link_before' => '<span>', 
					'link_after' => '</span>' )
				);
				echo '</div>';

				if( empty($theme_option['single-bottom-style']) || $theme_option['single-bottom-style'] == 'default' ){
					echo '<div class="gdlr-single-blog-tag">';
					echo gdlr_get_blog_info(array('tag'), false);
					echo '</div>';
				}
			?>
			
		</div> <!-- blog content wrapper -->
	</div>
</article><!-- #post -->
