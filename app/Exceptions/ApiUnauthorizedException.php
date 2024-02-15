<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class ApiUnauthorizedException extends UnauthorizedHttpException
{
    use ApiResponser;

    public function __construct() {
        parent::__construct('');
    }

    public function render(): JsonResponse
    {
        return $this->errorResponse(
            $this->message,
            Response::HTTP_UNAUTHORIZED
        );
    }
}
