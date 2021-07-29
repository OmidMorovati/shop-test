<?php


namespace App\Services;

use App\Models\User;
use App\Repositories\Eloquent\UserRepository;
use App\Services\Contracts\AuthServiceInterface;
use Illuminate\Support\Facades\Auth;

/**
 * Class AuthService
 * @package App\Services
 */
class AuthService implements AuthServiceInterface
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * AuthService constructor.
     */
    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @return array
     */
    public function register(string $name, string $email, string $password): array
    {
        /** @var User $user */
        $user = $this->userRepository->store([
            'name'     => $name,
            'email'    => $email,
            'password' => $password
        ]);

        return $this->makeToken($user);
    }

    /**
     * @param string $email
     * @param string $password
     * @return array|bool
     */
    public function login(string $email, string $password)
    {
        if (!Auth::attempt(['email' => $email, 'password' => $password])) {
            return false;
        }

        /** @var User $user */
        $user = $this->userRepository->findWhere([
            'email' => $email
        ]);

        return $this->makeToken($user);
    }

    /**
     *
     */
    public function logout(): void
    {
        Auth::logout();
    }

    public function me()
    {
        if (Auth::guest()) {
            return false;
        }
        return $this->userRepository->find(Auth::id(), ['name', 'email']);
    }

    /**
     * @param User $user
     * @return array
     */
    private function makeToken(User $user): array
    {
        $token = $user->createToken('api_token_' . $user->id)->plainTextToken;
        return [
            'access_token' => $token,
            'token_type'   => 'Bearer',
        ];
    }
}
