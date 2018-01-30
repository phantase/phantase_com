							<!-- Nav -->
								<nav id="nav">
<?php
foreach($categories as $categorie)
{
?>
									<a href="./category/<?php echo $categorie['categorie_html']; ?>/"><?php echo $categorie['categorie_titre']; ?></a>
<?php
}
?>
<?php if( isset( $_SESSION['userid'] ) && $_SESSION['userid'] == 1 ) { ?>
									<a href="./admin/">[ADMINISTRATION]</a>
<?php } ?>
								</nav>
