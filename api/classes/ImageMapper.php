<?php

namespace Objects;

class ImageMapper extends Mapper
{
  public function getImages() {
    $sql = "SELECT i.id AS id, 
                    i.name AS name,
                    i.title AS title, 
                    i.galleryid AS galleryid,
                    g.name AS galleryname
            FROM blog_images i
            JOIN blog_galleries g ON i.galleryid = g.id";
    $stmt = $this->db->query($sql);

    $results = [];
    while($row = $stmt->fetch()) {
      $results[] = new ImageEntity($row);
    }
    return $results;
  }

  public function getImageById($image_id) {
    $sql = "SELECT i.id AS id, 
                    i.name AS name,
                    i.title AS title, 
                    i.galleryid AS galleryid,
                    g.name AS galleryname
            FROM blog_images i
            JOIN blog_galleries g ON i.galleryid = g.id
            WHERE i.id = :image_id";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["image_id" => $image_id]);

    if($result) {
      return new ImageEntity($stmt->fetch());
    }
  }

  public function getImageByNames($image_name, $gallerie_name) {
    $sql = "SELECT i.id AS id, 
                    i.name AS name,
                    i.title AS title, 
                    i.galleryid AS galleryid,
                    g.name AS galleryname
            FROM blog_images i
            JOIN blog_galleries g ON i.galleryid = g.id
            WHERE i.name = :image_name AND g.name = :gallerie_name";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["image_name" => $image_name, "gallerie_name" => $gallerie_name]);

    if($result) {
      return new ImageEntity($stmt->fetch());
    }
  }

  public function getImagesByGalleryName($gallerie_name) {
    $sql = "SELECT i.id AS id, 
                    i.name AS name,
                    i.title AS title, 
                    i.galleryid AS galleryid,
                    g.name AS galleryname
            FROM blog_images i
            JOIN blog_galleries g ON i.galleryid = g.id
            WHERE g.name = :gallerie_name";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["gallerie_name" => $gallerie_name]);

    $results = [];
    while($row = $stmt->fetch()) {
      $results[] = new ImageEntity($row);
    }
    return $results;
  }

}