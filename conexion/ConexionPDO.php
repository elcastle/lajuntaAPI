<?php 
class ConexionPDO{
    private $dsn = 'mysql:host=sql108.epizy.com;dbname=epiz_32094821_lajunta';
    private $username = 'epiz_32094821';
    private $password = 'IllE8AamHT9J3b';
    public $mysql;

    function __construct() {
        try {
            $this->mysql = new PDO($this->dsn, $this->username, $this->password);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}