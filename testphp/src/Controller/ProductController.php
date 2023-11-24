<?php

namespace TesteAux\Testphp\Controller;

use TesteAux\Testphp\Service\ProductService;
use TesteAux\Testphp\Wrapper\Response;

class ProductController
{

    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function getAll()
    {
        $result = $this->productService->findAll();
        Response::json($result, 200);
    }

}