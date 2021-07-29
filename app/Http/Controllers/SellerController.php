<?php


namespace App\Http\Controllers;


use App\Http\Controllers\Contracts\ApiController;
use App\Http\Requests\SellerRequests\StoreRequest;
use App\Http\Resources\Seller\StoreResource;
use App\Services\Contracts\SellerServiceInterface;
use Illuminate\Support\Facades\Log;

class SellerController extends ApiController
{
    /**
     * @var SellerServiceInterface
     */
    private $sellerService;

    public function __construct(SellerServiceInterface $sellerService)
    {
        $this->sellerService = $sellerService;
    }

    public function store(StoreRequest $request)
    {
        try {
            $data = StoreResource::make($this->sellerService->add($request->userId));
            return $this->respondSuccess($data);
        } catch (\Throwable $exception) {
            Log::error(__CLASS__, ['store' => $exception->getMessage()]);
            return $this->respondInvalidParams('invalid params');
        }
    }
}
