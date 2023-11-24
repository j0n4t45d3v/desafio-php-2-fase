<?php

namespace TesteAux\Testphp\Wrapper;

class Request
{

    public static function getBodyJson() : array
    {
        $getRequestBody = $json = file_get_contents('php://input');
        return json_decode($json, true);
    }

}