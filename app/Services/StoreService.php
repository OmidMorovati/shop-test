<?php


namespace App\Services;


use App\Models\Permission;
use App\Models\User;
use App\Repositories\Contracts\StoreRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\UserRepository;
use App\Services\Contracts\StoreServiceInterface;
use Illuminate\Support\Facades\DB;

/**
 * Class AuthService
 * @package App\Services
 */
class StoreService implements StoreServiceInterface
{
    /**
     * @var StoreRepositoryInterface
     */
    private $storeRepository;

    /**
     * AuthService constructor.
     * @param StoreRepositoryInterface $storeRepository
     */
    public function __construct(StoreRepositoryInterface $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }

    public function update(int $id, array $data)
    {
        try {
            DB::beginTransaction();
            $store = $this->storeRepository->update($id, $data);
            DB::commit();
        } catch (\Throwable $exception) {
            DB::rollBack();
            return false;
        }
        return $store;
    }
}
