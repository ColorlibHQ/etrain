<?php 
/**
 * @Packge     : Etrain
 * @Version    : 1.0
 * @Author     : Colorlib
 * @Author URI : http://colorlib.com/wp/
 *
 */
 
    // Block direct access
    if( !defined( 'ABSPATH' ) ){
        exit( 'Direct script access denied.' );
    }

/*=========================================================
	Theme option callback
=========================================================*/
function etrain_opt( $id = null, $default = '' ) {
	
	$opt = get_theme_mod( $id, $default );
	
	$data = '';
	
	if( $opt ) {
		$data = $opt;
	}
	
	return $data;
}


/*=========================================================
	Site icon callback
=========================================================*/

function etrain_site_icon(){
	if ( ! has_site_icon() ) {
		$html = '';
		$icon_path = ETRAIN_DIR_ASSETS_URI . 'img/favicon.png';
		$html .= '<link rel="icon" href="' . esc_url ( $icon_path ) . '" sizes="32x32">';
		$html .= '<link rel="icon" href="' . esc_url ( $icon_path ) . '" sizes="192x192">';
		$html .= '<link rel="apple-touch-icon-precomposed" href="' . esc_url ( $icon_path ) . '">';
		$html .= '<meta name="msapplication-TileImage" content="' . esc_url ( $icon_path ) . '">';

		return $html;
	} else {
		return;
	}
}


/*=========================================================
	Custom meta id callback
=========================================================*/
function etrain_meta( $id = '' ){
    
    $value = get_post_meta( get_the_ID(), '_etrain_'.$id, true );
    
    return $value;
}


/*=========================================================
	User Review Submission
=========================================================*/

add_action( 'wp_ajax_course_star_review', 'etrain_course_star_review' );
add_action( 'wp_ajax_nopriv_course_star_review', 'etrain_course_star_review' );
function etrain_course_star_review() {

	if( isset( $_POST['userdata'] ) ){
		if( is_user_logged_in() ){

			parse_str( $_POST['userdata'], $getData );

			$userdata = get_user_by( 'id',  $getData['userid'] );
			$time = current_time('mysql');
		
			$data = array(
				'comment_post_ID' => absint( $getData['postid'] ),
				'comment_author' => $userdata->data->user_login,
				'comment_author_email' => $userdata->data->user_email,
				'comment_content' => wp_kses_post( $getData['feedback'] ),
				'user_id' => $userdata->data->ID,
				'comment_date' => $time,
				'comment_approved' => 1,
			);

			$commentsId = wp_insert_comment($data);


			$args = array(
				'post_id' => absint( $getData['postid'] ),
			);
			$reviews = get_comments( $args );
			 $reviewCount = count( $reviews );

			$avgreview = get_post_meta( absint( $getData['postid'] ), 'etrain_course_avgreview', true );

			$avgreview =  $avgreview +  $getData['ratingvalue'];

			update_post_meta( absint( $getData['postid'] ), 'etrain_course_avgreview', $avgreview );

			update_comment_meta( absint( $commentsId ), 'etrain_course_review', $getData['ratingvalue'] );

			echo 'success';
		}else{
			echo 'Error';
		}


	}


	die();
}




/*=========================================================
	Blog Date Permalink
=========================================================*/
function etrain_blog_date_permalink(){
	
	$year  = get_the_time('Y'); 
    $month_link = get_the_time('m');
    $day   = get_the_time('d');

    $link = get_day_link( $year, $month_link, $day);
    
    return $link; 
}



/*========================================================
	Blog Excerpt Length
========================================================*/
if ( ! function_exists( 'etrain_excerpt_length' ) ) {
	function etrain_excerpt_length( $limit = 30 ) {

		$excerpt = explode( ' ', get_the_excerpt() );
		
		// $limit null check
		if( !null == $limit ){
			$limit = $limit;
		}else{
			$limit = 30;
		}
        
        
		if ( count( $excerpt ) >= $limit ) {
			array_pop( $excerpt );
			$exc_slice = array_slice( $excerpt, 0, $limit );
			$excerpt = implode( " ", $exc_slice ).' ...';
		} else {
			$exc_slice = array_slice( $excerpt, 0, $limit );
			$excerpt = implode( " ", $exc_slice );
		}
		
		$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
		return $excerpt;

	}
}


