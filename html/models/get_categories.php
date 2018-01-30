<?php
function get_topCategories()
{
    global $bdd;
        
    $req = $bdd->prepare('SELECT categorie_id, categorie_titre, categorie_html FROM blog_categories WHERE categorie_parent_id = 0 ORDER BY categorie_id ASC');
    $req->execute();
    $categories = $req->fetchAll();
    
    return $categories;
}

function get_categoryTitle($categorie)
{
	global $bdd;
        
    $req = $bdd->prepare('SELECT categorie_titre FROM blog_categories WHERE categorie_html = :categorie');
	$req->bindParam(':categorie', $categorie, PDO::PARAM_STR);
    $req->execute();
    $categorieTitre = $req->fetchAll();
    
	if( count($categorieTitre) == 0 )
		return null;
	
    return $categorieTitre[0][0];
}