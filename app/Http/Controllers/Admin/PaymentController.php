<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->setModel(Payment::class);
        $this->resourceName = 'payments';
        $this->modelName = 'Payment';
        $this->validateRule = [
            'payment_method' => 'required|max:255|unique:payments|bail',
        ];
        $this->messageValidate = [
            'payment_method.required' => 'Trường này không được để trống',
            'payment_method.max' => 'Tối đa 255 ký tự',
            'payment_method.unique' => 'Giá trị đã tồn tại',
        ];
        $this->views = [
            'index' => 'admin.payment.index',
            'create' => 'admin.payment.create'
        ];
        $this->middleware(['permission:Payment Method_list'], ['only' => ['index']]);
        $this->middleware(['permission:Payment Method_create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:Payment Method_show'], ['only' => ['show']]);
        $this->middleware(['permission:Payment Method_update'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:Payment Method_delete'], ['only' => ['destroy']]);
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
            $newPayment = new Payment();
            $newPayment->payment_method = $request->payment_method;
            $newPayment->save();
            return redirect()->route('payment.index')->withToastSuccess('Tạo thành công!');
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        return view('admin.payment.edit')->with('payment', $payment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        $validator = $request->validate([
            'payment_method' => 'required|max:255|bail',
        ],[
            'payment_method.required' => 'Trường này không được để trống',
            'payment_method.max' => 'Tối đa 255 ký tự',
        ]);
        if ($validator) {
            $payment->update([
                'payment_method' => $request->payment_method,
            ]);
            return redirect()->route('payment.index')->withToastSuccess('Cập nhật thành công!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payment.index')->withToastSuccess('Xóa thành công!');
    }
}
