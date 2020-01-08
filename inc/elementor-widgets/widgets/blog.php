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
 * Etrain elementor few words section widget.
 *
 * @since 1.0
 */

class Etrain_Blog extends Widget_Base {

	public function get_name() {
		return 'etrain-blog';
	}

	public function get_title() {
		return __( 'Blog', 'etrain' );
	}

	public function get_icon() {
		return 'eicon-post-list';
	}

	public function get_categories() {
		return [ 'etrain-elements' ];
	}

	protected function _register_controls() {

        // ----------------------------------------  Blog content ------------------------------
        $this->start_controls_section(
            'blog_content',
            [
                'label' => __( 'Latest Blog Post', 'etrain' ),
            ]
        );
		$this->add_control(
			'sec_title',
			[
				'label'         => esc_html__( 'Title', 'etrain' ),
				'description'   => __( "Use < span> tag for color and italic word", "etrain" ),
				'type'          => Controls_Manager::WYSIWYG,
				'label_block'   => true,
				'default'       => __( '<p>Our Blog</p><h2>Students Blog</h2>', 'etrain' )
			]
		);

        $this->end_controls_section(); // End few words content


        // ----------------------------------------  Blog inner content ------------------------------
        $this->start_controls_section(
            'blog_post_sec',
            [
                'label' => __( 'Blog Post Settings', 'etrain' ),
            ]
        );
		$this->add_control(
			'post_num',
			[
				'label'         => esc_html__( 'Post Item', 'etrain' ),
				'type'          => Controls_Manager::NUMBER,
				'label_block'   => false,
                'default'       => absint(3),
                'min'           => 1,
                'max'           => 6,
			]
		);
		$this->add_control(
			'post_exc',
			[
				'label'         => esc_html__( 'Post Excerpt Length', 'etrain' ),
				'type'          => Controls_Manager::NUMBER,
				'label_block'   => false,
                'default'       => absint(13),
                'min'           => 5,
                'max'           => 20
			]
		);
		$this->add_control(
			'post_order',
			[
				'label'         => esc_html__( 'Post Order', 'etrain' ),
				'type'          => Controls_Manager::SWITCHER,
				'label_block'   => false,
				'label_on'      => 'ASC',
				'label_off'     => 'DESC',
                'default'       => 'yes',
                'options'       => [
                    'no'        => 'ASC',
                    'yes'       => 'DESC'
                ]
			]
		);

        $this->end_controls_section(); // End few words content

        //------------------------------ Style Section ------------------------------
        $this->start_controls_section(
            'style_section', [
                'label' => __( 'Style Section Heading', 'etrain' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'color_secttitle', [
                'label'     => __( 'Section Title Color', 'etrain' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#556172',
                'selectors' => [
                    '{{WRAPPER}} .blog_part .section_tittle p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_big_title', [
                'label'     => __( 'Big Title Color', 'etrain' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#0c2e60',
                'selectors' => [
                    '{{WRAPPER}} .blog_part .section_tittle h2' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .blog_part .single-home-blog .card h5' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'section_separator',
            [
                'label'     => __( 'Category BG Styles', 'etrain' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        ); 

        $this->add_control(
            'cat_bg_col', [
                'label'     => __( 'Category BG Color', 'etrain' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ff663b',
                'selectors' => [
                    '{{WRAPPER}} .blog_part .single-home-blog .card .card-body .btn_4' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();


        /**
         * Style Tab
         * ------------------------------ Background Style ------------------------------
         *
         */
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
                'selector' => '{{WRAPPER}} .blog_part',
            ]
        );

        $this->end_controls_section();
	}

	protected function render() {

    $settings   = $this->get_settings();
    $title      = !empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
    $post_num   = !empty( $settings['post_num'] ) ? $settings['post_num'] : '';
    $post_exc   = !empty( $settings['post_exc'] ) ? $settings['post_exc'] : '';
    $post_order = !empty( $settings['post_order'] ) ? $settings['post_order'] : '';
    $post_order = $post_order == 'yes' ? 'DESC' : 'ASC';
    ?>

    <!--::blog_part start::-->
    <section class="blog_part section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5">
                    <div class="section_tittle text-center">
                        <?php
                            //Header Content ==============
                            if( $title ){
                                echo wp_kses_post( wpautop( $title ) );
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <?php
                    if( function_exists( 'etrain_latest_blog' ) ) {
                        etrain_latest_blog( $post_num, $post_exc, $post_order );
                    }
                ?>
            </div>
        </div>
    </section>
    <!--::blog_part end::-->
    <?php
	}
}
