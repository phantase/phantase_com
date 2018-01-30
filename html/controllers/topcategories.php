<?php

// Retrieve all the top Categories (MODELS)
include_once('models/get_categories.php');
$categories = get_topCategories();

// On effectue du traitement sur les données (contrôleur)
// Ici, on doit surtout sécuriser l'affichage
foreach($categories as $cle => $categorie)
{
    $categories[$cle]['categorie_titre'] = htmlspecialchars($categorie['categorie_titre']);
    $categories[$cle]['categorie_html'] = $categorie['categorie_html'];
}

// On affiche la page (vue)
include_once('views/modules/header_categories.php');

