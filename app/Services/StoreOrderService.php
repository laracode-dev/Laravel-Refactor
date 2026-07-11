<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;

class StoreOrderService
{
    public function handle(array $data): ?Order
    {
        // product
        $product = $this->getProduct($data['product_id']);
        // total
        $total = $this->calculateTotal($data['quantity'], $product->price);
        //store order
        $attributes = [
            'user_id' => 1,
            'product_id' => $data['product_id'],
            'quantity' => $data['quantity'],
            'total' => $total,
            'address' => $data['address'],
        ];
        $order = $this->store($attributes);
        return $order ?? null;
    }

    public function getProduct(int $productId): ?Product
    {
        $product = Product::find($productId);
        return $product ?? null;
    }

    public function calculateTotal(int $quantity, float $price): float
    {
        return $quantity * $price;
    }

    public function store(array $attributes): ?Order
    {
        $order = Order::create($attributes);
        return $order ?? null;
    }
}
