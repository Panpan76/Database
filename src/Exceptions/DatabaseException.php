<?php

namespace Database\Exceptions;

use Exceptions\Exception;

class DatabaseException extends Exception{
  const LOG_FILE = 'database';

  const CONNECTION_ERROR        = 0;
  const NO_DATABASE_FOUND       = 1;
  const CAN_NOT_CREATE_DATABASE = 2;

  public function __construct($description, $code){
    $this->description  = $description;
    $this->code         = $code;

    switch($this->code){
      case self::CONNECTION_ERROR:
        $this->title  = "Connection error";
        $this->type   = "E";
        break;

      case self::NO_DATABASE_FOUND:
        $this->title  = "No database found";
        $this->type   = "E";
        break;

      case self::CAN_NOT_CREATE_DATABASE:
        $this->title  = "Can't create the database";
        $this->type   = "E";
        break;
    }

    parent::__construct($this->title, $this->description, $this->type, $this->code);
  }
}
