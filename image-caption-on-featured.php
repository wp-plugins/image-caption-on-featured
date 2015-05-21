<?php
/*
Plugin Name: Image Caption on Featured
Plugin URI: http://jenshunt.se
Description: Put the image caption on your featured image. Easy and light.
Author: Jens Hunt
Version: 0.1
Author URI: http://jenshunt.se
*/


//***********************************************************
// The Style
//***********************************************************

function build_stylesheet_url() {
    echo '<link rel="stylesheet" href="' . plugins_url( 'stylen.css', __FILE__ ) .'" type="text/css" media="screen" />';
}

add_action( 'wp_head', 'build_stylesheet_url' );



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