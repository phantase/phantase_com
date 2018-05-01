<?php
function get_allArticles()
{
    global $bdd;
        
    $req = $bdd->prepare('SELECT ba.article_id, ba.article_titre, ba.article_html, ba.article_accroche, ba.article_date_publie, ba.article_date_modifie, ba.article_publie, ba.article_promu, ba.article_nbpages FROM blog_articles AS ba ORDER BY ba.article_date_publie DESC');
    $req->execute();
    $articles = $req->fetchAll();
    
    return $articles;
}

function get_articles($offset, $limit)
{
    global $bdd;
    $offset = (int) $offset;
    $limit = (int) $limit;
        
    $req = $bdd->prepare('SELECT ba.article_id, ba.article_titre, ba.article_html, ba.article_accroche, ba.article_date_publie FROM blog_articles AS ba WHERE ba.article_publie = 1 ORDER BY ba.article_date_publie DESC LIMIT :offset, :limit');
    $req->bindParam(':offset', $offset, PDO::PARAM_INT);
    $req->bindParam(':limit', $limit, PDO::PARAM_INT);
    $req->execute();
    $articles = $req->fetchAll();
    
    return $articles;
}

function get_articlesForCategory($offset, $limit, $category)
{
    global $bdd;
    $offset = (int) $offset;
    $limit = (int) $limit;
        
    $req = $bdd->prepare('SELECT ba.article_id, ba.article_titre, ba.article_html, ba.article_accroche, ba.article_date_publie FROM blog_articles AS ba, blog_catarticles AS bca, blog_categories AS bc WHERE bca.article_id=ba.article_id AND bca.categorie_id=bc.categorie_id AND ba.article_publie = 1 AND bc.categorie_html = :category ORDER BY ba.article_date_publie DESC LIMIT :offset, :limit');
    $req->bindParam(':offset', $offset, PDO::PARAM_INT);
    $req->bindParam(':limit', $limit, PDO::PARAM_INT);
    $req->bindParam(':category', $category, PDO::PARAM_STR);
    $req->execute();
    $articles = $req->fetchAll();
    
    return $articles;
}

function get_promotedArticles($limit)
{
    global $bdd;
	$limit = (int) $limit;
        
    $req = $bdd->prepare('SELECT article_id, article_titre, article_html, article_accroche, article_date_publie FROM blog_articles WHERE article_publie = 1 AND article_promu = 1 ORDER BY article_date_publie DESC LIMIT :limit');
    $req->bindParam(':limit', $limit, PDO::PARAM_INT);
    $req->execute();
    $articles = $req->fetchAll();
    
    return $articles;
}

function get_numberOfArticles()
{
    global $bdd;
        
    $req = $bdd->prepare('SELECT count(*) FROM blog_articles WHERE article_publie = 1 ');
    $req->execute();
    $number = $req->fetchAll();
    
    return $number;
}

function get_numberOfArticlesForCategory($category)
{
    global $bdd;
        
    $req = $bdd->prepare('SELECT count(ba.article_id) FROM blog_articles AS ba, blog_catarticles AS bca, blog_categories AS bc WHERE bca.article_id=ba.article_id AND bca.categorie_id=bc.categorie_id AND ba.article_publie = 1 AND bc.categorie_html = :category');
    $req->bindParam(':category', $category, PDO::PARAM_STR);
	$req->execute();
    $number = $req->fetchAll();
    
    return $number;
}

function get_article($article_html)
{
	global $bdd;
        
    $req = $bdd->prepare('SELECT ba.article_id, ba.article_titre, ba.article_accroche, ba.article_html, ba.article_date_publie, ba.article_date_modifie, ba.article_nbpages FROM blog_articles AS ba WHERE ba.article_publie=1 AND ba.article_html=:article_html');
    $req->bindParam(':article_html', $article_html, PDO::PARAM_STR);
	$req->execute();
    $article = $req->fetchAll();
    
    return $article;
}

function get_unpublishedArticle($article_html)
{
	global $bdd;
        
    $req = $bdd->prepare('SELECT ba.article_id, ba.article_titre, ba.article_html, ba.article_accroche, ba.article_date_publie, ba.article_date_modifie, ba.article_nbpages FROM blog_articles AS ba WHERE ba.article_html=:article_html');
    $req->bindParam(':article_html', $article_html, PDO::PARAM_STR);
	$req->execute();
    $article = $req->fetchAll();
    
    return $article;
}

function get_articleCategories($article_html)
{
	global $bdd;
        
    $req = $bdd->prepare('SELECT bc.categorie_titre, bc.categorie_html FROM blog_articles AS ba, blog_catarticles AS bca, blog_categories AS bc WHERE ba.article_html=:article_html AND bca.article_id=ba.article_id AND bca.categorie_id=bc.categorie_id');
    $req->bindParam(':article_html', $article_html, PDO::PARAM_STR);
	$req->execute();
    $article = $req->fetchAll();
    
    return $article;
}

function get_articlePage($article_html,$page)
{
	global $bdd;
	
	$page = (int) $page;
        
    $req = $bdd->prepare('SELECT bp.page_id, bp.page_content, bp.page_edit FROM blog_articles AS ba, blog_pages AS bp WHERE ba.article_html=:article_html AND ba.article_id=bp.article_id AND bp.page_numero=:page');
    $req->bindParam(':article_html', $article_html, PDO::PARAM_STR);
    $req->bindParam(':page', $page, PDO::PARAM_INT);
	$req->execute();
    $article = $req->fetchAll();
    
    return $article;
}

?>