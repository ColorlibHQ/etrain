<?php
namespace Etrainelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 *
 * Etrain elementor section widget.
 *
 * @since 1.0
 */
class Etrain_Counter extends Widget_Base {

	public function get_name() {
		return 'etrain-counter';
	}

	public function get_title() {
		return __( 'Counter', 'etrain' );
	}

	public function get_icon() {
		return 'eicon-countdown';
	}

	public function get_categories() {
		return [ 'etrain-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  Customers review content ------------------------------
		$this->start_controls_section(
			'counter_label_content',
			[
				'label' => __( 'Counter Setting', 'etrain' ),
			]
		);

		$this->add_control(
            'counter_contents', [
                'label' => __( 'Create New', 'etrain' ),
                'type'  => Controls_Manager::REPEATER,
                'title_field' => '{{{ count_lbl }}}',
                'fields' => [
                    [
                        'name'  => 'count_val',
                        'label' => __( 'Counter Value', 'etrain' ),
                        'type'  => Controls_Manager::NUMBER,
                        'label_block' => true,
                        'default' => 1024
                    ],
                    [
                        'name'  => 'count_lbl',
                        'label' => __( 'Counter Label', 'etrain' ),
                        'type'  => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => 'All Teachers'
                    ]
                    
                ]
            ]
		);

		$this->end_controls_section(); // End exibition content

        /**
         * Style Tab
         *
         */
		//------------------------------ Style Section ------------------------------
		
		$this->start_controls_section(
			'style_item',
			[
				'label' => __( 'Style Item', 'etrain' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'counter_color', [
                'label'     => __( 'Counter Text Color', 'etrain' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .member_counter .single_member_counter span' => 'color: {{VALUE}};',
                ],
                'default'   => '#fff'
            ]
        );
        $this->add_control(
            'text_color', [
                'label'     => __( 'Text Color', 'etrain' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .member_counter .single_member_counter h4' => 'color: {{VALUE}};',
                ],
                'default'   => '#fff'
            ]
        );

		$this->end_controls_section();



        /*------------------------------ Background Style ------------------------------*/
		$this->start_controls_section(
            'section_bg', [
                'label' => __( 'Style Background', 'etrain' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'section_bgheading',
            [
                'label'     => __( 'Background Settings', 'etrain' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'sectionbg',
                'label' => __( 'Background', 'etrain' ),
                'types' => [ 'gradient' ],
                'selector' => '{{WRAPPER}} .member_counter',
            ]
        );

        $this->end_controls_section();

	}

	protected function render() {

    $settings = $this->get_settings();
    // call load widget script
	$this->load_widget_script();
    $counter_contents = !empty( $settings['counter_contents'] ) ? $settings['counter_contents'] : '';
    ?>

    <!-- member_counter counter start -->
    <section class="member_counter">
        <div class="container">
            <div class="row">
                <?php
                if( is_array( $counter_contents ) && count( $counter_contents ) > 0 ){
                    foreach ($counter_contents as $counter ) {
                        $count_val = !empty( $counter['count_val'] ) ? $counter['count_val'] : '';
                        $count_lbl = !empty( $counter['count_lbl'] ) ? $counter['count_lbl'] : '';
                    ?>
                <div class="col-lg-3 col-sm-6">
                    <div class="single_member_counter">
                        <span class="counter"><?php echo esc_html( $count_val )?></span>
                        <h4><?php echo esc_html( $count_lbl )?></h4>
                    </div>
                </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </section>
    <!-- member_counter counter end -->
    <?php

    }

    public function load_widget_script(){
        if( \Elementor\Plugin::$instance->editor->is_edit_mode() === true  ) {
        ?>
        <script>
        ( function( $ ){
            $('.counter').counterUp({
                time: 2000
            });
        })(jQuery);
        </script>
        <?php 
        }
    }
	
}
