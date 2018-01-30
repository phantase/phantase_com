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

?>