/*==========================================================
	Comment number and Link
==========================================================*/
if ( ! function_exists( 'etrain_posted_comments' ) ) {
    function etrain_posted_comments(){
        
        $comments_num = get_comments_number();
        if( comments_open() ){
            if( $comments_num == 0 ){
                $comments = esc_html__('No Comments','etrain');
            } elseif ( $comments_num > 1 ){
                $comments= $comments_num . esc_html__(' Comments','etrain');
            } else {
                $comments = esc_html__( '1 Comment','etrain' );
            }
            $comments = '<i class="ti-comments"></i> '. $comments;
        } else {
            $comments = esc_html__( 'Comments are closed', 'etrain' );
        }
        
        return $comments;
    }
}


/*===================================================
	Post embedded media
===================================================*/
function etrain_embedded_media( $type = array() ){
    
    $content = do_shortcode( apply_filters( 'the_content', get_the_content() ) );
    $embed   = get_media_embedded_in_content( $content, $type );
        
    if( in_array( 'audio' , $type) ){
    
        if( count( $embed ) > 0 ){
            $output = str_replace( '?visual=true', '?visual=false', $embed[0] );
        }else{
           $output = '';
        }
        
    }else{
        
        if( count( $embed ) > 0 ){

            $output = $embed[0];
        }else{
           $output = ''; 
        }
        
    }
    
    return $output;
}


/*===================================================
	WP post link pages
====================================================*/
function etrain_link_pages(){
    wp_link_pages( array(
    'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'etrain' ) . '</span>',
    'after'       => '</div>',
    'link_before' => '<span>',
    'link_after'  => '</span>',
    'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'etrain' ) . ' </span>%',
    'separator'   => '<span class="screen-reader-text">, </span>',
    ) );
}


/*====================================================
	Theme logo
====================================================*/
function etrain_theme_logo( $class = '' ) {

    $siteUrl = home_url('/');
    // site logo
		
	$custom_logo_id  = get_theme_mod( 'custom_logo' );
	$custom_logo_id2 = get_theme_mod( 'secondary_logo' );
	$imageUrl1 = wp_get_attachment_image_src( $custom_logo_id , 'etrain_logo_165x47' );
	$imageUrl2 = wp_get_attachment_image_src( $custom_logo_id2 , 'etrain_logo_165x47' );

	$siteLogo = '';
	if( !empty( $imageUrl1[0] ) ){
		$siteLogo = '<a class="'.esc_attr( $class ).' logo_1" href="'.esc_url( $siteUrl ).'"><img src="'.esc_url( $imageUrl1[0] ).'" alt="etrain logo"></a>';

		if( !empty( $imageUrl2[0] ) ){
			$siteLogo .= '<a class="'.esc_attr( $class ).' logo_2" href="'.esc_url( $siteUrl ).'"><img src="'.esc_url( $imageUrl2[0] ).'" alt="etrain logo 2"></a>';
		}
	}else{
		$siteLogo = '<h2><a class="'.esc_attr( $class ).'" href="'.esc_url( $siteUrl ).'">'.esc_html( get_bloginfo('name') ).'</a><span>'. esc_html( get_bloginfo('description') ) .'</span></h2>';
	}
	
	return wp_kses_post( $siteLogo );
	
}


/*================================================
    Page Title Bar
================================================*/
function etrain_page_titlebar() {
	if ( ! is_page_template( 'template-builder.php' ) ) {
		?>
        <section class="hero-banner">
            <div class="container">
				<h2>
				<?php
				if ( is_category() ) {
					single_cat_title( __('Category: ', 'etrain') );

				} elseif ( is_tag() ) {
					single_tag_title( 'Tag Archive for - ' );

				} elseif ( is_archive() ) {
					echo get_the_archive_title();

				} elseif ( is_page() ) {
					echo get_the_title();

				} elseif ( is_search() ) {
					echo esc_html__( 'Search for: ', 'etrain' ) . get_search_query();

				} elseif ( ! ( is_404() ) && ( is_single() ) || ( is_page() ) ) {
					echo  get_the_title();

				} elseif ( is_home() ) {
					echo esc_html__( 'Blog', 'etrain' );

				} elseif ( is_404() ) {
					echo esc_html__( '404 error', 'etrain' );

				}
				?>
				</h2>
                <nav aria-label="breadcrumb" class="banner-breadcrumb">
					<?php
					if ( function_exists( 'etrain_breadcrumbs' ) ) {
						etrain_breadcrumbs();
					}
					?>
                </nav>
            </div>
        </section>
		<?php
	}
}



