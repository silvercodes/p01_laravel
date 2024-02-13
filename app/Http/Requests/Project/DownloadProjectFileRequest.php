<?php

namespace App\Http\Requests\Project;

use App\Http\Requests\ApiRequest;
use App\Models\Project;
use Illuminate\Contracts\Validation\ValidationRule;

class DownloadProjectFileRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'file' => 'required|string|in:'
                        .Project::DOWNLOAD_FILE_AVATAR . ','
                        .Project::DOWNLOAD_FILE_TS . ','
                        .Project::DOWNLOAD_FILE_ZIP,
        ];
    }
}
