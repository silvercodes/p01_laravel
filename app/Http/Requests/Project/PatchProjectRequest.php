<?php

namespace App\Http\Requests\Project;

use App\Http\Requests\ApiRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PatchProjectRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'type'              => 'sometimes|required|string|max:255',
            'description'       => 'sometimes|string|max:255',
            'contacts'          => 'sometimes|required|string|max:255',
            'avatar'            => 'sometimes|required|file|mimes:jpeg,jpg,png|max:10240',    // 10Mb
            'ts'                => 'sometimes|required|file|mimes:pdf|max:51200',             // 50Mb
        ];
    }
}
