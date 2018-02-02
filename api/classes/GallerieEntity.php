<?php

namespace Objects;

class GallerieEntity
{
  protected $id;
  protected $name;

  public function __construct(array $data) {
    // no id if we're creating
    if(isset($data['id'])) {
      $this->id = $data['id'];
    }

    $this->name = $data['name'];
  }

  public function getId() {
    return $this->id;
  }
  public function getName() {
    return $this->name;
  }
}