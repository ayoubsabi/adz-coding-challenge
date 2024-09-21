<?php

namespace App\Repositories\Product\Eloquent;

use App\Models\Product;
use Illuminate\Support\Collection;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Exceptions\Product\ProductCreateFailureException;
use App\Exceptions\Product\ProductDeleteFailureException;
use App\Exceptions\Product\ProductNotFoundException;
use App\Exceptions\Product\ProductUpdateFailureException;

class ProductRepository implements ProductRepositoryInterface
{
    public function __construct(
        readonly private Product $product
    ) { }

    /**
     * {@inheritdoc}
     */
    public function get(?int $categoryId = null, ?string $sortByPrice = null): Collection
    {
        $query = $this->product->query();

        if (!is_null($categoryId)) {
            $query->where('category_id', $categoryId);
        }

        if (!is_null($sortByPrice) && in_array($sortByPrice, ['asc', 'desc'])) {
            $query->orderBy('price', $sortByPrice);
        }

        return $query->with('category')->get();
    }

    /**
     * {@inheritdoc}
     */
    public function find(int $id): Product
    {
        if (null === $product = $this->product->find($id)) {
            throw new ProductNotFoundException();
        }

        return $product;
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data): Product
    {
        $product = new Product();

        $product->name = $data['name'];
        $product->image = $data['image'];
        $product->price = $data['price'];
        $product->description = $data['description'];
        $product->category_id = $data['category_id'];

        if (!$product->save()) {
            throw new ProductCreateFailureException();
        }

        return $product;
    }

    /**
     * {@inheritdoc}
     */
    public function update(int $id, array $data): Product
    {
        $product = $this->find($id);

        if (!$product->update($data)) {
            throw new ProductUpdateFailureException();
        }

        return $product;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(int $id): ?bool
    {
        $product = $this->find($id);

        if (!$product->delete()) {
            throw new ProductDeleteFailureException();
        }

        return true;
    }
}
