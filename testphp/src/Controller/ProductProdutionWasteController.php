<?php

namespace TesteAux\Testphp\Controller;

use TesteAux\Testphp\Service\ProductProdutionWasteService;
use TesteAux\Testphp\Wrapper\Request;
use TesteAux\Testphp\Wrapper\Response;

class ProductProdutionWasteController
{
    private ProductProdutionWasteService $productWastService;

    public function __construct(ProductProdutionWasteService $productWastService)
    {
        $this->productWastService = $productWastService;    
    } 

    public function getAll()
    {
        $result = $this->productWastService->findAll();
        Response::json($result, 200);
    }

    public function getAllById(int $id)
    {
        try {
            $result = $this->productWastService->findAllById($id);
            Response::json($result, 200);
        } catch (\Exception $error) {
            Response::json([
                "error" => $error->getMessage()
            ], 400);
        }
    }

    public function getById(int $id)
    {
        try {
            $result = $this->productWastService->findById($id);
            Response::json($result, 200);
        } catch (\Exception $error) {
            Response::json([
                "error" => $error->getMessage()
            ], 400);
        }
    }

    public function addProductWaste(int $id)
    {
        try {
            $data = Request::getBodyJson();
            $result = $this->productWastService->save($data, $id);
            
            $makeMessage = ["message" => "Product Waste Adding"];

            Response::header("Location: /product_prodution_waste/id/$result");
            Response::json($makeMessage, 201);
        } catch (\Exception $error) {
            $errorMessage = ["error" => $error->getMessage()];
            Response::json($errorMessage, 400);
        }
    }

    public function editProductWaste(int $id)
    {
        try {
            $data = Request::getBodyJson();
            $this->productWastService->update($data, $id);

            $makeMessage = ["message" => "Product Waste Edited"];
            Response::json($makeMessage, 200);
        } catch (\Exception $error) {
            $errorMessage = ["error" => $error->getMessage()];
            Response::json($errorMessage, 400);
        }
    }

    public function excludeProductWaste(int $id)
    {
        try {
            $this->productWastService->delete($id);
            $makeMessage = ["message" => "Product Waste Excluded"];
            Response::json($makeMessage, 200);
        } catch (\Exception $error) {
            $errorMessage = ["error" => $error->getMessage()];
            Response::json($errorMessage, 400);
        }
    }

}