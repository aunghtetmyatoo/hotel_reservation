<?php	

	add_action( 'elementor/widgets/widgets_registered', 'hotelmaster_register_elementor_hostel_room_availability_widget' );
	function hotelmaster_register_elementor_hostel_room_availability_widget(){
		if( !function_exists('gdlr_print_hostel_availability_item') ) return;
		
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Hotelmaster_Elementor_Hostel_Room_Availability_Widget() );
	}

	class Hotelmaster_Elementor_Hostel_Room_Availability_Widget extends \Elementor\Widget_Base {

		public function get_name() {
			return 'hostel-room-avilability';
		}

		public function get_title() {
			return __( 'Hostel Room Availability', 'gdlr_translate' );
		}

		public function get_icon() {
			return 'fa fa-home';
		}

		public function get_categories() {
			return [ 'hotelmaster' ];
		}

		protected function _register_controls() {

			// style
			$this->start_controls_section( 'style-section',
				[
					'label' => __( 'Style', 'gdlr_translate' ),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
			$this->add_control( 'style',
				[
					'label' => __( 'Style', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'classic' => __('Classic', 'gdlr_translate'),
						'v4'=> __('V4' ,'gdlr_translate'),
					],
					'default' => 'v4',
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

			echo gdlr_print_hostel_availability_item($settings);
		}

	}