<?php

namespace App\Exceptions\File;

use Exception;

class FileUploadFailureException extends Exception
{
    public function __construct()
    {
        parent::__construct(message: "File upload failed. Please try again or contact support if the issue persists.");
    }
}
