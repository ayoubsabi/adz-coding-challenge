<?php

namespace App\Exceptions\Product;

use Exception;

class ProductDeleteFailureException extends Exception
{
    public function __construct()
    {
        parent::__construct(message: "Delete product failed. Please try again or contact support if the issue persists.");
    }
}
