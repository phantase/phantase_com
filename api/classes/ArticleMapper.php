<?php

namespace Objects;

class ArticleMapper extends Mapper
{
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
            ORDER BY a.article_date_publie DESC";
    $stmt = $this->db->query($sql);

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