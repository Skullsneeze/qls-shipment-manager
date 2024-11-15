<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateOrderRequest $request)
    {
        $requestData = $request->safe()->all();

        $order = new Order();
        $order->setNumber($requestData['order_number']);
        $order->setTotalAmount(0);
        $order->save();

        $totalAmount = 0;
        $orderItems = [];
        foreach ($requestData['products'] as $product) {
            $qty = (float)$product['qty'];
            $price = $qty * (float)$product['price'];
            $item = new OrderItem();
            $item->setName($product['name']);
            $item->setPrice($price);
            $item->setQty($qty);
            $item->setSku($product['sku']);
            $item->setEan($product['ean']);
            $orderItems[] = $item;

            $totalAmount += $price;
        }

        $order->items()->saveMany($orderItems);

        $order->setTotalAmount($totalAmount);
        $order->save();

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'order_id' => $order->id
            ]);
        }
    }
}
