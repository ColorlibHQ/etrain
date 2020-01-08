<?php
namespace Etrainelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Utils;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;  
}


/**
 *
 * Etrain elementor about us section widget.
 *
 * @since 1.0
 */
class Etrain_Banner extends Widget_Base {

	public function get_name() {
		return 'etrain-banner';
	}

	public function get_title() {
		return __( 'Banner', 'etrain' );
	}

	public function get_icon() {
		return 'eicon-banner';
	}

	public function get_categories() {
		return [ 'etrain-elements' ];
	}

	protected function _register_controls() {

        // ----------------------------------------  content ------------------------------
        $this->start_controls_section(
            'banner_section',
            [
                'label' => __( 'Banner Section Content', 'etrain' ),
            ]
        );
        $this->add_control(
            'banner_content',
            [
                'label'         => esc_html__( 'Banner Content', 'etrain' ),
                'type'          => Controls_Manager::WYSIWYG,
                'default'       => __( '<h5>Every child yearns to learn</h5><h1>Making Your Childs World Better</h1><p>Replenish seasons may male hath fruit beast were seas saw you arrie said man beast whales his void unto last session for bite. Set have great you\'ll male grass yielding yielding man</p>', 'etrain' )
            ]
        );
        $this->add_control(
            'banner_btn_label1',
            [
                'label'         => esc_html__( 'Button Label 1', 'etrain' ),
                'type'          => Controls_Manager::TEXT,
                'label_block'   => true,
                'default'       => esc_html__( 'View Course', 'etrain' )
            ]
        );
        $this->add_control(
            'banner_btn_url1',
            [
                'label'         => esc_html__( 'Button Url 1', 'etrain' ),
                'type'          => Controls_Manager::URL,
                'show_external' => false
            ]
        );
        $this->add_control(
            'banner_btn_label2',
            [
                'label'         => esc_html__( 'Button Label 2', 'etrain' ),
                'type'          => Controls_Manager::TEXT,
                'label_block'   => true,
                'default'       => esc_html__( 'Get Started', 'etrain' )
            ]
        );
        $this->add_control(
            'banner_btn_url2',
            [
                'label'         => esc_html__( 'Button Url 2', 'etrain' ),
                'type'          => Controls_Manager::URL,
                'show_external' => false
            ]
        );

        $this->end_controls_section(); // End content


        /**
         * Style Tab
         * ------------------------------ Background Style ------------------------------
         *
         */

        // Heading Style ==============================
        $this->start_controls_section(
            'color_sect', [
                'label' => __( 'Banner Heading Style', 'etrain' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'color_secttitle', [
                'label'     => __( 'Section Title Color', 'etrain' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#556172',
                'selectors' => [
                    '{{WRAPPER}} .banner_part .banner_text h5' => 'color: {{VALUE}};',
                ],
            ]
        );    
        $this->add_control(
            'bigger_title_color', [
                'label'     => __( 'Bigger Title Color', 'etrain' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#0c2e60',
                'selectors' => [
                    '{{WRAPPER}} .banner_part .banner_text h1' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'banner_txt_color', [
                'label'     => __( 'Banner Text Color', 'etrain' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#777777',
                'selectors' => [
                    '{{WRAPPER}} .banner_part .banner_text p' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_section();


        // Button BG Color ==============================
        $this->start_controls_section(
            'btn_bg_color_sec', [
                'label' => __( 'Button BG Color Style', 'etrain' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'btn_bg_color',
                'label' => __( 'Button BG Color', 'etrain' ),
                'types' => [ 'gradient' ],
                'selector' => '{{WRAPPER}} .banner_part .banner_text .btn_1',
            ]
        );

        $this->add_control(
            'section_separator',
            [
                'label'     => __( 'Second Button Hover Styles', 'etrain' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        ); 

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'btn_sec_bg_color',
                'label' => __( 'Button BG Color', 'etrain' ),
                'types' => [ 'gradient' ],
                'selector' => '{{WRAPPER}} .banner_part .banner_text .btn_2:hover',
            ]
        );

        $this->end_controls_section();

        // Background Style ==============================
        $this->start_controls_section(
            'section_bg', [
                'label' => __( 'Background Shape', 'etrain' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'sectionbg',
                'label' => __( 'Background', 'etrain' ),
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .banner_part',
            ]
        );
        $this->end_controls_section();

        // Background After Style ==============================
        $this->start_controls_section(
            'section_bg_before', [
                'label' => __( 'Banner Right Image', 'etrain' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'sectionbg_before',
                'label' => __( 'Background', 'etrain' ),
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .banner_part:after',
            ]
        );
        $this->end_controls_section();
	}

	protected function render() {
        $settings = $this->get_settings();
        $ban_content = !empty( $settings['banner_content'] ) ? $settings['banner_content'] : '';
        $button_label1 = !empty( $settings['banner_btn_label1'] ) ? $settings['banner_btn_label1'] : '';
        $button_url1 = !empty( $settings['banner_btn_url1']['url'] ) ? $settings['banner_btn_url1']['url'] : '';
        $button_label2 = !empty( $settings['banner_btn_label2'] ) ? $settings['banner_btn_label2'] : '';
        $button_url2 = !empty( $settings['banner_btn_url2']['url'] ) ? $settings['banner_btn_url2']['url'] : '';
    ?>

    <!-- banner part start-->
    <section class="banner_part">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-xl-6">
                    <div class="banner_text">
                        <div class="banner_text_iner">
                            <?php
                                //Content ==============
                                if( $ban_content ){
                                    echo wp_kses_post( wpautop( $ban_content ) );
                                }
                                // Button1 =============
                                if( $button_label1 ){
                                    echo '<a class="btn_1" href="'. esc_url( $button_url1 ) .'">'. esc_html( $button_label1 ) .' </a>';
                                }
                                // Button2 =============
                                if( $button_label2 ){
                                    echo '<a class="btn_2" href="'. esc_url( $button_url2 ) .'">'. esc_html( $button_label2 ) .' </a>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner part end-->     
    <?php

    }
	
}