/*================================================
	Blog pull right class callback
=================================================*/
function etrain_pull_right( $id = '', $condation ){
    
    if( $id == $condation ){
        return ' '.'order-last';
    }else{
        return;
    }
    
}



/*======================================================
	Inline Background
======================================================*/
function etrain_inline_bg_img( $bgUrl ){
    $bg = '';

    if( $bgUrl ){
        $bg = 'style="background-image:url('.esc_url( $bgUrl ).')"'; 
    }

    return $bg;
}


/*======================================================
	Blog Category
======================================================*/
function etrain_featured_post_cat(){

	if ( 'course' != get_post_type() ) {
		$categories = get_the_category(); 
		
		if( is_array( $categories ) && count( $categories ) > 0 ){
			$getCat = [];
			foreach ( $categories as $value ) {
	
				if( $value->slug != 'featured' ){
					$getCat[] = '<a href="'.esc_url( get_category_link( $value->term_id ) ).'" class="btn_4">'.esc_html( $value->name ).'</a>';
				}   
			}
	
			return implode( ', ', $getCat );
		}
	} else {
		$categories = get_the_terms( get_the_ID(), "course-cat");
		return '<a href="'.get_category_link( $categories[0]->term_id ).'" class="btn_4">'. $categories[0]->name .'</a>';
	}
         
}


/*=======================================================
	Customize Sidebar Option Value Return
========================================================*/
function etrain_sidebar_opt(){

    $sidebarOpt = etrain_opt( 'etrain_blog_layout' );
    $sidebar = '1';
    // Blog Sidebar layout  opt
    if( is_array( $sidebarOpt ) ){
        $sidebarOpt =  $sidebarOpt;
    }else{
        $sidebarOpt =  json_decode( $sidebarOpt, true );
    }
    
    
    if( !empty( $sidebarOpt['columnsCount'] ) ){
        $sidebar = $sidebarOpt['columnsCount'];
    }


    return $sidebar;
}


/**================================================
	Themify Icon
 =================================================*/
function etrain_themify_icon(){
    return[
        'cap'     => __('Icon Cap', 'etrain'),
        'bag'     => __('Icon Bag', 'etrain'),
        'shirt'   => __('Icon T-shirt', 'etrain'),
        'cafe'    => __('Icon Cafe', 'etrain'),
    ];
}


/*===========================================================
	Set contact form 7 default form template
============================================================*/
function etrain_contact7_form_content( $template, $prop ) {
    
    if ( 'form' == $prop ) {

        $template =
            '<div class="row"><div class="col-12"><div class="form-group">[textarea* your-message id:message class:form-control class:w-100 rows:9 cols:30 placeholder "Message"]</div></div><div class="col-sm-6"><div class="form-group">[text* your-name id:name class:form-control placeholder "Enter your  name"]</div></div><div class="col-sm-6"><div class="form-group">[email* your-email id:email class:form-control placeholder "Enter your email"]</div></div><div class="col-12"><div class="form-group">[text your-subject id:subject class:form-control placeholder "Subject"]</div></div></div><div class="form-group mt-3">[submit class:button class:button-contactForm "Send Message"]</div>';

        return $template;

    } else {
    return $template;
    } 
}
add_filter( 'wpcf7_default_template', 'etrain_contact7_form_content', 10, 2 );



/*============================================================
	Pagination
=============================================================*/
function etrain_blog_pagination(){
	echo '<nav class="blog-pagination justify-content-center d-flex">';
        the_posts_pagination(
            array(
                'mid_size'  => 2,
                'prev_text' => __( '<span class="ti-angle-left"></span>', 'etrain' ),
                'next_text' => __( '<span class="ti-angle-right"></span>', 'etrain' ),
                'screen_reader_text' => ' '
            )
        );
	echo '</nav>';
}


