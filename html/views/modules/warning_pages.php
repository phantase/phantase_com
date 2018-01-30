<?php
if( $articleObj['article_nbpages'] > 1 ){
?>
 - <span class="warning">Attention, cet article comporte <?php echo $articleObj['article_nbpages']; ?>, changez de page en utilisant les liens situés en bas d'article.</span>
<?php
}
?>
