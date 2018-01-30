<?php
$cptCat = 0;
foreach($articleCategories as $articleCategorie)
{
if($cptCat > 0)
	echo ',';
?>
<a href="./category/<?php echo $articleCategorie['categorie_html']; ?>/"><?php echo $articleCategorie['categorie_titre']; ?></a>
<?php
}
?>
