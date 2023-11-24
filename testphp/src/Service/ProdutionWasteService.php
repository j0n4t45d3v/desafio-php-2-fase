<?php

namespace TesteAux\Testphp\Service;

use Exception;
use TesteAux\Testphp\Model\ProdutionWaste;

class ProdutionWasteService
{
    public function findAll()
    {
        return ProdutionWaste::findAll();
    }

    public function findById(int $code)
    {
        $produtionWasteAlreadyExists = ProdutionWaste::findById($code);
        if ($produtionWasteAlreadyExists) {
            return $produtionWasteAlreadyExists;
        }

        throw new Exception("Product Waste Not Found");
    }

    public function save($request)
    {
        return ProdutionWaste::save($request);
    }

    public function update($request, int $id)
    {
        $produtionWasteAlreadyExists = ProdutionWaste::findById($id);

        if ($produtionWasteAlreadyExists == false) {
            throw new Exception("Product Waste Not Found");
        }

        if($produtionWasteAlreadyExists["finalizada"] == "S")
        {
            throw new Exception("Product Waste Not Open");
        }

        ProdutionWaste::updateOpenWaste($id, $request);
    }

    public function finalizeWaste(int $id)
    {
        $produtionWasteAlreadyExists = ProdutionWaste::findById($id);

        if ($produtionWasteAlreadyExists == false) {
            throw new Exception("Product Waste Not Found");
        }

        if($produtionWasteAlreadyExists["finalizada"] == "S")
        {
            throw new Exception("Product Waste Already Finalized");
        }

        ProdutionWaste::finalizeWaste($id);
    }

    public function delete(int $code)
    {
        $produtionWasteAlreadyExists = ProdutionWaste::findById($code);

        if ($produtionWasteAlreadyExists == false) {
            throw new Exception("Product Waste Not Found");
        }
        ProdutionWaste::deleteOpenWaste($code);
    }
}
