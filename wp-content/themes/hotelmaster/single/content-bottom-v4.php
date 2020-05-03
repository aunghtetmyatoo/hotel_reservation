<?php
/**
 * The default template for displaying standard post format
 */

	global $gdlr_post_settings, $theme_option;
?>

	<div class="gdlr-single-bottom-v4" >
				
		<nav class="gdlr-single-nav">
			<?php previous_post_link('<div class="previous-nav">%link</div>', '<span>' . __('Previous Post', 'gdlr_translate') . '</span><h3>%title</h3>', true); ?>
			<?php next_post_link('<div class="next-nav">%link</div>', '<span>' . __('Previous Post', 'gdlr_translate') . '</span><h3>%title</h3>', true); ?>
			<div class="clear"></div>
		</nav><!-- .nav-single -->

		<?php gdlr_get_social_shares(); ?>

		<!-- abou author section -->
		<?php if($theme_option['single-post-author'] != "disable"){ ?>
			<div class="gdlr-post-author">
			<div class="post-author-avartar"><?php echo get_avatar(get_the_author_meta('ID'), 90); ?></div>
			<div class="post-author-content">
			<h4 class="post-author"><?php the_author_posts_link(); ?></h4>
			<?php echo get_the_author_meta('description'); ?>
			</div>
			<div class="clear"></div>
			</div>
		<?php } ?>	

		<?php comments_template( '', true ); ?>	
	</div>
	