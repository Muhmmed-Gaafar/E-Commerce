<?php


namespace App\Services;

use App\Models\OrderItem;
use App\Models\Product;

class OrderItemService
{
    public function getAllOrderItems()
    {
        return OrderItem::all();
    }

    public function getOrderItemById($id)
    {
        return OrderItem::findOrFail($id);
    }

    public function createOrderItem($data)
    {
        $product = Product::find($data['product_id']);
        $priceAfterTax = $product->price + $product->tax;
        $totalPrice = $data['quantity'] * $priceAfterTax;
        if (!isset($data['price'])) {
            $data['price'] = $totalPrice;
        }

        return OrderItem::create($data);
    }

    public function updateOrderItem($id, $data)
    {
        $orderItem = OrderItem::findOrFail($id);
        $orderItem->update($data);
        return $orderItem;
    }

    public function deleteOrderItem($id)
    {
        $orderItem = OrderItem::findOrFail($id);
        $orderItem->delete();
        return $orderItem;
    }
}
