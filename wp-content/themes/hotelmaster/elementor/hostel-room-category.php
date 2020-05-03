<?php	

	add_action( 'elementor/widgets/widgets_registered', 'hotelmaster_register_elementor_hostel_room_category_widget' );
	function hotelmaster_register_elementor_hostel_room_category_widget(){
		if( !function_exists('gdlrs_print_room_category_item') ) return;

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Hotelmaster_Elementor_Hostel_Room_Category_Widget() );
	}

	class Hotelmaster_Elementor_Hostel_Room_Category_Widget extends \Elementor\Widget_Base {

		public function get_name() {
			return 'hostel-room-category';
		}

		public function get_title() {
			return __( 'Hostel Room Category', 'gdlr_translate' );
		}

		public function get_icon() {
			return 'fa fa-home';
		}

		public function get_categories() {
			return [ 'hotelmaster' ];
		}

		protected function _register_controls() {

			// settings
			$this->start_controls_section( 'settings-section',
				[
					'label' => __( 'Settings', 'gdlr_translate' ),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
			$this->add_control( 'category',
				[
					'label' => __( 'Select Category To Display', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::SELECT2,
					'options' => gdlr_get_term_list('hostel_room_category'),
					'multiple' => true
				]
			);
			$this->add_control( 'item-size',
				[
					'label' => __( 'Column Size', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'1' => '1',	
						'2' => '2',	
						'3' => '3',	
						'4' => '4',	
					],
					'default' => '3',
				]
			);
			$this->add_control( 'thumbnail-size',
				[
					'label' => __( 'Thumbnail Size', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => gdlr_get_thumbnail_list(),
					'default' => 'full'
				]
			);
			$this->end_controls_section();

			// title
			$this->start_controls_section( 'title-section',
				[
					'label' => __( 'Title', 'gdlr_translate' ),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
			$this->add_control( 'title-type',
				[
					'label' => __( 'Title Type', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'none' => __('None', 'gdlr_translate'),
						'left'=> __('Left Align' ,'gdlr_translate'),
						'left-divider'=> __('Left Align With Divider' ,'gdlr_translate'),
						'center'=> __('Center Align' ,'gdlr_translate'),
						'center-divider'=> __('Center Align With Divider' ,'gdlr_translate')
					],
					'default' => 'none',
				]
			);
			$this->add_control( 'title',
				[
					'label' => __( 'Title', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::TEXT,
				]
			);
			$this->add_control( 'caption',
				[
					'label' => __( 'Caption', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::TEXT,
				]
			);
			$this->add_control( 'right-text',
				[
					'label' => __( 'Title Link Text', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( 'View all branches', 'gdlr_translate' )
				]
			);
			$this->add_control( 'right-text-link',
				[
					'label' => __( 'Title Link URL', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::TEXT,
				]
			);
			$this->end_controls_section();

		}

		protected function render() {

			$settings = $this->get_settings_for_display();

			echo gdlrs_print_room_category_item( $settings );
		}

	}