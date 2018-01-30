<?php

/*
 * HOW TO USE SINGLEPIC TAG ?
 * [singlepic dir=20091030chibijapanexpo file=dsc_1023.jpg width=500 height=500]
 */
include_once('models/get_galleries.php');

function readSinglepicOptions($singlepicTag)
{
	$singlepicOptions = array();
	$singlepicOptionsRaw = explode(" ",substr($singlepicTag,1,strlen($singlepicTag)-2));
	foreach($singlepicOptionsRaw as $singlepicOptionRaw)
	{
		if($singlepicOptionRaw != "singlepic")
		{
			$singlepicOptionArray = explode("=",$singlepicOptionRaw);
			$singlepicOptions[$singlepicOptionArray[0]] = $singlepicOptionArray[1];
		}
	}
	return $singlepicOptions;
}

function getSinglepicHTML($singlepicOptions)
{
	$dir = $singlepicOptions['dir'];
	$file = $singlepicOptions['file'];
	$internaldir = './wp-content/gallery/';

	$image = getGalleryImage($dir,$file)[0];

	// lit les meta de l'image
	$alt = $image['title'];

	$style = "";
	if( array_key_exists('float',$singlepicOptions ) ){
		$style = $style." margin:10px; float: ".$singlepicOptions['float'].";";
	}
	if( strlen($style) > 0 )
		$style = "style=\"".$style."\"";

	$width = "";
	if( array_key_exists('width',$singlepicOptions ) )
		$width = "width=\"".$singlepicOptions['width']."\"";
	if( array_key_exists('w',$singlepicOptions ) )
		$width = "width=\"".$singlepicOptions['w']."\"";

	return "<a href=\"https://cdn.phantase.net/gallery/".$dir."/".$file."\" data-imagelightbox=\"f\"><img src=\"https://cdn.phantase.net/gallery/".$dir."/".$file."\" alt=\"".$alt."\" ".$width." ".$style."/></a>";
	// return "<a href=\"images/".$dir."/full/".$file."\" data-imagelightbox=\"f\"><img src=\"images/".$dir."/full/".$file."\" alt=\"".$alt."\" ".$width." ".$style."/></a>";

}
?>
