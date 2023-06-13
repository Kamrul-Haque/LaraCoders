<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Str;

class CheckoutService
{
    /**
     * Calculates 'delivery_charge', 'vat', 'discount' etc. pricing
     *
     * @param array $validatedData
     * @return array
     */
    public static function calculatePrice(array $validatedData): array
    {
        $validatedData['delivery_charge'] = $validatedData['customer_city'] == 'Dhaka' ? 30 : 60;
        $validatedData['sub_total'] = 0;
        $validatedData['total_vat'] = 0;

        $orderItems = [];

        foreach ($validatedData['items'] as $item)
        {
            $book = Book::findOrFail($item['book_id']);

            $item['price'] = $book->price * $item['quantity'];
            $item['vat'] = $item['price'] * 0.15;
            $validatedData['total_vat'] += $item['vat'];
            $validatedData['sub_total'] += $item['price'] + $item['vat'];

            $orderItems[] = $item;
        }

        $validatedData['discount'] = self::calculateDiscount($validatedData['sub_total'], $validatedData['voucher_code']);
        $validatedData['grand_total'] = $validatedData['sub_total'] + $validatedData['delivery_charge'] - $validatedData['discount'];

        return [
            'items' => $orderItems,
            'validated_data' => $validatedData
        ];
    }

    /**
     * Creates and returns an order
     *
     * @param array $orderInfo
     * @return Order
     */
    public static function createOrder(array $orderInfo): Order
    {
        $orderInfo['order_number'] = Str::uuid();

        return Order::create($orderInfo);
    }

    /**
     * Creates order_items with the given order
     *
     * @param Order $order
     * @param array $items
     * @return void
     */
    public static function createItems(Order $order, array $items): void
    {
        $order->order_items()->createMany($items);
    }

    /**
     * Creates payment with the given order
     *
     * @param Order $order
     * @return Payment
     */
    public static function createPayment(Order $order): Payment
    {
        return Payment::create([
            'transaction_id' => Str::uuid(),
            'order_id' => $order->id,
            'amount' => $order->id,
            'date' => today()->toDateString(),
        ]);
    }

    private static function calculateDiscount(float $sub_total, string $voucher_code): float
    {
        $discount = $sub_total > 1000 ? $sub_total * 0.10 : 0;
        $discount += $voucher_code == 'SUMMER20' ? 100 : 0;

        return $discount;
    }
}
