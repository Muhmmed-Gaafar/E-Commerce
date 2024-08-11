<?php


use App\Http\Controllers\OrderItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\ProductColorController;
use App\Http\Controllers\ProductSizeController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/getAllFavoriteProducts', [FavoriteController::class, 'getAllFavoriteProducts']);
    Route::post('/product_favorite', [FavoriteController::class, 'product_favorite']);
    Route::post('/carts', [CartController::class, 'store'])
        ->name('carts.store');
    Route::delete('deleteProductFromCart', [CartController::class, 'deleteProductFromCart'])
        ->name('cart.product.delete');
    Route::delete('/cart/clear', [CartController::class, 'deleteAllProductsFromCart'])
        ->name('cart.clear');
    Route::post('/orders', [OrderController::class, 'store'])
        ->name('orders.store');
    Route::post('getAllProductsFromCart', [CartController::class, 'getAllProductsFromCart']);
});

// Routes for Category
Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/{id}', [CategoryController::class, 'show'])->name('categories.show');
    Route::put('/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});

// Routes for Product
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::post('/', [ProductController::class, 'store'])->name('products.store');
    Route::get('/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::put('/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::post('getProductsByCategory', [ProductController::class, 'getProductsByCategory']);
    Route::post('change_favorite_product', [ProductController::class, 'change_favorite_product'])->name('products.change_favorite_product');
    Route::get('/products/addFavoriteProduct', [ProductController::class, 'addFavoriteProduct']);

});

// Routes for Product _Type
Route::prefix('product-types')->group(function () {
    Route::get('/', [ProductTypeController::class, 'index'])->name('product-types.index');
    Route::post('/', [ProductTypeController::class, 'store'])->name('product-types.store');
    Route::get('/{id}', [ProductTypeController::class, 'show'])->name('product-types.show');
    Route::put('/{id}', [ProductTypeController::class, 'update'])->name('product-types.update');
    Route::delete('/{id}', [ProductTypeController::class, 'destroy'])->name('product-types.destroy');

});

// Routes for Product _Color
Route::prefix('product-colors')->group(function () {
    Route::get('/', [ProductColorController::class, 'index'])->name('product-colors.index');
    Route::post('/', [ProductColorController::class, 'store'])->name('product-colors.store');
    Route::get('/{id}', [ProductColorController::class, 'show'])->name('product-colors.show');
    Route::put('/{id}', [ProductColorController::class, 'update'])->name('product-colors.update');
    Route::delete('/{id}', [ProductColorController::class, 'destroy'])->name('product-colors.destroy');
});

// Routes for Product _Size

Route::prefix('product-sizes')->group(function () {
    Route::apiResource('product-sizes' , ProductSizeController::class);
});

// Routes for ProductImage
Route::prefix('product-images')->group(function () {
    Route::get('/', [ProductImageController::class, 'index'])->name('product-images.index');
    Route::post('/', [ProductImageController::class, 'store'])->name('product-images.store');
    Route::get('/{id}', [ProductImageController::class, 'show'])->name('product-images.show');
    Route::put('/{id}', [ProductImageController::class, 'update'])->name('product-images.update');
    Route::delete('/{id}', [ProductImageController::class, 'destroy'])->name('product-images.destroy');
});


Route::prefix('product-reviews')->group(function () {
    Route::get('/', [ProductReviewController::class, 'index'])->name('product-reviews.index');
    Route::post('/', [ProductReviewController::class, 'store'])->name('product-reviews.store');
    Route::get('/{id}', [ProductReviewController::class, 'show'])->name('product-reviews.show');
    Route::put('/{id}', [ProductReviewController::class, 'update'])->name('product-reviews.update');
    Route::delete('/{id}', [ProductReviewController::class, 'destroy'])->name('product-reviews.destroy');
    Route::post('getReviewsByProductId', [ProductReviewController::class, 'getReviewsByProductId']);
});

// Routes for managing Admin resources
Route::prefix('admins')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admins.index');
    Route::post('/', [AdminController::class, 'store'])->name('admins.store');
    Route::get('/{id}', [AdminController::class, 'show'])->name('admins.show');
    Route::put('/{id}', [AdminController::class, 'update'])->name('admins.update');
    Route::delete('/{id}', [AdminController::class, 'destroy'])->name('admins.destroy');
    Route::post('/register', [AdminController::class, 'register'])->name('admins.register');

});
// Routes for managing Coupons resources
Route::prefix('coupons')->group(function () {
    Route::get('/', [CouponController::class, 'index'])->name('coupons.index');
    Route::post('/', [CouponController::class, 'store'])->name('coupons.store');
    Route::get('/{id}', [CouponController::class, 'show'])->name('coupons.show');
    Route::put('/{id}', [CouponController::class, 'update'])->name('coupons.update');
    Route::delete('/{id}', [CouponController::class, 'destroy'])->name('coupons.destroy');
});

// Routes for managing User resources
Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::post('/', [UserController::class, 'store'])->name('users.store');
    Route::get('/{id}', [UserController::class, 'show'])->name('users.show');
    Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});

// Routes for managing Blog resources
Route::prefix('blogs')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('blogs.index');
    Route::post('/', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('/{id}', [BlogController::class, 'show'])->name('blogs.show');
    Route::put('/{id}', [BlogController::class, 'update'])->name('blogs.update');
    Route::delete('/{id}', [BlogController::class, 'destroy'])->name('blogs.destroy');
});

Route::prefix('carts')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('carts.index');

    Route::get('/{id}', [CartController::class, 'show'])->name('carts.show');
    Route::put('/{id}', [CartController::class, 'update'])->name('carts.update');
    Route::delete('/{id}', [CartController::class, 'destroy'])->name('carts.destroy');
});

// Routes for Order
Route::prefix('orders')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('orders.index');

    Route::get('/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::put('/{id}', [OrderController::class, 'update'])->name('orders.update');
    Route::delete('/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
});

// Routes for OrderItem
Route::prefix('order-items')->group(function () {
    Route::get('/', [OrderItemController::class, 'index'])->name('order-items.index');
    Route::post('/', [OrderItemController::class, 'store'])->name('order-items.store');
    Route::get('/{id}', [OrderItemController::class, 'show'])->name('order-items.show');
    Route::put('/{id}', [OrderItemController::class, 'update'])->name('order-items.update');
    Route::delete('/{id}', [OrderItemController::class, 'destroy'])->name('order-items.destroy');
});
