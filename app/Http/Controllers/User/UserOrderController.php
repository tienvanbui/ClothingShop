<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserOrderController extends Controller
{
    public function __construct()
    {
        $this->setModel(Order::class);
        $this->getAppMenu();
    }
    public function trackOrder()
    {
        $this->cartDisplayInform(auth()->user()->id);
        $user = auth()->user();
        $detailOrder = DB::table('orders')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->join('order_products', 'order_products.order_id', '=', 'orders.id')
            ->join('products', 'products.id', '=', 'order_products.product_id')
            ->where('orders.user_id', '=', $user->id)
            ->whereNull('orders.deleted_at')
            ->select('orders.status', 'orders.created_at', 'orders.status', 'products.product_name', 'products.product_image', 'order_products.price', 'order_products.buy_quanlity', 'orders.id')
            ->get();
        return view('user.order.order-track')
            ->with('detailOrders', $detailOrder)
            ->with('menus', $this->menus)
            ->with('cart', $this->cartOfUser)
            ->with('totalPrice', $this->totalPriceOfAllProductInCart)
            ->with('countCartProduct', $this->countCartItem);;
    }
    public function processTrackedOrder(Request $request)
    {
        if ($request->ajax()) {
            $order = DB::table('orders')->where('id', '=', $request->order_id)->update([
                'status' => $request->status,
            ]);
            return response()->json([
                'status' => 'success',
                'id' => $request->order_id,
            ]);
        }
    }
}
