<?php

	// Vérifie si la catégorie existe
	if( isset($category) )
	{
		include_once('models/get_categories.php');
		$categorie_titre = get_categoryTitle($category);
		if(!isset($categorie_titre))
		{
			$error = true;
		}
	}
	
	if( isset($categorie_titre) )
		$title = "Articles pour la catégorie : ".$categorie_titre." | ".$title." | Page ".$page;
	if( $page > 1 )
		$title .= " | Page ".$page;

	include_once('views/skeleton_top.php');
	
	include_once('controllers/articles.php');
	
	include_once('views/skeleton_bottom.php');
?>