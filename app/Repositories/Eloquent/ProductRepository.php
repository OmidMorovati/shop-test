<?php


namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\Contracts\EloquentBaseRepository;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class ProductRepository extends EloquentBaseRepository implements ProductRepositoryInterface
{
    protected function model(): string
    {
        return Product::class;
    }

    public function getOwnProducts()
    {
        $storeId = Auth::user()->store->id ?? null;
        if (!isset($storeId)) {
            return collect();
        }
        return $this->model->where('store_id', Auth::user()->store->id)->get();
    }

    public function getByStoreId(array $ids)
    {
        return $this->model->whereIn('store_id', $ids)->get();
    }

    public function stockIncrement(int $id, $amount = 1)
    {
        $product = $this->find($id);
        $product->increment('stock', $amount);
        return $product;
    }

    public function stockDecrement(int $id, $amount = 1)
    {
        $product = $this->find($id);
        $product->decrement('stock', $amount);
        return $product;
    }
}
