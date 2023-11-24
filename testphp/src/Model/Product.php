<?php

namespace TesteAux\Testphp\Model;

use TesteAux\Testphp\Database\Database;

class Product
{
    private static string $tableName = "produtos";

    public static function findAll(): array
    {
        $connectionDb = self::getConnectionDb();
        $sql = 'SELECT * FROM ' . self::$tableName;
        $stmt = $connectionDb->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    private static function getConnectionDb(): \PDO
    {
        $database = Database::getInstance();
        return $database->getConnectionDb();
    }
}