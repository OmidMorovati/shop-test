<?php


namespace App\Services;


use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Repositories\Contracts\StoreRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\StoreRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Services\Contracts\SellerServiceInterface;
use Illuminate\Support\Facades\DB;

/**
 * Class AuthService
 * @package App\Services
 */
class SellerService implements SellerServiceInterface
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;
    /**
     * @var StoreRepository
     */
    private $storeRepository;

    /**
     * AuthService constructor.
     * @param UserRepositoryInterface $userRepository
     * @param StoreRepositoryInterface $storeRepository
     */
    public function __construct(UserRepositoryInterface $userRepository, StoreRepositoryInterface $storeRepository)
    {
        $this->userRepository  = $userRepository;
        $this->storeRepository = $storeRepository;
    }

    public function add(int $userId)
    {
        try {
            DB::beginTransaction();
            /** @var User $user */
            $user = $this->userRepository->find($userId);
            $user->givePermissionTo(Permission::ADD_SELLER);

            $this->storeRepository->store([
                'user_id' => $userId,
                'name'    => $user->name . '-shop'
            ]);
            DB::commit();
        } catch (\Throwable $exception) {
            DB::rollBack();
            return false;
        }
        return $user;
    }
}
