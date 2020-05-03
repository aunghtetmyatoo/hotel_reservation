<?php	

	add_action( 'elementor/widgets/widgets_registered', 'hotelmaster_register_elementor_room_info_widget' );
	function hotelmaster_register_elementor_room_info_widget(){
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Hotelmaster_Elementor_Room_Info_Widget() );
	}

	class Hotelmaster_Elementor_Room_Info_Widget extends \Elementor\Widget_Base {

		public function get_name() {
			return 'hotel-room-info';
		}

		public function get_title() {
			return __( 'Hotel Room Info', 'gdlr_translate' );
		}

		public function get_icon() {
			return 'fa fa-navicon';
		}

		public function get_categories() {
			return [ 'hotelmaster' ];
		}

		protected function _register_controls() {

			// title
			$this->start_controls_section( 'settings-section',
				[
					'label' => __( 'Settings', 'gdlr_translate' ),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
			$this->add_control( 'info-style',
				[
					'label' => __( 'Info Style', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'classic-style' => __('Classic Style', 'gdlr_translate'),
						'new-style'=> __('New Style' ,'gdlr_translate'),
					],
					'default' => 'new-style',
				]
			);
			$this->end_controls_section();

		}

		protected function render() {

			$settings = $this->get_settings_for_display();
			$gdlr_post_option = json_decode(gdlr_decode_preventslashes(get_post_meta(get_the_ID(), 'post-option', true)), true);

			if( get_post_type() == 'room' ){
				echo gdlr_hotel_room_info($gdlr_post_option, array(), true, $settings['info-style']); 
			}else if( get_post_type() == 'hostel_room' ){
				echo gdlr_hostel_room_info($gdlr_post_option, array(), true, $settings['info-style']);
			}else{
				echo __('You can only use this item on "room" and "hostel room" post type.', 'gdlr_translate');
			}

		}

	}