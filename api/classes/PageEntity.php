<?php

class PageEntity
{
  protected $id;
  protected $content;
  protected $article;
  protected $numero;
  protected $edit;

  public function __construct(array $data) {
    // no id if we're creating
    if(isset($data['id'])) {
      $this->id = $data['id'];
    }

    $this->content = $data['content'];
    $this->article = $data['article'];
    $this->numero = $data['numero'];
    $this->edit = $data['edit'];
  }

  public function getId() {
    return $this->id;
  }
  public function getContent() {
    return $this->content;
  }
  public function getArticle() {
    return $this->article;
  }
  public function getNumero() {
    return $this->numero;
  }
  public function getEdit() {
    return $this->edit;
  }
}