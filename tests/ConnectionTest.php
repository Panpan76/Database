<?php

namespace Informations\Tests;

use PHPUnit\Framework\TestCase;

use Database\Connection;
use Database\Exceptions\DatabaseException;


class ConnectionTest extends TestCase{

  public function testConnectionFail(){
    fwrite(STDOUT, "\n".__METHOD__."\t: ");
    try{
      $connection = new Connection('mysql', 'localhost', '', '');
      $connection->useDatabase('test_database');
      $this->assertTrue(false);
    }catch(DatabaseException $e){
      $this->assertEquals(DatabaseException::CONNECTION_ERROR, $e->getCode());
    }

    try{
      $connection = new Connection('mysql', 'localhost', 'root', '');
      $connection->useDatabase('test_database');
      $this->assertTrue(false);
    }catch(DatabaseException $e){
      $this->assertEquals(DatabaseException::NO_DATABASE_FOUND, $e->getCode());
    }
  }

  /**
   * @depends testConnectionFail
   */
  public function testConnectionCreateDatabaseOk(){
    fwrite(STDOUT, "\n".__METHOD__."\t: ");
    Connection::devModeEnable();
    try{
      $connection = new Connection('mysql', 'localhost', 'root', '');
      $this->assertTrue($connection->useDatabase('test_database'));
    }catch(DatabaseException $e){
      $this->assertTrue(false);
    }
  }

  /**
   * @depends testConnectionCreateDatabaseOk
   */
  public function testConnectionOk(){
    fwrite(STDOUT, "\n".__METHOD__."\t: ");
    Connection::devModeEnable();
    try{
      $connection = new Connection('mysql', 'localhost', 'root', '');
      $this->assertTrue($connection->useDatabase('test_database'));
    }catch(DatabaseException $e){
      $this->assertTrue(false);
    }
  }

  public static function tearDownAfterClass(){
    fwrite(STDOUT, "\n".__METHOD__."\t: On nettoi");
    Connection::devModeEnable();
    $connection = new Connection('mysql', 'localhost', 'root', '');
    $connection->deleteDatabase('test_database');
  }
}
