<?php

namespace App\Exceptions\Category;

use Exception;

class CategoryDeleteFailureException extends Exception
{
    public function __construct()
    {
        parent::__construct(message: "Delete category failed. Please try again or contact support if the issue persists.");
    }
}