/*=============================================================
	Course Single Post Navigation
=============================================================*/
if( ! function_exists('etrain_course_single_post_navigation') ) {
	function etrain_course_single_post_navigation() {
		$slim_left_icon = ETRAIN_DIR_ICON_IMG_URI . 'slim-left.svg';
		$slim_right_icon = ETRAIN_DIR_ICON_IMG_URI . 'slim-right.svg';
		// Start nav Area
		if( get_next_post_link() || get_previous_post_link()   ) {
			
			if( get_next_post_link() ){
				$nextPost = get_next_post();
				?>
				<div class="pre_icon float-left">
					<a href="<?php the_permalink(  absint( $nextPost->ID )  ) ?>"><img src="<?php echo esc_url( $slim_left_icon )?>" alt="slim left icon"> <?php echo esc_html__( 'previous', 'etrain' ); ?></a> 
				</div>
				<?php
			}
			
			if( get_previous_post_link() ){
				$prevPost = get_previous_post();
				?>
				<div class="next_icon float-right">
					<a href="<?php the_permalink(  absint( $prevPost->ID )  ) ?>"> <?php echo esc_html__( 'next', 'etrain' ); ?> <img src="<?php echo esc_url( $slim_right_icon )?>" alt="slim right icon"> </a> 
				</div>
				<?php
			}
		}

	}
}


/*=============================================================
	Blog Single Post Navigation
=============================================================*/
if( ! function_exists('etrain_blog_single_post_navigation') ) {
	function etrain_blog_single_post_navigation() {

		// Start nav Area
		if( get_next_post_link() || get_previous_post_link()   ):
			?>
			<div class="navigation-area">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
						<?php
						if( get_next_post_link() ){
							$nextPost = get_next_post();

							if( has_post_thumbnail() ){
								?>
								<div class="thumb">
									<a href="<?php the_permalink(  absint( $nextPost->ID )  ) ?>">
										<?php echo get_the_post_thumbnail( absint( $nextPost->ID ), 'etrain_np_thumb', array( 'class' => 'img-fluid' ) ) ?>
									</a>
								</div>
								<?php
							} ?>
							<div class="arrow">
								<a href="<?php the_permalink(  absint( $nextPost->ID )  ) ?>">
									<span class="ti-arrow-left text-white"></span>
								</a>
							</div>
							<div class="detials">
								<p><?php echo esc_html__( 'Prev Post', 'etrain' ); ?></p>
								<a href="<?php the_permalink(  absint( $nextPost->ID )  ) ?>">
									<h4><?php echo wp_trim_words( get_the_title( $nextPost->ID ), 4, ' ...' ); ?></h4>
								</a>
							</div>
							<?php
						} ?>
					</div>
					<div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
						<?php
						if( get_previous_post_link() ){
							$prevPost = get_previous_post();
							?>
							<div class="detials">
								<p><?php echo esc_html__( 'Next Post', 'etrain' ); ?></p>
								<a href="<?php the_permalink(  absint( $prevPost->ID )  ) ?>">
									<h4><?php echo wp_trim_words( get_the_title( $prevPost->ID ), 4, ' ...' ); ?></h4>
								</a>
							</div>
							<div class="arrow">
								<a href="<?php the_permalink(  absint( $prevPost->ID )  ) ?>">
									<span class="ti-arrow-right text-white"></span>
								</a>
							</div>
							<div class="thumb">
								<a href="<?php the_permalink(  absint( $prevPost->ID )  ) ?>">
									<?php echo get_the_post_thumbnail( absint( $prevPost->ID ), 'etrain_np_thumb', array( 'class' => 'img-fluid' ) ) ?>
								</a>
							</div>
							<?php
						} ?>
					</div>
				</div>
			</div>
		<?php
		endif;

	}
}


/*=======================================================
	Author Bio
=======================================================*/
function etrain_author_bio(){
	$avatar = get_avatar( absint( get_the_author_meta( 'ID' ) ), 90 );
	?>
	<div class="blog-author">
		<div class="media align-items-center">
			<?php
			if( $avatar  ) {
				echo wp_kses_post( $avatar );
			}
			?>
			<div class="media-body">
				<a href="<?php echo esc_url( get_author_posts_url( absint( get_the_author_meta( 'ID' ) ) ) ); ?>"><h4><?php echo esc_html( get_the_author() ); ?></h4></a>
				<p><?php echo esc_html( get_the_author_meta('description') ); ?></p>
			</div>
		</div>
	</div>
	<?php
}


/*===================================================
 Etrain Comment Template Callback
 ====================================================*/
