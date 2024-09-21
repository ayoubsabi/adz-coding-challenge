<?php

namespace Tests\Unit\Product;

use Faker\Factory;
use Tests\TestCase;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use App\Repositories\Category\CategoryRepositoryInterface;

class ProductCreationTest extends TestCase
{
    /**
     * A basic unit test for product creation.
     */
    public function test_product_creation(): void
    {
        $faker = Factory::create();
        $categoryRepository = $this->app->make(CategoryRepositoryInterface::class);
        $category = $categoryRepository->get()->random();

        $this->post('/api/products', [
            'name' => $faker->word,
            'description' => $faker->paragraph,
            'category_id' => $category->id,
            'price' => $faker->randomFloat(2, 0, 10000),
            'image' => UploadedFile::fake()->image('thread.png')
        ])->assertStatus(Response::HTTP_CREATED);
    }
}
