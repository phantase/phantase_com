<?php

// Retrieve all the promoted articles (MODELS)
include_once('models/get_articles.php');
$articles = get_promotedArticles($param_promoted_article_limit);

// On effectue du traitement sur les données (contrôleur)
// Ici, on doit surtout sécuriser l'affichage
foreach($articles as $cle => $article)
{
    $articles[$cle]['article_id'] = $article['article_id'];
    $articles[$cle]['article_titre'] = htmlspecialchars($article['article_titre']);
    $articles[$cle]['article_html'] = $article['article_html'];
    $articles[$cle]['article_accroche'] = nl2br(htmlspecialchars($article['article_accroche']));
    $articles[$cle]['article_date_publie_html'] = strftime('%Y/%m/%d',strtotime($article['article_date_publie']));
    $articles[$cle]['article_date_publie_fr'] = strftime('%e %b %Y',strtotime($article['article_date_publie']));
}

// On affiche la page (vue)
include_once('views/modules/slider_promotedarticles.php');

?>