<?php


namespace App\Services;


use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Services\Contracts\ProductServiceInterface;
use Illuminate\Support\Facades\Auth;

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
        return $this->productRepository->store($data);
    }
}
