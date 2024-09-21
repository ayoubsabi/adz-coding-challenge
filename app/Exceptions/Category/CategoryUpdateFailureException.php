<?php

namespace App\Exceptions\Category;

use Exception;

class CategoryUpdateFailureException extends Exception
{
    public function __construct()
    {
        parent::__construct(message: "Update category failed. Please try again or contact support if the issue persists.");
    }
}
