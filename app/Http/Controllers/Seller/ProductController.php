<?php


namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Contracts\ApiController;
use App\Http\Requests\ProductRequests\StoreRequest;
use App\Http\Resources\Seller\ProductResource;
use App\Models\User;
use App\Services\Contracts\ProductServiceInterface;
use Illuminate\Support\Facades\Log;

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

    public function store(StoreRequest $request)
    {
        try {
            /** @var User $user */
            $data = ProductResource::make($this->productService->create($request->validated()));
            return $this->respondSuccess($data);
        } catch (\Throwable $exception) {
            Log::error(__CLASS__, ['store' => $exception->getMessage()]);
            return $this->respondInvalidParams('invalid params');
        }
    }

    public function index()
    {
        $data = ProductResource::collection($this->productService->ownProducts());
        return $this->respondSuccess($data);
    }
}
