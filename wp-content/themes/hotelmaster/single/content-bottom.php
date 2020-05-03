<?php
/**
 * The default template for displaying standard post format
 */

	global $gdlr_post_settings, $theme_option;
?>

<?php gdlr_get_social_shares(); ?>
						
<nav class="gdlr-single-nav">
	<?php previous_post_link('<div class="previous-nav">%link</div>', '<i class="icon-angle-left"></i><span>%title</span>', true); ?>
	<?php next_post_link('<div class="next-nav">%link</div>', '<span>%title</span><i class="icon-angle-right"></i>', true); ?>
	<div class="clear"></div>
</nav><!-- .nav-single -->

<!-- abou author section -->
<?php if($theme_option['single-post-author'] != "disable"){ ?>
	<div class="gdlr-post-author">
	<h3 class="post-author-title" ><?php echo __('About Post Author', 'gdlr_translate'); ?></h3>
	<div class="post-author-avartar"><?php echo get_avatar(get_the_author_meta('ID'), 90); ?></div>
	<div class="post-author-content">
	<h4 class="post-author"><?php the_author_posts_link(); ?></h4>
	<?php echo get_the_author_meta('description'); ?>
	</div>
	<div class="clear"></div>
	</div>
<?php } ?>						

<?php comments_template( '', true ); ?>	