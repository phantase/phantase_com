<?php

function editArticleMetadata($article_id,$article_titre,$article_html,$article_accroche)
{
    global $bdd;
        
    $req = $bdd->prepare('UPDATE blog_articles SET article_titre = :article_titre, article_html = :article_html, article_accroche = :article_accroche WHERE article_id = :article_id');
    $req->bindParam(':article_id', $article_id, PDO::PARAM_INT);
    $req->bindParam(':article_titre', $article_titre, PDO::PARAM_STR);
    $req->bindParam(':article_html', $article_html, PDO::PARAM_STR);
    $req->bindParam(':article_accroche', $article_accroche, PDO::PARAM_STR);
    $affectedLine = $req->execute();
    
    return $affectedLine;
}

function editArticlePage($page_id,$page_content)
{
	global $bdd;
	
	$req = $bdd->prepare('UPDATE blog_pages SET page_content = :page_content, page_edit = 1 WHERE page_id = :page_id');
    $req->bindParam(':page_content', $page_content, PDO::PARAM_STR);
    $req->bindParam(':page_id', $page_id, PDO::PARAM_INT);
	$affectedLine = $req->execute();
    
    return $affectedLine;
}

function addArticlePage($article_html)
{
	global $bdd;
	
	// Retrieve article
    $req = $bdd->prepare('SELECT ba.article_id, ba.article_nbpages FROM blog_articles AS ba WHERE ba.article_html=:article_html');
    $req->bindParam(':article_html', $article_html, PDO::PARAM_STR);
	$req->execute();
    $article = $req->fetchAll();
	
	// Retrieve article id
	$article_id = $article[0]['article_id'];
	// Compute new page number
	$page_numero = $article[0]['article_nbpages'] + 1;
	
	// Create new page
	$req = $bdd->prepare('INSERT INTO blog_pages(article_id,page_numero) VALUES (:article_id,:page_numero)');
    $req->bindParam(':article_id', $article_id, PDO::PARAM_INT);
    $req->bindParam(':page_numero', $page_numero, PDO::PARAM_INT);
	$affectedLine = $req->execute();
	//$affectedLine = $bdd->lastInsertId();
    
	// Incremente page number of article
    $req = $bdd->prepare('UPDATE blog_articles SET article_nbpages = :article_nbpages WHERE article_id = :article_id');
    $req->bindParam(':article_nbpages', $page_numero, PDO::PARAM_INT);
    $req->bindParam(':article_id', $article_id, PDO::PARAM_INT);
    $req->execute();
	
    //return $affectedLine;
    return $page_numero;
}

?>