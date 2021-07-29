<?php


namespace App\Http\Controllers\Seller;


use App\Http\Controllers\Contracts\ApiController;
use App\Http\Requests\StoreRequests\UpdateRequest;
use App\Http\Resources\Seller\StoreResource;
use App\Models\User;
use App\Services\Contracts\StoreServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class StoreController extends ApiController
{
    /**
     * @var StoreServiceInterface
     */
    private $storeService;

    public function __construct(StoreServiceInterface $storeService)
    {
        $this->storeService = $storeService;
    }

    public function update(UpdateRequest $request)
    {
        try {
            /** @var User $user */
            $data = StoreResource::make($this->storeService->update(Auth::user()->store->id, $request->validated()));
            return $this->respondSuccess($data);
        } catch (\Throwable $exception) {
            Log::error(__CLASS__, ['update' => $exception->getMessage()]);
            return $this->respondInvalidParams('invalid params');
        }
    }
}
