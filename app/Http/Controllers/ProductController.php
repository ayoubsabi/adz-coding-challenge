<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Services\Product\ProductService;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductCollection;

class ProductController extends Controller
{
    public function __construct(
        readonly private ProductService $productService
    ) { }

    /**
     * Display a listing of the resource.
     * 
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        return new JsonResponse(
            new ProductCollection(
                $this->productService->getProducts($request->all())
            ),
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        return new JsonResponse(
            new ProductResource(
                $this->productService->createProduct($request->all())
            ),
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     * 
     * @param int $id
     * 
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return new JsonResponse(
            new ProductResource(
                $this->productService->getProductById($id)
            ),
            Response::HTTP_OK
        );
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param Request $request
     * @param int $id
     * 
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        return new JsonResponse(
            new ProductResource(
                $this->productService->updateProduct($id, $request->all())
            ),
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param int $id
     * 
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->productService->deleteProduct($id);

        return new JsonResponse(status: Response::HTTP_NO_CONTENT);
    }
}
