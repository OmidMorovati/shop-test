<?php


namespace App\Services;


use App\Models\Role;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\UserRepository;
use App\Services\Contracts\AuthServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @return array|bool
     */
    public function register(string $name, string $email, string $password)
    {
        try {
            DB::beginTransaction();
            /** @var User $user */
            $user = $this->userRepository->store([
                'name'     => $name,
                'email'    => $email,
                'password' => $password
            ]);

            $user->assignRole(Role::CUSTOMER);
            DB::commit();
        } catch (\Throwable $exception) {
            DB::rollBack();
            return false;
        }

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
            'role'         => $user->roles()->first()->name ?? null
        ];
    }
}
