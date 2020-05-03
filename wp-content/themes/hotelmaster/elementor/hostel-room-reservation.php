<?php	

	add_action( 'elementor/widgets/widgets_registered', 'hotelmaster_register_elementor_hostel_room_reservation_widget' );
	function hotelmaster_register_elementor_hostel_room_reservation_widget(){
		if( !function_exists('gdlrs_get_reservation_bar') ) return;
		
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Hotelmaster_Elementor_Hostel_Room_Reservation_Widget() );
	}

	class Hotelmaster_Elementor_Hostel_Room_Reservation_Widget extends \Elementor\Widget_Base {

		public function get_name() {
			return 'hostel-room-reservation';
		}

		public function get_title() {
			return __( 'Hostel Room Reservation', 'gdlr_translate' );
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
			$this->add_control( 'enable-title',
				[
					'label' => __( 'Enable Title', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'disable' => __('Disable', 'gdlr_translate'),
						'enable' => __('Enable', 'gdlr_translate'),
					],
					'default' => 'enable'
				]
			);
			$this->end_controls_section();

		}

		protected function render() {

			$settings = $this->get_settings_for_display();

			echo gdlrs_get_reservation_bar(true, $settings); 
		}

	}