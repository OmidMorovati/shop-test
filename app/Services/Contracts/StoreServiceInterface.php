<?php


namespace App\Services\Contracts;

/**
 * Interface StoreServiceInterface
 * @package App\Services\Contracts
 */
interface StoreServiceInterface
{
    public function update(int $id, array $data);
}
