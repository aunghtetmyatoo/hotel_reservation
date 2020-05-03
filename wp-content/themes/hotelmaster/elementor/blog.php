<?php	

	add_action( 'elementor/widgets/widgets_registered', 'hotelmaster_register_elementor_blog_widget' );
	function hotelmaster_register_elementor_blog_widget(){
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Hotelmaster_Elementor_Blog_Widget() );
	}

	class Hotelmaster_Elementor_Blog_Widget extends \Elementor\Widget_Base {

		public function get_name() {
			return 'hotelmaster-blog';
		}

		public function get_title() {
			return __( 'Blog', 'gdlr_translate' );
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
					'options' => gdlr_get_term_list('category'),
					'multiple' => true
				]
			);
			$this->add_control( 'tag',
				[
					'label' => __( 'Tag', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::SELECT2,
					'options' => gdlr_get_term_list('post_tag'),
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
			$this->add_control( 'offset',
				[
					'label' => __( 'Offset', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'description'=> __('Fill in number of the posts you want to skip. Please noted that this will not works well with pagination', 'gdlr_translate')				
				]
			);
			$this->add_control( 'enable-sticky',
				[
					'label' => __( 'Prepend Sticky Post', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'enable' => __('Enable', 'gdlr_translate'), 
						'disable' => __('Disable', 'gdlr_translate'), 
					],
					'default' => 'disable'
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
			$this->add_control( 'blog-style',
				[
					'label' => __( 'Blog Style', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'blog-widget' => __('Blog Widget', 'gdlr_translate'),
						'blog-widget-2' => __('Blog Widget 2', 'gdlr_translate'),
						'blog-1-4' => '1/4 ' . __('Blog Grid', 'gdlr_translate'),
						'blog-1-3' => '1/3 ' . __('Blog Grid', 'gdlr_translate'),
						'blog-1-2' => '1/2 ' . __('Blog Grid', 'gdlr_translate'),
						'blog-1-1' => '1/1 ' . __('Blog Grid', 'gdlr_translate'),
						'blog2-1-4' => '1/4 ' . __('Blog Grid 2', 'gdlr_translate'),
						'blog2-1-3' => '1/3 ' . __('Blog Grid 2', 'gdlr_translate'),
						'blog2-1-2' => '1/2 ' . __('Blog Grid 2', 'gdlr_translate'),
						'blog2-1-1' => '1/1 ' . __('Blog Grid 2', 'gdlr_translate'),
						'blog-medium' => __('Blog Medium', 'gdlr_translate'),
						'blog-full' => __('Blog Full', 'gdlr_translate'),
					],
					'default' => 'blog-1-1'
				]
			);
			$this->add_control( 'blog-layout',
				[
					'label' => __( 'Blog Layout', 'gdlr_translate' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'fitRows' =>  __('FitRows ( Order items by row )', 'gdlr_translate'),
						'masonry' => __('Masonry ( Order items by spaces )', 'gdlr_translate'),
						'carousel' => __('Carousel ( Only For Blog Grid )', 'gdlr_translate'),
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

			echo gdlr_get_blog_item($settings);

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