<?php

// Retrieve all the articles (MODELS)
include_once('models/get_articles.php');
	
if( isset($article) ) {
	$articlesArray = get_unpublishedArticle($article);

	if( count($articlesArray) == 0 ) {
		include_once('views/error.php');
	} else {
		$articleObj = $articlesArray[0];
		$articleObj['article_id'] = $articleObj['article_id'];
		$articleObj['article_titre'] = htmlspecialchars($articleObj['article_titre']);
		$articleObj['article_html'] = $articleObj['article_html'];
		$articleObj['article_accroche'] = $articleObj['article_accroche'];
		$articleObj['article_date_publie_html'] = utf8_encode(strftime('%Y/%m/%d',strtotime($articleObj['article_date_publie'])));
		$articleObj['article_date_publie_fr'] = utf8_encode(strftime('%d %B %Y',strtotime($articleObj['article_date_publie'])));
		$articleObj['article_date_modifie_fr'] = utf8_encode(strftime('%d %B %Y',strtotime($articleObj['article_date_modifie'])));
		$articleObj['article_nbpages'] = $articleObj['article_nbpages'];
		$title = $articleObj['article_titre'];
		$pages = (int) $articleObj['article_nbpages'];
		
		$article_base_write_url = 'write/'.$articleObj['article_date_publie_html'].'/'.$articleObj['article_html'].'/';
		
		if( $pages > 0 && $page <= $pages )
			$pageArray = get_articlePage($article,$page);
		
		if( isset($pageArray) && count($pageArray) > 0 ){
			$pageObj = $pageArray[0];
			$pageObj['page_id'] = $pageObj['page_id'];
			if( $pageObj['page_edit'] == 0 ){
				$pageObj['page_content'] = nl2br_save_html($pageObj['page_content']);
			} else {
				$pageObj['page_content'] = $pageObj['page_content'];
			}
		}
		
		include_once('views/modules/admin_article_write.php');
		
	}
	
}

?>