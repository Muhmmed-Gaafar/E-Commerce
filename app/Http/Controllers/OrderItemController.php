<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderItemRequest;
use App\Http\Resources\OrderItemResource;
use App\Services\OrderItemService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Trait\Response;

class OrderItemController extends Controller
{
    use Response;

    protected $orderItemService;

    public function __construct(OrderItemService $orderItemService)
    {
        $this->orderItemService = $orderItemService;
    }

    public function index()
    {
        $orderItems = $this->orderItemService->getAllOrderItems();
        return $this->success(OrderItemResource::collection($orderItems), 'Order items retrieved successfully', 200);
    }

    public function store(OrderItemRequest $request)
    {
            $orderItem = $this->orderItemService->createOrderItem($request->validated());
            return $this->success(new OrderItemResource($orderItem), 'Order item created successfully', 201);

    }

    public function show($id)
    {
        try {
            $orderItem = $this->orderItemService->getOrderItemById($id);
            return $this->success(new OrderItemResource($orderItem), 'Order item retrieved successfully', 200);
        } catch (\Exception $e) {
            return $this->failed(null, 'Order item not found', 404);
        }
    }

    public function update(OrderItemRequest $request, $id)
    {
        try {
            $orderItem = $this->orderItemService->updateOrderItem($id, $request->validated());
            return $this->success(new OrderItemResource($orderItem), 'Order item updated successfully', 200);
        } catch (\Exception $e) {
            return $this->failed(null, 'Order item update failed', 400);
        }
    }

    public function destroy($id)
    {
        try {
            $this->orderItemService->deleteOrderItem($id);
            return $this->success(null, 'Order item deleted successfully', 200);
        } catch (\Exception $e) {
            return $this->failed(null, 'Order item deletion failed', 400);
        }
    }
}

