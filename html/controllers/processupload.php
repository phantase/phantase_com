<?php

session_start();

if( ! ( isset( $_SESSION['userid'] ) && $_SESSION['userid'] == 1 ) )
	die("Not authorized");

	include_once('../models/sql_connection.php');
	include_once('../models/set_galleries.php');


############ Configuration ##############
$thumb_square_size 		= 100; //Thumbnails will be cropped to 200x200 pixels
$max_image_size 		= 500; //Maximum image size (height and width)
$thumb_prefix			= "thumbs_"; //Normal thumb Prefix
$thumb_folder			= 'thumbs/'; //upload directory ends with / (slash)
//$destination_base		= 'C:/wamp/www/phantase/wp-content/gallery/_temp/'; //upload directory ends with / (slash)
$destination_base		= '../wp-content/gallery/';
$destination_path		= '';
$internal_thumb			= 'thumb/';
$internal_fullsize		= 'full/';
$internal_path			= 'images/';
$jpeg_quality 			= 90; //jpeg quality
##########################################

//continue only if $_POST is set and it is a Ajax request
if(isset($_POST) /*&& isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'*/){

	// check $_POST['mypath'] not empty
	if(!isset($_POST['mypath']) && $_POST['mypath'] != "") {
		die('No path provided!');
	}

	// check $_FILES['myfile'] not empty
	if(!isset($_FILES['myfile']) || !is_uploaded_file($_FILES['myfile']['tmp_name'])){
			die('Image file is Missing!'); // output error when above checks fail.
	}
	
	$destination_path = $_POST['mypath'];
	$destination_folder = $destination_base . "/" . $destination_path . "/";
	
	//uploaded file info we need to proceed
	$image_name = $_FILES['myfile']['name']; //file name
	$image_size = $_FILES['myfile']['size']; //file size
	$image_temp = $_FILES['myfile']['tmp_name']; //file temp

	$image_size_info 	= getimagesize($image_temp); //get image size
	
	if($image_size_info){
		$image_width 		= $image_size_info[0]; //image width
		$image_height 		= $image_size_info[1]; //image height
		$image_type 		= $image_size_info['mime']; //image type
	}else{
		die("Make sure image file is valid!");
	}
	
	if( ! file_exists($destination_folder . $thumb_folder) )
		mkdir($destination_folder . $thumb_folder, 0755, true);

	//switch statement below checks allowed image type 
	//as well as creates new image from given file 
	switch($image_type){
		case 'image/png':
			$image_res =  imagecreatefrompng($image_temp); break;
		case 'image/gif':
			$image_res =  imagecreatefromgif($image_temp); break;			
		case 'image/jpeg': case 'image/pjpeg':
			$image_res = imagecreatefromjpeg($image_temp); break;
		default:
			$image_res = false;
	}

	if($image_res){
		//Get file extension and name to construct new file name 
		$image_info = pathinfo($image_name);
		$image_extension = strtolower($image_info["extension"]); //image extension
		$image_name_only = strtolower($image_info["filename"]);//file name only, no extension
		
		//create a random name for new image (Eg: fileName_293749.jpg) ;
		//$new_file_name = $image_name_only. '_' .  rand(0, 9999999999) . '.' . $image_extension;
		$new_file_name = $image_name_only . '.' . $image_extension;
		
		//folder path to save resized images and thumbnails
		$thumb_save_folder 	= $destination_folder . $thumb_folder . $thumb_prefix . $new_file_name; 
		$image_save_folder 	= $destination_folder . $new_file_name;
		
		//call normal_resize_image() function to proportionally resize image
		//if(normal_resize_image($image_res, $image_save_folder, $image_type, $max_image_size, $image_width, $image_height, $jpeg_quality))
		//instead of resize the image, just copy it...
		if(move_uploaded_file($image_temp,$image_save_folder))
		{
			//call crop_image_square() function to create square thumbnails
			if(!crop_image_square($image_res, $thumb_save_folder, $image_type, $thumb_square_size, $image_width, $image_height, $jpeg_quality))
			{
				die('Error Creating thumbnail');
			}

			// lit les meta de l'image
			$alt = "";
			
			$size = getimagesize($destination_folder . $new_file_name, $info);
			if(isset($info['APP13']))
			{
				// On tente avec les IPTC
				$iptc = iptcparse($info['APP13']);
				//var_dump($iptc);
				if( array_key_exists('2#120',$iptc) )
					$alt = utf8_encode($iptc['2#120'][0]);
				else if( array_key_exists('2#005',$iptc) )
					$alt = utf8_encode($iptc['2#005'][0]);
				
			} else { // Sinon on tente avec les EXIF
				$exif = exif_read_data($internaldir.$dir."/".$file);
				//var_dump($exif);
				if( array_key_exists('ImageDescription',$exif) )
					$alt = utf8_encode($exif['ImageDescription']);
				else if( array_key_exists('Title',$exif) )
					$alt = utf8_encode($exif['Title']);
			}

			upload_image($destination_base, $destination_path, $new_file_name);

			addImage($destination_path,$new_file_name,$alt);
			
			/* We have succesfully resized and created thumbnail image
			We can now output image to user's browser or store information in the database*/
			/*echo '<div align="center">';
			echo '<img src="uploads/'.$thumb_prefix . $new_file_name.'" alt="Thumbnail">';
			echo '<br />';
			echo '<img src="uploads/'. $new_file_name.'" alt="Resized Image">';
			echo '</div>';*/
			
echo <<<EOF
<div class="s">
		<p>
			<a href="https://cdn.phantase.net/gallery/{$destination_path}/{$new_file_name}" target="_blank">
				<img src="https://cdn.phantase.net/gallery/{$destination_path}/thumbs/thumbs_{$new_file_name}" />
			</a>
		</p>
    <p>{$new_file_name}</p>
</div>
EOF;
		}
		
		imagedestroy($image_res); //freeup memory
	}
}

