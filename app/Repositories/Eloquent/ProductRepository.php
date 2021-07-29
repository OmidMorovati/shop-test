<?php


namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\Contracts\EloquentBaseRepository;
use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductRepository extends EloquentBaseRepository implements ProductRepositoryInterface
{
    protected function model(): string
    {
        return Product::class;
    }
}
