<?php

session_start();

setlocale(LC_ALL, 'fr_FR.utf8','fra');
include_once('../models/sql_connection.php');
include_once('../models/set_articles.php');

if( ! ( isset( $_SESSION['userid'] ) && $_SESSION['userid'] == 1 ) )
	die("Not authorized");

//continue only if $_POST is set and it is a Ajax request
if(isset($_POST) /*&& isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'*/){
	// 4 parts: i) create metadata of article; ii) create new page for article (this includes the first page of an article); iii) edit metadata of existing article; iv) edit existing page of an article
	if( isset($_POST['action']) ){
		if( $_POST['action'] == "createArticle" ){
			
		} else if( $_POST['action'] == "editArticle" ){
			
			if( isset($_POST['article_id']) && isset($_POST['article_titre']) && isset($_POST['article_html']) && isset($_POST['article_accroche']) ){
				$affectedLine = editArticleMetadata($_POST['article_id'],$_POST['article_titre'],$_POST['article_html'],$_POST['article_accroche']);
				echo $affectedLine;
			}
			
		} else if( $_POST['action'] == "createPage" ){
			
			if( isset( $_POST['article_html']) ){
				$affectedLine = addArticlePage($_POST['article_html']);
				echo $affectedLine;
			}
			
		} else if( $_POST['action'] == "editPage" ){
			
			if( isset($_POST['page_id']) && isset($_POST['page_content']) ){
				$affectedLine = editArticlePage($_POST['page_id'],$_POST['page_content']);
				echo $affectedLine;
			}
			
		} else {
			die("Not authorized");
		}
	}
}

?>