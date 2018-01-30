<?php

// Retrieve all the articles (MODELS)
include_once('models/get_articles.php');

$articleCategories = get_articleCategories($article);

// On effectue du traitement sur les données (contrôleur)
// Ici, on doit surtout sécuriser l'affichage
foreach($articleCategories as $cle => $articleCategorie)
{
    $articleCategories[$cle]['categorie_titre'] = $articleCategorie['categorie_titre'];
    $articleCategories[$cle]['categorie_html'] = $articleCategorie['categorie_html'];
}

// On affiche la page (vue)
include_once('views/modules/article_categories.php');

?>