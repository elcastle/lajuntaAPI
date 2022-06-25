<?php 
class ConexionPDO{
    private $dsn = 'mysql:host=localhost;dbname=laJunta';
    private $username = 'root';
    private $password = 'root';
    public $mysql;

    function __construct() {
        try {
            $this->mysql = new PDO($this->dsn, $this->username, $this->password);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}