<?php

function setGalleries()
{
    $internaldir = './wp-content/gallery/';
    $files = scandir($internaldir);

    global $bdd;
    $req = $bdd->prepare('INSERT INTO blog_galleries(galleryname) VALUES (:galleryname)');
    foreach($files as $file)
    {
        if( is_dir($internaldir.$file) && $file != '.' && $file != '..' )
        {
            $req->execute(array(':galleryname'=>$file));
        }
    }
}

function addImage($galname, $imgname, $imgtitle)
{
	global $bdd;
    
    $req = $bdd->prepare('SELECT bg.id FROM blog_galleries AS bg WHERE bg.name=:galname');
    $req->bindParam(':galname', $galname, PDO::PARAM_STR);
	$req->execute();
    $galleries = $req->fetchAll();

    if( count($galleries) > 0 ) {
        $galid = $galleries[0]['id'];
    } else {
        $req = $bdd->prepare('INSERT INTO blog_galleries(name) VALUES (:galname)');
        $req->bindParam(':galname', $galname);
        $affectedLine = $req->execute();
        $galid = $bdd->lastInsertId();
    }

    $req = $bdd->prepare('INSERT INTO blog_images(name, title, galleryid) VALUES (:imgname, :imgtitle, :galid)');
    $req->bindParam(':imgname', $imgname);
    $req->bindParam(':imgtitle', $imgtitle);
    $req->bindParam(':galid', $galid);
    $affectedLine = $req->execute();
    $imgid = $bdd->lastInsertId();

    return $imgid;
}

?>
