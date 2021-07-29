<?php


namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Contracts\ApiController;
use App\Http\Requests\OrderRequests\StoreRequest;
use App\Http\Resources\Customer\OrderResource;
use App\Services\Contracts\OrderServiceInterface;
use Illuminate\Support\Facades\Log;


class OrderController extends ApiController
{
    /**
     * @var OrderServiceInterface
     */
    private $orderService;

    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }

    public function store(StoreRequest $request)
    {
        try {
            $data = OrderResource::make($this->orderService->create($request->validated()));
            return $this->respondSuccess($data);
        } catch (\Throwable $exception) {
            Log::error(__CLASS__, ['store' => $exception->getMessage()]);
            return $this->respondInvalidParams('invalid params');
        }
    }
}
