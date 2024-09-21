<?php

namespace App\Exceptions\Product;

use Exception;

class ProductUpdateFailureException extends Exception
{
    public function __construct()
    {
        parent::__construct(message: "Update product failed. Please try again or contact support if the issue persists.");
    }
}
