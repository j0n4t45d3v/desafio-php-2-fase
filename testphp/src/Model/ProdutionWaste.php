<?php

namespace TesteAux\Testphp\Model;

use TesteAux\Testphp\Database\Database;

class ProdutionWaste
{
    private static string $nameTable = "desperdicio_producao";

    public static function findAll() : array
    {
        $connectionDb = self::getConnectionDb();
        $sql = "SELECT * FROM " . self::$nameTable;
        $stmt = $connectionDb->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function findById(int $id)
    {
        $connectionDb = self::getConnectionDb();
        $sql = "SELECT * FROM " . self::$nameTable . " WHERE id = :id";
        $stmt = $connectionDb->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function save(array $data) : int
    {
        $connectionDb = self::getConnectionDb();
        $sql = "CALL sp_insert_desperdicio_producao(:nome_pessoa, :data_lancamento, :numero_producao)";
        $stmt = $connectionDb->prepare($sql);
        $stmt->bindValue(":nome_pessoa", $data["nome_pessoa"]);
        $stmt->bindValue(":numero_producao", $data["numero_producao"]);
        $stmt->bindValue(":data_lancamento", $data["date"]);
        $stmt->execute();

        return $connectionDb->lastInsertId();   
    }

    public static function deleteOpenWaste(int $code): void
    {
        $connectionDb = self::getConnectionDb();
        $sql = "CALL sp_delete_desperdicio_producao(:code)";
        $stmt = $connectionDb->prepare($sql);
        $stmt->bindValue(":code", $code);
        $stmt->execute();
    }

    public static function updateOpenWaste(int $id, array $data)
    {
        $connectionDb = self::getConnectionDb();
        $sql = "CALL sp_update_desperdicio_producao(:id, :nome_pessoa, :data_lancamento, :numero_producao)";
        $stmt = $connectionDb->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->bindValue(":nome_pessoa", $data["nome_pessoa"]);
        $stmt->bindValue(":numero_producao", $data["numero_producao"]);
        $stmt->bindValue(":data_lancamento", $data["date"]);
        $stmt->execute();
    }

    public static function finalizeWaste(int $code)
    {
        $connectionDb = self::getConnectionDb();
        $sql = "CALL sp_finaliza_desperdicio_producao(:code)";
        $stmt = $connectionDb->prepare($sql);
        $stmt->bindValue(":code", $code);
        $stmt->execute();
    }

    private static function getConnectionDb() : \PDO
    {
        $database = Database::getInstance();
        return $database->getConnectionDb();
    }
}