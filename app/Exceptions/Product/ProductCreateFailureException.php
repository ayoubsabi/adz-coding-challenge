<?php

namespace App\Exceptions\Product;

use Exception;

class ProductCreateFailureException extends Exception
{
    public function __construct()
    {
        parent::__construct(message: "Create product failed. Please try again or contact support if the issue persists.");
    }
}
