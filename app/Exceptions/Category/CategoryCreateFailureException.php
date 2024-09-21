<?php

namespace App\Exceptions\Category;

use Exception;

class CategoryCreateFailureException extends Exception
{
    public function __construct()
    {
        parent::__construct(message: "Create category failed. Please try again or contact support if the issue persists.");
    }
}
