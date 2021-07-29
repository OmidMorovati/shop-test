<?php


namespace App\Services\Contracts;

/**
 * Interface ProductServiceInterface
 * @package App\Services\Contracts
 */
interface ProductServiceInterface
{
    public function create(array $data);

    public function ownProducts();

    public function all();

    public function allInNearby();
}
