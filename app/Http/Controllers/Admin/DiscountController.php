<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function __construct()
    {
        $this->setModel(Discount::class);
        $this->resourceName = 'discounts';
        $this->modelName = 'Discount';
        $this->views = [
            'index' => 'admin.discount.index',
            'create' => 'admin.discount.create',
        ];
        $this->validateRule = [
            'discount_percent' => 'required|numeric|bail',
            'discount_event_name' => 'nullable|string|bail',
            'description_discount_event' => 'nullable|string|bail',
            'start_date_event' => 'required|date_format:Y-m-d H:i:s',
            'end_date_event' => 'required|date_format:Y-m-d H:i:s',
        ];
        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->startValidationProcess($request)) {
            $discount = new Discount();
            $discount->discount_type =  $request->discount_type;
            $discount->discount_event_name =  $request->discount_event_name;
            $discount->description_discount_event = $request->description_discount_event;
            $discount->start_date_event = $request->start_date_event;
            $discount->end_date_event = $request->end_date_event;
            $discount->active = $request->active;
            $discount->save();
            $arrayProductWillSales = (Product::all())->pluck('id');
            $discount->products()->attach($arrayProductWillSales);
            return redirect()->route('discount.index')->withToastSuccess('Tạo sự kiện giảm giá thành công!');
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function edit(Discount $discount)
    {
        return view('admin.discount.edit')->with('discount', $discount);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discount $discount)
    {
        if ($this->startValidationProcess($request)) {
            $discountUpdate = Discount::findOrFail($discount->id);
            $discountUpdate->coupon_code =  $request->coupon_code;
            $discountUpdate->coupon_condition = $request->coupon_condition;
            $discountUpdate->coupon_use_number = $request->coupon_use_number;
            $discountUpdate->coupon_price_discount = $request->coupon_price_discount;
            $discount->active = $request->active;
            $discount->save();
            return redirect()->route('coupon.index')->withToastSuccess('Cập nhật sự kiện giảm giá thành công!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Discount  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount)
    {
        $discount->products()->detach();
        $discount->delete();
        return redirect()->route('coupon.index')->withToastSuccess('Xóa sự kiện giảm giá thành công!');
    }
}
