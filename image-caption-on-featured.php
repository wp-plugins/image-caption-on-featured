<?php
/*
Plugin Name: Image Caption on Featured
Plugin URI: http://www.jenshunt.se/image-caption-on-featured-wordpress-plugin/
Description: Put the image caption on your featured image. Easy and light.
Author: Jens Hunt
Version: 0.1
Author URI: http://jenshunt.se
License: GPLv2 or later
*/


//***********************************************************
// The Style
//***********************************************************


function wpb_adding_styles() {
wp_register_script('stylen', plugins_url('stylen.css', __FILE__));
wp_enqueue_script('stylen');
}

add_action( 'wp_enqueue_scripts', 'wpb_adding_styles' );  


//***********************************************************
// The Caption
//***********************************************************


function imgcaption(){ 
	
 	global $post;

  	$thumb_id = get_post_thumbnail_id($post->id);

  	$args = array(
		'post_type' => 'attachment',
		'post_status' => null,
		'post_parent' => $post->ID,
		'include'  => $thumb_id
	); 

   $thumbnail_image = get_posts($args);
	$imageurl = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
		$imageurl = $imageurl[0]; ?>
	
		<div class="theimage" style="background-image: url('<?php echo $imageurl; ?>')" >
		<div class="image-texten">
		<?php if ($thumbnail_image && isset($thumbnail_image[0])) {
     echo $thumbnail_image[0]->post_excerpt; 
	} ?>
	

		
		</div>
		</div>
<?php
} 



//***********************************************************
// The Add
//***********************************************************


add_filter( 'post_thumbnail_html', 'imgcaption' );



?>