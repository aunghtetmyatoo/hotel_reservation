<?php	

	add_action( 'elementor/widgets/widgets_registered', 'hotelmaster_register_elementor_portfolio_widget' );
	function hotelmaster_register_elementor_portfolio_widget(){
		if( !function_exists('gdlr_print_portfolio_item') ) return;
		
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Hotelmaster_Elementor_Portfolio_Widget() );
	}

	class Hotelmaster_Elementor_Portfolio_Widget extends \Elementor\Widget_Base {

		public function get_name() {
			return 'hotelmaster-portfolio';
		}

		public function get_title() {
			return __( 'Portfolio', 'gdlr_translate' );
		}

		public function get_icon() {
			return 'fa fa-navicon';
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
					'options' => gdlr_get_term_list('portfolio_category'),
					'multiple' => true
				]
			);
			$this->add_control( 'tag',
				[
					'label' => __( 'Tag', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::SELECT2,
					'options' => gdlr_get_term_list('portfolio_tag'),
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
			$this->add_control( 'portfolio-filter',
				[
					'label' => __( 'Portfolio Filter', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'enable' => __('Enable', 'gdlr_translate'), 
						'disable' => __('Disable', 'gdlr_translate'), 
					],
					'default' => 'disable',
					'description'=> __('*** You have to select only 1 ( or none ) portfolio category when enable this option. This option cannot works with carousel function.','gdlr_translate')
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
			$this->add_control( 'portfolio-style',
				[
					'label' => __( 'Portfolio Style', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'classic-portfolio' => __('Classic Style', 'gdlr_translate'),
						'classic-portfolio-no-space' => __('Classic No Space Style', 'gdlr_translate'),
						'modern-portfolio' => __('Modern Style', 'gdlr_translate'),
						'modern-portfolio-no-space' => __('Modern No Space Style', 'gdlr_translate'),
					],
					'default' => 'classic-portfolio'
				]
			);
			$this->add_control( 'portfolio-size',
				[
					'label' => __( 'Column Size', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'1/4'=>'1/4',
						'1/3'=>'1/3',
						'1/2'=>'1/2',
						'1/1'=>'1/1'
					],
					'default' => '1/3',
				]
			);
			$this->add_control( 'portfolio-layout',
				[
					'label' => __( 'Portfolio Layout', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'fitRows' =>  __('FitRows ( Order items by row )', 'gdlr_translate'),
						'masonry' => __('Masonry ( Order items by spaces )', 'gdlr_translate'),
						'carousel' => __('Carousel ( Only For Grid And Modern Style )', 'gdlr_translate'),
					],
					'default' => 'fitRows',
					'description' => __('For Blog Grid Style', 'gdlr_translate')
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
					'description' => __( 'For classic portfolio style', 'gdlr_translate')
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

			echo gdlr_print_portfolio_item($settings);

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