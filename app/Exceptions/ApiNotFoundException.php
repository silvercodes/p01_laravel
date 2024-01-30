<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class ApiNotFoundException extends Exception
{
    use ApiResponser;

    public function __construct(string $message = "")
    {
        parent::__construct($message);
    }

    public function render()
    {
        return $this->errorResponse(
            $this->getMessage(),
            Response::HTTP_NOT_FOUND,
        );
    }
}
