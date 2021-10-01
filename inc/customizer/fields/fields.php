<?php 
/**
 * @Packge     : Etrain

 * @Author     : Colorlib
 * @Author URI : http://colorlib.com/wp/
 *
 * Customizer section fields
 *
 */

/***********************************
 * General Section Fields
 ***********************************/

 // Theme color field
Epsilon_Customizer::add_field(
    'etrain_theme_color',
    array(
        'type'        => 'epsilon-color-picker',
        'label'       => esc_html__( 'Theme Color', 'etrain' ),
        'description' => esc_html__( 'Select the theme color.', 'etrain' ),
        'sanitize_callback' => 'sanitize_text_field',
        'section'     => 'etrain_general_section',
        'default'     => '#ff663b',
    )
);

 // Theme color field
Epsilon_Customizer::add_field(
    'etrain_theme_box_shadow_color',
    array(
        'type'        => 'epsilon-color-picker',
        'label'       => esc_html__( 'Box Shadow Color', 'etrain' ),
        'description' => esc_html__( 'Applies where it\'s needed.', 'etrain' ),
        'sanitize_callback' => 'sanitize_text_field',
        'section'     => 'etrain_general_section',
        'default'     => 'rgba(255, 126, 95, 0.15)',
    )
);

 
// Header background color field
Epsilon_Customizer::add_field(
    'etrain_header_bg_color',
    array(
        'type'        => 'epsilon-color-picker',
        'label'       => esc_html__( 'Sticky Header BG Color', 'etrain' ),
        'description' => esc_html__( 'Select the header background color.', 'etrain' ),
        'sanitize_callback' => 'sanitize_text_field',
        'section'     => 'etrain_header_section',
        'default'     => '#fff',
    )
);


// Header right button toggle section
Epsilon_Customizer::add_field(
    'etrain_header_button_section_separator',
    array(
        'type'        => 'epsilon-separator',
        'label'       => esc_html__( 'Header right button toggle Section', 'etrain' ),
        'section'     => 'etrain_header_section',

    )
);


// Header right button toggle
Epsilon_Customizer::add_field(
	'etrain_header_right_button',
	array(
		'type'        => 'epsilon-toggle',
		'label'       => esc_html__( 'Header right button show/hide', 'etrain' ),
		'section'     => 'etrain_header_section',
		'default'     => true
	)
);

// Header right button toggle
Epsilon_Customizer::add_field(
	'etrain_header_right_button_lbl',
	array(
		'type'              => 'text',
		'label'             => esc_html__( 'Header right button label', 'etrain' ),
		'section'           => 'etrain_header_section',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => 'Get a quote'
	)
);

// Header right button toggle
Epsilon_Customizer::add_field(
	'etrain_header_right_button_url',
	array(
		'type'              => 'url',
		'label'             => esc_html__( 'Header right button URL', 'etrain' ),
		'section'           => 'etrain_header_section',
        'sanitize_callback' => 'esc_url_raw'
	)
);

// Header right button bg color field
Epsilon_Customizer::add_field(
    'etrain_header_right_btn_color',
    array(
        'type'        => 'epsilon-color-picker',
        'label'       => esc_html__( 'Header right button bg color', 'etrain' ),
        'sanitize_callback' => 'sanitize_text_field',
        'section'     => 'etrain_header_section',
        'default'     => '#ff663b'
    )
);

// Header right button hover bg color field
Epsilon_Customizer::add_field(
    'etrain_header_right_btn_hover_color',
    array(
        'type'        => 'epsilon-color-picker',
        'label'       => esc_html__( 'Header right button hover bg color', 'etrain' ),
        'sanitize_callback' => 'sanitize_text_field',
        'section'     => 'etrain_header_section',
        'default'     => '#ff663b'
    )
);



/***********************************
 * Blog Section Fields
 ***********************************/
 
// Post excerpt length field
Epsilon_Customizer::add_field(
    'etrain_excerpt_length',
    array(
        'type'        => 'text',
        'label'       => esc_html__( 'Set post excerpt length', 'etrain' ),
        'description' => esc_html__( 'Set post excerpt length.', 'etrain' ),
        'section'     => 'etrain_blog_section',
        'sanitize_callback' => 'sanitize_text_field',
        'default'     => '30',
    )
);

// Blog single page social share icon
Epsilon_Customizer::add_field(
    'etrain_blog_meta',
    array(
        'type'        => 'epsilon-toggle',
        'label'       => esc_html__( 'Blog page post meta show/hide', 'etrain' ),
        'section'     => 'etrain_blog_section',
        'default'     => true
    )
);
Epsilon_Customizer::add_field(
    'etrain_like_btn',
    array(
        'type'        => 'epsilon-toggle',
        'label'       => esc_html__( 'Blog Single Page Like Button show/hide', 'etrain' ),
        'section'     => 'etrain_blog_section',
        'default'     => true
    )
);
Epsilon_Customizer::add_field(
    'etrain_blog_share',
    array(
        'type'        => 'epsilon-toggle',
        'label'       => esc_html__( 'Blog Single Page Share show/hide', 'etrain' ),
        'section'     => 'etrain_blog_section',
        'default'     => true
    )
);


/***********************************
 * 404 Page Section Fields
 ***********************************/

