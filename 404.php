<?php 
// Block direct access
if( !defined( 'ABSPATH' ) ){
	exit( 'Direct script access denied.' );
}
/**
 * @Packge 	   : Colorlib

 * @Author 	   : Colorlib
 * @Author URI : http://colorlib.com/wp/
 *
 */
 

	//  Call Header
	get_header(); ?>

		<div id="f0f">
			<div class="container">
				<div class="row justify-content-center">
					<div class="f0f-content text-center">
						<div class="f0f-content-inner">
							<?php 
							$errorText = esc_html__( 'Ooops 404 Error !', 'etrain' );
							if( etrain_opt( 'etrain_fof_titleone' ) ){
								$errorText = etrain_opt( 'etrain_fof_titleone' );
							}
							//
							echo '<h1 class="h1">'.esc_html( $errorText ).'</h1>';
							

							// Wrong text block

							$wrongText = wp_kses_post( __( 'Either something went wrong or the page dosen&rsquo;t exist anymore.', 'etrain' ) );

							if( etrain_opt('etrain_fof_titletwo') ){
								$wrongText = etrain_opt('etrain_fof_titletwo');
							}

							$anchor = etrain_anchor_tag(
								array(
									'url' 	 => esc_url( site_url( '/' ) ),
									'text' 	 => esc_html__( 'Go To Home page', 'etrain' ),
									'class'	 => 'button button-contactForm btn_1'
								)
							);

							echo etrain_paragraph_tag(
								array(
									'text' 	 => esc_html( $wrongText )
								)
							);

							echo wp_kses_post( $anchor );
							?>
						</div>
					</div>
				</div>
			</div>
		</div>

	<?php
	 // Call Footer
	 get_footer();
?>