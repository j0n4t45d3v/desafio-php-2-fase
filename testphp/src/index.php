<?php

namespace TesteAux\Testphp;

require_once __DIR__ . "/../vendor/autoload.php";

use PHPJasper\PHPJasper;
use TesteAux\Testphp\Controller\ProductController;
use TesteAux\Testphp\Controller\ProductProdutionWasteController;
use TesteAux\Testphp\Controller\ProdutionWasteController;
use TesteAux\Testphp\Service\ProdutionWasteService;
use TesteAux\Testphp\Router\Router;
use TesteAux\Testphp\Service\ProductProdutionWasteService;
use TesteAux\Testphp\Service\ProductService;
use TesteAux\Testphp\Service\ReportService;

$productService = new ProductService;
$productController = new ProductController($productService);

$phpJasper = new PHPJasper;
$reportService = new ReportService($phpJasper);
$produtionWasteService = new ProdutionWasteService;
$produtionWasteController = new ProdutionWasteController($produtionWasteService, $reportService);

$productProdutionWasteService = new ProductProdutionWasteService;
$productProdutionWasteController = new ProductProdutionWasteController($productProdutionWasteService);

$router = new Router();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTION");

$routes = [
    "product" => [
        [
            "uri" => "products",
            "handler" => array($productController, 'getAll')
        ]
    ],
    "produtionWaste" => [
        [
            "uri" => "prodution_wastes",
            "handler" => array($produtionWasteController, 'getAll')
        ],
        [
            "uri" => "prodution_wastes/id",
            "handler" => array($produtionWasteController, 'getById')
        ],
        [
            "uri" => "prodution_wastes/report",
            "handler" => array($produtionWasteController, 'getReportById')
        ],
        [
            "uri" => "prodution_wastes",
            "handler" => array($produtionWasteController, 'saveWaste')
        ],
        [
            "uri" => "prodution_wastes/id",
            "handler" => array($produtionWasteController, 'editWaste')
        ],
        [
            "uri" => "prodution_wastes/finalize",
            "handler" => array($produtionWasteController, 'finalizeWaste')
        ],
        [
            "uri" => "prodution_wastes/id",
            "handler" => array($produtionWasteController, 'excludeWaste')
        ],
    ],
    "productProdutionWaste" => [
        [
            "uri" => "product_prodution_wastes",
            "handler" => array($productProdutionWasteController, 'getAll')
        ],
        [
            "uri" => "product_prodution_wastes/id",
            "handler" => array($productProdutionWasteController, 'getAllById')
        ],
        [
            "uri" => "product_prodution_wastes/product",
            "handler" => array($productProdutionWasteController, 'getById')
        ],
        [
            "uri" => "product_prodution_wastes/id",
            "handler" => array($productProdutionWasteController, 'addProductWaste')
        ],
        [
            "uri" => "product_prodution_wastes/id",
            "handler" => array($productProdutionWasteController, 'editProductWaste')
        ],
        [
            "uri" => "product_prodution_wastes/id",
            "handler" => array($productProdutionWasteController, 'excludeProductWaste')
        ],
    ]

];

$router->addRoute("GET", $routes["product"][0]);

$router->addRoute("GET", $routes["produtionWaste"][0]);
$router->addRoute("GET", $routes["produtionWaste"][1]);
$router->addRoute("GET", $routes["produtionWaste"][2]);
$router->addRoute("POST", $routes["produtionWaste"][3]);
$router->addRoute("PUT", $routes["produtionWaste"][4]);
$router->addRoute("PUT", $routes["produtionWaste"][5]);
$router->addRoute("DELETE", $routes["produtionWaste"][6]);

$router->addRoute("GET", $routes["productProdutionWaste"][0]);
$router->addRoute("GET", $routes["productProdutionWaste"][1]);
$router->addRoute("GET", $routes["productProdutionWaste"][2]);
$router->addRoute("POST", $routes["productProdutionWaste"][3]);
$router->addRoute("PUT", $routes["productProdutionWaste"][4]);
$router->addRoute("DELETE", $routes["productProdutionWaste"][5]);

$router->run();
