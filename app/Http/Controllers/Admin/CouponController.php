<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->setModel(Coupon::class);
        $this->resourceName = 'coupons';
        $this->modelName = 'Coupon';
        $this->views = [
            'index' => 'admin.coupon.index',
            'create' => 'admin.coupon.create',
        ];
        $this->validateRule = [
            'coupon_code' => 'required|unique:coupons|max:10|min:4|bail',
            'coupon_condition' => 'required',
            'coupon_use_number' => 'required',
            'coupon_price_discount' => 'required',
        ];
        $this->messageValidate = [
            'coupon_code.required' => "Trường này không được để trống",
            'coupon_code.unique' => "Giá trị đã tồn tại",
            'coupon_code.max' => "Trường này tối đa 10 ký tự",
            'coupon_code.min' => "Trường này tối thiểu 4 ký tự",
            'coupon_condition.required' => "Trường này không được để trống",
            'coupon_use_number.required' => "Trường này không được để trống",
            'coupon_price_discount.required' => "Trường này không được để trống",
        ];
        $this->middleware(['permission:Coupon_list'], ['only' => ['index']]);
        $this->middleware(['permission:Coupon_create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:Coupon_show'], ['only' => ['show']]);
        $this->middleware(['permission:Coupon_update'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:Coupon_delete'], ['only' => ['destroy']]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->startValidationProcess($request,$this->messageValidate)) {
            $coupon = new Coupon();
            $coupon->coupon_code =  $request->coupon_code;
            $coupon->coupon_condition = $request->coupon_condition;
            $coupon->coupon_use_number = $request->coupon_use_number;
            $coupon->coupon_price_discount = $request->coupon_price_discount;
            $coupon->save();
            return redirect()->route('coupon.index')->withToastSuccess('Tạo thành công!');
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        return view('admin.coupon.edit')->with('coupon', $coupon);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        $validator = $request->validate([
            'coupon_code' => 'required|max:10|min:4|bail',
            'coupon_condition' => 'required',
            'coupon_use_number' => 'required',
            'coupon_price_discount' => 'required',
        ],[
            'coupon_code.required' => "Trường này không được để trống",
            'coupon_code.max' => "Trường này tối đa 10 ký tự",
            'coupon_code.min' => "Trường này tối thiểu 4 ký tự",
            'coupon_condition.required' => "Trường này không được để trống",
            'coupon_use_number.required' => "Trường này không được để trống",
            'coupon_price_discount.required' => "Trường này không được để trống",
        ]);
        if ($validator) {
            $couponUpdate = Coupon::findOrFail($coupon->id);
            $couponUpdate->coupon_code =  $request->coupon_code;
            $couponUpdate->coupon_condition = $request->coupon_condition;
            $couponUpdate->coupon_use_number = $request->coupon_use_number;
            $couponUpdate->coupon_price_discount = $request->coupon_price_discount;
            $coupon->save();
            return redirect()->route('coupon.index')->withToastSuccess('Cập nhật thành công!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('coupon.index')->withToastSuccess('Xóa thành công!');
    }
}
