<?php


namespace App\Repositories\Eloquent;

use App\Models\Order;
use App\Repositories\Contracts\EloquentBaseRepository;
use App\Repositories\Contracts\OrderRepositoryInterface;


class OrderRepository extends EloquentBaseRepository implements OrderRepositoryInterface
{
    protected function model(): string
    {
        return Order::class;
    }
}
