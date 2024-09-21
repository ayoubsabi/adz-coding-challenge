<?php

namespace App\Services\Product;

use App\Models\Product;
use App\Rules\CategoryExists;
use Illuminate\Support\Collection;
use App\Services\Utils\ValidatorService;
use App\Services\Utils\LocalFileUploadService;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;

class ProductService
{
    public function __construct(
        readonly private ProductRepositoryInterface $productRepository,
        readonly private CategoryRepositoryInterface $categoryRepository,
        readonly private LocalFileUploadService $localFileUploadService,
        readonly private ValidatorService $validatorService
    ) { }

    public function getProducts(?array $data): Collection
    {
        $data = $this->validatorService->validate($data, [
            'category_id' => ['nullable', 'integer', new CategoryExists($this->categoryRepository)],
            'sort_by_price' => ['nullable', 'string', 'in:asc,desc']
        ]);

        return $this->productRepository->get(
            $data['category_id'] ?? null,
            $data['sort_by_price'] ?? null
        );
    }

    public function getProductById(int $id): Product
    {
        return $this->productRepository->find($id);
    }

    public function createProduct(array $data): Product
    {
        $data = $this->validatorService->validate($data, [
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0', 'max:99999'],
            'image' => ['required', 'mimes:jpeg,jpg,png'],
            'category_id' => ['required', 'integer', new CategoryExists($this->categoryRepository)]
        ]);

        $data['image'] = $this->localFileUploadService->save(
            $data['image'],
            storage_path('app/images')
        );

        return $this->productRepository->create($data);
    }

    public function updateProduct(int $id, array $data): Product
    {
        $data = $this->validatorService->validate($data, [
            'name' => ['string'],
            'description' => ['string'],
            'price' => ['numeric', 'min:0', 'max:99999'],
            'image' => ['mimes:jpeg,jpg,png'],
            'category_id' => ['integer', new CategoryExists($this->categoryRepository)]
        ]);

        $product = $this->productRepository->find($id);

        if (isset($data['image'])) {
            $data['image'] = $this->localFileUploadService->update(
                $product->image,
                $data['image'],
                storage_path('app/images')
            );
        }

        return $this->productRepository->update($id, $data);
    }

    public function deleteProduct(int $id): void
    {
        $product = $this->productRepository->find($id);

        $this->localFileUploadService->delete(sprintf("%s/%s", storage_path('app/images'), $product->image));

        $this->productRepository->delete($id);
    }
}
