<?php
// Block direct access
if( !defined( 'ABSPATH' ) ){
    exit( 'Direct script access denied.' );
}

/**
 * @Packge     : Etrain
 * @Version    : 1.0
 * @Author     : Colorlib
 * @Author URI : http://colorlib.com/wp/
 *
 */
 
 
function etrain_widgets_init() {
    // sidebar widgets 
    
    register_sidebar(array(
        'name'          => esc_html__('Sidebar widgets', 'etrain'),
        'description'   => esc_html__('Place widgets in sidebar widgets area.', 'etrain'),
        'id'            => 'sidebar_widgets',
        'before_widget' => '<div id="%1$s" class="widget single_sidebar_widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget_title">',
        'after_title'   => '</h4>'
    ));

	// footer widgets register
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer One', 'etrain' ),
			'id'            => 'footer-1',
			'before_widget' => '<div class="col-sm-6 col-md-4 col-xl-3"><div id="%1$s" class="single-footer-widget footer_1 %2$s">',
			'after_widget'  => '</div></div>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Two', 'etrain' ),
			'id'            => 'footer-2',
			'before_widget' => '<div id="%1$s" class="single-footer-widget footer_2 %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Three', 'etrain' ),
			'id'            => 'footer-3',
			'before_widget' => '<div class="col-xl-3 col-sm-6 col-md-4"><div id="%1$s" class="single-footer-widget footer_3 %2$s">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		)
	);
	

}
add_action( 'widgets_init', 'etrain_widgets_init' );
