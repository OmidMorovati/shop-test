<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Contracts\ApiController;
use App\Http\Requests\ProfileRequests\UpdateRequest;
use App\Http\Resources\UserGeneralResource;
use App\Services\Contracts\UserServiceInterface;

class ProfileController extends ApiController
{

    /**
     * @var UserServiceInterface
     */
    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function update(UpdateRequest $request)
    {
        $data = UserGeneralResource::make($this->userService->updateProfile($request->validated()));
        if (!$data) {
            return $this->respondInvalidParams('Invalid Params');
        }
        return $this->respondSuccess($data);
    }
}
