<?php

use Slim\Http\Request;
use Slim\Http\Response;

use Objects\ArticleMapper;
use Objects\CategorieMapper;
use Objects\PageMapper;
use Objects\GalleryMapper;
use Objects\ImageMapper;

// Routes

$app->get('/{year}/{month}/{day}/{html}/[{page}/]', function (Request $request, Response $response, array $args) {
    $article_html = $args['html'];
    $article_mapper = new ArticleMapper($this->db);
    $article = $article_mapper->getArticleByHtml($article_html);
    $article_id = $article->getId();

    $categorie_mapper = new CategorieMapper($this->db);
    $categories = $categorie_mapper->getArticleCategories($article_id);

    $maincategories = $categorie_mapper->getMainCategories();

    if( isset($args['page']) ) {
        $page_number = (int)$args['page'];
    } else {
        $page_number = 1;
    }
    $page_mapper = new PageMapper($this->db);
    $page = $page_mapper->getPageNumberByArticle($article_id, $page_number);
    
    // replace galleries and singlepics pseudo-code by real-code
    $image_mapper = new ImageMapper($this->db);
    $page_content = $page->getContent();

    $page_content = nl2br_save_html($page_content);

    $countgal = preg_match_all("/\[gallery dir=([\S]*)(?: only=([\S]*))?\]/", $page_content, $galleries);
    for ($i=0; $i < count($galleries[0]); $i++) { 
        $gallerie_dir = $galleries[1][$i];
        $gallerie_exception = $galleries[2][$i];
        $gallerie_html = '';

        $images = $image_mapper->getImagesByGalleryName($gallerie_dir);

        for ($j=0; $j < count($images); $j++) {
            $image = $images[$j];
            if( (strlen($gallerie_exception) == 0) || strpos($gallerie_exception, $image->getName()) ) {
                $gallerie_html .= "<li><a href=\"https://cdn.phantase.net/gallery/".$image->getGalleryname()."/".$image->getName()."\"";
                $gallerie_html .= " data-imagelightbox=\"gal".$i."\">";
                $gallerie_html .= "<img src=\"https://cdn.phantase.net/gallery/".$image->getGalleryname()."/thumbs/thumbs_".$image->getName()."\"";
                $gallerie_html .= " alt=\"".$image->getTitle()."\" /></a></li>";
            }
        }
        $page_content = str_replace($galleries[0][$i], '<ul class="imagelightbox">'.$gallerie_html.'</ul>', $page_content);
    }
    $countsinglepics = preg_match_all("/\[singlepic dir=([\S]*) file=([\S]*) (?:width|w)=([0-9]*)(?: (?:height|h)=([0-9]*))?(?: float=([\S]*))?\]/", $page_content, $singlepics);
    for ($i=0; $i < count($singlepics[0]); $i++) {
        $singlepic_dir = $singlepics[1][$i];
        $singlepic_file = $singlepics[2][$i];
        $singlepic_width = $singlepics[3][$i];
        $singlepic_height = $singlepics[4][$i];
        $singlepic_float = $singlepics[5][$i];
        $singlepic_html = '';

        $image = $image_mapper->getImageByNames($singlepic_file,$singlepic_dir);

        if($image) {
            // $style = 'width:'.$singlepic_width.'px; height:'.$singlepic_height.'px;';
            $style = 'width:'.$singlepic_width.'px;';
            if(strlen($singlepic_float) > 0){
                $style .= ' float:'.$singlepic_float.';';
            }
            $singlepic_html = "<img src=\"https://cdn.phantase.net/gallery/".$image->getGalleryname()."/".$image->getName()."\" alt=\"".$image->getTitle()."\" style=\"".$style."\"/>";
        }
        $page_content = str_replace($singlepics[0][$i],$singlepic_html, $page_content);
    }

    return $this->view->render($response, 'article.html', [
        'maincategories' => $maincategories,
        'article' => $article,
        'categories' => $categories,
        'page_content' => $page_content,
        'page_number' => $page_number,
        'article_html' => $args['year'].'/'.$args['month'].'/'.$args['day'].'/'.$args['html'],
    ]);
});

$app->get('/category/{html}/[{page}/]', function (Request $request, Response $response, array $args) {
    $categorie_html = $args['html'];

    if( isset($args['page']) ) {
        $page_number = (int)$args['page'];
    } else {
        $page_number = 1;
    }

    $limit = 12;
    $offset = ($page_number - 1) * $limit;

    $categorie_mapper = new CategorieMapper($this->db);
    $categorie = $categorie_mapper->getCategorieByHtml($categorie_html);

    $maincategories = $categorie_mapper->getMainCategories($categorie_html);

    $nbpages = (int) ($categorie->getNbArticles() / $limit + 1);

    $article_mapper = new ArticleMapper($this->db);
    $articles = $article_mapper->getCategoryArticlesPaging($categorie->getId(), $offset, $limit);

    return $this->view->render($response, 'category.html', [
        'maincategories' => $maincategories,
        'categorie' => $categorie,
        'articles' => $articles,
        'page_number' => $page_number,
        'nbpages' => $nbpages,
    ]);
});

$app->get('/[page/{page}/]', function (Request $request, Response $response, array $args) {

    if( isset($args['page']) ) {
        $page_number = (int)$args['page'];
    } else {
        $page_number = 1;
    }

    $limit = 12;
    $offset = ($page_number - 1) * $limit;
    $promotedlimit = 3;

    $categorie_mapper = new CategorieMapper($this->db);
    $maincategories = $categorie_mapper->getMainCategories($categorie_html);

    $article_mapper = new ArticleMapper($this->db);
    $articles = $article_mapper->getArticlesPaging($offset, $limit);
    $promotedarticles = $article_mapper->getPromotedArticles($promotedlimit);

    $nbarticles = $article_mapper->countArticles();

    $nbpages = (int) ($nbarticles / $limit + 1);

    return $this->view->render($response, 'articles.html', [
        'maincategories' => $maincategories,
        'articles' => $articles,
        'page_number' => $page_number,
        'nbpages' => $nbpages,
        'nbarticles' => $nbarticles,
        'promotedarticles' => $promotedarticles,
    ]);
});
