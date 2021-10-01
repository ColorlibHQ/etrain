<?php 
/**
 * @Packge     : Etrain

 * @Author     : Colorlib
 * @Author URI : http://colorlib.com/wp/
 *
 */

// Block direct access
if( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

 if ( is_user_logged_in() ) {
    $currentUser = wp_get_current_user();
    $currentUserId = $currentUser->data->ID;
 } else {
    $currentUserId = '';
 }

// Call Header
get_header();
    if( function_exists( 'etrain_set_post_views' ) ){
        etrain_set_post_views( get_the_ID() );
    }
    
    if( have_posts() ){ ?>

    <!--================ Start Course Details Area =================-->
    <section class="course_details_area section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 course_details_left">
                    <?php
                        if( has_post_thumbnail() ){ ?>
                            <div class="main_image">
                                <?php the_post_thumbnail( 'etrain_single_blog_750x375', array( 'class' => 'img-fluid' ) )?>
                            </div>
                            <?php                            
                        }
                    ?>

                    <div class="content_wrapper">
                        <h4 class="title_top"><?php echo esc_html__( 'Objectives', 'etrain' ); ?></h4>
                        <div class="content">
                            <?php 
                                while( have_posts() ){
                                    the_post();
                                    the_content();
                                }

                                $args = array(
                                    'post_id' => get_the_ID(),
                                );
                                $reviews = get_comments( $args );
                                $reviewCount = is_array( $reviews ) ?  count( $reviews ) : '';
                            ?>   
                        </div>

                        <h4 class="title"><?php echo esc_html__( 'Eligibility', 'etrain' ); ?></h4>
                        <div class="content">
                            <?php
                                $eligibility = get_post_meta( get_the_ID(), 'course_eligibility', true );
                                if( !empty( $eligibility ) ){
                                    echo wp_kses_post( $eligibility );
                                }
                            ?> 
                        </div>

                        <h4 class="title"><?php echo esc_html__( 'Course Outline', 'etrain' ); ?></h4>
                        <div class="content">
                            <ul class="course_list">
                                <?php
                                    $outlines = get_post_meta( get_the_ID(), 'course_outlines', true );
                                    if( ! empty( $outlines ) ){
                                        foreach( $outlines as $outline ){
                                            echo '<li class="justify-content-between align-items-center d-flex">';
                                            echo '<p>'. $outline['lesson_title'] .'</p>';
                                            echo '<a class="btn_2 text-uppercase" href="'. esc_url( $outline['outline_btn_url'] ) .'">'.esc_html__( 'View Details', 'etrain' ).'</a>';
                                            echo '</li>';
                                            
                                        }
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="col-lg-4 right-contents">
                    <div class="sidebar_top">
                        <ul>
                            <?php
                            $trainer = get_post_meta( get_the_ID(), 'course_trainer', true );
                            $courseFee = get_post_meta( get_the_ID(), 'course_fee', true );
                            $courseSeat = get_post_meta( get_the_ID(), 'course_seat', true );
                            $courseSchedule = get_post_meta( get_the_ID(), 'course_schedule', true );

                            if( ! empty( $trainer ) ){ ?>
                                <li>
                                    <span class="justify-content-between d-flex" >
                                        <p><?php echo esc_html__('Trainer’s Name', 'etrain') ?></p> 
                                        <span class="or"><?php echo esc_html( $trainer ) ?></span>
                                    </span>
                                </li>
                                <?php
                            }
                            if( ! empty( $courseFee ) ){ ?>
                                 <li>
                                    <span class="justify-content-between d-flex" >
                                        <p><?php echo esc_html__('Course Fee', 'etrain') ?> </p>
                                        <span><?php echo esc_html( $courseFee ) ?></span>
                                    </span>
                                </li>
                            <?php
                            }
                            if( ! empty( $courseSeat ) ){ ?>
                                <li>
                                    <span class="justify-content-between d-flex" >
                                        <p><?php echo esc_html__('Available Seats', 'etrain') ?> </p>
                                        <span><?php echo esc_html( $courseSeat ) ?></span>
                                    </span>
                                </li>
                            <?php
                            }
                            if( ! empty( $courseSchedule ) ){ ?>
                                <li>
                                    <span class="justify-content-between d-flex" >
                                        <p><?php echo esc_html__('Schedule', 'etrain') ?></p>
                                        <span><?php echo esc_html( $courseSchedule ) ?></span>
                                    </span>
                                </li>
                            <?php
                            } ?>                            
                        </ul>
                        <?php
                        $course_enroll = get_post_meta( get_the_ID(), 'course_enroll', true );
                        ?>
                        <a href="<?php echo esc_url( $course_enroll ) ?>" class="btn_1 d-block"><?php echo esc_html__( 'Enroll the course', 'etrain' ) ?></a>
                    </div>

                    <h4 class="title"><?php echo esc_html__( 'Reviews', 'etrain' ); ?></h4>
                    <div class="content">
                        <div class="review-top row pt-40">
                            <div class="col-lg-12">
                                <h6 class="mb-15"><?php echo esc_html__( 'Provide Your Rating', 'etrain' ); ?></h6>
                                <div class="d-flex flex-row reviews justify-content-between">
                                    <span><?php echo esc_html__( 'Quality', 'etrain' ); ?></span>
                                    <div class='rating-stars text-center'>
                                        <ul id='stars'>
                                        <li class='star' title='Poor' data-value='1'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' title='Fair' data-value='2'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' title='Good' data-value='3'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' title='Excellent' data-value='4'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' title='WOW!!!' data-value='5'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        </ul>
                                    </div>
                                    <div class='success-box text-right'>
                                        <div class='text-message'><span><?php echo esc_html__( 'N/A', 'etrain' ); ?></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="feedeback">
                            <h6><?php echo esc_html__( 'Your Feedback', 'etrain' ); ?></h6>
                            <form action="#" method="post" id="reviw_submit" >
                                <textarea name="feedback" id="feedback" class="form-control" cols="10" rows="10"></textarea>
                                <input type="hidden" name="ratingvalue" id="ratingvalue" >
                                <input type="hidden" id="reviewajax" value="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ) ?>" >
                                <input type="hidden" name="userid" id="userid" value="<?php echo absint( $currentUserId ) ?>" >
                                <input type="hidden" name="postid" id="postid" value="<?php echo absint( get_the_ID() ); ?>" >
                                <div class="mt-10 text-right">
                                    <button type="submit" name="subpost" class="btn_1"><?php echo esc_html__( 'Submit', 'etrain' ); ?></button>
                                </div>
                            </form>
                        </div>
                        <div class="comments-area mb-30">
                            <?php 
                            if( $reviewCount > 0 ){
                                foreach( $reviews as $review ){ 
                                    $starReview = get_comment_meta( $review->comment_ID, 'etrain_course_review', true );
                                    
                                    ?>
                                    <div class="comment-list">
                                        <div class="single-comment single-reviews justify-content-between d-flex">
                                            <div class="user justify-content-between d-flex">
                                                <div class="thumb">
                                                    <?php echo get_avatar( $review->user_id , 60 ); ?>
                                                </div>
                                                <div class="desc">
                                                    <h5><?php echo $review->comment_author;  ?></h5>
                                                    <?php
                                                    // Star Review ==================
                                                    if (!empty( $starReview )) {
                                                        echo '<div class="star">';
                                                        $i = 1;
                                                        for ($i = 1; $i <= 5; $i++) {

                                                            if ($starReview >= $i) {
                                                                echo '<span class="fa fa-star checked"></span>';
                                                            } else {
                                                                echo '<span class="fa fa-star"></span>';
                                                            }
                                                        }
                                                        echo '</div>';
                                                    } ?>
                                                    </h5>
                                                    <p class="comment"> <?php echo $review->comment_content; ?> </p>
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
        </div>
    </section>
    <!--================ End Course Details Area =================-->


<?php
    }
// Call Footer
get_footer();
