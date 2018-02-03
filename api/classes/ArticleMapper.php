<?php

namespace Objects;

class ArticleMapper extends Mapper
{
  public function countArticles() {
    $sql = "SELECT count(*) AS count
            FROM blog_articles a
            WHERE a.article_publie = 1";
    $stmt = $this->db->query($sql);
    $row = $stmt->fetch();

    return $row['count'];
  }

  public function getArticles() {
    $sql = "SELECT a.article_id AS id, 
                    a.article_titre AS titre,
                    a.article_html AS html,
                    a.article_accroche AS accroche,
                    a.article_publie AS publie,
                    a.article_promu AS promu,
                    a.article_date_publie AS date_publie,
                    a.article_date_modifie AS date_modifie,
                    a.article_nbpages AS nbpages
            FROM blog_articles a
            WHERE a.article_publie = 1
            ORDER BY a.article_date_publie DESC";
    $stmt = $this->db->query($sql);

    $results = [];
    while($row = $stmt->fetch()) {
      $results[] = new ArticleEntity($row);
    }
    return $results;
  }

  public function getArticlesPaging($offset,$limit) {
    $sql = "SELECT a.article_id AS id, 
                    a.article_titre AS titre,
                    a.article_html AS html,
                    a.article_accroche AS accroche,
                    a.article_publie AS publie,
                    a.article_promu AS promu,
                    a.article_date_publie AS date_publie,
                    a.article_date_modifie AS date_modifie,
                    a.article_nbpages AS nbpages
            FROM blog_articles a
            WHERE a.article_publie = 1
            ORDER BY a.article_date_publie DESC
            LIMIT :offset,:limit";
     $stmt = $this->db->prepare($sql);
     $stmt->bindParam('offset', $offset, \PDO::PARAM_INT);
     $stmt->bindParam('limit', $limit, \PDO::PARAM_INT);
     $result = $stmt->execute();
 
     $results = [];
     while($row = $stmt->fetch()) {
       $results[] = new ArticleEntity($row);
     }
     return $results;
  }

  public function getCategoryArticles($category_id) {
    $sql = "SELECT a.article_id AS id, 
                    a.article_titre AS titre,
                    a.article_html AS html,
                    a.article_accroche AS accroche,
                    a.article_publie AS publie,
                    a.article_promu AS promu,
                    a.article_date_publie AS date_publie,
                    a.article_date_modifie AS date_modifie,
                    a.article_nbpages AS nbpages
            FROM blog_articles a
            JOIN blog_catarticles ca ON ca.article_id = a.article_id
            WHERE ca.categorie_id = :category_id
            AND a.article_publie = 1
            ORDER BY a.article_date_publie DESC";
     $stmt = $this->db->prepare($sql);
     $result = $stmt->execute(["category_id" => $category_id]);
 
     $results = [];
     while($row = $stmt->fetch()) {
       $results[] = new ArticleEntity($row);
     }
     return $results;
  }

  public function getCategoryArticlesPaging($category_id,$offset,$limit) {
    $sql = "SELECT a.article_id AS id, 
                    a.article_titre AS titre,
                    a.article_html AS html,
                    a.article_accroche AS accroche,
                    a.article_publie AS publie,
                    a.article_promu AS promu,
                    a.article_date_publie AS date_publie,
                    a.article_date_modifie AS date_modifie,
                    a.article_nbpages AS nbpages
            FROM blog_articles a
            JOIN blog_catarticles ca ON ca.article_id = a.article_id
            WHERE ca.categorie_id = :category_id
            AND a.article_publie = 1
            ORDER BY a.article_date_publie DESC
            LIMIT :offset,:limit";
     $stmt = $this->db->prepare($sql);
     $stmt->bindParam('category_id', $category_id, \PDO::PARAM_STR);
     $stmt->bindParam('offset', $offset, \PDO::PARAM_INT);
     $stmt->bindParam('limit', $limit, \PDO::PARAM_INT);
     $result = $stmt->execute();
 
     $results = [];
     while($row = $stmt->fetch()) {
       $results[] = new ArticleEntity($row);
     }
     return $results;
  }

  public function getArticleById($article_id) {
    $sql = "SELECT a.article_id AS id, 
                    a.article_titre AS titre,
                    a.article_html AS html,
                    a.article_accroche AS accroche,
                    a.article_publie AS publie,
                    a.article_promu AS promu,
                    a.article_date_publie AS date_publie,
                    a.article_date_modifie AS date_modifie,
                    a.article_nbpages AS nbpages
            FROM blog_articles a
            WHERE a.article_id = :article_id";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["article_id" => $article_id]);

    if($result) {
      return new ArticleEntity($stmt->fetch());
    }
  }

  public function getArticleByHtml($article_html) {
    $sql = "SELECT a.article_id AS id, 
                    a.article_titre AS titre,
                    a.article_html AS html,
                    a.article_accroche AS accroche,
                    a.article_publie AS publie,
                    a.article_promu AS promu,
                    a.article_date_publie AS date_publie,
                    a.article_date_modifie AS date_modifie,
                    a.article_nbpages AS nbpages
            FROM blog_articles a
            WHERE a.article_html = :article_html";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["article_html" => $article_html]);

    if($result) {
      return new ArticleEntity($stmt->fetch());
    }
  }
}