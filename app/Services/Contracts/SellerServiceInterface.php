<?php


namespace App\Services\Contracts;

/**
 * Interface SellerServiceInterface
 * @package App\Services\Contracts
 */
interface SellerServiceInterface
{
    /**
     * @param int $userId
     * @return mixed
     */
    public function add(int $userId);
}
