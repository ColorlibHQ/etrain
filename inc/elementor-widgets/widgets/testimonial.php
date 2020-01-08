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
class Etrain_Testimonial extends Widget_Base {

	public function get_name() {
		return 'etrain-testimonial';
	}

	public function get_title() {
		return __( 'Testimonial', 'etrain' );
	}

	public function get_icon() {
		return 'eicon-post-slider';
	}

	public function get_categories() {
		return [ 'etrain-elements' ];
	}

	protected function _register_controls() {

        // Testimonial Heading
		$this->start_controls_section(
			'section_heading',
			[
				'label' => __( 'Section Heading', 'etrain' ),
			]
		);
        $this->add_control(
            'sec_title',
            [
                'label'         => esc_html__( 'Section Title', 'etrain' ),
                'description'   => __( "Use < span> tag for color and italic word", "etrain" ),
                'type'          => Controls_Manager::WYSIWYG,
                'label_block'   => true,
                'default'       => __( '<p>tesimonials</p><h2>Happy Students</h2>', 'etrain' )
            ]
        );
		$this->end_controls_section(); 

		// ----------------------------------------  Customers review content ------------------------------
		$this->start_controls_section(
			'customersreview_content',
			[
				'label' => __( 'Customers Review', 'etrain' ),
			]
		);

		$this->add_control(
            'review_slider', [
                'label' => __( 'Create Review', 'etrain' ),
                'type'  => Controls_Manager::REPEATER,
                'title_field' => '{{{ label }}}',
                'fields' => [
                    [
                        'name'  => 'client_img',
                        'label' => __( 'Client Image', 'etrain' ),
                        'type'  => Controls_Manager::MEDIA,
                    ],
                    [
                        'name'  => 'desc',
                        'label' => __( 'Client Review Text', 'etrain' ),
                        'type'  => Controls_Manager::TEXTAREA,
                        'default'   => __('Behold place was a multiply creeping creature his domin to thiren open void hath herb divided divide creepeth living shall i call beginning third sea itself set', 'etrain')
                    ],
                    [
                        'name'  => 'label',
                        'label' => __( 'Client Name', 'etrain' ),
                        'type'  => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => esc_html__( 'Michel Hashale', 'etrain' )
                    ],
                    [
                        'name'  => 'designation',
                        'label' => __( 'Designation', 'etrain' ),
                        'type'  => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => esc_html__( 'Sr. Web Designer', 'etrain' )
                    ],
                ],
            ]
		);

		$this->end_controls_section(); // End exibition content

        /**
         * Style Tab
         *
         */
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
					'{{WRAPPER}} .testimonial_part .section_tittle p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'color_bigtitle', [
				'label'     => __( 'Big Title & Client Name Color', 'etrain' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0c2e60',
				'selectors' => [
					'{{WRAPPER}} .testimonial_part .section_tittle h2' => 'color: {{VALUE}};',
					'{{WRAPPER}} .testimonial_part .testimonial_slider_text h4' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'color_rev_txt_color', [
				'label'     => __( 'Review Text & Client Designation Color', 'etrain' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#888',
				'selectors' => [
					'{{WRAPPER}} .testimonial_part .testimonial_slider_text p' => 'color: {{VALUE}};',
					'{{WRAPPER}} .testimonial_part .testimonial_slider_text h5' => 'color: {{VALUE}};',
				],
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
            'sing_item_bg',
            [
                'label'     => __( 'Single Item BG Color', 'etrain' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'sing-rev-bg',
                'label' => __( 'Single Item Background Color', 'etrain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .testimonial_part .testimonial_slider_text',
            ]
        );

        $this->add_control(
            'section_bgheading',
            [
                'label'     => __( 'Section Background Settings', 'etrain' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'total-section-bg',
                'label' => __( 'Section Background', 'etrain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .testimonial_part',
            ]
        );

        $this->end_controls_section();

	}

	protected function render() {

    $settings = $this->get_settings();
    // call load widget script
	$this->load_widget_script();
	$title = !empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
    $reviews = !empty( $settings['review_slider'] ) ? $settings['review_slider'] : '';
    ?>

    <!--::review_part start::-->
    <section class="testimonial_part">
        <div class="container-fluid">
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="textimonial_iner owl-carousel">
                        <?php
                            if( is_array( $reviews ) && count( $reviews ) > 0 ){
                                for ( $i = 0; $i < count( $reviews ); $i++ ) {
                                    $rev_txt  = !empty( $reviews[$i]['desc'] ) ? $reviews[$i]['desc'] : '';
                                    $name     = !empty( $reviews[$i]['label'] ) ? $reviews[$i]['label'] : '';
                                    $desig    = !empty( $reviews[$i]['designation'] ) ? $reviews[$i]['designation'] : '';
                                    $image    = !empty( $reviews[$i]['client_img']['id'] ) ? wp_get_attachment_image( $reviews[$i]['client_img']['id'], 'etrain_testimonial_img_263x311', array('alt' => $reviews[$i]['label'] ) ) : '';
                                ?>
                        <div class="testimonial_slider">
                            <div class="row">
                                <div class="col-lg-8 col-xl-4 col-sm-8 align-self-center">
                                    <div class="testimonial_slider_text">
                                        <?php
                                            //Review Content ==============
                                            if( $rev_txt ){
                                                echo wp_kses_post( wpautop( $rev_txt ) );
                                            }

                                            //Client name ==============
                                            if( $name ){
                                                echo '<h4>'. esc_html( $name ) .'</h4>';
                                            }

                                            //Client designation ==============
                                            if( $desig ){
                                                echo '<h5>'. esc_html( $desig ) .'</h5>';
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xl-2 col-sm-4">
                                    <div class="testimonial_slider_img">
                                        <?php
                                            if( $image ){
                                                echo wp_kses_post( $image );
                                            }
                                        ?>
                                    </div>
                                </div>

                                <?php 
                                    if ( $i != count( $reviews )-1 ){ 
                                        $j = $i+1;
                                    } else {
                                        $j = 0;
                                    }
                                ?>
                                <div class="col-xl-4 d-none d-xl-block">
                                    <div class="testimonial_slider_text">
                                        <?php
                                            $rev_txt_next  = !empty( $reviews[$j]['desc'] ) ? $reviews[$j]['desc'] : '';
                                            $name_next     = !empty( $reviews[$j]['label'] ) ? $reviews[$j]['label'] : '';
                                            $desig_next    = !empty( $reviews[$j]['designation'] ) ? $reviews[$j]['designation'] : '';
                                            $image_next    = !empty( $reviews[$j]['client_img']['id'] ) ? wp_get_attachment_image( $reviews[$j]['client_img']['id'], 'etrain_testimonial_img_263x311', array('alt' => $reviews[$j]['label'] ) ) : '';
                                            
                                            //Review Content ==============
                                            if( $rev_txt_next ){
                                                echo wp_kses_post( wpautop( $rev_txt_next ) );
                                            }

                                            //Client name ==============
                                            if( $name_next ){
                                                echo '<h4>'. esc_html( $name_next ) .'</h4>';
                                            }

                                            //Client designation ==============
                                            if( $desig_next ){
                                                echo '<h5>'. esc_html( $desig_next ) .'</h5>';
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-xl-2 d-none d-xl-block">
                                    <div class="testimonial_slider_img">
                                        <?php
                                            if( $image_next ){
                                                echo wp_kses_post( $image_next );
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--::blog_part end::-->
    <?php

    }

    public function load_widget_script(){
        if( \Elementor\Plugin::$instance->editor->is_edit_mode() === true  ) {
        ?>
        <script>
        ( function( $ ){
            $(document).ready(function() {

                var review = $('.textimonial_iner');
                if (review.length) {
                    review.owlCarousel({
                    items: 1,
                    loop: true,
                    dots: true,
                    autoplay: true,
                    autoplayHoverPause: true,
                    autoplayTimeout: 5000,
                    nav: false,
                    responsive: {
                        0: {
                        margin: 15,
                        },
                        600: {
                        margin: 10,
                        },
                        1000: {
                        margin: 10,
                        }
                    }
                    });
                }
            });
        })(jQuery);
        </script>
        <?php 
        }
    }
	
}
