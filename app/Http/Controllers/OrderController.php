<?php


namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Trait\Response;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    use Response;

    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        $orders = $this->orderService->getAllOrders();
        return $this->success(OrderResource::collection($orders), 'Orders retrieved successfully', 200);
    }

    public function store(OrderRequest $request)
    {
            $order = $this->orderService->createOrder($request->validated());
            return $this->success(new OrderResource($order), 'Order created successfully', 201);
    }

    public function show($id)
    {
        try {
            $order = $this->orderService->getOrderById($id);
            return $this->success(new OrderResource($order), 'Order retrieved successfully', 200);
        } catch (\Exception $e) {
            return $this->failed(null, 'Order not found', 404);
        }
    }

    public function update(OrderRequest $request, $id)
    {
        try {
            $order = $this->orderService->updateOrder($id, $request->validated());
            return $this->success(new OrderResource($order), 'Order updated successfully', 200);
        } catch (\Exception $e) {
            return $this->failed(null, 'Order update failed', 400);
        }
    }

    public function destroy($id)
    {
        try {
            $this->orderService->deleteOrder($id);
            return $this->success(null, 'Order deleted successfully', 200);
        } catch (\Exception $e) {
            return $this->failed(null, 'Order deletion failed', 400);
        }
    }
}

