<?php

declare(strict_types=1);

namespace App\Services\File;

use App\Models\File;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

abstract class AbstractFileHandler
{
    protected string $directory = 'common';
    public const fileTypes = [];
    public abstract function store(UploadedFile $uploadedFile);
    public function delete(File $file): bool
    {
        try {
            $path = $file->path;

            if (Storage::exists($path))
                Storage::delete($path);
        } catch(Exception) {
            return false;                   // TODO: throw
        } finally {
            $file->delete();
        }

        return true;
    }
}