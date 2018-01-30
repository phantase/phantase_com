<?php
function get_galleries()
{
    $internaldir = './wp-content/gallery/';
	$files = scandir($internaldir);

	$galleries = array();

	foreach($files as $file)
	{
		if( is_dir($internaldir.$file) && $file != '.' && $file != '..' )
		{
			$gallery = array();
			$gallery['dir'] = $file;

			$content = scandir($internaldir.$file);

			$galcontent = array();
			foreach($content as $subfile)
			{
				if(substr($subfile,strlen($subfile)-4) == '.jpg' )
					$galcontent[] = $subfile;
			}

			$gallery['content'] = $galcontent;
			$gallery['size'] = count($galcontent);

			$galleries[] = $gallery;
		}
	}

	return $galleries;
}

function get_gallery($gallery)
{
    $internaldir = './wp-content/gallery/';
	$content = scandir($internaldir.$gallery);

	$galcontent = array();
	foreach($content as $subfile)
	{
		if(substr($subfile,strlen($subfile)-4) == '.jpg' )
			$galcontent[] = $subfile;
	}

	return $galcontent;
}

function getGalleryImages($galname)
{
	global $bdd;

    $req = $bdd->prepare('SELECT bi.id, bi.name, bi.title FROM blog_images AS bi, blog_galleries AS bg WHERE bi.galleryid = bg.id AND bg.name=:galname');
    $req->bindParam(':galname', $galname, PDO::PARAM_STR);
	$req->execute();
    $images = $req->fetchAll();

    return $images;
}

function getGalleryImage($galname, $imgname)
{
	global $bdd;

    $req = $bdd->prepare('SELECT bi.id, bi.name, bi.title FROM blog_images AS bi, blog_galleries AS bg WHERE bi.galleryid = bg.id AND bg.name=:galname AND bi.name=:imgname');
    $req->bindParam(':galname', $galname, PDO::PARAM_STR);
    $req->bindParam(':imgname', $imgname, PDO::PARAM_STR);
	$req->execute();
    $images = $req->fetchAll();

    return $images;
}

?>
