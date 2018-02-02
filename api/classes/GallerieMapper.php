<?php

namespace Objects;

class GallerieMapper extends Mapper
{
  public function getGalleries() {
    $sql = "SELECT g.id AS id, 
                    g.name AS name
            FROM blog_galleries g";
    $stmt = $this->db->query($sql);

    $results = [];
    while($row = $stmt->fetch()) {
      $results[] = new GallerieEntity($row);
    }
    return $results;
  }

  public function getGallerieById($gallerie_id) {
    $sql = "SELECT g.id AS id, 
                    g.name AS name
            FROM blog_galleries g
            WHERE g.id = :gallerie_id";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["gallerie_id" => $gallerie_id]);

    if($result) {
      return new GallerieEntity($stmt->fetch());
    }
  }

  public function getGallerieByName($gallerie_name) {
    $sql = "SELECT g.id AS id, 
                    g.name AS name
            FROM blog_galleries g
            WHERE g.name = :gallerie_name";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["gallerie_name" => $gallerie_name]);

    if($result) {
      return new GallerieEntity($stmt->fetch());
    }
  }

}