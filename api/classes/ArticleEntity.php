<?php

class ArticleEntity
{
  protected $id;
  protected $titre;
  protected $html;
  protected $accroche;
  protected $publie;
  protected $promu;
  protected $datepublie;
  protected $datemodifie;
  protected $nbPages;

  public function __construct(array $data) {
    // no id if we're creating
    if(isset($data['id'])) {
      $this->id = $data['id'];
    }

    $this->titre = $data['titre'];
    $this->html = $data['html'];
    $this->accroche = $data['accroche'];
    $this->publie = $data['publie'];
    $this->promu = $data['promu'];
    $this->datepublie = $data['date_publie'];
    $this->datemodifie = $data['date_modifie'];
    $this->nbpages = $data['nbpages'];
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
  public function getAccroche() {
    return $this->accroche;
  }
  public function getPublie() {
    return $this->publie;
  }
  public function getPromu() {
    return $this->promu;
  }
  public function getDatepublie() {
    return $this->datepublie;
  }
  public function getDatemodifie() {
    return $this->datemodifie;
  }
  public function getNbpages() {
    return $this->nbpages;
  }
}