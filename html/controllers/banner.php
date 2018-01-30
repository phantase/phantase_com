<?php

if($page == 1 && $action == "home" ){
	include_once('controllers/promotedarticles.php');
} else if( $action == "category" ) {
	include_once('views/modules/banner_categorie.php');
} else if( $action == "article") {
	// Quelque chose un jour ?!
} else if( $action == "preview") {
	// Quelque chose un jour ?!
} else if( $action == "home" ) {
	include_once('views/modules/banner_page.php');
}
?>