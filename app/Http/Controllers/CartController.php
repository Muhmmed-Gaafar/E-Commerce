<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Services\CartService;
use App\Http\Requests\CartRequest;
use App\Http\Resources\CartResource;
use Illuminate\Http\Response as HttpResponse;
use App\Trait\Response;

class CartController extends Controller
{
    use Response;

    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $carts = $this->cartService->getAllCarts();
        return $this->success(CartResource::collection($carts), 'Carts retrieved successfully');
    }

    public function show($id)
    {
        $cart = $this->cartService->getCartById($id);
        if ($cart) {
            return $this->success(new CartResource($cart), 'Cart retrieved successfully');
        }
        return $this->failed('Cart not found', [], HttpResponse::HTTP_NOT_FOUND);
    }

    public function store(CartRequest $request)
    {
        $cart = $this->cartService->createCart($request->validated());
        return $this->success(new CartResource($cart), 'Cart created successfully', HttpResponse::HTTP_CREATED);
    }

    public function update(CartRequest $request, $id)
    {
        $cart = $this->cartService->updateCart($request->validated(), $id);
        if ($cart) {
            return $this->success(new CartResource($cart), 'Cart updated successfully');
        }
        return $this->failed('Cart not found', [], HttpResponse::HTTP_NOT_FOUND);
    }

    public function destroy($id)
    {
        $deleted = $this->cartService->deleteCart($id);
        if ($deleted) {
            return $this->msg('Cart deleted successfully', HttpResponse::HTTP_NO_CONTENT);
        }
        return $this->failed('Cart not found', [], HttpResponse::HTTP_NOT_FOUND);
    }

    public function getAllProductsFromCart()
    {
        $user = auth()->user();
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();

        return $this->success(CartResource::collection($cartItems), 'Cart items retrieved successfully');
    }


    public function deleteProductFromCart(CartRequest $request)
    {
        dd($request);
            $this->cartService->removeProductFromCart($request->user(), $request->input('product_id'));
            return $this->msg('Product removed from cart successfully', HttpResponse::HTTP_OK);

    }

    public function deleteAllProductsFromCart()
    {
        try {
            $this->cartService->clearCartForUser(auth()->user());
            return $this->msg('All products removed from cart successfully', HttpResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->failed('Failed to clear cart', [], HttpResponse::HTTP_BAD_REQUEST);
        }
    }
}


