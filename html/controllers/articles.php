<?php

$og_title = "Phantase - Photographe amateur";
$og_description = "Site personnel de présentation de mes sessions de photos.";

// Vérifie si la catégorie existe
if( isset($category) )
{
    include_once('models/get_categories.php');
    $categorie_titre = get_categoryTitle($category);
    $og_description = "Catégorie ".$categorie_titre." de mon site personnel de présentation de mes sessions photos.";
    if(!isset($categorie_titre))
    {
        $error = true;
    }
}

if( isset($categorie_titre) )
    $title = "Articles pour la catégorie : ".$categorie_titre." | ".$title;
if( $page > 1 )
    $title .= " | Page ".$page;

$og_title = $title;

// Retrieve all the articles (MODELS)
include_once('models/get_articles.php');
if(isset($category)) {
	$articles = get_articlesForCategory(($page-1)*$param_article_limit,$param_article_limit,$category);
	$numberOfArticles = get_numberOfArticlesForCategory($category)[0][0];
} else {
	$articles = get_articles(($page-1)*$param_article_limit,$param_article_limit);
	$numberOfArticles = get_numberOfArticles()[0][0];
}

// On effectue du traitement sur les données (contrôleur)
// Ici, on doit surtout sécuriser l'affichage
foreach($articles as $cle => $article)
{
    $articles[$cle]['article_id'] = $article['article_id'];
    $articles[$cle]['article_titre'] = htmlspecialchars($article['article_titre']);
    $articles[$cle]['article_html'] = $article['article_html'];
    $articles[$cle]['article_accroche'] = nl2br(htmlspecialchars($article['article_accroche']));
    $articles[$cle]['article_date_publie_html'] = utf8_encode(strftime('%Y/%m/%d',strtotime($article['article_date_publie'])));
    $articles[$cle]['article_date_publie_fr'] = utf8_encode(strftime('%d %b %Y',strtotime($article['article_date_publie'])));
}

$og_image = $articles[0]['article_html'];

$pages = floor($numberOfArticles / $param_article_limit)+1;

// On affiche la page (vue)
include_once('views/category.php');

?>