<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ApiValidationException extends ValidationException
{
    use ApiResponser;

    public function render(): JsonResponse
    {
        return $this->errorResponse(
            "Validation failed",
            $this->status,
            $this->validator->errors()->getMessages()
        );
    }
}
