<?php
	/*
		ob_start();
		var_dump($someVar);
		$result = ob_get_clean();
	*/
	
	session_start();

date_default_timezone_set('Europe/Paris');

	
	function nl2br_save_html($string)
	{
		if(! preg_match("#</.*>#", $string)) // avoid looping if no tags in the string.
			return nl2br($string);

		$string = str_replace(array("\r\n", "\r", "\n"), "\n", $string);

		$lines=explode("\n", $string);
		$output='';
		foreach($lines as $line)
		{
			$line = rtrim($line);
			if(! preg_match("#</?[^/<>]*>$#", $line)) // See if the line finished with has an html opening or closing tag
				$line .= '<br />';
			$output .= $line . "\n";
		}

		return $output;
	}
	
	function isAdmin()
	{
		return (isset( $_SESSION['userid'] ) && $_SESSION['userid'] == 1);
	}
	
	function isLogged()
	{
		return (isset( $_SESSION['userid'] ) );
	}
	
	setlocale(LC_ALL, 'fr_FR','fra');
	include_once('models/sql_connection.php');
	
	$param_article_limit = 12;
	$param_promoted_article_limit = 5;
	
	$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
	$category = isset($_GET['category']) ? $_GET['category'] : null;
	$date = isset($_GET['date']) ? $_GET['date'] : null;
	$article = isset($_GET['article']) ? $_GET['article'] : null;
	$gallery = isset($_GET['gallery']) ? $_GET['gallery'] : null;
	
	$action = isset($_GET['action']) ? $_GET['action'] : "home";
	
	$title = "Phantase | Photographe amateur";
	
	if( $action == "login" )
		include_once('views/login.php');
	else if( $action == "admin" && isAdmin() )
		include_once('views/admin.php');
	else if( $action == "upload" && isAdmin() )
		include_once('views/admin_gallery_upload.php');
	else if( $action == "write" && isAdmin() )
		include_once('views/admin_article_write.php');
	else if( $action == "articles" && isAdmin() )
		include_once('views/admin_articles_view.php');
	else if( $action == "galleries" && isAdmin() )
		include_once('views/admin_galleries_view.php');
	else if( $action == "gallery" && isAdmin() )
		include_once('views/admin_gallery_view.php');
	else if( ( $action == "article" || $action == "preview" ) && isset($date) && isset($article) )
		include_once('controllers/article.php');
	else if( $action == "category" && isset($category) )
		include_once('views/category.php');
	else if( $action == "home" )
		include_once('views/category.php');
	else
		$action = "error";
			
	if( $action == "error" )
		include_once('views/error.php');
	
?>
