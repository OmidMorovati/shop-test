<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Contracts\ApiController;
use App\Http\Requests\AuthRequests\LoginRequest;
use App\Http\Requests\AuthRequests\RegisterRequest;
use App\Services\Contracts\AuthServiceInterface;

class AuthController extends ApiController
{
    /**
     * @var AuthServiceInterface
     */
    private AuthServiceInterface $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request)
    {
        $data = $this->authService->login($request->email, $request->password);
        if (!$data) {
            return $this->respondUnauthorized('Invalid login details');
        }
        return $this->respondSuccess($data);
    }

    public function register(RegisterRequest $request)
    {
        $data = $this->authService->register($request->name, $request->email, $request->password);
        if (!$data) {
            return $this->respondInternalError('Internal Error');
        }
        return $this->respondItemCreated($data);
    }

    public function me()
    {
        $data = $this->authService->me();
        if (!$data) {
            return $this->respondUnauthorized('you must login');
        }
        return $this->respondSuccess($data);
    }
}
