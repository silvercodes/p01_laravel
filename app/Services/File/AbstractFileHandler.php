<?php

declare(strict_types=1);

namespace App\Services\File;

use Illuminate\Http\UploadedFile;

abstract class AbstractFileHandler
{
    protected string $directory = 'common';
    public const fileTypes = [];
    public abstract function store(UploadedFile $uploadedFile);
}