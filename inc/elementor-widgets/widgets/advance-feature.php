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
class Etrain_Advance_Feature extends Widget_Base {

	public function get_name() {
		return 'etrain-advance-feature';
	}

	public function get_title() {
		return __( 'Advance Feature', 'etrain' );
	}

	public function get_icon() {
		return 'eicon-video-camera';
	}

	public function get_categories() {
		return [ 'etrain-elements' ];
	}

	protected function _register_controls() {

        
		// ----------------------------------------  Advance Feature content ------------------------------
		$this->start_controls_section(
			'advance_feature_content',
			[
				'label' => __( 'Advance Feature Section', 'etrain' ),
			]
		);
        
        $this->add_control(
            'content',
            [
                'label'         => esc_html__( 'Left Text', 'etrain' ),
                'description'   => esc_html__('Use <br> tag for line break', 'etrain'),
                'type'          => Controls_Manager::WYSIWYG,
                'label_block'   => true,
                'default'       => __( '<h5>Advance feature</h5><h2>Our Advance Educator Learning System</h2><p>Fifth saying upon divide divide rule for deep their female all hath brind mid Days and beast greater grass signs abundantly have greater also use over face earth days years under brought moveth she star</p>', 'etrain' )
            ]
        );

        $this->add_control(
            'icon_sec_heading',
            [
                'label'     => __( 'Feature Items', 'etrain' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        
        $this->add_control(
            'list_contents', [
                'label' => __( 'Create New', 'etrain' ),
                'type'  => Controls_Manager::REPEATER,
                'title_field' => '{{{ title }}}',
                'fields' => [
                    [
                        'name'      => 'list_icon',
                        'label'     => __( 'Select Icon', 'etrain' ),
                        'type'      => Controls_Manager::ICON,
                        'default'   => 'fa fa-pencil-square-o',
                        'options'   => etrain_themify_icon()
                    ],
                    [
                        'name'  => 'title',
                        'label' => __( 'Feature Title', 'etrain' ),
                        'type'  => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => __( 'Learn Anywhere', 'etrain' )
                    ],
                    [
                        'name'  => 'short_text',
                        'label' => __( 'Short Text', 'etrain' ),
                        'type'  => Controls_Manager::TEXTAREA,
                        'label_block' => true,
                        'default' => __( 'There earth face earth behold she star so made void two given and also our', 'etrain' )
                    ],
                    
                ]
            ]
        );

        $this->add_control(
            'img_sec_heading',
            [
                'label'     => __( 'Section Right Image', 'etrain' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
			'right_img',
			[
				'label'         => esc_html__( 'Right Image', 'etrain' ),
                'type'          => Controls_Manager::MEDIA,
                'default'       => [
                    'url'       => Utils::get_placeholder_image_src(),
                ]
			]
		);
        
		$this->end_controls_section(); // End about content

        // Color Settings ==============================
        $this->start_controls_section(
            'color_sect', [
                'label' => __( 'Style Text', 'etrain' ),
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
					'{{WRAPPER}} .advance_feature .learning_member_text_iner h4' => 'color: {{VALUE}};',
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


        // Icon Styles ==============================
        $this->start_controls_section(
            'icon_sect', [
                'label' => __( 'Icon Styles', 'etrain' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'icon_color', [
                'label'     => __( 'Icon Color', 'etrain' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#212529',
                'selectors' => [
                    '{{WRAPPER}} .advance_feature .learning_member_text_iner span' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icon_bg', [
                'label'     => __( 'Icon BG Color', 'etrain' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fdeae5',
                'selectors' => [
                    '{{WRAPPER}} .advance_feature .learning_member_text_iner span' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();



        /**
         * Style Tab
         * ------------------------------ Background Style ------------------------------
         *
         */

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
                'selector' => '{{WRAPPER}} .advance_feature',
            ]
        );

        $this->end_controls_section();

        // Learning part bg shade image
        $this->start_controls_section(
            'section_shade_img', [
                'label' => __( 'Right Image BG Shade', 'etrain' ),
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
                'selector' => '{{WRAPPER}} .advance_feature .learning_img',
            ]
        );

        $this->end_controls_section();
	}

	protected function render() {
        $settings     = $this->get_settings();    
        $left_text    = !empty( $settings['content'] ) ? $settings['content'] : '';
        $list_contents= !empty( $settings['list_contents'] ) ? $settings['list_contents'] : '';
		$right_img    = !empty( $settings['right_img']['id'] ) ? wp_get_attachment_image( $settings['right_img']['id'], 'etrain_advance_feature_img_500x508', array( 'alt' => 'learning right image' ) ) : '';
        ?>

    
    <!-- learning part start-->
    <section class="advance_feature learning_part">
        <div class="container">
            <div class="row align-items-sm-center align-items-xl-stretch">
                <div class="col-md-6 col-lg-6">
                    <div class="learning_member_text">
                        <?php
                            //Left Content ==============
                            if( $left_text ){
                                echo wp_kses_post( wpautop( $left_text ) );
                            }

                            //List Content ==============
                            if( is_array( $list_contents ) && count( $list_contents ) > 0 ){
                                echo '<div class="row">';
                                foreach ( $list_contents as $list_content ) {
                                    $list_icon = !empty( $list_content['list_icon'] ) ? $list_content['list_icon'] : '';
                                    $title = !empty( $list_content['title'] ) ? $list_content['title'] : '';
                                    $short_text = !empty( $list_content['short_text'] ) ? $list_content['short_text'] : '';
                                
                                    echo '<div class="col-sm-6 col-md-12 col-lg-6"><div class="learning_member_text_iner"><span class="'.esc_attr($list_icon).'"></span><h4>'.esc_html($title).'</h4><p>'.esc_html($short_text).'</p></div></div>';
                                }
                                echo '</div>';
                            }
                        ?>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="learning_img">
                        <?php
                            if( $right_img ){
                                echo wp_kses_post( $right_img );
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