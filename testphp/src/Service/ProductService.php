<?php

namespace TesteAux\Testphp\Service;

use TesteAux\Testphp\Model\Product;

class ProductService
{

    public function findAll()
    {
        return Product::findAll();
    }

}
