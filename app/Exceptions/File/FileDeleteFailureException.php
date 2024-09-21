<?php

namespace App\Exceptions\File;

use Exception;

class FileDeleteFailureException extends Exception
{
    public function __construct()
    {
        parent::__construct(message: "File delete failed. Please try again or contact support if the issue persists.");
    }
}
