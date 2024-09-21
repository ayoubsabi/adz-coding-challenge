<?php

namespace App\Services\Utils;

use Illuminate\Http\UploadedFile;
use Illuminate\Filesystem\Filesystem;
use App\Exceptions\File\FileDeleteFailureException;
use App\Exceptions\File\FileUploadFailureException;

class LocalFileUploadService
{
    public function __construct(
        readonly private Filesystem $filesystem
    ) { }

    /**
     * Saves the uploaded file to the specified path and returns the generated file name.
     * 
     * @param UploadedFile $file
     * @param string $dirPath
     * 
     * @return string
     */
    public function save(UploadedFile $file, string $dirPath): string
    {
        $fileName = $this->generateFileName($file);
        $filePath = sprintf('%s/%s', $dirPath, $fileName);

        if (!$this->filesystem->put($filePath, $file)) {
            throw new FileUploadFailureException();
        }

        return $fileName;
    }

    /**
     * Deletes the current file and uploads a new one to the specified path.
     *
     * @param string $currentFileName
     * @param UploadedFile $file
     * @param string $path
     * 
     * @return string
     */
    public function update(string $currentFileName, UploadedFile $file, string $path): string
    {
        $this->delete(sprintf('%s/%s', $path, $currentFileName));

        return $this->save($file, $path);
    }

    /**
     * Deletes a file at the given path.
     *
     * @param string $filePath
     * 
     * @return bool
     */
    public function delete(string $filePath): bool
    {
        if (!$this->filesystem->delete($filePath)) {
            throw new FileDeleteFailureException();
        }

        return true;
    }

    /**
     * Generates a unique file name using the hash of the uploaded file.
     * 
     * @return string
     */
    private function generateFileName(UploadedFile $file): string
    {
        return $file->hashName();
    }
}