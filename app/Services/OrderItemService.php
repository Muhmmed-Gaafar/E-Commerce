<?php


namespace App\Services;

use App\Models\OrderItem;

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
