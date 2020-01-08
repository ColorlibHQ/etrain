<?php
namespace Etrainelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
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
class Etrain_About extends Widget_Base {

	public function get_name() {
		return 'etrain-about';
	}

	public function get_title() {
		return __( 'About', 'etrain' );
	}

	public function get_icon() {
		return 'eicon-video-camera';
	}

	public function get_categories() {
		return [ 'etrain-elements' ];
	}

	protected function _register_controls() {

        
		// ----------------------------------------  About content ------------------------------
		$this->start_controls_section(
			'about_content',
			[
				'label' => __( 'About Section', 'etrain' ),
			]
		);
        
        $this->add_control(
			'left_img',
			[
				'label'         => esc_html__( 'Left Image', 'etrain' ),
                'type'          => Controls_Manager::MEDIA,
                'default'       => [
                    'url'       => Utils::get_placeholder_image_src(),
                ]
			]
		);
        $this->add_control(
            'content',
            [
                'label'         => esc_html__( 'Right Text', 'etrain' ),
                'description'   => esc_html__('Use <br> tag for line break', 'etrain'),
                'type'          => Controls_Manager::WYSIWYG,
                'label_block'   => true,
                'default'       => __( '<h5>About us</h5><h2>Learning with Love and Laughter</h2><p>Fifth saying upon divide divide rule for deep their female all hath brind Days and beast greater grass signs abundantly have greater also days years under brought moveth.</p>', 'etrain' )
            ]
        );

        $this->add_control(
            'icon_sec_heading',
            [
                'label'     => __( 'Listing Contents', 'etrain' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'list_contents', [
                'label' => __( 'Create New', 'etrain' ),
                'type'  => Controls_Manager::REPEATER,
                'title_field' => '{{{ text }}}',
                'fields' => [
                    [
                        'name'      => 'list_icon',
                        'label'     => __( 'Select Icon', 'etrain' ),
                        'type'      => Controls_Manager::ICON,
                        'default'   => 'fa fa-pencil-square-o',
                        'options'   => etrain_themify_icon()
                    ],
                    [
                        'name'  => 'text',
                        'label' => __( 'List Text', 'etrain' ),
                        'type'  => Controls_Manager::TEXTAREA,
                        'label_block' => true,
                        'default' => __( 'Him lights given i heaven second yielding seas gathered wear', 'etrain' )
                    ],
                    
                ]
            ]
        );
        $this->add_control(
            'btnlabel',
            [
                'label'         => esc_html__( 'Button Label', 'etrain' ),
                'type'          => Controls_Manager::TEXT,
                'label_block'   => true,
                'default'       => esc_html__( 'Read More', 'etrain' )
            ]
        );
        $this->add_control(
            'btnurl',
            [
                'label'         => esc_html__( 'Button Url', 'etrain' ),
                'type'          => Controls_Manager::URL,
                'show_external' => false,
                'default'       => [
                    'url'       => '#'
                ]
            ]
        );
        
		$this->end_controls_section(); // End about content

        // Color Settings ==============================
        $this->start_controls_section(
            'color_sect', [
                'label' => __( 'Style Heading', 'etrain' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
			'title_color', [
				'label'     => __( 'Title Color', 'etrain' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#556172',
				'selectors' => [
					'{{WRAPPER}} .learning_part .learning_member_text h5' => 'color: {{VALUE}};',
				],
			]
        );
		$this->add_control(
			'bigger_title_color', [
				'label'     => __( 'Bigger Title Color', 'etrain' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0c2e60',
				'selectors' => [
					'{{WRAPPER}} .learning_part .learning_member_text h2' => 'color: {{VALUE}};',
				],
			]
        );

		$this->add_control(
			'txt_color', [
				'label'     => __( 'Text Color', 'etrain' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#888',
				'selectors' => [
					'{{WRAPPER}} .learning_part .learning_member_text p' => 'color: {{VALUE}};',
					'{{WRAPPER}} .learning_part .learning_member_text ul li' => 'color: {{VALUE}};',
				],
			]
		);
        $this->end_controls_section();

        /**
         * Style Tab
         * ------------------------------ Background Style ------------------------------
         *
         */

        // Button Background Style ==============================
        $this->start_controls_section(
            'btn_bg_sec', [
                'label' => __( 'Button Background Color Settings', 'etrain' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'btn_bg',
                'label' => __( 'Button Background Color', 'etrain' ),
                'types' => [ 'gradient' ],
                'selector' => '{{WRAPPER}} .learning_part .learning_member_text .btn_1',
            ]
        );
        $this->end_controls_section();

        // Style Background
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
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .learning_part',
            ]
        );

        $this->end_controls_section();

        // Learning part bg shade image
        $this->start_controls_section(
            'section_shade_img', [
                'label' => __( 'Left Image BG Shade', 'etrain' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'shade_img_sett',
            [
                'label'     => __( 'Shade Image Settings', 'etrain' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'section_shade_image',
                'label' => __( 'Shade Image', 'etrain' ),
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .learning_part .learning_img',
            ]
        );

        $this->end_controls_section();
	}

	protected function render() {
        $settings     = $this->get_settings();    
		$left_img     = !empty( $settings['left_img']['id'] ) ? wp_get_attachment_image( $settings['left_img']['id'], 'etrain_about_section_703x485', array( 'alt' => 'learning left image' ) ) : '';
        $right_text   = !empty( $settings['content'] ) ? $settings['content'] : '';
        $list_contents= !empty( $settings['list_contents'] ) ? $settings['list_contents'] : '';
        $button_label = !empty( $settings['btnlabel'] ) ? $settings['btnlabel'] : '';
        $button_url   = !empty( $settings['btnurl']['url'] ) ? $settings['btnurl']['url'] : '';
        ?>

    <!-- learning part start-->
    <section class="learning_part">
        <div class="container">
            <div class="row align-items-sm-center align-items-lg-stretch">
                <div class="col-md-7 col-lg-7">
                    <div class="learning_img">
                        <?php
                            if( $left_img ){
                                echo wp_kses_post( $left_img );
                            }
                        ?>
                    </div>
                </div>
                <div class="col-md-5 col-lg-5">
                    <div class="learning_member_text">
                        <?php
                            //Content ==============
                            if( $right_text ){
                                echo wp_kses_post( wpautop( $right_text ) );
                            }

                            //List Content ==============
                            if( is_array( $list_contents ) && count( $list_contents ) > 0 ){
                                echo '<ul>';
                                foreach ( $list_contents as $list_content ) {
                                    $list_icon = !empty( $list_content['list_icon'] ) ? $list_content['list_icon'] : '';
                                    $text = !empty( $list_content['text'] ) ? $list_content['text'] : '';
                                
                                    echo '<li><span class="'.esc_attr($list_icon).'"></span>'.esc_html($text).'</li>';
                                }
                                echo '</ul>';
                            }

                            // Button =============
                            if( $button_label ){
                                echo '<a class="btn_1" href="'. esc_url( $button_url ) .'">'. esc_html( $button_label ) .'</a>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- learning part end-->
    <?php

    }

}
