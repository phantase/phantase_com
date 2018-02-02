<?php

namespace Objects;

class ImageEntity
{
  protected $id;
  protected $name;
  protected $title;
  protected $galleryid;
  protected $galleryname;

  public function __construct(array $data) {
    // no id if we're creating
    if(isset($data['id'])) {
      $this->id = $data['id'];
    }

    $this->name = $data['name'];
    $this->title = $data['title'];
    $this->galleryid = $data['galleryid'];
    $this->galleryname = $data['galleryname'];
  }

  public function getId() {
    return $this->id;
  }
  public function getName() {
    return $this->name;
  }
  public function getTitle() {
    return $this->title;
  }
  public function getGalleryid() {
    return $this->galleryid;
  }
  public function getGalleryname() {
    return $this->galleryname;
  }
}