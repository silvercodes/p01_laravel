<?php

declare(strict_types=1);

namespace App\Services\File;

use App\Exceptions\ApiBadRequestException;
use App\Models\File;
use Illuminate\Http\UploadedFile;

class FileService
{
    private array $handlers = [
        ImageHandler::class,
        PDFHandler::class,
    ];

    private ?AbstractFileHandler $fileHandler = null;

    public function save(UploadedFile $uploadedFile): File
    {
        $handler = $this->getFileHandler($uploadedFile->getMimeType());
        $path = $handler->store($uploadedFile);

        $file = new File([
            'mime_type' => $uploadedFile->getMimeType(),
            'original_name' => $uploadedFile->getClientOriginalName(),
            'original_extension' => $uploadedFile->getClientOriginalExtension(),
            'path' => $path
        ]);

        $file->save();

        return $file;
    }

    public function delete(File $file): bool
    {
        return $this->getFileHandler($file->mime_type)->delete($file);
    }

    private function getFileHandler(string $fileType): AbstractFileHandler
    {
        $handlerClass = $this->findHandlerClass($fileType);

        if (! ($this->fileHandler instanceof $handlerClass))
            $this->fileHandler = new $handlerClass();

        return $this->fileHandler;
    }

    private function findHandlerClass(string $fileType)
    {
        foreach ($this->handlers as $handler)
            if (in_array($fileType, $handler::fileTypes))
                return $handler;

        throw new ApiBadRequestException('File format not supported');
    }
}