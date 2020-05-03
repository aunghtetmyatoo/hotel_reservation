<?php
	/*	
	*	Goodlayers Import Variable Setting
	*/

	if( is_admin() ){
		add_filter('gdlr_nav_meta', 'gdlr_add_import_nav_meta');
		add_action('gdlr_import_end', 'gdlr_add_import_action');
	}
	
	if( !function_exists('gdlr_add_import_nav_meta') ){
		function gdlr_add_import_nav_meta( $array ){
			return array('_gdlr_menu_icon', '_gdlr_mega_menu_item', '_gdlr_mega_menu_section');
		}
	}
	
	if( !function_exists('gdlr_add_import_action') ){
		function gdlr_add_import_action(){
			
			// setting > reading area
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', 3720 );
			update_option( 'page_for_posts', 0 );
			
			// style-custom file
			if( $_POST['import-file'] == 'demo.xml' ){
				$default_file = GDLR_LOCAL_PATH . '/include/function/gdlr-admin-default.txt';
				$default_admin_option = unserialize(file_get_contents($default_file));
				update_option(THEME_SHORT_NAME . '_admin_option', $default_admin_option);	

				$source = get_template_directory() . '/stylesheet/style-custom-light.css';
				$destination = get_template_directory() . '/stylesheet/style-custom.css';
				copy($source, $destination);				
			}else if( $_POST['import-file'] == 'demo-dark.xml' ){
				$default_file = GDLR_LOCAL_PATH . '/include/function/gdlr-admin-default-dark.txt';
				$default_admin_option = unserialize(file_get_contents($default_file));
				update_option(THEME_SHORT_NAME . '_admin_option', $default_admin_option);	

				$source = get_template_directory() . '/stylesheet/style-custom-dark.css';
				$destination = get_template_directory() . '/stylesheet/style-custom.css';
				copy($source, $destination);				
			}else if( $_POST['import-file'] == 'demo-modern.xml' ){
				$default_file = GDLR_LOCAL_PATH . '/include/function/gdlr-admin-default-modern.txt';
				$default_admin_option = unserialize(file_get_contents($default_file));
				update_option(THEME_SHORT_NAME . '_admin_option', $default_admin_option);	

				$source = get_template_directory() . '/stylesheet/style-custom-modern.css';
				$destination = get_template_directory() . '/stylesheet/style-custom.css';
				copy($source, $destination);				
			}else if( $_POST['import-file'] == 'demo-hostel.xml' ){
				$default_file = GDLR_LOCAL_PATH . '/include/function/gdlr-admin-default-hostel.txt';
				$default_admin_option = unserialize(file_get_contents($default_file));
				update_option(THEME_SHORT_NAME . '_admin_option', $default_admin_option);	

				$source = get_template_directory() . '/stylesheet/style-custom-hostel.css';
				$destination = get_template_directory() . '/stylesheet/style-custom.css';
				copy($source, $destination);				
			}else if( $_POST['import-file'] == 'demo-apartment.xml' ){
				$default_file = GDLR_LOCAL_PATH . '/include/function/gdlr-admin-default-apartment.txt';
				$default_admin_option = unserialize(file_get_contents($default_file));
				update_option(THEME_SHORT_NAME . '_admin_option', $default_admin_option);	

				$source = get_template_directory() . '/stylesheet/style-custom-apartment.css';
				$destination = get_template_directory() . '/stylesheet/style-custom.css';
				copy($source, $destination);				
			}else if( $_POST['import-file'] == 'demo-main4.xml' ){
				$default_file = GDLR_LOCAL_PATH . '/include/function/gdlr-admin-default-main4.txt';
				$default_admin_option = unserialize(file_get_contents($default_file));
				update_option(THEME_SHORT_NAME . '_admin_option', $default_admin_option);	

				$source = get_template_directory() . '/stylesheet/style-custom-main4.css';
				$destination = get_template_directory() . '/stylesheet/style-custom.css';
				copy($source, $destination);		
			}
			
			// menu to themes location
			$nav_id = 0;
			$navs = get_terms('nav_menu', array( 'hide_empty' => true ));
			foreach( $navs as $nav ){
				if($nav->name == 'Main menu'){
					$nav_id = $nav->term_id; break;
				}
			}
			set_theme_mod('nav_menu_locations', array('main_menu' => $nav_id));		

			// import the widget
			if( $_POST['import-file'] == 'demo-main4.xml' ){
				$hotel_option_data = '{"booking-money-format":"$NUMBER","enable-hotel-branch":"disable","enable-adult-child-option":"enable","preserve-booking-room":"paid","booking-price-display":"start-from","booking-vat-amount":"8","block-date":"","booking-deposit-amount":"20","payment-method":"instant","instant-payment-method":["paypal","stripe","paymill","authorize"],"transaction-per-page":"30","booking-slug":"booking","enable-single-booking-bar":"disable","enable-multi-room-selection":"enable","enable-checkin-time":"no","checkin-time-hour":"15","enable-booking-term-and-condition":"no","booking-term-and-condition":"4240","booking-item-style":"medium-new","booking-thumbnail-size":"room-booking-thumbnail","booking-num-fetch":"5","booking-num-excerpt":"30","recipient-name":"","recipient-mail":"","booking-complete-contact":"<span style=\"margin-right: 20px;\"><i class=\"fa fa-phone\" ><\/i> +11-2233-442<\/span> <span><i class=\"fa fa-envelope\"><\/i> sales@hotelmastertheme.com<\/span>","booking-code-prefix":"GDLR","maximum-room-selected":"9","minimum-night":"1","room-thumbnail-size":"post-thumbnail-size","ical-cache-time":"5","ical-start-time":"2","paypal-recipient-email":"testmail@test.com","paypal-action-url":"https:\/\/www.paypal.com\/cgi-bin\/webscr","paypal-currency-code":"USD","stripe-secret-key":"","stripe-publishable-key":"","stripe-currency-code":"usd","paymill-private-key":"","paymill-public-key":"","paymill-currency-code":"usd","authorize-live-mode":"disable","authorize-api-id":"","authorize-transaction-key":""}';
				$hotel_option = json_decode($hotel_option_data, true);
				update_option('gdlr_hotel_option', $hotel_option);

				$widget_data = '{"sidebars_widgets":{"wp_inactive_widgets":["gdlr-recent-post-widget-4"],"sidebar-1":["text-11"],"sidebar-2":["text-12"],"sidebar-3":["text-13"],"sidebar-4":["text-14"],"sidebar-5":["search-3","text-2","gdlr-recent-portfolio-widget-2","recent-comments-3","tag_cloud-2"],"sidebar-6":["gdlr-popular-post-widget-4","gdlr-video-widget-4","categories-2","gdlr-port-slider-widget-4"],"sidebar-7":["recent-posts-3","gdlr-recent-portfolio2-widget-4","categories-3"],"sidebar-8":["text-3","recent-comments-4","gdlr-popular-post-widget-5","tag_cloud-4"],"sidebar-9":["nav_menu-2"],"sidebar-10":[],"sidebar-11":["nav_menu-3"],"sidebar-12":["archives-2","calendar-2"],"sidebar-13":["text-6","text-7","text-8"],"sidebar-14":["gdlr-recent-post-widget-5"],"sidebar-15":["gdlr-recent-portfolio2-widget-5","text-9","gdlr-popular-post-widget-6","recent-comments-5"],"array_version":3},"widget_archives":{"1":[],"2":{"title":"","count":0,"dropdown":0},"_multiwidget":1},"widget_calendar":{"1":[],"2":{"title":"Calendar"},"_multiwidget":1},"widget_categories":{"2":{"title":"","count":1,"hierarchical":0,"dropdown":0},"3":{"title":"","count":1,"hierarchical":0,"dropdown":0},"_multiwidget":1},"widget_gdlr-flickr-widget":{"1":[],"_multiwidget":1},"widget_gdlr-popular-post-widget":{"1":[],"4":{"title":"Popular Posts","category":"","num_fetch":"3"},"5":{"title":"Popular Posts","category":"","num_fetch":"3"},"6":{"title":"Popular Posts","category":"","num_fetch":"3"},"_multiwidget":1},"widget_gdlr-port-slider-widget":{"1":[],"4":{"title":"Post Slider","category":"","num_fetch":"3","thumbnail_size":"small-grid-size"},"_multiwidget":1},"widget_gdlr-post-slider-widget":{"1":[],"_multiwidget":1},"widget_gdlr-recent-comment-widget":{"1":[],"_multiwidget":1},"widget_gdlr-recent-portfolio-widget":{"1":[],"2":{"title":"Recent Works","category":"","num_fetch":"3"},"_multiwidget":1},"widget_gdlr-recent-portfolio2-widget":{"1":[],"4":{"title":"Recent Works","category":"","num_fetch":"8"},"5":{"title":"Recent Works","category":"","num_fetch":"8"},"_multiwidget":1},"widget_gdlr-recent-post-widget":{"1":[],"4":{"title":"","category":"","num_fetch":"3"},"5":{"title":"Latest News","category":"fit-row","num_fetch":"3"},"_multiwidget":1},"widget_gdlr-top-rated-post-widget":{"1":[],"_multiwidget":1},"widget_gdlr-twitter-widget":{"1":[],"_multiwidget":1},"widget_gdlr-video-widget":{"1":[],"4":{"title":"Vimeo Video","url":"http:\/\/vimeo.com\/75188030"},"_multiwidget":1},"widget_layerslider_widget":{"1":[],"_multiwidget":1},"widget_master-slider-main-widget":{"1":[],"_multiwidget":1},"widget_meta":{"_multiwidget":1,"1":[]},"widget_nav_menu":{"1":[],"2":{"title":"Shortcodes","nav_menu":51},"3":{"title":"Features","nav_menu":49},"_multiwidget":1},"widget_pages":{"1":[],"_multiwidget":1},"widget_price_filter":false,"widget_product_categories":false,"widget_product_search":false,"widget_product_tag_cloud":false,"widget_recent-comments":{"3":{"title":"","number":5},"4":{"title":"","number":5},"5":{"title":"","number":4},"_multiwidget":1},"widget_recent-posts":{"3":{"title":"","number":7,"show_date":false},"_multiwidget":1},"widget_recently_viewed_products":false,"widget_recent_reviews":false,"widget_rss":{"1":[],"_multiwidget":1},"widget_search":{"1":[],"3":{"title":""},"_multiwidget":1},"widget_soundcloud_is_gold_widget":{"1":[],"2":{"title":"SoundCloud","user":"anna-chocola","format":"tracks","behavior":"latest","number":"1","playertype":"html5","autoplay":"","comments":"","artwork":"","classes":"","type":"custom","wp":"150px","custom":"100%"},"_multiwidget":1},"widget_shopping_cart":false,"widget_tag_cloud":{"1":[],"2":{"title":"Tag Cloud","taxonomy":"post_tag"},"4":{"title":"Tag Cloud","taxonomy":"post_tag"},"_multiwidget":1},"widget_text":{"1":[],"2":{"title":"Text Widget","text":"Morbi leo risus, porta ac consectetur ac, vest ibulum at eros. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Sed posuere consectetur est at lobortis. ","filter":false},"3":{"title":"Text Widget","text":"Vestibulum id ligula porta felis euismod semper. Donec sed odio dui. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.","filter":false},"6":{"title":"Before Contacting Us","text":"Lorem ipsum dolor sit amet, consectetur adipisici elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Non equidem invideo, miror magis posuere velit aliquet.","filter":false},"7":{"title":"Contact Information","text":"[gdlr_icon type=\"fa-map-marker\" size=\"16px\" color=\"#444444\"]184 Main Collins Street West Victoria 8007\r\n\r\n[gdlr_icon type=\"fa-phone\" size=\"16px\" color=\"#444444\"] 1800-222-222\r\n\r\n[gdlr_icon type=\"fa-envelope\" size=\"16px\" color=\"#444444\"] contact@versatilewptheme.com\r\n\r\n[gdlr_icon type=\"fa-clock-o\" size=\"16px\" color=\"#444444\"] Everyday 9:00-17:00","filter":true},"8":{"title":"Social Media","text":"<a href=\"http:\/\/facebook.com\/goodlayers\">[gdlr_icon type=\"icon-facebook\" size=\"28px\" color=\"#444444\"]<\/a> <a href=\"http:\/\/twitter.com\/goodlayers\">[gdlr_icon type=\"icon-twitter\" size=\"28px\" color=\"#444444\"]<\/a> <a href=\"#\">[gdlr_icon type=\"icon-dribbble\" size=\"28px\" color=\"#444444\"]<\/a> <a href=\"#\">[gdlr_icon type=\"icon-pinterest\" size=\"28px\" color=\"#444444\"]<\/a> <a href=\"#\">[gdlr_icon type=\"icon-google-plus\" size=\"28px\" color=\"#444444\"]<\/a> <a href=\"#\">[gdlr_icon type=\"icon-instagram\" size=\"28px\" color=\"#444444\"]<\/a>\r\n","filter":false},"9":{"title":"Text Widget","text":"Morbi leo risus, porta ac consectetur ac, vesti bulum at eros. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Sed posuere consectetur est at lobortis. ","filter":false},"11":{"title":"","text":"<img class=\"size-medium wp-image-4235 aligncenter\" src=\"https:\/\/demo.goodlayers.com\/hotelmaster\/main4\/wp-content\/uploads\/sites\/4\/2019\/07\/logo-300x153.png\" alt=\"\" width=\"130\" style=\"width:130px;\" \/>","filter":true,"visual":true},"12":{"title":"Contact Info","text":"Tel: +1-325-33-345<br\/>\r\nFax: +1-573-23-66<br\/>\r\nEmail: reserve@hotelmaster.co\r\n","filter":true,"visual":true},"13":{"title":"Address","text":"Hotel Master Av. <br\/>\r\ndel Ejercito, 2, 1900 <br\/>\r\nMadrid, Spain","filter":true,"visual":true},"14":{"title":"Awards","text":"<img class=\"alignnone size-medium wp-image-4511\" src=\"https:\/\/demo.goodlayers.com\/hotelmaster\/main4\/wp-content\/uploads\/sites\/4\/2019\/08\/footer-logo-1-300x127.jpg\" alt=\"\" width=\"210\" style=\"width: 210px;\"\/>","filter":true,"visual":true},"_multiwidget":1},"widget_top-rated-products":false,"widget_woocommerce_layered_nav":{"1":[],"_multiwidget":1},"widget_woocommerce_layered_nav_filters":{"1":[],"_multiwidget":1},"widget_woocommerce_product_search":{"1":[],"_multiwidget":1},"widget_woocommerce_price_filter":{"1":[],"2":{"title":"Filter by price"},"_multiwidget":1},"widget_woocommerce_products":{"1":[],"_multiwidget":1},"widget_woocommerce_product_categories":{"1":[],"2":{"title":"Product Categories","orderby":"name","dropdown":0,"count":0,"hierarchical":"1","show_children_only":0},"_multiwidget":1},"widget_woocommerce_random_products":false,"widget_woocommerce_top_rated_products":{"1":[],"2":{"title":"Top Rated Products","number":"5"},"_multiwidget":1},"widget_woocommerce_product_tag_cloud":{"1":[],"_multiwidget":1},"widget_woocommerce_recently_viewed_products":{"1":[],"_multiwidget":1},"widget_woocommerce_recent_reviews":{"1":[],"_multiwidget":1},"widget_woocommerce_widget_cart":{"1":[],"_multiwidget":1},"widget_wpgmp_google_map_widget":{"1":[],"_multiwidget":1}}';
				$widgets = json_decode($widget_data, true);
				foreach($widgets as $slug => $value){
					update_option($slug, $value);
				}
			}else{
				$widget_file = GDLR_LOCAL_PATH . '/plugins/goodlayers-importer-widget.txt';
				$widget_data = unserialize(file_get_contents($widget_file));
				
				// retrieve widget data
				foreach($widget_data as $key => $value){
					update_option( $key, $value );
				}
			}
		}
	}

	//$widget_data = array();
	//$widget_list = array('sidebars_widgets', 'widget_archives', 'widget_calendar', 
	//	'widget_categories', 'widget_gdlr-flickr-widget', 
	//	'widget_gdlr-popular-post-widget', 'widget_gdlr-port-slider-widget', 
	//	'widget_gdlr-post-slider-widget', 'widget_gdlr-recent-comment-widget', 'widget_gdlr-recent-portfolio-widget', 
	//	'widget_gdlr-recent-portfolio2-widget', 'widget_gdlr-recent-post-widget', 'widget_gdlr-top-rated-post-widget',
	//	'widget_gdlr-twitter-widget', 'widget_gdlr-video-widget', 'widget_layerslider_widget', 
	//  'widget_master-slider-main-widget', 'widget_meta', 'widget_nav_menu', 'widget_pages',
	//	'widget_price_filter', 'widget_product_categories', 'widget_product_search', 
	//	'widget_product_tag_cloud', 'widget_recent-comments', 'widget_recent-posts', 
	//	'widget_recently_viewed_products', 'widget_recent_reviews', 'widget_rss', 'widget_search', 'widget_soundcloud_is_gold_widget',
	//	'widget_shopping_cart', 'widget_tag_cloud', 'widget_text', 'widget_top-rated-products', 
	//	'widget_woocommerce_layered_nav', 'widget_woocommerce_layered_nav_filters', 'widget_woocommerce_product_search',
	//	'widget_woocommerce_price_filter', 'widget_woocommerce_products',
	//	'widget_woocommerce_product_categories', 'widget_woocommerce_random_products', 'widget_woocommerce_top_rated_products',
	//  'widget_woocommerce_product_tag_cloud', 'widget_woocommerce_recently_viewed_products', 'widget_woocommerce_recent_reviews',
	//  'widget_woocommerce_widget_cart', 'widget_wpgmp_google_map_widget');
	// foreach($widget_list as $widget){
	//	$widget_data[$widget] = get_option($widget);
	// }
	//$widget_file = GDLR_LOCAL_PATH . '/plugins/goodlayers-importer-widget.txt';
	//$file_stream = @fopen($widget_file, 'w');
	//fwrite($file_stream, serialize($widget_data));
	//fclose($file_stream);	
	
	
?>