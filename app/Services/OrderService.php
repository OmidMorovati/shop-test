<?php


namespace App\Services;


use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Services\Contracts\OrderServiceInterface;
use Illuminate\Support\Facades\Auth;

/**
 * Class AuthService
 * @package App\Services
 */
class OrderService implements OrderServiceInterface
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;
    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepository;


    /**
     * AuthService constructor.
     * @param OrderRepositoryInterface $orderRepository
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(OrderRepositoryInterface $orderRepository, ProductRepositoryInterface $productRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->productRepository   = $productRepository;
    }

    public function create(array $data)
    {

        $product             = $this->productRepository->find($data['product_id']);
        $data['total_price'] = $product->price;
        $data['buyer_id']    = Auth::id();
        return $this->orderRepository->store($data);
    }
}
