<?php

namespace Database;

use \PDO;
use \PDOException;
use Database\Exceptions\DatabaseException;

/**
 * Use it to create a new connection to a database
 * When we initiate a connection, we must specify how we connect (dbms, host, user, password...)
 *
 * We should be able to configure the charset of the connection (utf-8 as default should be ok)
 */
class Connection{
  private $pdo;

  private static $devMode = false;

  public function __construct(string $dbms, string $host, string $user, string $password){
    try{
      $this->pdo = new PDO("{$dbms}:host={$host};", $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
      $this->pdo->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING); // Empty string convert to null
    }
    catch(PDOException $error){
      throw new DatabaseException($error->getMessage(), DatabaseException::CONNECTION_ERROR);
    }
  }

  public static function devModeEnable(){
    self::$devMode = true;
  }

  public function useDatabase(string $database){
    $use = $this->pdo->prepare("USE $database");
    if(!($selectOk = $use->execute()) && self::$devMode){
      return $this->createDatabase($database);
    }elseif(!$selectOk){
      throw new DatabaseException("Unknow database '$database'", DatabaseException::NO_DATABASE_FOUND);
    }
    return $selectOk;
  }

  private function createDatabase(string $database){
    if(!$this->pdo->query("CREATE DATABASE $database CHARACTER SET utf8 COLLATE utf8_general_ci;")){
      throw new DatabaseException("Can't create the database '$database'", DatabaseException::CAN_NOT_CREATE_DATABASE);
    }
    $use = $this->pdo->prepare("USE $database");
    return $use->execute();
  }

  public function deleteDatabase(string $dabatase){
    if(self::$devMode){
      return $this->pdo->query("DROP DATABASE IF EXISTS $dabatase");
    }
  }
}
