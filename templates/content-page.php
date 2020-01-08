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



?>

	<div id="page_<?php the_ID(); ?>" <?php post_class('row'); ?>>
		<?php 

		/**
		 * page content 
		 * Comments Template
		 * @Hook  etrain_page_content
		 *
		 * @Hooked etrain_page_content_cb
		 * 
		 *
		 */
		do_action( 'etrain_page_content' );

		?>
	</div>
