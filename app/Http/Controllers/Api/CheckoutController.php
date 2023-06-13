<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\CheckoutService;
use Illuminate\Support\Arr;

class CheckoutController extends Controller
{
    public function __invoke(CheckoutRequest $request)
    {
        $valid = $request->validated();

        $prices = CheckoutService::calculatePrice($valid);

        $order = CheckoutService::createOrder(Arr::except($prices['validated_data'], 'items'));

        if ($order)
        {
            CheckoutService::createItems($order, $prices['items']);

            CheckoutService::createPayment($order);
        }

        $order = Order::query()
                      ->with('order_items', 'order_items.book', 'order_items.book.authors')
                      ->find($order->id);

        return new OrderResource($order);
    }
}