function etrain_comment_callback( $comment, $args, $depth ) {

	if ( 'div' === $args['style'] ) {
		$tag       = 'div';
		$add_below = 'comment';
	} else {
		$tag       = 'li';
		$add_below = 'div-comment';
	}
	?>
	<<?php echo esc_attr( $tag ); ?> <?php comment_class( ( empty( $args['has_children'] ) ? '' : 'parent').' comment-list' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-list">
	<?php endif; ?>
		<div class="single-comment">
			<div class="user d-flex">
				<div class="thumb">
					<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
				</div>
				<div class="desc">
					<div class="comment">
						<?php comment_text(); ?>
					</div>

					<div class="d-flex justify-content-between">
						<div class="d-flex align-items-center">
							<h5 class="comment_author"><?php printf( __( '<span class="comment-author-name">%s</span> ', 'etrain' ), get_comment_author_link() ); ?></h5>
							<p class="date"><?php printf( __('%1$s at %2$s', 'etrain'), get_comment_date(),  get_comment_time() ); ?><?php edit_comment_link( esc_html__( '(Edit)', 'etrain' ), '  ', '' ); ?> </p>
							<?php if ( $comment->comment_approved == '0' ) : ?>
								<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'etrain' ); ?></em>
								<br>
							<?php endif; ?>
						</div>

						<div class="reply-btn">
							<?php comment_reply_link(array_merge( $args, array( 'add_below' => $add_below, 'depth' => 1, 'max_depth' => 5, 'reply_text' => 'Reply' ) ) ); ?>
						</div>
					</div>

				</div>
			</div>
		</div>
	<?php if ( 'div' != $args['style'] ) : ?>
		</div>
	<?php endif; ?>
	<?php
}
// add class comment reply link
add_filter('comment_reply_link', 'etrain_replace_reply_link_class');
function etrain_replace_reply_link_class( $class ) {
	$class = str_replace("class='comment-reply-link", "class='btn-reply comment-reply-link text-uppercase", $class);
	return $class;
}



/*=========================================================
    Latest Blog Post For Elementor Section
===========================================================*/
function etrain_latest_blog( $pNumber = 3, $excerpt_limit = 13, $post_order = 'DESC' ){
	
	$lBlog = new WP_Query( array(
        'post_type'      => 'post',
		'posts_per_page' => $pNumber,
		'order'			 => $post_order
    ) );

    if( $lBlog->have_posts() ){
        while( $lBlog->have_posts() ){
			$lBlog->the_post();
	?>
			
			<div class="col-sm-6 col-lg-4 col-xl-4">
				<div class="single-home-blog">
					<div class="card">
						<?php
							if( has_post_thumbnail() ){
								the_post_thumbnail( 'etrain_latest_blog_360x313', ['class' => 'card-img-top', 'alt' => get_the_title() ] );
							}
						?>
						<div class="card-body">
							<?php echo etrain_featured_post_cat(); ?>
							<a href="<?php the_permalink(); ?>">
								<h5 class="card-title"><?php the_title(); ?></h5>
							</a>
							<p><?php echo etrain_excerpt_length( $excerpt_limit ) ?></p>
							<ul>
								<li><?php echo etrain_posted_comments();?></li>
								<li><?php echo get_simple_likes_button( get_the_ID() );?></li>
							</ul>
						</div>
					</div>
				</div>
			</div>

        <?php
        }

    }

}



/*=========================================================
    Share Button Code
===========================================================*/
function etrain_social_sharing_buttons( $ulClass = '', $tagLine = '' ) {

	// Get page URL
	$URL = get_permalink();
	$Sitetitle = get_bloginfo('name');

	// Get page title
	$Title = str_replace( ' ', '%20', get_the_title());

	// Construct sharing URL without using any script
	$twitterURL = 'https://twitter.com/intent/tweet?text='.esc_html( $Title ).'&amp;url='.esc_url( $URL ).'&amp;via='.esc_html( $Sitetitle );
	$facebookURL= 'https://www.facebook.com/sharer/sharer.php?u='.esc_url( $URL );
	$linkedin   = 'https://www.linkedin.com/shareArticle?mini=true&url='.esc_url( $URL ).'&title='.esc_html( $Title );
	$pinterest  = 'http://pinterest.com/pin/create/button/?url='.esc_url( $URL ).'&description='.esc_html( $Title );;

	// Add sharing button at the end of page/page content
	$content = '';
	$content  .= '<ul class="'.esc_attr( $ulClass ).'">';
	$content .= $tagLine;
	$content .= '<li><a href="' . esc_url( $facebookURL ) . '" target="_blank"><i class="ti-facebook"></i></a></li>';
	$content .= '<li><a href="' . esc_url( $twitterURL ) . '" target="_blank"><i class="ti-twitter-alt"></i></a></li>';
	$content .= '<li><a href="' . esc_url( $pinterest ) . '" target="_blank"><i class="ti-pinterest"></i></a></li>';
	$content .= '<li><a href="' . esc_url( $linkedin ) . '" target="_blank"><i class="ti-linkedin"></i></a></li>';
	$content .= '</ul>';

	return $content;

}



