<?php

use Slim\Http\Request;
use Slim\Http\Response;

use Objects\ArticleMapper;
use Objects\CategorieMapper;
use Objects\PageMapper;

// Routes

$app->get('/articles', function (Request $request, Response $response, array $args) {
    $article_mapper = new ArticleMapper($this->db);
    $articles = $article_mapper->getArticles();
    return $this->view->render($response, 'articles.html', [
        'articles' => $articles,
    ]);
});

$app->get('/article/id/{id}', function (Request $request, Response $response, array $args) {
    $article_id = (int)$args['id'];
    $article_mapper = new ArticleMapper($this->db);
    $article = $article_mapper->getArticleById($article_id);
    return $this->view->render($response, 'article.html', [
        'article' => $article,
    ]);
});

$app->get('/article/{html}', function (Request $request, Response $response, array $args) {
    $article_html = $args['html'];
    $article_mapper = new ArticleMapper($this->db);
    $article = $article_mapper->getArticleByHtml($article_html);
    return $this->view->render($response, 'article.html', [
        'article' => $article,
    ]);
});

$app->get('/categories', function (Request $request, Response $response, array $args) {
    $categorie_mapper = new CategorieMapper($this->db);
    $categories = $categorie_mapper->getCategories();
    return $this->view->render($response, 'categories.html', [
        'categories' => $categories,
    ]);
});

$app->get('/categorie/id/{id}', function (Request $request, Response $response, array $args) {
    $categorie_id = (int)$args['id'];
    $categorie_mapper = new CategorieMapper($this->db);
    $categorie = $categorie_mapper->getCategorieById($categorie_id);
    return $this->view->render($response, 'categorie.html', [
        'categorie' => $categorie,
    ]);
});

$app->get('/categorie/{html}', function (Request $request, Response $response, array $args) {
    $categorie_html = $args['html'];
    $categorie_mapper = new CategorieMapper($this->db);
    $categorie = $categorie_mapper->getCategorieByHtml($categorie_html);
    return $this->view->render($response, 'categorie.html', [
        'categorie' => $categorie,
    ]);
});

$app->get('/pages', function (Request $request, Response $response, array $args) {
    $page_mapper = new PageMapper($this->db);
    $pages = $page_mapper->getPages();
    return $this->view->render($response, 'pages.html', [
        'pages' => $pages,
    ]);
});

$app->get('/page/id/{id}', function (Request $request, Response $response, array $args) {
    $page_id = (int)$args['id'];
    $page_mapper = new PageMapper($this->db);
    $page = $page_mapper->getPageById($page_id);
    return $this->view->render($response, 'page.html', [
        'page' => $page,
    ]);
});

$app->get('/article/id/{id}/pages', function (Request $request, Response $response, array $args) {
    $article_id = (int)$args['id'];
    $page_mapper = new PageMapper($this->db);
    $pages = $page_mapper->getPagesByArticle($article_id);
    return $this->view->render($response, 'pages.html', [
        'pages' => $pages,
    ]);
});




$app->get('/{year}/{month}/{day}/{html}/{page}/', function (Request $request, Response $response, array $args) {
    $article_html = $args['html'];
    $article_mapper = new ArticleMapper($this->db);
    $article = $article_mapper->getArticleByHtml($article_html);
    $article_id = $article->getId();
    $page_number = (int)$args['page'];
    $page_mapper = new PageMapper($this->db);
    $page = $page_mapper->getPageNumberByArticle($article_id, $page_number);
    
    // replace galleries and images pseudo-code by real-code
    $page_content = $page->getContent();
    preg_match_all("/\[gallery dir=[a-zA-Z0-9]*\]/", $page_content, $galleries_found);

    return $this->view->render($response, 'base_article.html', [
        'article' => $article,
        'page' => $page,
        'galleries' => $galleries_found,
        'countgal' => count($galleries_found),
    ]);
});
