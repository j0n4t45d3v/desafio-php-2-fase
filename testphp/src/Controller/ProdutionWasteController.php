<?php

namespace TesteAux\Testphp\Controller;

use Exception;
use TesteAux\Testphp\Service\ProdutionWasteService;
use TesteAux\Testphp\Service\ReportService;
use TesteAux\Testphp\Wrapper\Request;
use TesteAux\Testphp\Wrapper\Response;

class ProdutionWasteController
{
    private ProdutionWasteService $wasteService;
    private ReportService $reportService;

    public function __construct(ProdutionWasteService $wasteService, ReportService $reportService)
    {
        $this->wasteService = $wasteService;
        $this->reportService = $reportService;
    }

    public function getAll()
    {
        $result = $this->wasteService->findAll();
        Response::json($result, 200);
    }

    public function getByid(int $id)
    {
        try {
            $result = $this->wasteService->findById($id);
            Response::json($result, 200);
        } catch (\Exception $error) {
            Response::json([
                "error" => $error->getMessage()
            ], 400);
        }
    }

    public function getReportById(int $id)
    {
        try{
            $reportResult = $this->reportService->generateReport($id);
            Response::renderPdf($reportResult, 200);
        }catch(Exception $error){
            Response::json([
                "error" => $error->getMessage()
            ], 400);
        }
    }

    public function saveWaste()
    {
        try {
            $data = Request::getBodyJson();
            $result = $this->wasteService->save($data);
            
            $makeMessage = ["message" => "Waste Saved"];
            var_dump($result);
            Response::header("Location: /prodution_waste/id/$result");
            Response::json($makeMessage, 201);
        } catch (\Exception $error) {
            $errorMessage = ["error" => $error->getMessage()];
            Response::json($errorMessage, 400);
        }
    }

    public function editWaste(int $id)
    {
        try {
            $data = Request::getBodyJson();
            $this->wasteService->update($data, $id);

            $makeMessage = ["message" => "Waste Edited"];
            Response::json($makeMessage, 200);
        } catch (\Exception $error) {
            $errorMessage = ["error" => $error->getMessage()];
            Response::json($errorMessage, 400);
        }
    }

    public function finalizeWaste(int $id)
    {
        try {
            $this->wasteService->finalizeWaste($id);

            $makeMessage = ["message" => "Waste Finalized"];
            Response::json($makeMessage, 200);
        } catch (\Exception $error) {
            $errorMessage = ["error" => $error->getMessage()];
            Response::json($errorMessage, 400);
        }
    }

    public function excludeWaste(int $id)
    {
        try {
            $this->wasteService->delete($id);
            $makeMessage = ["message" => "Waste Excluded"];
            Response::json($makeMessage, 200);
        } catch (\Exception $error) {
            $errorMessage = ["error" => $error->getMessage()];
            Response::json($errorMessage, 400);
        }
    }
    
}
