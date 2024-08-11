<?php
namespace App\Services;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartService
{
    public function getAllCarts()
    {
        return Cart::all();
    }

    public function getCartById($id)
    {
        return Cart::where('id', $id)->first();
    }

    public function createCart($data)
    {
        return Cart::updateOrCreate(
            [
                'user_id' =>Auth::user()->id,
                'product_id' => $data['product_id']
            ],
            [
                'quantity' => $data['quantity']
            ]
        );
    }

    public function updateCart($data, $id)
    {
        $cart = Cart::where('id', $id)->first();
        if ($cart) {
            $cart->update($data);
            return $cart;
        }
        return null;
    }

    public function deleteCart($id)
    {
        $cart = Cart::where('id', $id)->first();
        if ($cart) {
            $cart->delete();
            return true;
        }
        return false;
    }

    public function removeProductFromCart($user, $productId)
    {
        Cart::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->delete();
    }

    public function clearCartForUser($user)
    {
        Cart::where('user_id', $user->id)->delete();
    }
}
