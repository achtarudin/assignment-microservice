<?php

namespace App\Exceptions\Blog;

use Exception;

class MicroserviceException extends Exception
{
    public function __construct($code = 500, $message = 'Microservice error')
    {
        parent::__construct($message, $code);
    }
}
