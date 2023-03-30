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
            'payment_method' => 'required|string|unique:payments|bail',
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
        if ($this->startValidationProcess($request)) {
            $newPayment = new Payment();
            $newPayment->payment_method = $request->payment_method;
            $newPayment->save();
            return redirect()->route('payment.index')->withToastSuccess('Payment Method was created successfully!');
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
        if ($this->startValidationProcess($request)) {
            $payment->update([
                'payment_method' => $request->payment_method,
            ]);
            return redirect()->route('payment.index')->withToastSuccess('Payment Method was updated successfully!');
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
        return redirect()->route('payment.index')->withToastSuccess('Payment Method was deleted successfully!');
    }
}
