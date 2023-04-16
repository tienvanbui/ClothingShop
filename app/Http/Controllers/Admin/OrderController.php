<?php

namespace App\Http\Controllers\Admin;

use App\Events\orderConfirmedEvent;
use App\Events\orderRemovedEvent;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->setModel(Order::class);
        $this->resourceName = 'orders';
        $this->modelName = 'Order';
        $this->middleware(['permission:Order_list'], ['only' => ['index']]);
        $this->middleware(['permission:Order_create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:Order_show'], ['only' => ['show']]);
        $this->middleware(['permission:Order_update'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:Order_delete'], ['only' => ['destroy']]);
    }

    public function orderCheck()
    {
        $orders = Order::latest()->paginate($this->itemInPerPgae);
        return view('admin.order.list')
            ->with('orders', $orders);
    }
    public function orderShow(Order $order)
    {
        return view('admin.order.show', ['order' => $order]);
    }
    public function orderConfirm(Order $order)
    {
        if ($order->status == 0) {
            $order->update([
                'status' => 1
            ]);
            $order->load('products');
            // orderConfirmedEvent::dispatch($order);
            return redirect()->route('admin.order-check')->withToastSuccess('Đơn hàng đang vận chuyển');
        }
        return redirect()->route('admin.order-check')->withToastError('Đơn hàng đang chuyển!');
    }
    // public function orderDelete(Order $order)
    // {
    //     if ($order->status == 2) {
    //         DB::table('orders')
    //             ->join('order_products', 'orders.id', '=', 'order_products.order_id')
    //             ->where('order_products.product_id', '=', $order->id)
    //             ->delete();
    //         $order->delete();
    //         return redirect()->route('admin.order-check')->withToastSuccess('Order Was Removed Successfully! ');
    //     }
    // }
}
