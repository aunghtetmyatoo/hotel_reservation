<?php 
	global $gdlr_post_option;

	while ( have_posts() ){ the_post();
		$content = gdlr_content_filter(get_the_content(), true); 
		if(!empty($content)){
			?>
			<div class="main-content-container container gdlr-item-start-content <?php
				if( !empty($gdlr_post_option['content-top-padding']) && $gdlr_post_option['content-top-padding'] == 'disable' ){
					echo 'gdlr-no-top-padding';
				}
			?>">
				<div class="gdlr-item gdlr-main-content <?php
				if( !empty($gdlr_post_option['content-bottom-margin']) && $gdlr_post_option['content-bottom-margin'] == 'disable' ){
					echo 'gdlr-no-bottom-margin';
				}
			?>">
					<?php 
						echo $content; 

						wp_link_pages( array(
							'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'traveltour' ) . '</span>',
							'after'       => '</div>',
							'link_before' => '<span>',
							'link_after'  => '</span>',
							'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'traveltour' ) . ' </span>%',
							'separator'   => '<span class="screen-reader-text">, </span>',
						) );
					?>
					<div class="clear"></div>
				</div>
			</div>
			<?php
		}
	} 
?>