/*================================================
	Projects Return data 
================================================ */
function return_tab_data( $getTags, $menu_tabs ) {
	$y = [];
	foreach ( $getTags as $val ) {

		$t = [];

		foreach( $menu_tabs as $data ) {
			if( $data['label'] == $val ) {
				$t[] = $data;
			}
		}

		$y[$val] = $t;

	}

	return $y;
}


/*================================================
    Etrain Custom Posts
================================================*/
function etrain_custom_posts() {
	
	// Course Custom Post
	
	$labels = array(
		'name'               => _x( 'Courses', 'post type general name', 'etrain' ),
		'singular_name'      => _x( 'Course', 'post type singular name', 'etrain' ),
		'menu_name'          => _x( 'Courses', 'admin menu', 'etrain' ),
		'name_admin_bar'     => _x( 'Course', 'add new on admin bar', 'etrain' ),
		'add_new'            => _x( 'Add New', 'course', 'etrain' ),
		'add_new_item'       => __( 'Add New Course', 'etrain' ),
		'new_item'           => __( 'New Course', 'etrain' ),
		'edit_item'          => __( 'Edit Course', 'etrain' ),
		'view_item'          => __( 'View Course', 'etrain' ),
		'all_items'          => __( 'All Courses', 'etrain' ),
		'search_items'       => __( 'Search Courses', 'etrain' ),
		'parent_item_colon'  => __( 'Parent Courses:', 'etrain' ),
		'not_found'          => __( 'No courses found.', 'etrain' ),
		'not_found_in_trash' => __( 'No courses found in Trash.', 'etrain' )
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'etrain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'course' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' )
	);

	register_post_type( 'course', $args );

	$labels = array(
		'name'              => _x( 'Course Category', 'taxonomy general name', 'etrain' ),
		'singular_name'     => _x( 'Course Categories', 'taxonomy singular name', 'etrain' ),
		'search_items'      => __( 'Search Course Categories', 'etrain' ),
		'all_items'         => __( 'All Course Categories', 'etrain' ),
		'parent_item'       => __( 'Parent Course Category', 'etrain' ),
		'parent_item_colon' => __( 'Parent Course Category:', 'etrain' ),
		'edit_item'         => __( 'Edit Course Category', 'etrain' ),
		'update_item'       => __( 'Update Course Category', 'etrain' ),
		'add_new_item'      => __( 'Add New Course Category', 'etrain' ),
		'new_item_name'     => __( 'New Course Category Name', 'etrain' ),
		'menu_name'         => __( 'Course Category', 'etrain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'course-category' ),
	);

	register_taxonomy( 'course-cat', array( 'course' ), $args );

}
add_action( 'init', 'etrain_custom_posts' );


