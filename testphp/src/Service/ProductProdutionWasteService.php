<?php

namespace TesteAux\Testphp\Service;

use Exception;
use TesteAux\Testphp\Model\ProductProdutionWaste;

class ProductProdutionWasteService
{
    private static string $msgNotFound = "Product Prodution Waste Not Found";

    public function findAll()
    {
        return ProductProdutionWaste::findAll();
    }

    public function findAllById(int $id)
    {
        $ProductProdutionWasteAlreadyExists = ProductProdutionWaste::findAllById($id);
        if ($ProductProdutionWasteAlreadyExists == false) {
            throw new Exception(self::$msgNotFound);
        }
        return $ProductProdutionWasteAlreadyExists;
    }

    public function findById(int $id)
    {
        $ProductProdutionWasteAlreadyExists = ProductProdutionWaste::findById($id);
        if ($ProductProdutionWasteAlreadyExists == false) {
            throw new Exception(self::$msgNotFound);
        }
        return $ProductProdutionWasteAlreadyExists;
    }

    public function save($request, int $id)
    {
        return ProductProdutionWaste::save($id, $request);
    }

    public function update($request, int $id)
    {
        $ProductProdutionWasteAlreadyExists = ProductProdutionWaste::findById($id);

        if ($ProductProdutionWasteAlreadyExists == false) {
            throw new Exception(self::$msgNotFound);
        }

        ProductProdutionWaste::update($id, $request);
    }

    public function delete(int $id)
    {
        $ProductProdutionWasteAlreadyExists = ProductProdutionWaste::findById($id);

        if ($ProductProdutionWasteAlreadyExists == false) {
            throw new Exception(self::$msgNotFound);
        }
        ProductProdutionWaste::delete($id);
    }
}
