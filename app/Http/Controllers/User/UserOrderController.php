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
        $detailOrder = Order::latest()->paginate(10);
        return view('user.order.order-track')
            ->with('detailOrders', $detailOrder)
            ->with('menus', $this->menus)
            ->with('cart', $this->cartOfUser)
            ->with('totalPrice', $this->totalPriceOfAllProductInCart)
            ->with('countCartProduct', $this->countCartItem);
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