// 404 text #1 field
Epsilon_Customizer::add_field(
    'etrain_fof_titleone',
    array(
        'type'              => 'text',
        'label'             => esc_html__( '404 Text #1', 'etrain' ),
        'section'           => 'etrain_fof_section',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => 'Say Hello.'
    )
);
// 404 text #2 field
Epsilon_Customizer::add_field(
    'etrain_fof_titletwo',
    array(
        'type'              => 'text',
        'label'             => esc_html__( '404 Text #2', 'etrain' ),
        'section'           => 'etrain_fof_section',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => 'Say Hello.'
    )
);
// 404 text #1 color field
Epsilon_Customizer::add_field(
    'etrain_fof_textone_color',
    array(
        'type'        => 'epsilon-color-picker',
        'label'       => esc_html__( '404 Text #1 Color', 'etrain' ),
        'sanitize_callback' => 'sanitize_text_field',
        'section'     => 'etrain_fof_section',
        'default'     => '#000000',
    )
);
// 404 text #2 color field
Epsilon_Customizer::add_field(
    'etrain_fof_texttwo_color',
    array(
        'type'        => 'epsilon-color-picker',
        'label'       => esc_html__( '404 Text #2 Color', 'etrain' ),
        'sanitize_callback' => 'sanitize_text_field',
        'section'     => 'etrain_fof_section',
        'default'     => '#656565',
    )
);
// 404 background color field
Epsilon_Customizer::add_field(
    'etrain_fof_bg_color',
    array(
        'type'        => 'epsilon-color-picker',
        'label'       => esc_html__( '404 Page Background Color', 'etrain' ),
        'sanitize_callback' => 'sanitize_text_field',
        'section'     => 'etrain_fof_section',
        'default'     => '#fff',
    )
);

/***********************************
 * Footer Section Fields
 ***********************************/

// Footer Widget section
Epsilon_Customizer::add_field(
    'footer_widget_separator',
    array(
        'type'        => 'epsilon-separator',
        'label'       => esc_html__( 'Footer Widget Section', 'etrain' ),
        'section'     => 'etrain_footer_section',

    )
);

// Footer widget toggle field
Epsilon_Customizer::add_field(
    'etrain_footer_widget_toggle',
    array(
        'type'        => 'epsilon-toggle',
        'label'       => esc_html__( 'Footer widget show/hide', 'etrain' ),
        'description' => esc_html__( 'Toggle to display footer widgets.', 'etrain' ),
        'section'     => 'etrain_footer_section',
        'default'     => true,
    )
);


// Footer widget background color field
Epsilon_Customizer::add_field(
    'etrain_footer_bg_color',
    array(
        'type'        => 'epsilon-color-picker',
        'label'       => esc_html__( 'Footer Background Color', 'etrain' ),
        'sanitize_callback' => 'sanitize_text_field',
        'section'     => 'etrain_footer_section',
        'default'     => '#f7f7f7',
    )
);

// Footer widget text color field
Epsilon_Customizer::add_field(
    'etrain_footer_widget_text_color',
    array(
        'type'        => 'epsilon-color-picker',
        'label'       => esc_html__( 'Footer Text Color', 'etrain' ),
        'sanitize_callback' => 'sanitize_text_field',
        'section'     => 'etrain_footer_section',
        'default'     => '#888',
    )
);

// Footer widget title color field
Epsilon_Customizer::add_field(
    'etrain_footer_widget_title_color',
    array(
        'type'        => 'epsilon-color-picker',
        'label'       => esc_html__( 'Footer Widget Title Color', 'etrain' ),
        'sanitize_callback' => 'sanitize_text_field',
        'section'     => 'etrain_footer_section',
        'default'     => '#0c2e60',
    )
);

// Footer widget anchor color field
Epsilon_Customizer::add_field(
    'etrain_footer_widget_anchor_color',
    array(
        'type'        => 'epsilon-color-picker',
        'label'       => esc_html__( 'Footer Anchor Color', 'etrain' ),
        'sanitize_callback' => 'sanitize_text_field',
        'section'     => 'etrain_footer_section',
        'default'     => '#ff663b',
    )
);

// Footer widget anchor hover color field
Epsilon_Customizer::add_field(
    'etrain_footer_widget_anchor_hover_color',
    array(
        'type'        => 'epsilon-color-picker',
        'label'       => esc_html__( 'Footer Anchor Hover Color', 'etrain' ),
        'sanitize_callback' => 'sanitize_text_field',
        'section'     => 'etrain_footer_section',
        'default'     => '#ff663b',
    )
);


// Footer Copyright section
Epsilon_Customizer::add_field(
    'etrain_footer_copyright_separator',
    array(
        'type'        => 'epsilon-separator',
        'label'       => esc_html__( 'Footer Copyright Section', 'etrain' ),
        'section'     => 'etrain_footer_section',
        'default'     => true,

    )
);

// Footer copyright text field
// Copy right text
$url = 'https://colorlib.com/';
$copyText = sprintf( __( 'Theme by %s colorlib %s Copyright &copy; %s  |  All rights reserved.', 'etrain' ), '<a target="_blank" href="' . esc_url( $url ) . '">', '</a>', date( 'Y' ) );
Epsilon_Customizer::add_field(
    'etrain_footer_copyright_text',
    array(
        'type'        => 'epsilon-text-editor',
        'label'       => esc_html__( 'Footer copyright text', 'etrain' ),
        'section'     => 'etrain_footer_section',
        'default'     => wp_kses_post( $copyText ),
    )
);

