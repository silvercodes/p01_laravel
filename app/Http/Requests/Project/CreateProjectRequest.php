<?php

namespace App\Http\Requests\Project;

use App\Http\Requests\ApiRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class CreateProjectRequest extends ApiRequest
{    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'type'              => 'required|string|max:255',
            'description'       => 'sometimes|string|max:255',
            'contacts'          => 'required|string|max:255',
            'avatar'            => 'required|file|mimes:jpeg,jpg,png|max:10240',    // 10Mb
            'ts'                => 'required|file|mimes:pdf|max:51200',             // 50Mb
        ];
    }
}
