<?php

namespace App\Repositories\Product;

use App\Models\Product;
use Illuminate\Support\Collection;

interface ProductRepositoryInterface
{
    /**
     * Get products with optional filtering by criteria and sorting by price.
     *
     * @param int|null $categoryId
     * @param string|null $sortByPrice
     * 
     * @return Collection
     */
    public function get(?int $categoryId = null, ?string $sortByPrice = null): Collection;

    /**
     * Find a product by its ID.
     *
     * @param int $id
     * 
     * @return Product
     */
    public function find(int $id): Product;

    /**
     * Create a new product.
     *
     * @param array $data
     * 
     * @return Product
     */
    public function create(array $data): Product;

    /**
     * Update a product by its ID.
     *
     * @param int $id
     * @param array $data
     * 
     * @return Product
     */
    public function update(int $id, array $data): Product;

    /**
     * Delete a product by its ID.
     *
     * @param int $id
     * 
     * @return bool|null
     */
    public function delete(int $id): ?bool;
}
