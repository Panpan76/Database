<?php

namespace Database;

use Informations\InformationsClass;

class Manager{

  public function getEntity(mixed $entity){
    $class = is_string($entity) ? $entity : get_class($entity);
    return new ManagerEntity($entity);
  }
}
