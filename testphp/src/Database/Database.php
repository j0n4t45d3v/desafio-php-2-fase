<?php
namespace TesteAux\Testphp\Database;

use Exception;
use PDO;

class Database 
{
    private static $instanceDb = null;
    private \PDO $connectionDb;

    private function __construct()
    {
        try
        {
            $uriDb = "mysql:host=127.0.0.1;dbname=testephp"; 
            $this->connectionDb = new \PDO($uriDb, "root", "");
            $this->connectionDb->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
            $this->connectionDb->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        }
        catch(\PDOException $error)
        {
            $error->getMessage();
        }
    }

    public function getConnectionDb(): \PDO 
    {
        return $this->connectionDb;
    }

    public static function getDataConnection() : array
    {
        return [
            'driver' => 'mysql',
            'username' => 'root',
            'host' => '127.0.0.1',
            'database' => 'testephp',
            'port' => '3306'
        ];
    }

    public static function getInstance() : Database
    {
        if (self::$instanceDb === null)
        {
            self::$instanceDb = new Database();
        }

        return self::$instanceDb;
    } 

}