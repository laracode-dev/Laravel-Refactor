<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;

class StoreOrderService
{
    public function handle(array $data): ?Order
    {
        $product = $this->getProduct($data['product_id']);

        $totalPrice = $this->calculateTotal($data['quantity'], $product->price);

        $orderData = [
            'user_id' => 1,
            'product_id' => $product->id,
            'quantity' => $data['quantity'],
            'address' => $data['address'],
            'total' => $totalPrice,
        ];
        $order = $this->store($orderData);

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
        $order = Order::create([
            'user_id' => $attributes['user_id'],
            'product_id' => $attributes['product_id'],
            'quantity' => $attributes['quantity'],
            'address' => $attributes['address'],
            'total' => $attributes['total'],
        ]);
        return $order ?? null;
    }


}
