<?php
/*
Plugin Name: Posts or To custom url to qr Code
Plugin URI: https://wptownhall.com
Description: Display QR Code under ever posts and accepts custom url and height width
Version: 1.0
Author: NH Tanvir
Author URI: https://wptownhall.com
License: GPLv2 or later
Text Domain: posts-to-qrcode
Domain Path: /languages/
*/


function pqrc_display_qr_code($content){
	?>
	<form action="" method='post'>
  	<label for="height">Custom Height</label><br>
  	<input type="number" name="height" placeholder="height"><br>
	<label for="width">Custom width</label><br>
  	<input type="number" name="width" placeholder="width"><br>
	<label for="custom_url">Custom Url</label><br>
  	<input type="text" name="custom_url" placeholder="Custom Url"><br><br>
  	<input type="submit" value="Submit">
	</form> 
	<?php
	if(isset($_POST["height"]) && isset($_POST["width"]) && isset($_POST["custom_url"])){
		$custom_url = $_POST['custom_url'];
    	$height = $_POST['height'];
   	 	$width = $_POST['width'];
		$src= sprintf("https://api.qrserver.com/v1/create-qr-code/?data=%s&size=%sx%s&margin=0" , $custom_url , $height ,$width);
    	$content.=sprintf("<img src='%s'>", $src);
		return $content;	
	}else{
		$my_id = get_the_ID();
    	$my_title = get_the_title($my_id);
    	$my_url = get_the_permalink( $my_id);
   	 	$image_src= sprintf("https://api.qrserver.com/v1/create-qr-code/?data=%s&size=220x220&margin=0" , $my_url);
    	$content.=sprintf("<img src='%s' alt='%s'>", $image_src ,$my_title);
    	return $content;
	}
    
}


add_filter( 'the_content', 'pqrc_display_qr_code' );