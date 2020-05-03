<?php	

	add_action( 'elementor/widgets/widgets_registered', 'hotelmaster_register_elementor_room_widget' );
	function hotelmaster_register_elementor_room_widget(){
		if( !function_exists('gdlr_print_room_item') ) return;
		
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Hotelmaster_Elementor_Room_Widget() );
	}

	class Hotelmaster_Elementor_Room_Widget extends \Elementor\Widget_Base {

		public function get_name() {
			return 'hotel-room';
		}

		public function get_title() {
			return __( 'Hotel Room', 'gdlr_translate' );
		}

		public function get_icon() {
			return 'fa fa-hotel';
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
					'label' => __( 'Category', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::SELECT2,
					'options' => gdlr_get_term_list('room_category'),
					'multiple' => true
				]
			);
			$this->add_control( 'tag',
				[
					'label' => __( 'Tag', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::SELECT2,
					'options' => gdlr_get_term_list('room_tag'),
					'multiple' => true
				]
			);
			$this->add_control( 'num-fetch',
				[
					'label' => __( 'Num Fetch', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => '8'
				]
			);
			$this->add_control( 'orderby',
				[
					'label' => __( 'Orderby', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'date' => __('Publish Date', 'gdlr_translate'), 
						'title' => __('Title', 'gdlr_translate'), 
						'rand' => __('Random', 'gdlr_translate'),
					],
					'default' => 'date'
				]
			);
			$this->add_control( 'order',
				[
					'label' => __( 'Order', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'desc'=>__('Descending Order', 'gdlr_translate'), 
						'asc'=> __('Ascending Order', 'gdlr_translate'), 
					],
					'default' => 'desc'
				]
			);
			$this->add_control( 'pagination',
				[
					'label' => __( 'Pagination', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'enable'=>__('Enable', 'gdlr_translate'), 
						'disable'=> __('Disable', 'gdlr_translate'), 
					],
					'default' => 'enable'
				]
			);
			$this->end_controls_section();

			// style
			$this->start_controls_section( 'style-section',
				[
					'label' => __( 'Style', 'gdlr_translate' ),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
			$this->add_control( 'room-style',
				[
					'label' => __( 'Room Style', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'classic' => __('Classic', 'gdlr_translate'),
						'classic-no-space' => __('Classic No Space', 'gdlr_translate'),
						'modern' => __('Modern', 'gdlr_translate'),
						'modern-no-space' => __('Modern No Space', 'gdlr_translate'),
						'modern-new' => __('Modern New', 'gdlr_translate'),
						'modern-new-no-space' => __('Modern New No Space', 'gdlr_translate'),
						'medium' => __('Medium Thumbnail', 'gdlr_translate'),
						'medium-new' => __('New Medium Thumbnail', 'gdlr_translate'),
						'image' => __('Image', 'gdlr_translate'),
						'image-no-space' => __('Image No Space', 'gdlr_translate')
					],
					'default' => 'classic'
				]
			);
			$this->add_control( 'room-size',
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
					'description' => __( 'For Classic/Modern Style', 'gdlr_translate' )
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
			$this->add_control( 'num-excerpt',
				[
					'label' => __( 'Num Excerpt', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => '20',
					'description' => __( 'For medium room style', 'gdlr_translate')
				]
			);
			$this->add_control( 'enable-carousel',
				[
					'label' => __( 'Enable Carousel', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'disable' => __('Disable', 'gdlr_translate'),
						'enable' => __('Enable', 'gdlr_translate'),
					],
					'default' => 'disable'
				]
			);
			$this->add_control( 'carousel-navigation',
				[
					'label' => __( 'Carousel Navigation (If Enable)', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'default' => __('Default', 'gdlr_translate'),
						'bottom'=> __('Bottom' ,'gdlr_translate'),
					],
					'default' => 'default',
				]
			);
			$this->add_control( 'carousel-navigation-text',
				[
					'label' => __( 'Carousel Navigation Text (If Enable)', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'label_block' => true
				]
			);
			$this->add_control( 'carousel-navigation-link',
				[
					'label' => __( 'Carousel Navigation Text Link (If Enable)', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'label_block' => true
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
					'default' => __( 'View all rooms', 'gdlr_translate' )
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

			echo gdlr_print_room_item($settings);

			?>
				<script>
					(function($){
						$(document).ready(function(){
							$('.flexslider').gdlr_flexslider();
						});
					})(jQuery);
				</script>
			<?php	
		}

	}