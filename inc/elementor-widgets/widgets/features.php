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
 * Etrain elementor Team Member section widget.
 *
 * @since 1.0
 */
class Etrain_Features extends Widget_Base {

	public function get_name() {
		return 'etrain-features';
	}

	public function get_title() {
		return __( 'Features', 'etrain' );
	}

	public function get_icon() {
		return 'eicon-info-box';
	}

	public function get_categories() {
		return [ 'etrain-elements' ];
	}

	protected function _register_controls() {

		$repeater = new \Elementor\Repeater();

        // ----------------------------------------  Feature Section ------------------------------
        $this->start_controls_section(
            'features_heading',
            [
                'label' => __( 'Features Heading', 'etrain' ),
            ]
        );
        $this->add_control(
            'feature_header',
            [
                'label'         => esc_html__( 'Feature Header', 'etrain' ),
                'description'   => esc_html__('Use <br> tag for line break', 'etrain'),
                'type'          => Controls_Manager::WYSIWYG,
                'label_block'   => true,
                'default'       => __( '<h2>Awesome <br> Feature</h2><p>Set have great you male grass yielding an yielding first their you\'re have called the abundantly fruit were man </p>', 'etrain' )
            ]
        );
        $this->add_control(
            'btn_lbl',
            [
                'label'         => esc_html__( 'Button Label', 'etrain' ),
                'type'          => Controls_Manager::TEXT,
                'label_block'   => true,
                'default'       => esc_html__( 'Read More', 'etrain' )
            ]
        );
        $this->add_control(
            'btn_url',
            [
                'label'         => esc_html__( 'Button Url', 'etrain' ),
                'type'          => Controls_Manager::URL,
                'show_external' => false,
                'default'       => [
                    'url'       => '#'
                ]
            ]
        );

        $this->end_controls_section(); // End section top content
        
		// ----------------------------------------   Features content ------------------------------
		$this->start_controls_section(
			'features_block',
			[
				'label' => __( 'Features', 'etrain' ),
			]
		);
		$this->add_control(
            'features_content', [
                'label' => __( 'Create Feature', 'etrain' ),
                'type'  => Controls_Manager::REPEATER,
                'title_field' => '{{{ label }}}',
                'fields' => [
                    [
                        'name'      => 'icon',
                        'label'     => __( 'Select Icon', 'etrain' ),
                        'type'      => Controls_Manager::ICON,
                        'default'   => 'fa fa-mobile',
                        'options'   => etrain_flaticon_list()
                    ],
                    [
                        'name'  => 'label',
                        'label' => __( 'Title', 'etrain' ),
                        'type'  => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => __( 'Better Future', 'etrain' )
                    ],
                    [
                        'name'      => 'desc',
                        'label'     => __( 'Descriptions', 'etrain' ),
                        'type'      => Controls_Manager::TEXTAREA,
                        'default'   => __( 'Set have great you male grasses yielding yielding first their to called deep abundantly Set have great you male', 'etrain' )
                    ],
                ],
            ]
        );

		$this->end_controls_section(); // End Features content

        /**
         * Style Tab
         * ------------------------------ Style Tab Content ------------------------------
         *
         */

        // Heading Style ==============================
        $this->start_controls_section(
            'color_sect', [
                'label' => __( 'Style Heading', 'etrain' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'color_secttitle', [
                'label'     => __( 'Title Color', 'etrain' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#0c2e60',
                'selectors' => [
                    '{{WRAPPER}} .feature_part .single_feature_text h2'     => 'color: {{VALUE}};',
                    '{{WRAPPER}} .feature_part .single_feature_part span i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .feature_part .single_feature_part h4'     => 'color: {{VALUE}};',
                ],
            ]
        );    
        $this->add_control(
            'sec_txt_color', [
                'label'     => __( 'Text Color', 'etrain' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#888888',
                'selectors' => [
                    '{{WRAPPER}} .feature_part .single_feature_text p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .feature_part .single_feature_part p' => 'color: {{VALUE}};',
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
                'selector' => '{{WRAPPER}} .feature_part .single_feature_text .btn_1',
            ]
        );

        $this->end_controls_section();


        // Single Feature Color Settings ==============================
        $this->start_controls_section(
            'single_serv_color_sett', [
                'label' => __( 'Single Feature Color Settings', 'etrain' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'icon_bg_color', [
                'label'     => __( 'Icon BG Color', 'etrain' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#f0f4f6',
                'selectors' => [
                    '{{WRAPPER}} .feature_part .single_feature_part span' => 'background-color: {{VALUE}};',
                ],
            ]
        );    
        $this->add_control(
            'section_separator',
            [
                'label'     => __( 'Hover Styles', 'etrain' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );  
        $this->add_control(
            'item_hover_border_color', [
                'label'     => __( 'Item Hover Border Color', 'etrain' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ff663b',
                'selectors' => [
                    '{{WRAPPER}} .feature_part .single_feature:hover .single_feature_part' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'item_hover_icon_color', [
                'label'     => __( 'Item Hover Icon Color', 'etrain' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .feature_part .single_feature:hover span i' => 'color: {{VALUE}};',
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
                'selector' => '{{WRAPPER}} .feature_part',
            ]
        );
        $this->end_controls_section();

        // Item Hover Icon BG Color ==============================
        $this->start_controls_section(
            'item_hover_icon_style_sec', [
                'label' => __( 'Item Hover Icon BG Color', 'etrain' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'item_hover_icon_bg',
                'label' => __( 'Item hover icon BG Color', 'etrain' ),
                'types' => [ 'gradient' ],
                'selector' => '{{WRAPPER}} .feature_part .single_feature:hover span',
            ]
        );

        $this->end_controls_section();


	}

	protected function render() {

    $settings = $this->get_settings();
    $feature_header = !empty( $settings['feature_header'] ) ? $settings['feature_header'] : '';
    $btn_lbl = !empty( $settings['btn_lbl'] ) ? $settings['btn_lbl'] : '';
    $btn_url = !empty( $settings['btn_url']['url'] ) ? $settings['btn_url']['url'] : '';
    $features = !empty( $settings['features_content'] ) ? $settings['features_content'] : '';
    ?>

    <!-- feature_part start-->
    <section class="feature_part">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-xl-3 align-self-center">
                    <div class="single_feature_text ">
                        <?php
                            // Feature Header =============
                            if( $feature_header ){
                                echo wp_kses_post( wpautop( $feature_header ) );
                            }

                            // Button =============
                            if( $btn_lbl ){
                                echo '<a href="'.esc_url( $btn_url ).'" class="btn_1">'.esc_html( $btn_lbl ).'</a>';
                            }
                        ?>
                    </div>
                </div>
                <?php
                if( is_array( $features ) && count( $features ) > 0 ){
                    foreach ( $features as $feature ) {
                        $fontIcon      = !empty( $feature['icon'] ) ? $feature['icon'] : '';
                        $feature_title = !empty( $feature['label'] ) ? $feature['label'] : '';
                        $feature_desc  = !empty( $feature['desc'] ) ? $feature['desc'] : '';
                ?>
                <div class="col-sm-6 col-xl-3">
                    <div class="single_feature">
                        <div class="single_feature_part">
                            <?php
                                if( $fontIcon ){
                                    echo '<span class="single_feature_icon"><i class="'.esc_attr( $fontIcon ).'"></i></span>';
                                }
                            ?>
                            <h4><?php echo esc_html( $feature_title );?></h4>
                            <p><?php echo esc_html( $feature_desc );?></p>
                        </div>
                    </div>
                </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </section>
    <!-- feature_part end-->
    <?php
    }
}
