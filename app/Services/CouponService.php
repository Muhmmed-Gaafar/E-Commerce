<?php

namespace App\Services;

use App\Models\Coupon;

class CouponService
{
    public function getAllCoupons()
    {
        return Coupon::all();
    }

    public function createCoupon( $request)
    {
        $data = $request->validated();
        $code = $data['code'];
        return Coupon::updateOrCreate([
            'code' => $code
        ],$data);

    }

    public function getCouponById($id)
    {
        return Coupon::where('id', $id)->first();
    }

    public function updateCoupon($id, $request)
    {
        $data = $request->validated();
        $coupon = Coupon::where('id', $id)->first();
        $code = $data['code'];
        return Coupon::updateOrCreate([
            'code' => $code
        ],$data);
    }

    public function deleteCoupon($id)
    {
        $coupon = Coupon::where('id', $id)->first();
        $coupon->delete();
    }
}

