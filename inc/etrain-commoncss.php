<?php
// Block direct access
if( !defined( 'ABSPATH' ) ){
    exit( 'Direct script access denied.' );
} 
/**
 * @Packge     : ETRAIN
 * @Version    : 1.0
 * @Author     : Colorlib
 * @Author URI : http://colorlib.com/wp/
 *
 */
 
 
// enqueue css
function etrain_common_custom_css(){
    
    wp_enqueue_style( 'etrain-common', get_template_directory_uri().'/assets/css/dynamic.css' );
		$header_bg         		  = esc_url( get_header_image() );
		$header_bg_img 			  = !empty( $header_bg ) ? 'background-image: url('.esc_url( $header_bg ).')' : '';

		$themeColor     		  = etrain_opt( 'etrain_theme_color' ) != '#ff663b' ? etrain_opt('etrain_theme_color') : '';
		$boxShadowColor    		  = etrain_opt( 'etrain_theme_box_shadow_color' ) != 'rgba(255, 126, 95, 0.15)' ? '0px 12px 20px 0px ' . etrain_opt( 'etrain_theme_box_shadow_color' ) : '';

		$buttonBorderColor     	  = etrain_opt( 'etrain_button_border_color' );
		$hoverColor     	  	  = etrain_opt( 'etrain_hover_color');

		$headerTop_bg     		  = etrain_opt( 'etrain_top_header_bg_color' );
		$headerTop_col     		  = etrain_opt( 'etrain_top_header_color' );

		$headerBg          		  = etrain_opt( 'etrain_header_bg_color');
		
		$headerRightBtnColor      = etrain_opt( 'etrain_header_right_btn_color' ) != '#ff663b' ? etrain_opt( 'etrain_header_right_btn_color' ) : '';
		$headerRightBtnHvrColor   = etrain_opt( 'etrain_header_right_btn_hover_color' ) != '#ff663b' ? etrain_opt( 'etrain_header_right_btn_hover_color' ) : '';

		$footerwbgColor     	  = etrain_opt('etrain_footer_bg_color');
		$footerwTextColor   	  = etrain_opt('etrain_footer_widget_text_color') != '#abb2ba' ? etrain_opt('etrain_footer_widget_text_color') : '';
		$widgettitlecolor  		  = etrain_opt('etrain_footer_widget_title_color');
		$footerwanchorcolor 	  = etrain_opt('etrain_footer_widget_anchor_color') != '#ff663b' ? etrain_opt('etrain_footer_widget_anchor_color') : '';
		$footerwanchorhovcolor    = etrain_opt('etrain_footer_widget_anchor_hover_color');

		$fofbg					  = etrain_opt('etrain_fof_bg_color');
		$foftonecolor			  = etrain_opt('etrain_fof_textone_color');
		$fofttwocolor			  = etrain_opt('etrain_fof_texttwo_color');

		$customcss ="
			.hero-banner{
				{$header_bg_img}
			}
			
			.main_menu nav .btn_1
			{
				background: {$headerRightBtnColor};
			}
			.main_menu nav .btn_1:hover
			{
				background: {$headerRightBtnHvrColor};
			}

			.feature_part .single_feature:hover .single_feature_part{
				border-color: {$themeColor}!important;
			}
			
			.main_menu nav .btn_1, .blog_right_sidebar .btn_1, .right-contents .sidebar_top .btn_1, .feedeback .btn_1, .button-contactForm, .button-contactForm:hover, .banner_part .banner_text .btn_1, .feature_part .single_feature_text .btn_1:hover, .learning_part .learning_member_text .btn_1:hover{
				box-shadow: {$boxShadowColor};
			}
			.btn_2
			{
				border-color: {$buttonBorderColor};
			}

			.cta_part .cta_part_iner .cta_part_text p, .about_part .about_text h5, .section_tittle p, .our_latest_work .single_work_demo h5, .blog_part .single-home-blog .card h5:hover, .blog_part .single-home-blog .card ul li i, .main_menu .main-menu-item ul li .nav-link:hover, .main_menu .main-menu-item ul li.active .nav-link:hover
			{
				color: {$themeColor}
			}			
			.dropdown .dropdown-menu .dropdown-item:hover, .our_latest_work .single_work_demo .btn_3:hover, .team_member_section .single_team_member .single_team_text h3 a:hover, .team_member_section .single_team_member .team_member_social_icon a:hover, .blog_part .single-home-blog .card .card-body a:not(.btn_4):hover, .pre_icon a:hover, .next_icon a:hover, .review_part .section_tittle p, .banner-breadcrumb > ol > li.breadcrumb-item > a.bread-link:hover, .review_part .section_tittle p, .banner-breadcrumb .breadcrumb-item a:hover, .blog_details a:hover, .blog_right_sidebar .widget_categories ul li:hover, .blog_right_sidebar .widget_categories ul li:hover a, .blog_right_sidebar .widget_categories ul li a:hover, .special_cource .single_special_cource .special_cource_text h3:hover, .special_cource .single_special_cource .special_cource_text h4, .blog_part .single-home-blog .card a:hover h5, .blog_area a:hover span, .single-post-area .navigation-area a:hover h4, .blog_right_sidebar .widget_etrain_recent_widget .post_item .media-body a:hover h3, .blog_left_sidebar .blog_details a:hover h2, .single-post-area .blog-author a:hover h4{
				color: {$themeColor}!important;
			}

			.btn_1, .review_part .intro_video_bg .video-play-button, .review_part .owl-prev span:after, .review_part .owl-next span:after, .review_part .intro_video_bg .video-play-button:after, .review_part .intro_video_bg .video-play-button:before, .review_part .intro_video_bg .video-play-button:hover:after, .blog_item_img .blog_item_date, .button, .single_sidebar_widget .tagcloud a:hover, .blog_right_sidebar .single_sidebar_widget.widget_etrain_newsletter .btn, .pre_icon :after, .next_icon :after, .section_tittle h2:after, .testimonial_part .owl-dots button.owl-dot.active, .learning_part .learning_member_text h5:after, .course_details_area .btn_2:hover
			{
				background: {$themeColor}
			}

			.service_part .single_service_part:hover .single_service_part_iner span, .special_cource .single_special_cource .special_cource_text .btn_4, .blog_part .single-home-blog .card .card-body .btn_4, .banner_part .banner_text .btn_1, .banner_part .banner_text .btn_2:hover, .feature_part .single_feature:hover span
			{
				background: {$themeColor}!important;
			}

			.btn_2:hover,
			.copyright_part .footer-social a:hover
			{
				background: {$hoverColor}!important;
			}

			.blog_part .single-home-blog .card h5:hover
			{
				color: {$hoverColor};
			}

			.about_part .about_img h2:after, .copyright_part .footer-social a
			{
				border-color: {$themeColor}
			}
			.sub_header{
				background: {$headerTop_bg}
			}
			.sub_header .sub_header_social_icon a,
			.sub_header .sub_header_social_icon .register_icon
			{
				color: {$headerTop_col}
			}

			.main_menu.menu_fixed, .dropdown .dropdown-menu, .dropdown .dropdown-menu .dropdown-item
			{
				background: {$headerBg};
			}

			.footer-area {
				background-color: {$footerwbgColor};
			}

			.footer-area .single-footer-widget p, .footer-area .widget_etrain_newsletter .input-group input, .footer-area .copyright_part_text p, .footer-area .footer_2 .social_icon a
			{
				color: {$footerwTextColor}
			}
			.footer-area .copyright_part_text {
				border-color: {$footerwTextColor}
			}
			.footer-area .single-footer-widget h4
			{
				color: {$widgettitlecolor}
			}

			.footer-area .copyright_part_text a
			{
			   color: {$footerwanchorcolor};
			}
			.footer-area .copyright_part_text a:hover, .footer-area .footer_2 .social_icon a:hover
			{
			   color: {$footerwanchorhovcolor}!important;
			}
			#f0f {
				background-color: {$fofbg};
			 }
			 .f0f-content .h1 {
				color: {$foftonecolor};
			 }
			 .f0f-content p {
				color: {$fofttwocolor};
			 }

        ";
       
    wp_add_inline_style( 'etrain-common', $customcss );
    
}
add_action( 'wp_enqueue_scripts', 'etrain_common_custom_css', 50 );