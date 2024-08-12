<?php


namespace App\Services;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function getAllOrders()
    {
        return Order::all();
    }

    public function getOrderById($id)
    {
        return Order::findOrFail($id);
    }

    public function createOrder(array $data)
    {
        return DB::transaction(function () use ($data) {
            $user = Auth::user();
            if ($user) {
                $data['user_id'] = $user->id;
                $data['first_name'] = $user->first_name;
                $data['last_name'] = $user->last_name;
                $data['phone'] = $user->phone;
                $data['address'] = $user->address;
                $data['email'] = $user->email;
            } else {
                $requiredFields = ['first_name', 'last_name', 'phone', 'address', 'email'];
                foreach ($requiredFields as $field) {
                    if (empty($data[$field])) {
                        throw new \Exception("The {$field} field is required.");
                    }
                }
            }

            $totalPrice = 0;
            $orderItemsData = [];
            foreach ($data['order_items'] as $itemData) {
                $product = Product::findOrFail($itemData['product_id']);
                $itemTotal = $itemData['price'] ?? ($product->price + $product->tax) * $itemData['quantity'];
                $totalPrice += $itemTotal;
                $orderItemsData[] = [
                    'product_id' => $itemData['product_id'],
                    'quantity' => $itemData['quantity'],
                    'price' => $itemTotal,
                ];
            }
            $data['total'] = $totalPrice;
            $data['status'] = OrderStatus::PROCESSING->value;
            $order = Order::create($data);

            foreach ($orderItemsData as &$itemData) {
                $itemData['order_id'] = $order->id;
                OrderItem::create($itemData);
            }

            return $order;
        });
    }


    public function updateOrder($id, $data)
    {
        $order = Order::findOrFail($id);
        $order->update($data);
        return $order;
    }

    public function deleteOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return $order;
    }
}
