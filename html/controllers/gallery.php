<?php

/*
 * HOW TO USE GALLERY TAG ?
 * [gallery dir=20090728chateauvalencay]
 */
include_once('models/get_galleries.php');

function readGalleryOptions($galleryTag)
{
	$galleryOptions = array();
	$galleryOptionsRaw = explode(" ",substr($galleryTag,1,strlen($galleryTag)-2));
	foreach($galleryOptionsRaw as $galleryOptionRaw)
	{
		if($galleryOptionRaw != "gallery")
		{
			$galleryOptionArray = explode("=",$galleryOptionRaw);
			$galleryOptions[$galleryOptionArray[0]] = $galleryOptionArray[1];
		}
	}
	return $galleryOptions;
}

function getGalleryHTML($galleryOptions)
{
	$dir = $galleryOptions['dir'];
	$internaldir = './wp-content/gallery/';

	$images = getGalleryImages($dir);

	$output = "<ul class=\"imagelightbox\">";

		foreach($images as $image)
		{
			$file = $image['name'];

			$keep = true;
			if( array_key_exists('only',$galleryOptions ) ){
				if ( strpos($galleryOptions['only'],$file) === false )
					$keep = false;
			}

			if( $keep ){
				$alt = $image['title'];

				$output .= "<li><a href=\"https://cdn.phantase.net/gallery/".$dir."/".$file."\" data-imagelightbox=\"f\"><img src=\"https://cdn.phantase.net/gallery/".$dir."/thumbs/thumbs_".$file."\" alt=\"".$alt."\" /></a></li>";
				// $output .= "<li><a href=\"images/".$dir."/full/".$file."\" data-imagelightbox=\"f\"><img src=\"images/".$dir."/thumb/".$file."\" alt=\"".$alt."\" /></a></li>";
			}
		}

		$output .= "</ul>";

		return $output;

}
?>
