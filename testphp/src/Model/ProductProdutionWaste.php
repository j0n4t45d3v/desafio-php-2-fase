<?php

namespace TesteAux\Testphp\Model;

use TesteAux\Testphp\Database\Database;

class ProductProdutionWaste
{
    private static string $nameTable = "desperdicio_producao_produto";

    public static function findAll(): array
    {
        $connectionDb = self::getConnectionDb();
        $sql = "SELECT * FROM " . self::$nameTable;
        $stmt = $connectionDb->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function findAllById(int $id)
    {
        $connectionDb = self::getConnectionDb();
        $sql = "SELECT * FROM vw_desperdicio_producao_produto WHERE id = :id";
        $stmt = $connectionDb->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function findById(int $id)
    {
        $connectionDb = self::getConnectionDb();
        $sql = "SELECT * FROM " . self::$nameTable . " WHERE sequencia = :id";
        $stmt = $connectionDb->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function save(int $id, array $data): int
    {
        $connectionDb = self::getConnectionDb();
        $sql = "CALL sp_insert_desperdicio_producao_produto(
            :id_desperdicio_producao, :codigo_produto, :qtde_saida
        )";
        $stmt = $connectionDb->prepare($sql);
        $stmt->bindValue(":id_desperdicio_producao", $id);
        $stmt->bindValue(":codigo_produto", $data["codigo_produto"]);
        $stmt->bindValue(":qtde_saida", $data["qtde_saida"]);
        $stmt->execute();

        return $connectionDb->lastInsertId();
    }

    public static function update(int $id, array $data)
    {
        $connectionDb = self::getConnectionDb();
        $sql = "CALL sp_update_desperdicio_producao_produto(
            :id_desperdicio_producao_produto, :id_desperdicio_producao, :codigo_produto, :qtde_saida
        )";
        $stmt = $connectionDb->prepare($sql);
        $stmt->bindValue(":id_desperdicio_producao_produto", $id);
        $stmt->bindValue(":id_desperdicio_producao", $data["id_waste"]);
        $stmt->bindValue(":codigo_produto", $data["codigo_produto"]);
        $stmt->bindValue(":qtde_saida", $data["qtde_saida"]);
        $stmt->execute();
    }

    public static function delete(int $id): void
    {
        $connectionDb = self::getConnectionDb();
        $sql = "CALL sp_delete_desperdicio_producao_produto(:id)";
        $stmt = $connectionDb->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
    }

    private static function getConnectionDb(): \PDO
    {
        $database = Database::getInstance();
        return $database->getConnectionDb();
    }
}
