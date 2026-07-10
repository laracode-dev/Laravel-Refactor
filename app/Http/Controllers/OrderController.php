<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validation
        $request->validate([
            'product_id' => 'required|numeric|exists:products,id',
            'quantity' => 'required|numeric|min:1',
            'address' => 'required|string'
        ]);
        // product
        $product = Product::find($request->product_id);

        // total price
        $total = $product->price * $request->quntity;
        // create order
        $order = Order::create([
            'user_id' => 1,
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'address' => $request->address,
            'total' => $total
        ]);
        // return response
        return response()->json([
            'success' => true,
            'message' => 'Order created successfully!',
            'data' => $order
        ], 201);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
