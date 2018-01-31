<?php

class PageMapper extends Mapper
{
  public function getPages() {
    $sql = "SELECT c.page_id AS id, 
                    c.page_content AS content,
                    c.article_id AS article,
                    c.page_numero AS numero,
                    c.page_edit AS edit
            FROM blog_pages c";
    $stmt = $this->db->query($sql);

    $results = [];
    while($row = $stmt->fetch()) {
      $results[] = new PageEntity($row);
    }
    return $results;
  }

  public function getPageById($page_id) {
    $sql = "SELECT c.page_id AS id, 
                    c.page_content AS content,
                    c.article_id AS article,
                    c.page_numero AS numero,
                    c.page_edit AS edit
            FROM blog_pages c
            WHERE c.page_id = :page_id";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["page_id" => $page_id]);

    if($result) {
      return new PageEntity($stmt->fetch());
    }
  }

  public function getPagesByArticle($article_id) {
    $sql = "SELECT c.page_id AS id, 
                    c.page_content AS content,
                    c.article_id AS article,
                    c.page_numero AS numero,
                    c.page_edit AS edit
            FROM blog_pages c
            WHERE c.article_id = :article_id";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["article_id" => $article_id]);

    $results = [];
    while($row = $stmt->fetch()) {
      $results[] = new PageEntity($row);
    }
    return $results;
  }

  public function getPageNumberByArticle($article_id, $page_numero) {
    $sql = "SELECT c.page_id AS id, 
                    c.page_content AS content,
                    c.article_id AS article,
                    c.page_numero AS numero,
                    c.page_edit AS edit
            FROM blog_pages c
            WHERE c.article_id = :article_id AND c.page_numero = :page_numero";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["article_id" => $article_id]);
    $result = $stmt->execute(["page_numero" => $page_numero]);

    if($result) {
      return new PageEntity($stmt->fetch());
    }
  }

}