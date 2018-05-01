<?php

// Retrieve all the promoted articles (MODELS)
include_once('models/get_articles.php');
$articlesPromoted = get_promotedArticles($param_promoted_article_limit);

// On effectue du traitement sur les données (contrôleur)
// Ici, on doit surtout sécuriser l'affichage
foreach($articlesPromoted as $cle => $articlePromoted)
{
    $articlesPromoted[$cle]['article_id'] = $articlePromoted['article_id'];
    $articlesPromoted[$cle]['article_titre'] = htmlspecialchars($articlePromoted['article_titre']);
    $articlesPromoted[$cle]['article_html'] = $articlePromoted['article_html'];
    $articlesPromoted[$cle]['article_accroche'] = nl2br(htmlspecialchars($articlePromoted['article_accroche']));
    $articlesPromoted[$cle]['article_date_publie_html'] = strftime('%Y/%m/%d',strtotime($articlePromoted['article_date_publie']));
    $articlesPromoted[$cle]['article_date_publie_fr'] = strftime('%e %b %Y',strtotime($articlePromoted['article_date_publie']));
}

// On affiche la page (vue)
include_once('views/modules/slider_promotedarticles.php');

?>