<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package etrain
 */

get_header();

$categories     = get_the_category();
$count          = count( $categories );
?>

    <section <?php post_class( 'blog_area single-post-area section_padding' ) ?> >
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <div class="single-post">
                        <?php
                        if( has_post_thumbnail() ){ ?>
                            <div class="feature-img">
                                <?php the_post_thumbnail( 'etrain_single_blog_750x375', array( 'class' => 'card-img rounded-0' ) ); ?>
                            </div>
                            <?php
                        } ?>
                        <div class="blog_details">
                            <h2 class="p_title"><?php the_title(); ?></h2>
                            <?php
                            if( etrain_opt( 'etrain_blog_single_meta', 1 ) == 1 ) {
	                            ?>
                                <ul class="blog-info-link mt-3 mb-4">
		                            <?php if ( has_category() ) {
			                            echo '<li><i class="fa fa-tags"></i>';
			                            echo etrain_post_cats();
			                            echo '</li>';
		                            }

		                            echo '<li>';
		                            echo etrain_posted_comments();
		                            echo '</li>';

		                            ?>
                                </ul>
	                            <?php
                            }

	                        if( have_posts() ) :
		                        while( have_posts() ) : the_post();
                                    the_content();

                                    // Link Pages
                                    wp_link_pages(
                                        array(
                                            'before' => '<div class="page-links">' . __( 'Pages:', 'etrain' ),
                                            'after'  => '</div>',
                                        )
                                    );
                                    // Post visitor count 
                                    etrain_set_post_views( get_the_ID() );
		                        endwhile;
                            endif;
                            if( has_tag() ){
                                echo '<div class="tag_list"><span>'.esc_html__( 'Tags:', 'etrain' ).'</span>';
                                echo etrain_post_tags();
                                echo '</div>';
                            }
                            
	                        ?>
                        </div>
                    </div>
                    <div class="navigation-top">
                        <?php
                        if( etrain_opt('etrain_like_btn') == 1 || etrain_opt('etrain_blog_share') == 1 ) {
	                        ?>
                            <div class="d-sm-flex justify-content-between text-center">
		                        <?php
		                        if ( etrain_opt( 'etrain_like_btn' ) == 1 ) {
			                        echo get_simple_likes_button( get_the_ID() );
		                        }

		                        if ( etrain_opt( 'etrain_blog_share' ) == 1 ) {
			                        echo etrain_social_sharing_buttons( 'social-icons' );
		                        }
		                        ?>
                            </div>

	                        <?php
                        }

                        // Post Navigation
                        etrain_blog_single_post_navigation(); ?>
                    </div>

                    <?php
                    //Author Bio ===============
                    if( !empty( get_the_author_meta( 'description' ) ) ) {
	                    etrain_author_bio();
                    }

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) {
	                    comments_template();
                    } ?>
                </div>
                <?php get_sidebar(); ?>
            </div>
        </div>
    </section>

<?php
get_footer();