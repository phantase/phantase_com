<?php

namespace Objects;

class CategorieMapper extends Mapper
{
  public function getCategories() {
    $sql = "SELECT c.categorie_id AS id, 
                    c.categorie_titre AS titre,
                    c.categorie_html AS html,
                    c.categorie_description AS description,
                    c.categorie_parent_id AS parent_id
            FROM blog_categories c";
    $stmt = $this->db->query($sql);

    $results = [];
    while($row = $stmt->fetch()) {
      $results[] = new CategorieEntity($row);
    }
    return $results;
  }

  public function getMainCategories() {
    $sql = "SELECT c.categorie_id AS id, 
                    c.categorie_titre AS titre,
                    c.categorie_html AS html,
                    c.categorie_description AS description,
                    c.categorie_parent_id AS parent_id
            FROM blog_categories c
            WHERE c.categorie_parent_id = 0";
    $stmt = $this->db->query($sql);

    $results = [];
    while($row = $stmt->fetch()) {
      $results[] = new CategorieEntity($row);
    }
    return $results;
  }

  public function getCategorieById($categorie_id) {
    $sql = "SELECT c.categorie_id AS id, 
                    c.categorie_titre AS titre,
                    c.categorie_html AS html,
                    c.categorie_description AS description,
                    c.categorie_parent_id AS parent_id
            FROM blog_categories c
            WHERE c.categorie_id = :categorie_id";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["categorie_id" => $categorie_id]);

    if($result) {
      return new CategorieEntity($stmt->fetch());
    }
  }

  public function getCategorieByHtml($categorie_html) {
    $sql = "SELECT c.categorie_id AS id, 
                    c.categorie_titre AS titre,
                    c.categorie_html AS html,
                    c.categorie_description AS description,
                    c.categorie_parent_id AS parent_id,
                    COUNT(ca.article_id) AS nbarticles
            FROM blog_categories c
            JOIN blog_catarticles ca ON ca.categorie_id = c.categorie_id
            JOIN blog_articles a ON ca.article_id = a.article_id
            WHERE c.categorie_html = :categorie_html
            AND a.article_publie = 1
            GROUP BY c.categorie_id, c.categorie_titre, c.categorie_html, c.categorie_description, c.categorie_parent_id";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["categorie_html" => $categorie_html]);

    if($result) {
      return new CategorieEntity($stmt->fetch());
    }
  }

  public function getArticleCategories($article_id) {
    $sql = "SELECT c.categorie_id AS id, 
                    c.categorie_titre AS titre,
                    c.categorie_html AS html,
                    c.categorie_description AS description,
                    c.categorie_parent_id AS parent_id
            FROM blog_categories c
            JOIN blog_catarticles ca ON ca.categorie_id = c.categorie_id
            WHERE ca.article_id = :article_id";
     $stmt = $this->db->prepare($sql);
     $result = $stmt->execute(["article_id" => $article_id]);
 
     $results = [];
     while($row = $stmt->fetch()) {
       $results[] = new CategorieEntity($row);
     }
     return $results;
  }

}