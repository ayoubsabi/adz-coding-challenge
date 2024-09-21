<?php

namespace App\Console\Commands\Product;

use App\Services\Product\ProductService;
use Illuminate\Console\Command;

class CreateProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new product via the command line';

    public function __construct(readonly private ProductService $productService)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        try {
            $product = $this->productService->createProduct([
                'name' => $this->ask('Enter product name'),
                'description' => $this->ask('Enter product description'),
                'price' => $this->ask('Enter product price'),
                'category_id' => $this->ask('Enter category ID')
            ]);
    
            $this->output->success(
                sprintf('Product %s created successfully', $product->name)
            );
        } catch (\Throwable $th) {
            $this->output->error($th->getMessage());
        }
    }
}
