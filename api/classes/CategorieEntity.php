<?php

namespace Objects;

class CategorieEntity
{
  protected $id;
  protected $titre;
  protected $html;
  protected $description;
  protected $parent;
  protected $nbarticles;

  public function __construct(array $data) {
    // no id if we're creating
    if(isset($data['id'])) {
      $this->id = $data['id'];
    }

    $this->titre = $data['titre'];
    $this->html = $data['html'];
    $this->description = $data['description'];
    $this->parent = $data['parent'];
    // sometime we will not provide the number of articles
    if(isset($data['nbarticles'])) {
      $this->nbarticles = $data['nbarticles'];
    }
  }

  public function getId() {
    return $this->id;
  }
  public function getTitre() {
    return $this->titre;
  }
  public function getHtml() {
    return $this->html;
  }
  public function getDescription() {
    return $this->description;
  }
  public function getParent() {
    return $this->parent;
  }
  public function getNbarticles() {
    return $this->nbarticles;
  }
}