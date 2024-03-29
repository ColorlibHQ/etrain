<?php 
/**
 * @Packge     : Etrain

 * @Author     : Colorlib
 * @Author URI : http://colorlib.com/wp/
 *
 * Customizer panels and sections
 *
 */

/***********************************
 * Register customizer panels
 ***********************************/

$panels = array(
    /**
     * Theme Options Panel
     */
    array(
        'id'   => 'etrain_theme_options_panel',
        'args' => array(
            'priority'       => 0,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => esc_html__( 'Theme Options', 'etrain' ),
        ),
    )
);


/***********************************
 * Register customizer sections
 ***********************************/


$sections = array(

    /**
     * General Section
     */
    array(
        'id'   => 'etrain_general_section',
        'args' => array(
            'title'    => esc_html__( 'General', 'etrain' ),
            'panel'    => 'etrain_theme_options_panel',
            'priority' => 1,
        ),
    ),
    
    /**
     * Header Section
     */
    array(
        'id'   => 'etrain_header_section',
        'args' => array(
            'title'    => esc_html__( 'Header', 'etrain' ),
            'panel'    => 'etrain_theme_options_panel',
            'priority' => 2,
        ),
    ),

    /**
     * Blog Section
     */
    array(
        'id'   => 'etrain_blog_section',
        'args' => array(
            'title'    => esc_html__( 'Blog', 'etrain' ),
            'panel'    => 'etrain_theme_options_panel',
            'priority' => 3,
        ),
    ),



    /**
     * 404 Page Section
     */
    array(
        'id'   => 'etrain_fof_section',
        'args' => array(
            'title'    => esc_html__( '404 Page', 'etrain' ),
            'panel'    => 'etrain_theme_options_panel',
            'priority' => 6,
        ),
    ),

    /**
     * Footer Section
     */
    array(
        'id'   => 'etrain_footer_section',
        'args' => array(
            'title'    => esc_html__( 'Footer Page', 'etrain' ),
            'panel'    => 'etrain_theme_options_panel',
            'priority' => 7,
        ),
    ),



);


/***********************************
 * Add customizer elements
 ***********************************/
$collection = array(
    'panel'   => $panels,
    'section' => $sections,
);

Epsilon_Customizer::add_multiple( $collection );

?>