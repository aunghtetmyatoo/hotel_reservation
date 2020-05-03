<?php	

	add_action( 'elementor/widgets/widgets_registered', 'hotelmaster_register_elementor_testimonial_widget' );
	function hotelmaster_register_elementor_testimonial_widget(){
		if( !function_exists('gdlr_get_testimonial_item') ) return;
		
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Hotelmaster_Elementor_Testimonial_Widget() );
	}

	class Hotelmaster_Elementor_Testimonial_Widget extends \Elementor\Widget_Base {

		public function get_name() {
			return 'hotelmaster-testimonial';
		}

		public function get_title() {
			return __( 'Testimonial', 'gdlr_translate' );
		}

		public function get_icon() {
			return 'fa fa-comments';
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


			$repeater = new \Elementor\Repeater();
			$repeater->add_control( 'gdl_tab_author_image', [
					'label' => __( 'Author Image', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
				]
			);
			$repeater->add_control( 'gdl_tab_title', [
					'label' => __( 'Name', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::TEXT,
				]
			);
			$repeater->add_control( 'gdl_tab_position', [
					'label' => __( 'Position', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::TEXT,
				]
			);
			$repeater->add_control( 'gdl_tab_content', [
					'label' => __( 'Content', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
				]
			);

			$this->add_control( 'hotelmaster-testimonial',
				[
					'label' => __( 'Testimonial', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'gdl_tab_title' => __( 'John Doe', 'gdlr_translate' ),
							'gdl_tab_position' => __( 'Project Manager', 'gdlr_translate' ),
						],
						[
							'gdl_tab_title' => __( 'Mat Thew', 'gdlr_translate' ),
							'gdl_tab_position' => __( 'Developer', 'gdlr_translate' ),
						],
					],
					'title_field' => '{{{ gdl_tab_title }}}',
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
			$this->add_control( 'testimonial-type',
				[
					'label' => __( 'Layout', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'static' => __('Static', 'gdlr_translate'),
						'carousel'=> __('Carousel' ,'gdlr_translate'),
					],
					'default' => 'static',
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
			$this->add_control( 'testimonial-columns',
				[
					'label' => __( 'Columns', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
					],
					'default' => '3',
				]
			);
			$this->add_control( 'testimonial-style',
				[
					'label' => __( 'Style', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'box-style'=>__('Box Style', 'gdlr_translate'),
						'round-style'=>__('Round Style', 'gdlr_translate'),
						'plain-style'=>__('Plain Style', 'gdlr_translate'),
						'large plain-style'=>__('Large Plain Style', 'gdlr_translate'),
						'plain-style2'=>__('Plain Style 2', 'gdlr_translate'),
					],
					'default' => 'box-style',
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
					'type' => \Elementor\Controls_Manager::TEXT
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

			if( !empty($settings['hotelmaster-testimonial']) ){
				$settings['testimonial'] = array();
				foreach( $settings['hotelmaster-testimonial'] as $testimonial ){
					$testimonial['gdl-tab-title'] = empty($testimonial['gdl_tab_title'])? '': $testimonial['gdl_tab_title'];
					$testimonial['gdl-tab-position'] = empty($testimonial['gdl_tab_position'])? '': $testimonial['gdl_tab_position'];
					$testimonial['gdl-tab-content'] = empty($testimonial['gdl_tab_content'])? '': $testimonial['gdl_tab_content'];

					if( !empty($testimonial['gdl_tab_author_image']['id']) ){
						$testimonial['gdl-tab-author-image'] = $testimonial['gdl_tab_author_image']['id'];
					}else{
						$testimonial['gdl-tab-author-image'] = 0;
					}
					
					$settings['testimonial'][] = $testimonial;
				}
				unset($settings['hotelmaster-testimonial']);
			}

			echo gdlr_get_testimonial_item($settings);

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