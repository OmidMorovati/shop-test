<?php


namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Contracts\ApiController;
use App\Http\Resources\Customer\ProductResource;
use App\Services\Contracts\ProductServiceInterface;


class ProductController extends ApiController
{
    /**
     * @var ProductServiceInterface
     */
    private $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $data = ProductResource::collection($this->productService->allInNearby());
        return $this->respondSuccess($data);
    }
}
