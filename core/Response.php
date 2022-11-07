<?php
namespace app\core;


class Response{
    public function setStatusCode(int $response_code)
    {
        // echo '<pre>';
        // var_dump(http_response_code($response_code));
        // echo '</pre>';
        // exit;
         http_response_code($response_code);
    }
}

?>