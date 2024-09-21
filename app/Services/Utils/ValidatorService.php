<?php

namespace App\Services\Utils;

use Illuminate\Contracts\Validation\Factory as ValidatorFactory;

class ValidatorService
{
    public function __construct(
        readonly private ValidatorFactory $validatorFactory
    ) { }

    /**
     * Validate user inputs.
     *
     * @param array $data
     * @param array $rules
     * 
     * @return array
     */
    public function validate(array $data, array $rules): array
    {
        return $this->validatorFactory->make($data, $rules)->validate();
    }
}