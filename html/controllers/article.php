<?php

// Retrieve all the articles (MODELS)
include_once('models/get_articles.php');
	
if( $action == "preview" && isAdmin() )
	$articlesArray = get_unpublishedArticle($article);
else
	$articlesArray = get_article($article);
if( count($articlesArray) == 0 ) {
	include_once('views/error.php');
} else {
	$articleObj = $articlesArray[0];
    $articleObj['article_id'] = $articleObj['article_id'];
    $articleObj['article_titre'] = htmlspecialchars($articleObj['article_titre']);
    $articleObj['article_accroche'] = htmlspecialchars($articleObj['article_accroche']);
    $articleObj['article_html'] = $articleObj['article_html'];
    $articleObj['article_date_publie_html'] = utf8_encode(strftime('%Y/%m/%d',strtotime($articleObj['article_date_publie'])));
    $articleObj['article_date_publie_fr'] = utf8_encode(strftime('%d %B %Y',strtotime($articleObj['article_date_publie'])));
    $articleObj['article_date_modifie_fr'] = utf8_encode(strftime('%d %B %Y',strtotime($articleObj['article_date_modifie'])));
    $articleObj['article_nbpages'] = $articleObj['article_nbpages'];
		$title = $articleObj['article_titre'];
		$og_title = $articleObj['article_titre'];
		$og_description = $articleObj['article_accroche'];
		$og_image = $articleObj['article_html'];
    $pages = (int) $articleObj['article_nbpages'];
	
	$pageArray = get_articlePage($article,$page);
	if( count($pageArray) == 0 ){
		include_once('views/error.php');
	} else {
		$pageObj = $pageArray[0];
		$pageObj['page_id'] = $pageObj['page_id'];
//		$pageObj['page_content'] = str_replace('>\n','>',$pageObj['page_content']);
//		$pageObj['page_content'] = nl2br($pageObj['page_content']);
		if( $pageObj['page_edit'] == 0 ){
			$pageObj['page_content'] = nl2br_save_html($pageObj['page_content']);
		} else {
			$pageObj['page_content'] = $pageObj['page_content'];
		}
		
		// Search for Singlepics
		include_once('controllers/singlepic.php');
		
		while( $locationSinglepic = strpos($pageObj['page_content'],'[singlepic') ){
			$locationEndSinglepic = strpos($pageObj['page_content'],']',$locationSinglepic);
			if ($locationEndSinglepic === false )
			{
				// Error ?!
			} else {
				$singlepicTag = substr($pageObj['page_content'],$locationSinglepic,($locationEndSinglepic - $locationSinglepic + 1));
				
				$singlepicOptions = readSinglepicOptions($singlepicTag);
				
				$pageObj['page_content'] = str_replace($singlepicTag,getSinglepicHTML($singlepicOptions),$pageObj['page_content']);
			}
		}
		
		// Search for Galleries
		include_once('controllers/gallery.php');
		while( $locationGallery = strpos($pageObj['page_content'],'[gallery') ){
			$locationEndGallery = strpos($pageObj['page_content'],']',$locationGallery);
			if ($locationEndGallery === false )
			{
				// Error ?!
			} else {
				$galleryTag = substr($pageObj['page_content'],$locationGallery,($locationEndGallery - $locationGallery + 1));
				
				$galleryOptions = readGalleryOptions($galleryTag);
				
				$pageObj['page_content'] = str_replace($galleryTag,getGalleryHTML($galleryOptions),$pageObj['page_content']);
			}
		}
		
		include_once('views/article.php');
	}
	
}

?>