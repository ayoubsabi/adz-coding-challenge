<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryExists implements ValidationRule
{
    public function __construct(
        readonly private CategoryRepositoryInterface $categoryRepository
    ) { }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->categoryRepository->find($value)) {
            $fail('The selected category does not exist.');
        }
    }
}
