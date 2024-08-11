<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponRequest;
use App\Http\Resources\CouponResource;
use App\Services\CouponService;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    protected $couponService;

    public function __construct(CouponService $couponService)
    {
        $this->couponService = $couponService;
    }

    public function index()
    {

        $coupons = $this->couponService->getAllCoupons();
        return CouponResource::collection($coupons);
    }

    public function store(CouponRequest $request)
    {

        $coupon = $this->couponService->createCoupon($request);
        return new CouponResource($coupon);
    }

    public function show($id)
    {
        $coupon = $this->couponService->getCouponById($id);
        return new CouponResource($coupon);
    }

    public function update(CouponRequest $request, $id)
    {
        $coupon = $this->couponService->updateCoupon($id, $request);
        return new CouponResource($coupon);
    }

    public function destroy($id)
    {
        $this->couponService->deleteCoupon($id);
        return response()->noContent();
    }
}
