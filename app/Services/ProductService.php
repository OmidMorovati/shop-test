<?php


namespace App\Services;

use App\Exceptions\ModelAlreadyExitstsException;
use App\Models\Store;
use App\Models\User;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Services\Contracts\ProductServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class ProductService
 * @package App\Services
 */
class ProductService implements ProductServiceInterface
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function create(array $data)
    {
        $data['store_id'] = Auth::user()->store->id;

        $checkExists = $this->productRepository->exists([
            'store_id' => $data['store_id'],
            'name'     => $data['name']
        ]);
        throw_if($checkExists, new ModelAlreadyExitstsException());
        return $this->productRepository->store($data);
    }

    public function all()
    {
        return $this->productRepository->all(['name', 'price']);
    }

    public function ownProducts()
    {
        return $this->productRepository->getOwnProducts();
    }

    public function allInNearby()
    {
        $usersTable    = (resolve(User::class))->getTable();
        $storesTable   = (resolve(Store::class))->getTable();
        $radiosInMeter = (int)env('NEARBY_DISTANCE_RADIOS', 1000);
        $storeIds      = DB::table($usersTable)
            ->select($storesTable . '.id')
            ->where('user_id', Auth::id())
            ->join('stores', function ($join) use ($radiosInMeter, $usersTable, $storesTable) {
                $join->on(DB::raw('st_distance(' . $usersTable . '.location, ' . $storesTable . '.location)'), '<', DB::raw($radiosInMeter));
            })->pluck('id')->toArray();

        return $this->productRepository->getByStoreId($storeIds);
    }
}
