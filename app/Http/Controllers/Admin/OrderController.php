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
            orderConfirmedEvent::dispatch($order);
            return redirect()->route('admin.order-check')->withToastSuccess('Order Was Shipping ');
        }
        return redirect()->route('admin.order-check')->withToastError('Order Was Shipping!Could Not Change The Status Of Order');
    }
    public function orderDelete(Order $order)
    {
        if ($order->status == 2) {
            DB::table('orders')
                ->join('order_products', 'orders.id', '=', 'order_products.order_id')
                ->where('order_products.product_id', '=', $order->id)
                ->delete();
            $order->delete();
            return redirect()->route('admin.order-check')->withToastSuccess('Order Was Removed Successfully! ');
        }
    }
}
