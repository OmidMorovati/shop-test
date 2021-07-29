<?php


namespace App\Repositories\Contracts;


interface ProductRepositoryInterface extends RepositoryInterface
{
    public function getOwnProducts();

    public function getByStoreId(array $ids);
}
