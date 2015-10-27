<?php

class Database
{
    public $conn;
    private static $instance;
    private $dbhost = 'localhost';
    private $dbname = 'test';
    private $dbusername = 'root';
    private $dbpassword = 'root';

    public function __construct()
    {
        try
        {

           $this->conn = new PDO("mysql:host=$this->dbhost;dbname=$this->dbname", $this->dbusername, $this->dbpassword);
           $this->conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

           return $this->conn;

        }catch(PDOException $e){

            throw new error($e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (!isset(static::$instance))
        {

            static::$instance = new self;
        }

        return static::$instance;
    }
}

?>