<?php

// Retrieve a single gallery (MODELS)
include_once('models/get_galleries.php');

	$galleryObj = getGalleryImages($gallery);

// On effectue du traitement sur les données (contrôleur)
// Ici, on doit surtout sécuriser l'affichage
/*foreach($files as $cle => $file)
{
    $articles[$cle]['article_id'] = $article['article_id'];
    $articles[$cle]['article_titre'] = htmlspecialchars($article['article_titre']);
    $articles[$cle]['article_html'] = $article['article_html'];
    $articles[$cle]['article_accroche'] = nl2br(htmlspecialchars($article['article_accroche']));
    $articles[$cle]['article_date_publie_html'] = utf8_encode(strftime('%Y/%m/%d',strtotime($article['article_date_publie'])));
    $articles[$cle]['article_date_publie_fr'] = utf8_encode(strftime('%d %b %Y',strtotime($article['article_date_publie'])));
    $articles[$cle]['article_date_modifie_html'] = utf8_encode(strftime('%Y/%m/%d',strtotime($article['article_date_modifie'])));
    $articles[$cle]['article_date_modifie_fr'] = utf8_encode(strftime('%d %b %Y',strtotime($article['article_date_modifie'])));
    $articles[$cle]['article_publie_fr'] = $article['article_publie']?"Publié":"En attente";;
    $articles[$cle]['article_promu_fr'] = $article['article_promu']?"Promu":"";;
}*/

// On affiche la page (vue)
include_once('views/modules/admin_gallery_view.php');

?>