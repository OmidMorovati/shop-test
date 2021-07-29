<?php


namespace App\Repositories\Contracts;


interface ProductRepositoryInterface extends RepositoryInterface
{
    public function getOwnProducts();

    public function getByStoreId(array $ids);

    public function stockIncrement(int $id, $amount = 1);

    public function stockDecrement(int $id, $amount = 1);
}
