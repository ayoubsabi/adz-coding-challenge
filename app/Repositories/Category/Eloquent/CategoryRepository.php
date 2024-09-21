<?php

namespace App\Repositories\Category\Eloquent;

use App\Models\Category;
use Illuminate\Support\Collection;
use App\Exceptions\Category\CategoryNotFoundException;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Exceptions\Category\CategoryCreateFailureException;
use App\Exceptions\Category\CategoryDeleteFailureException;
use App\Exceptions\Category\CategoryUpdateFailureException;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function __construct(
        readonly private Category $category
    ) { }

    /**
     * {@inheritdoc}
     */
    public function get(): Collection
    {
        return $this->category->get();
    }

    /**
     * {@inheritdoc}
     */
    public function find(int $id): ?Category
    {
        if (null === $category = $this->category->find($id)) {
            throw new CategoryNotFoundException();
        }

        return $category;
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data): Category
    {
        $category = new Category();

        $category->name = $data['name'];
        $category->parent_id = $data['parent_id'];

        if (!$category->save()) {
            throw new CategoryCreateFailureException();
        }

        return $category;
    }

    /**
     * {@inheritdoc}
     */
    public function update(int $id, array $data): Category
    {
        $category = $this->find($id);

        if (!$category->update($data)) {
            throw new CategoryUpdateFailureException();
        }

        return $category;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(int $id): ?bool
    {
        $category = $this->find($id);

        if (!$category->delete()) {
            throw new CategoryDeleteFailureException();
        }

        return true;
    }
}