#####  This function will proportionally resize image ##### 
function normal_resize_image($source, $destination, $image_type, $max_size, $image_width, $image_height, $quality){
	
	if($image_width <= 0 || $image_height <= 0){return false;} //return false if nothing to resize
	
	//do not resize if image is smaller than max size
	if($image_width <= $max_size && $image_height <= $max_size){
		if(save_image($source, $destination, $image_type, $quality)){
			return true;
		}
	}
	
	//Construct a proportional size of new image
	$image_scale	= min($max_size/$image_width, $max_size/$image_height);
	$new_width		= ceil($image_scale * $image_width);
	$new_height		= ceil($image_scale * $image_height);
	
	$new_canvas		= imagecreatetruecolor( $new_width, $new_height ); //Create a new true color image
	
	//Copy and resize part of an image with resampling
	if(imagecopyresampled($new_canvas, $source, 0, 0, 0, 0, $new_width, $new_height, $image_width, $image_height)){
		save_image($new_canvas, $destination, $image_type, $quality); //save resized image
	}

	return true;
}

##### This function corps image to create exact square, no matter what its original size! ######
function crop_image_square($source, $destination, $image_type, $square_size, $image_width, $image_height, $quality){
	if($image_width <= 0 || $image_height <= 0){return false;} //return false if nothing to resize
	
	if( $image_width > $image_height )
	{
		$y_offset = 0;
		$x_offset = ($image_width - $image_height) / 2;
		$s_size 	= $image_width - ($x_offset * 2);
	}else{
		$x_offset = 0;
		$y_offset = ($image_height - $image_width) / 2;
		$s_size = $image_height - ($y_offset * 2);
	}
	$new_canvas	= imagecreatetruecolor( $square_size, $square_size); //Create a new true color image
	
	//Copy and resize part of an image with resampling
	if(imagecopyresampled($new_canvas, $source, 0, 0, $x_offset, $y_offset, $square_size, $square_size, $s_size, $s_size)){
		save_image($new_canvas, $destination, $image_type, $quality);
	}

	return true;
}

##### Saves image resource to file ##### 
function save_image($source, $destination, $image_type, $quality){
	switch(strtolower($image_type)){//determine mime type
		case 'image/png': 
			imagepng($source, $destination); return true; //save png file
			break;
		case 'image/gif': 
			imagegif($source, $destination); return true; //save gif file
			break;          
		case 'image/jpeg': case 'image/pjpeg': 
			imagejpeg($source, $destination, $quality); return true; //save jpeg file
			break;
		default: return false;
	}
}

function upload_image($base, $directory, $file){
	$ftp_server=""; 
	$ftp_user_name=""; 
	$ftp_user_pass="";
	$remote_directory="/cdn_phantase_com/gallery/";

	// set up basic connection 
	$conn_id = ftp_connect($ftp_server);

	// login with username and password 
	$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass); 

	// goto passive mode
	ftp_pasv($conn_id, true);

	// create folder if needed
	if(ftp_nlist($conn_id, $remote_directory.$directory)) {

	} else {
		ftp_chdir($conn_id, $remote_directory);
		ftp_mkdir($conn_id, $directory);
		ftp_chdir($conn_id, $remote_directory.$directory);
		ftp_mkdir($conn_id, 'thumbs');
	}

	ftp_chdir($conn_id, $remote_directory.$directory);

	// upload the full image
	ftp_put($conn_id, $remote_directory.$directory.'/'.$file, $base.$directory.'/'.$file, FTP_BINARY);
	// upload the thumb image
	ftp_chdir($conn_id, $remote_directory.$directory.'/thumbs/');
	ftp_put($conn_id, $remote_directory.$directory.'/thumbs/thumbs_'.$file, $base.$directory.'/thumbs/thumbs_'.$file, FTP_BINARY);

	// close the connection 
	ftp_close($conn_id); 

	// remove uploaded files
	// thumb and dir
	unlink($base.$directory.'/thumbs/thumbs_'.$file);
	rmdir($base.$directory.'/thumbs');
	// full and dir
	unlink($base.$directory.'/'.$file);
	rmdir($base.$directory);
}

?>