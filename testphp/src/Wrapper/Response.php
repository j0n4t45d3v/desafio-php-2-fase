<?php

namespace TesteAux\Testphp\Wrapper;

class Response
{
    public static function json(array $message, int $statusCode)
    {
        self::header("Content-Type: application/json");
        http_response_code($statusCode);
        echo json_encode($message);
    }

    public static function renderPdf($file, int $statusCode)
    {
        self::header("Content-Type: application/pdf");
        self::header('Content-Disposition: inline; filename=relatorio-de-desperdicio');
        http_response_code($statusCode);
        echo readfile($file);
    }

    public static function header(string $header)
    {
        header($header);
    }
}