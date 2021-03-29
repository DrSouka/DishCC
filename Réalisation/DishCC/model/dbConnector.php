<?php

class Db
{
    private $dbConnection;
    public function __construct()
    {
      $this->openDBConnection();
    }
    /**
     * This function is designed to execute a query received as parameter
     * @param $query : must be correctly build for sql (synthaxis) but the protection against sql injection will be done there
     * @return array|null : get the query result (can be null)
     * Source : http://php.net/manual/en/pdo.prepare.php
     */
    public function select($query, $params = []){
      try{
        $statement = $this->dbConnection->prepare($query);//prepare query
        $statement->execute($params);
        $result = $statement->fetchAll();
      }catch(PDOException $e){
        echo $e->getMessage() .' '. $query;
        var_dump($params);
        return false;
      }
      return $result;
    }

    /**
     * This function is designed to insert value in database
     * @param $query
     * @return int : $statement->execute() returns the last inserted id if the insert was successful
     * @throws PDOException
     */
    public function insert($query, $params = []){
      try{
        $statement = $this->dbConnection->prepare($query);//prepare query
        $statement->execute($params);
      }catch(PDOException $e){
        echo $e->getMessage() .' '. $query;
        var_dump($params);
        return false;
      }
      return $this->dbConnection->lastInsertId();
    }

    /**
     * This function is designed to insert value in database
     * @param $query
     * @return int : $statement->execute() returns the last inserted id if the insert was successful
     * @throws PDOException
     */
    public function update($query, $params = []){
      try{
        $statement = $this->dbConnection->prepare($query);//prepare query
        $statement->execute($params);
      }catch(PDOException $e){
        echo $e->getMessage() .' '. $query;
        var_dump($params);
        return false;
      }
      return $statement->rowCount();
    }

    /**
     * This function is designed to manage the database connexion. Closing will be not proceeded there. The client is responsible of this.
     * @return PDO|null
     * Source : http://php.net/manual/en/pdo.construct.php
     */
    private function openDBConnection (){
        $sqlDriver = 'mysql';
        $hostname = 'localhost';
        $port = 3306;
        $charset = 'utf8';
        $dbName = 'dishcc';
        $userName = 'dishcc';
        $userPwd = '88w36fn9MdorXPCp';
        $dsn = $sqlDriver . ':host=' . $hostname . ';dbname=' . $dbName . ';port=' . $port . ';charset=' . $charset;

        $this->dbConnection = new PDO($dsn, $userName, $userPwd);
        $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}
