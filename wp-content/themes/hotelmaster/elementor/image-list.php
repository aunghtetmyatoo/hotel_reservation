<?php

	add_action( 'elementor/widgets/widgets_registered', 'hotelmaster_register_elementor_image_list_widget' );
	function hotelmaster_register_elementor_image_list_widget(){		
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Hotelmaster_Elementor_Widget_Image_List() );
	}

	class Hotelmaster_Elementor_Widget_Image_List extends \Elementor\Widget_Base {

		public function get_name() {
			return 'image-list';
		}

		public function get_title() {
			return __( 'Text With Image List', 'elementor' );
		}

		public function get_icon() {
			return 'eicon-bullet-list';
		}

		public function get_categories() {
			return [ 'hotelmaster' ];
		}

		protected function _register_controls() {
			$this->start_controls_section(
				'section_icon',
				[
					'label' => __( 'List', 'elementor' ),
				]
			);

			$this->add_control(
				'view',
				[
					'label' => __( 'Layout', 'elementor' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'default' => 'traditional',
					'options' => [
						'traditional' => [
							'title' => __( 'Default', 'elementor' ),
							'icon' => 'eicon-editor-list-ul',
						],
						'inline' => [
							'title' => __( 'Inline', 'elementor' ),
							'icon' => 'eicon-ellipsis-h',
						],
					],
					'render_type' => 'template',
					'classes' => 'elementor-control-start-end',
					'label_block' => false,
					'style_transfer' => true,
					'prefix_class' => 'elementor-icon-list--layout-',
				]
			);

			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'text',
				[
					'label' => __( 'Text', 'elementor' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'label_block' => true,
					'placeholder' => __( 'List Item', 'elementor' ),
					'default' => __( 'List Item', 'elementor' ),
					'dynamic' => [
						'active' => true,
					],
				]
			);

			$repeater->add_control(
				'image',
				[
					'label' => __( 'Choose Image Icon', 'elementor' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'dynamic' => [
						'active' => true,
					],
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
				]
			);

			$repeater->add_control(
				'link',
				[
					'label' => __( 'Link', 'elementor' ),
					'type' => \Elementor\Controls_Manager::URL,
					'dynamic' => [
						'active' => true,
					],
					'label_block' => true,
					'placeholder' => __( 'https://your-link.com', 'elementor' ),
				]
			);

			$this->add_control(
				'icon_list',
				[
					'label' => '',
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'text' => __( 'List Item #1', 'elementor' ),
							'image' => array()
						],
						[
							'text' => __( 'List Item #2', 'elementor' ),
							'image' => array()
						],
						[
							'text' => __( 'List Item #3', 'elementor' ),
							'image' => array()
						],
					]
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_icon_list',
				[
					'label' => __( 'List', 'elementor' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'space_between',
				[
					'label' => __( 'Space Between', 'elementor' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max' => 50,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-list-items:not(.elementor-inline-items) .elementor-icon-list-item:not(:last-child)' => 'padding-bottom: calc({{SIZE}}{{UNIT}}/2)',
						'{{WRAPPER}} .elementor-icon-list-items:not(.elementor-inline-items) .elementor-icon-list-item:not(:first-child)' => 'margin-top: calc({{SIZE}}{{UNIT}}/2)',
						'{{WRAPPER}} .elementor-icon-list-items.elementor-inline-items .elementor-icon-list-item' => 'margin-right: calc({{SIZE}}{{UNIT}}/2); margin-left: calc({{SIZE}}{{UNIT}}/2)',
						'{{WRAPPER}} .elementor-icon-list-items.elementor-inline-items' => 'margin-right: calc(-{{SIZE}}{{UNIT}}/2); margin-left: calc(-{{SIZE}}{{UNIT}}/2)',
						'body.rtl {{WRAPPER}} .elementor-icon-list-items.elementor-inline-items .elementor-icon-list-item:after' => 'left: calc(-{{SIZE}}{{UNIT}}/2)',
						'body:not(.rtl) {{WRAPPER}} .elementor-icon-list-items.elementor-inline-items .elementor-icon-list-item:after' => 'right: calc(-{{SIZE}}{{UNIT}}/2)',
					],
				]
			);

			$this->add_responsive_control(
				'icon_align',
				[
					'label' => __( 'Alignment', 'elementor' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => __( 'Left', 'elementor' ),
							'icon' => 'eicon-h-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'elementor' ),
							'icon' => 'eicon-h-align-center',
						],
						'right' => [
							'title' => __( 'Right', 'elementor' ),
							'icon' => 'eicon-h-align-right',
						],
					],
					'prefix_class' => 'elementor%s-align-',
				]
			);

			$this->add_control(
				'divider',
				[
					'label' => __( 'Divider', 'elementor' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_off' => __( 'Off', 'elementor' ),
					'label_on' => __( 'On', 'elementor' ),
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-list-item:not(:last-child):after' => 'content: ""',
					],
					'separator' => 'before',
				]
			);

			$this->add_control(
				'divider_style',
				[
					'label' => __( 'Style', 'elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'solid' => __( 'Solid', 'elementor' ),
						'double' => __( 'Double', 'elementor' ),
						'dotted' => __( 'Dotted', 'elementor' ),
						'dashed' => __( 'Dashed', 'elementor' ),
					],
					'default' => 'solid',
					'condition' => [
						'divider' => 'yes',
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-list-items:not(.elementor-inline-items) .elementor-icon-list-item:not(:last-child):after' => 'border-top-style: {{VALUE}}',
						'{{WRAPPER}} .elementor-icon-list-items.elementor-inline-items .elementor-icon-list-item:not(:last-child):after' => 'border-left-style: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'divider_weight',
				[
					'label' => __( 'Weight', 'elementor' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'default' => [
						'size' => 1,
					],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 20,
						],
					],
					'condition' => [
						'divider' => 'yes',
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-list-items:not(.elementor-inline-items) .elementor-icon-list-item:not(:last-child):after' => 'border-top-width: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .elementor-inline-items .elementor-icon-list-item:not(:last-child):after' => 'border-left-width: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_control(
				'divider_width',
				[
					'label' => __( 'Width', 'elementor' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'default' => [
						'unit' => '%',
					],
					'condition' => [
						'divider' => 'yes',
						'view!' => 'inline',
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-list-item:not(:last-child):after' => 'width: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_control(
				'divider_height',
				[
					'label' => __( 'Height', 'elementor' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ '%', 'px' ],
					'default' => [
						'unit' => '%',
					],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 100,
						],
						'%' => [
							'min' => 1,
							'max' => 100,
						],
					],
					'condition' => [
						'divider' => 'yes',
						'view' => 'inline',
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-list-item:not(:last-child):after' => 'height: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_control(
				'divider_color',
				[
					'label' => __( 'Color', 'elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#ddd',
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_3,
					],
					'condition' => [
						'divider' => 'yes',
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-list-item:not(:last-child):after' => 'border-color: {{VALUE}}',
					],
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_icon_style',
				[
					'label' => __( 'Image', 'elementor' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_responsive_control(
				'icon_size',
				[
					'label' => __( 'Size', 'elementor' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'default' => [
						'size' => 14,
					],
					'range' => [
						'px' => [
							'min' => 6,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-list-icon' => 'max-width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'margin_right',
				[
					'label' => __( 'Margin Right', 'elementor' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'default' => [
						'size' => 10,
					],
					'range' => [
						'px' => [
							'max' => 50,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-list-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'margin_top',
				[
					'label' => __( 'Margin Top', 'elementor' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'default' => [
						'size' => 0,
					],
					'range' => [
						'px' => [
							'max' => 50,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-list-icon' => 'margin-top: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_text_style',
				[
					'label' => __( 'Text', 'elementor' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'text_color',
				[
					'label' => __( 'Text Color', 'elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-list-text' => 'color: {{VALUE}};',
					],
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_2,
					],
				]
			);

			$this->add_control(
				'text_color_hover',
				[
					'label' => __( 'Hover', 'elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-list-item:hover .elementor-icon-list-text' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'text_indent',
				[
					'label' => __( 'Text Indent', 'elementor' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max' => 50,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-list-text' => is_rtl() ? 'padding-right: {{SIZE}}{{UNIT}};' : 'padding-left: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'icon_typography',
					'selector' => '{{WRAPPER}} .elementor-icon-list-item',
					'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_3,
				]
			);

			$this->end_controls_section();
		}

		/**
		 * Render icon list widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @since 1.0.0
		 * @access protected
		 */
		protected function render() {
			$settings = $this->get_settings_for_display();

			$this->add_render_attribute( 'icon_list', 'class', 'elementor-icon-list-items' );
			$this->add_render_attribute( 'list_item', 'class', 'elementor-icon-list-item' );

			if ( 'inline' === $settings['view'] ) {
				$this->add_render_attribute( 'icon_list', 'class', 'elementor-inline-items' );
				$this->add_render_attribute( 'list_item', 'class', 'elementor-inline-item' );
			}
			?>
			<ul <?php echo $this->get_render_attribute_string( 'icon_list' ); ?>>
				<?php
				foreach ( $settings['icon_list'] as $index => $item ) :
					$repeater_setting_key = $this->get_repeater_setting_key( 'text', 'icon_list', $index );

					$this->add_render_attribute( $repeater_setting_key, 'class', 'elementor-icon-list-text' );

					$this->add_inline_editing_attributes( $repeater_setting_key );
					?>
					<li class="elementor-icon-list-item" >
						<?php
						if ( ! empty( $item['link']['url'] ) ) {
							$link_key = 'link_' . $index;

							$this->add_render_attribute( $link_key, 'href', $item['link']['url'] );

							if ( $item['link']['is_external'] ) {
								$this->add_render_attribute( $link_key, 'target', '_blank' );
							}

							if ( $item['link']['nofollow'] ) {
								$this->add_render_attribute( $link_key, 'rel', 'nofollow' );
							}

							echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
						}

						if ( ! empty( $item['image']['url'] ) ) :
							?>
							<span class="elementor-icon-list-icon">
								<?php
									echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $item );
								?>
							</span>
						<?php endif; ?>
						<span <?php echo $this->get_render_attribute_string( $repeater_setting_key ); ?>><?php echo $item['text']; ?></span>
						<?php if ( ! empty( $item['link']['url'] ) ) : ?>
							</a>
						<?php endif; ?>
					</li>
					<?php
				endforeach;
				?>
			</ul>
			<?php
		}

		/**
		 * Render icon list widget output in the editor.
		 *
		 * Written as a Backbone JavaScript template and used to generate the live preview.
		 *
		 * @since 1.0.0
		 * @access protected
		 */
		protected function _content_template() {
			?>
			<#
				view.addRenderAttribute( 'icon_list', 'class', 'elementor-icon-list-items' );
				view.addRenderAttribute( 'list_item', 'class', 'elementor-icon-list-item' );

				if ( 'inline' == settings.view ) {
					view.addRenderAttribute( 'icon_list', 'class', 'elementor-inline-items' );
					view.addRenderAttribute( 'list_item', 'class', 'elementor-inline-item' );
				}
			#>
			<# if ( settings.icon_list ) { #>
				<ul {{{ view.getRenderAttributeString( 'icon_list' ) }}}>
				<# _.each( settings.icon_list, function( item, index ) {

						var iconTextKey = view.getRepeaterSettingKey( 'text', 'icon_list', index );

						view.addRenderAttribute( iconTextKey, 'class', 'elementor-icon-list-text' );

						view.addInlineEditingAttributes( iconTextKey ); #>

						<li {{{ view.getRenderAttributeString( 'list_item' ) }}}>
							<# if ( item.link && item.link.url ) { #>
								<a href="{{ item.link.url }}">
							<# } #>
							<# if ( item.image.url ) { #>
							<span class="elementor-icon-list-icon">
								<img src="{{ item.image.url }}" ></i>
							</span>
							<# } #>
							<span {{{ view.getRenderAttributeString( iconTextKey ) }}}>{{{ item.text }}}</span>
							<# if ( item.link && item.link.url ) { #>
								</a>
							<# } #>
						</li>
					<#
					} ); #>
				</ul>
			<#	} #>

			<?php
		}
	}
