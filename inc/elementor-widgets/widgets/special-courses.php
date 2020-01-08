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
 * elementor projects section widget.
 *
 * @since 1.0
 */
class Etrain_Special_Courses extends Widget_Base {

	public function get_name() {
		return 'etrain-special-courses';
	}

	public function get_title() {
		return __( 'Special Courses', 'etrain' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return [ 'etrain-elements' ];
	}

	protected function _register_controls() {

        $this->start_controls_section(
			'section_heading',
			[
				'label' => __( 'Section Heading', 'etrain' ),
			]
        );
        
        $this->add_control(
            'sec_heading',
            [
                'label'         => esc_html__( 'Heading Text', 'etrain' ),
                'type'          => Controls_Manager::WYSIWYG,
                'default'       => __( '<p>popular courses</p><h2>Special Courses</h2>', 'etrain' )
            ]
        );
		$this->end_controls_section(); 


        // ----------------------------------------  Projects Content ------------------------------
        $this->start_controls_section(
            'menu_tab_sec',
            [
                'label' => __( 'Courses', 'etrain' ),
            ]
        );
        $this->add_control(
			'course_order',
			[
				'label'         => esc_html__( 'Course Order', 'etrain' ),
				'type'          => Controls_Manager::SWITCHER,
				'label_block'   => false,
				'label_on'      => 'DESC',
				'label_off'     => 'ASC',
                'default'       => 'yes',
                'options'       => [
                    'no'        => 'ASC',
                    'yes'       => 'DESC'
                ]
			]
		);
		$this->add_control(
			'excerpt_limit', [
				'label'         => esc_html__( 'Excerpt Limit', 'etrain' ),
				'type'          => Controls_Manager::NUMBER,
				'min'           => 1,
				'default'       => 15
			]
		);
		$this->add_control(
			'course_item', [
				'label'         => esc_html__( 'Course Item', 'etrain' ),
				'type'          => Controls_Manager::NUMBER,
				'max'           => 6,
				'min'           => 1,
				'step'          => 1,
				'default'       => 3

			]
		);

        $this->end_controls_section(); // End projects content

        //------------------------------ Color Settings ------------------------------
        $this->start_controls_section(
            'color_settings', [
                'label' => __( 'Color Settings', 'etrain' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'sec_title_color', [
                'label'     => __( 'Section Title Color', 'etrain' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#556172',
                'selectors' => [
                    '{{WRAPPER}} .special_cource .section_tittle p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .special_cource .single_special_cource .special_cource_text .author_info .author_img p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'big_title_trainer_name_color', [
                'label'     => __( 'Big & Course Title & Trainer Name Color', 'etrain' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#0c2e60',
                'selectors' => [
                    '{{WRAPPER}} .special_cource .section_tittle h2' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .special_cource .single_special_cource .special_cource_text h3' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .special_cource .single_special_cource .special_cource_text .author_info .author_img h5' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'course_cat_fee_bg_color', [
                'label'     => __( 'Course Cat BG & Fee Color', 'etrain' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ff663b',
                'selectors' => [
                    '{{WRAPPER}} .special_cource .single_special_cource .special_cource_text .btn_4' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .special_cource .single_special_cource .special_cource_text h4' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'course_text_color', [
                'label'     => __( 'Other Text Color', 'etrain' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#888',
                'selectors' => [
                    '{{WRAPPER}} .special_cource .single_special_cource .special_cource_text p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .special_cource .single_special_cource .special_cource_text .author_info .author_rating p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

        // Background Style ==============================
        $this->start_controls_section(
            'section_bg', [
                'label' => __( 'Style Background', 'etrain' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'sectionbg',
                'label' => __( 'Background', 'etrain' ),
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .special_cource',
            ]
        );

        $this->end_controls_section();

	}

	protected function render() {

    $settings = $this->get_settings();
    $sec_heading = !empty( $settings['sec_heading'] ) ? $settings['sec_heading'] : '';
    $cOrder = $settings['course_order'] == 'yes' ? 'DESC' : 'ASC';
    $excerpt_limit = $settings['excerpt_limit'];
    $cNumber = $settings['course_item'];
    ?>

    <!--::special_course_part start::-->
    <section class="special_cource padding_top">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5">
                    <div class="section_tittle text-center">
                        <?php
                            //Section heading ==============
                            if( $sec_heading ){
                                echo wp_kses_post( wpautop( $sec_heading ) );
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <?php
                    etrain_special_courses( $cNumber, $cOrder, $excerpt_limit );
                ?>
            </div>
        </div>
    </div>
    <!--::special_course_part end::-->
    <?php

    }
}
