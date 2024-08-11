<?php


namespace App\Services;

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

//    public function createOrder($data)
//    {
//        $user = Auth::user();
//        $data['user_id'] = $user->id;
//        return Order::create($data);
//    }

    public function createOrder($data)
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
            $order = Order::create($data);

            foreach ($data['order_items'] as $itemData) {
                $product = Product::findOrFail($itemData['product_id']);
                $priceAfterTax = $product->price + $product->tax;
                $Total = $itemData['quantity'] * $priceAfterTax;
                $totalPrice += $Total;

                $itemData['price'] = $Total;
                $itemData['order_id'] = $order->id;

                $orderItemsData[] = $itemData;
            }

            $data['total'] = $totalPrice;
            $order = Order::create($data);

            foreach ($orderItemsData as $itemData) {
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
