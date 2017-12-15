<?php

namespace Database;

use Informations\InformationsClass;

class ManagerEntity{
  private $entity;

  public function __construct(InformationsClass $entity){
    $this->entity = $entity;
  }

  public function select(int $id){}
  public function update($entity){}
  public function delete($entity){}

}
