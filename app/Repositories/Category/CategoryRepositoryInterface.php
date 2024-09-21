<?php

namespace App\Repositories\Category;

use App\Models\Category;
use Illuminate\Support\Collection;

interface CategoryRepositoryInterface
{
    /**
     * Get categorys.
     * 
     * @return Collection
     */
    public function get(): Collection;

    /**
     * Find a category by its ID.
     *
     * @param int $id
     * 
     * @return Category
     */
    public function find(int $id): ?Category;

    /**
     * Create a new category.
     *
     * @param array $data
     * 
     * @return Category
     */
    public function create(array $data): Category;

    /**
     * Update a category by its ID.
     *
     * @param int $id
     * @param array $data
     * 
     * @return Category
     */
    public function update(int $id, array $data): Category;

    /**
     * Delete a category by its ID.
     *
     * @param int $id
     * 
     * @return bool|null
     */
    public function delete(int $id): ?bool;
}
