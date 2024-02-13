<?php

namespace App\Services\Zip;

use Illuminate\Support\Collection;
use ZipArchive;

class ZipService
{
    const ZIP_DIR = 'storage/';
    public function compress(Collection $files, string $zipTitle): string
    {
        $zip = new ZipArchive();

        $zipName = self::ZIP_DIR . $zipTitle;

        $zip->open($zipName, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        foreach ($files as $file)
            $zip->addFile($file->getAbsolutePath(), $file->original_name);

        $zip->close();

        return $zipName;
    }
}