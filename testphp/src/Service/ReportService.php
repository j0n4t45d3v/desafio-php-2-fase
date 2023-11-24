<?php

namespace TesteAux\Testphp\Service;

use Exception;
use PHPJasper\PHPJasper;
use TesteAux\Testphp\Database\Database;

class ReportService
{
    private PHPJasper $jasper;

    public function __construct(PHPJasper $jasper)
    {
        $this->jasper = $jasper;
    }

    public function generateReport(int $id)
    {
        header("TESTE: $id");
        $pathReport = __DIR__ . "/../../resources/relatorio-desperdicio-produtos.jrxml";
        $pathOut = __DIR__ . "/../../resources/out/";
        $options = [
            "format" => ["pdf"],
            'locale' => 'pt_BR',
            'params' => ["ID_DESPERDICIO" => $id],
            'db_connection' => Database::getDataConnection()
        ];

        $this->validPath($pathReport);
        $this->validPath($pathOut);

        $this->jasper->process(
            $pathReport,
            $pathOut,
            $options
        )->execute();

        return $pathOut. "relatorio-desperdicio-produtos.pdf";
    }

    private function validPath(string $path)
    {
        if (!file_exists($path)) {
            throw new Exception("Path Not Found");
        }
    }
}