/*======================================================
    Recent Course for Single Page
=======================================================*/
function etrain_recent_course(){

	$sec_title    = !empty( etrain_opt( 'course_recent_post_section_title' ) ) ? etrain_opt( 'course_recent_post_section_title' ) : '';
	$pnumber      = !empty( etrain_opt( 'course_recent_post_number' ) ) ? etrain_opt( 'course_recent_post_number' ) : '';

	$recentCourse = new WP_Query( array(
        'post_type' => 'course',
        'posts_per_page'    => $pnumber,

    ) );

	?>

	<!-- related_project_part start-->
	<section class="blog_part section_padding related_projects project_details_single">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-12">
                    <div class="section_tittle text-center">
						<?php
							if( $sec_title ){
								echo '<h2>'. wp_kses_post( $sec_title ) .'</h2>';
							}
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
			<?php
				if( $recentCourse->have_posts() ){
					while ( $recentCourse->have_posts() ){
						$recentCourse->the_post(); ?>
                <div class="col-sm-6 col-lg-4 col-xl-4">
                    <div class="single-home-blog">
                        <div class="card">
							<?php
								if( has_post_thumbnail() ){
									the_post_thumbnail( 'etrain_related_projects_360x369', array( 'class' => 'card-img-top', 'alt' => get_the_title() ) );
								}
							?>
                            <div class="card-body">
                                <h4><a href="<?php the_permalink()?>"><?php the_title()?></a></h4>
								<?php
									$categories = get_the_terms( get_the_ID(), "course-cat");
									foreach ( $categories as $category ){
										echo '<p>'. $category->name .'</p>';
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
    </section>
    <!-- related_project_part end-->
<?php
}


/*=========================================================
    Course Section
========================================================*/
function etrain_special_courses( $cNumber = 3, $cOrder, $excerpt_limit = 15 ){

	$courses = new WP_Query( array(
		'post_type' => 'course',
		'posts_per_page'=> $cNumber,
		'order'			=> $cOrder

	) );
	if( $courses->have_posts() ) {
		while ( $courses->have_posts() ) {
			$courses->the_post();
			$args = array(
				'post_id' => get_the_ID(),
			);
			$reviews = get_comments( $args );
			$reviewCount = is_array( $reviews ) ? count( $reviews ) : '';
			$categories = get_the_terms( get_the_ID(), "course-cat");
			$trainer = get_post_meta( get_the_ID(), 'course_trainer', true );
			$trainer_img = get_post_meta( get_the_ID(), 'course_trainer_img_id', true );
			$trainer_img = wp_get_attachment_image( $trainer_img, 'etrain_course_author_img_50x50' );
			$courseFee = get_post_meta( get_the_ID(), 'course_fee', true );
			?>

			<div class="col-sm-6 col-lg-4">
				<div class="single_special_cource">
					<?php 
						the_post_thumbnail( 'etrain_special_course_360x313', [ 'class' => 'special_img', 'alt' => get_the_title() ] );
					?>

					<div class="special_cource_text">
						<?php
							$categories = get_the_terms( get_the_ID(), "course-cat");
							echo '<a href="'.get_category_link( $categories[0]->term_id ).'" class="btn_4">'. $categories[0]->name .'</a>';
						?>
						<h4><?php echo esc_html( $courseFee )?></h4>
						<a href="<?php the_permalink(); ?>"><h3><?php the_title() ?></h3></a>
						<p><?php echo etrain_excerpt_length( $excerpt_limit ) ?></p>
						<div class="author_info">
							<div class="author_img">
								<?php echo $trainer_img?>
								<div class="author_info_text">
									<p><?php echo esc_html( 'Conduct by: ', 'etrain' )?></p>
									<h5><?php echo esc_html( $trainer )?></h5>
								</div>
							</div>
							<div class="author_rating">
								<?php
									$total = get_post_meta( absint( get_the_ID() ), 'etrain_course_avgreview', true ); 
									if( $reviewCount ) {
										$average = $total / $reviewCount;
										$average_review = number_format( $average, 1, ".", "." );
									} else {
										$average_review = 'N/A';
									}
								
									// Star Review ==================
									$review = ceil( $average_review );
									echo '<div class="rating">';
										if ( $review != 'N/A' ) {
											$i = 1;
											for ($i = 1; $i <= 5; $i++) {
												if ($review >= $i) {
													echo '<span class="fa fa-star checked"></span>';
												} else {
													echo '<span class="fa fa-star"></span>';
												}
											}
										} else {
											for ($i = 1; $i <= 5; $i++) {
												echo '<span class="fa fa-star"></span>';
											}
										}
									echo '</div>';
								?>

								<p><?php echo $average_review . esc_html( ' Ratings', 'etrain' );?></p>
							</div>
						</div>
					</div>

				</div>
			</div>
		<?php
		
		}
	}
}


/*==========================================================
 *  Flaticon Icon List
=========================================================*/
function etrain_flaticon_list(){
    return(
        array(
            'flaticon-growth'     => 'Flaticon Growth',
            'flaticon-wallet'     => 'Flaticon Wallet',
        )
    );
}

