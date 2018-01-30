<ul><?php
foreach($gallery as $image)
{
?><li><a href="images/<?php echo $image['dir']; ?>/full/<?php echo $image['file']; ?>" data-imagelightbox="f"><img src="images/<?php echo $image['dir']; ?>/thumb/<?php echo $image['file']; ?>" alt="<?php echo $image['alt']; ?>" /></a></li><?php
}</ul>