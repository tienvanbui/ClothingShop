<?php

namespace App\Http\Controllers\User;

use App\Events\checkProductIsEmptyEvent;
use App\Events\orderConfirmedEvent;
use App\Events\sendMailAppectOrderdEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CreatedOrder;
use Carbon\Carbon;

class UserCartController extends Controller
{
    public function __construct()
    {
        $this->setModel(Cart::class);
        $this->getAppMenu();
    }
    public function listProductInCart()
    {
        if (auth()->check()) {
            $this->cartDisplayInform(auth()->user()->id);
        } else {
            $this->cartDisplayInform(null);
        }
        return view('user.carts.list')
            ->with('menus', $this->menus)
            ->with('cart', $this->cartOfUser)
            ->with('totalPrice', $this->totalPriceOfAllProductInCart)
            ->with('countCartProduct', $this->countCartItem);
    }
    private function checkSessionProductExists($productId, $colorId, $sizeId, $cart)
    {
        foreach ($cart as $index =>  $cartItem) {
            if ($cartItem['product_id'] == $productId && $cartItem['color_id'] == $colorId && $cartItem['size_id'] == $sizeId) {
                return $index;
            }
        }
        return -1;
    }
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $notify = checkProductIsEmptyEvent::dispatch($request->product_id, $request->color_id, $request->size_id, $request->buy_quanlity);
            if ($notify["0"] == 1) {
                $response['status'] = 'warning';
                $response['product_name'] = $request->product_name;
                return response($response);
            } else {
                if (auth()->check()) {
                    if ((Cart::where('user_id', auth()->user()->id))->first() == null) {
                        $cart = new Cart();
                        $cart = $cart->fill(['user_id' => auth()->user()->id]);
                        $cart->save();
                    }
                    $cart = Cart::where('user_id', auth()->user()->id)->first();
                    $productStored = $cart->products()->wherePivot('product_id', $request->product_id)
                        ->wherePivot('size_id', $request->size_id)
                        ->wherePivot('color_id', $request->color_id)->first();
                    $response['product_item_in_cart'] = '';
                    $productCount = $cart->products()->count();
                    if (!empty($productStored)) {
                        if ($productStored->pivot->color_id == $request->color_id && $productStored->pivot->size_id == $request->size_id) {
                            $response['product_name'] = $request->product_name;
                            $response['status'] = 'fail';
                            $response['product_in_cart'] =  $productCount;
                            return response($response);
                        }
                    } else {
                        $productNeedCheck = Product::whereId($request->product_id)->first();
                        $priceOfProduct = $productNeedCheck->price;
                        if (strpos($priceOfProduct, ',') !== false) {
                            $priceOfProduct = str_replace(',', '', $priceOfProduct);
                        }
                        $cart->products()->attach(
                            $request->product_id,
                            [
                                'buy_quanlity' => $request->buy_quanlity,
                                'color_id' => $request->color_id,
                                'size_id' => $request->size_id,
                                'total_price' => ((int)$request->buy_quanlity * (int)$priceOfProduct),
                            ]
                        );
                        $response['product_name'] = $request->product_name;
                        $response['status'] = 'success';
                        $response['product_in_cart'] =  $productCount + 1;
                        $response['product_item_in_cart'] .= '
                    <li class="header-cart-item flex-w flex-t m-b-12">
                        <div class="header-cart-item-img">
                            <img src="' . $productNeedCheck->product_image . '" alt="' . $productNeedCheck->product_image_name . '">
                        </div>  
                        <div class="header-cart-item-txt p-t-8">
                            <a href="' . route('shop.show', ['product' => $request->product_id]) . '"
                                class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                ' . $request->product_name . '
                            </a>      
                            <span class="header-cart-item-info">
                                ' . $request->buy_quanlity . ' x
                                ' . number_format(((int)$request->buy_quanlity * (int)$priceOfProduct)) . 'VNĐ' . '
                            </span>
                        </div>  
                     </li>';
                        $response['product_sum_all_product_price'] = $cart->products()->sum('total_price');
                        return response($response);
                    }
                } else {
                    $response['product_item_in_cart'] = '';
                    $productNeedCheck = Product::whereId($request->product_id)->first();
                    $priceOfProduct = $productNeedCheck->price;
                    if (strpos($priceOfProduct, ',') !== false) {
                        $priceOfProduct = str_replace(',', '', $priceOfProduct);
                    }
                    if (!Session::has('cart')) {
                        $user_cart = [];
                        array_push($user_cart, [
                            'buy_quanlity' => $request->buy_quanlity,
                            'product_image' => $productNeedCheck->product_image,
                            'product_image_name' => $productNeedCheck->product_image_name,
                            'product_name' => $productNeedCheck->product_name,
                            'product_id' => $request->product_id,
                            'color_id' => $request->color_id,
                            'size_id' => $request->size_id,
                            'price' => $productNeedCheck->price,
                            'total_price' => ((int)$request->buy_quanlity * (int)$priceOfProduct),
                        ]);
                        Session::put('cart', $user_cart);
                    } else {
                        $checkInCart = $this->checkSessionProductExists($request->product_id, $request->color_id, $request->size_id, Session::get('cart'));
                        $user_cart = Session::get('cart');
                        if ($checkInCart != -1) {
                            $user_cart[$checkInCart]['buy_quanlity'] += 1;
                            $user_cart[$checkInCart]['total_price'] = $user_cart[$checkInCart]['buy_quanlity'] *  $user_cart[$checkInCart]['price'];
                        } else {
                            array_push($user_cart, [
                                'buy_quanlity' => $request->buy_quanlity,
                                'product_image' => $productNeedCheck->product_image,
                                'product_image_name' => $productNeedCheck->product_image_name,
                                'product_name' => $productNeedCheck->product_name,
                                'product_id' => $request->product_id,
                                'color_id' => $request->color_id,
                                'size_id' => $request->size_id,
                                'price' => $productNeedCheck->price,
                                'total_price' => ((int)$request->buy_quanlity * (int)$priceOfProduct),
                            ]);
                        }
                        Session::put('cart', $user_cart);
                    }
                    $response['product_name'] = $request->product_name;
                    $response['status'] = 'success';
                    $response['product_in_cart'] =  count($user_cart) + 1;
                    $response['product_item_in_cart'] .= '<li class="header-cart-item flex-w flex-t m-b-12">
                    <div class="header-cart-item-img">
                        <img src="' . $productNeedCheck->product_image . '" alt="' . $productNeedCheck->product_image_name . '">
                    </div>  
                    <div class="header-cart-item-txt p-t-8">
                        <a href="' . route('shop.show', ['product' => $request->product_id]) . '"
                            class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                            ' . $request->product_name . '
                        </a>      
                        <span class="header-cart-item-info">
                            ' . $request->buy_quanlity . ' x
                            ' . number_format(((int)$request->buy_quanlity * (int)$priceOfProduct)) . 'VNĐ' . '
                        </span>
                    </div>  
                 </li>';
                    $price = 0;
                    foreach (Session::get('cart') as $cartItem) {
                        $price += $cartItem['total_price'];
                    }
                    $response['product_sum_all_product_price'] = $price;
                    return response($response);
                }
            }
        }
    }
    public function deleteFromCart(Request $request)
    {
        if ($request->ajax()) {
            if (auth()->check()) {
                $cartOfUser = Cart::where('user_id', '=', $request->user_id)
                    ->first();
                $cartOfUser->products()->wherePivot('product_id', $request->product_id)->wherePivot('size_id', $request->size_id)->wherePivot('color_id', $request->color_id)->detach();
            } else {
                $user_cart = Session::get('cart');
                $checkInCart = $this->checkSessionProductExists($request->product_id, $request->color_id, $request->size_id, $user_cart);
                if ($checkInCart != -1) {
                    unset($user_cart[$checkInCart]);
                }
                Session::put('cart', array_values($user_cart));
            }
        }
    }
    protected function updateCart(Request $request)
    {
        if ($request->ajax()) {
            if (auth()->check()) {
                $cart = Cart::where('id', $request->cart_id)->first();
                $notify = checkProductIsEmptyEvent::dispatch($request->product_id, $request->color_id, $request->size_id, $request->buy_quanlity);
                if ($notify["0"] == 1) {
                    $response['status'] = 'warning';
                    return response($response);
                }
                $priceOfProduct = (Product::whereId($request->product_id)->first())->price;
                if (strpos($priceOfProduct, ',') !== false) {
                    $priceOfProduct = str_replace(',', '', $priceOfProduct);
                }
                $cart->products()->wherePivot('product_id', $request->product_id)
                    ->wherePivot('size_id', $request->size_id)
                    ->wherePivot('color_id', $request->color_id)->detach();
                $cart->products()->attach(
                    $request->product_id,
                    [
                        'buy_quanlity' => $request->buy_quanlity,
                        'color_id' => $request->color_id,
                        'size_id' => $request->size_id,
                        'total_price' => ((int)$request->buy_quanlity * (int)$priceOfProduct)
                    ]
                );
            }
            if (!auth()->check()) {
                $user_cart = Session::get('cart');
                $checkInCart = $this->checkSessionProductExists($request->product_id, $request->color_id, $request->size_id, $user_cart);
                $priceOfProduct = (Product::whereId($request->product_id)->first())->price;
                if ($checkInCart != -1) {
                    $user_cart[$checkInCart]['buy_quanlity'] = $request->buy_quanlity;
                    $user_cart[$checkInCart]['total_price'] = $request->buy_quanlity * $priceOfProduct;
                }
                Session::put('cart', $user_cart);
            }
            $response['status'] = 'success';
            return response($response);
        }
    }
    protected function confirmPayment(Request $request)
    {
        $this->cartDisplayInform(auth()->user()->id);
        $payments = Payment::all();
        return view('user.payment.create')
            ->with('menus', $this->menus)
            ->with('cart', $this->cartOfUser)
            ->with('totalPrice', $this->totalPriceOfAllProductInCart)
            ->with('countCartProduct', $this->countCartItem)
            ->with('payments', $payments);
    }

    public function applyCouponCodeWithAjax(Request $request)
    {
        if ($request->ajax()) {
            //get coupon code 
            $coupon_code = $request->coupon_code;
            //get coupon object
            $check_coupon_isEmpty = Coupon::where('coupon_code', '=', $coupon_code)->first();
            //if coupon object not empty 
            if($check_coupon_isEmpty->created_at->addDays(7)->toDateString() >= (Carbon::now()->toDateString()) == true){
                if (!empty($check_coupon_isEmpty)) {
                    if($this->checkCouponApplied($request->coupon_code) == true){
                        $response['status'] = 'isset_coupon_code';
                    }
                
                    else{
                    //if coupon code of type is discount by money
                    if ($check_coupon_isEmpty->coupon_condition == 0) {
                        $response['discountPrice'] =
                            $check_coupon_isEmpty->coupon_price_discount;
                        $response['totalAfterDiscount'] = $request->total_price_all_products_in_cart - $response['discountPrice'];
                        if ($check_coupon_isEmpty->coupon_use_number == 0) {
                            $response['status'] = 'full';
                        } else {
                            $check_coupon_isEmpty->coupon_use_number -= 1;
                            $check_coupon_isEmpty->coupon_used_count += 1;
                            $check_coupon_isEmpty->update([
                                'coupon_use_number' => $check_coupon_isEmpty->coupon_use_number,
                                'coupon_used_count' => $check_coupon_isEmpty->coupon_used_count
                            ]);
                            $response['status'] = 'success';
                        }
                    }
                    //if coupon code of type is discount by percent
                    else {
                        $response['discountPrice'] = ceil(
                            ($request->total_price_all_products_in_cart * ($check_coupon_isEmpty->coupon_price_discount)) / 100
                        );
                        $response['totalAfterDiscount'] = $request->total_price_all_products_in_cart -  $response['discountPrice'];
                        if ($check_coupon_isEmpty->coupon_use_number == 0) {
                            $response['status'] = 'full';
                        } else {
                            $check_coupon_isEmpty->coupon_use_number -= 1;
                            $check_coupon_isEmpty->coupon_used_count += 1;
                            $check_coupon_isEmpty->update([
                                'coupon_use_number' => $check_coupon_isEmpty->coupon_use_number,
                                'coupon_used_count' => $check_coupon_isEmpty->coupon_used_count
                            ]);
                            $response['status'] = 'success';
                        }
                    }
                    }
                } else {
                    $response['status'] = 'fail';
                    $response['totalAfterDiscount'] = $request->total_price_all_products_in_cart;
                }
            }
            else{
                $response['status'] = 'time_out';
            }
            
            return response($response);
        }
    }
    public function checkCouponApplied($couponCode){
        $user = auth()->user();
        $orders = $user->orders;
        foreach($orders as $order){
            if($order->apply_coupon_code == $couponCode){
                return true;
            }
        }
        return false;
    }
    protected function proceedToOrder(Request $request)
    {
        if ($request->ajax()) {
            if ((User::whereId($request->user_id)->first())->cart->products()->count() == 0) {
                $response['status'] = 'fail';
            }
            else {
                $newOrder = new Order();
                $newOrder->user_id = $request->user_id;
                $newOrder->payment_id = $request->payment_id;
                $newOrder->total = $request->total;
                $newOrder->order_code = 'ĐH'.rand(100000,99999).'VN';
                $newOrder->address_shipping = $request->addressShipping;
                $newOrder->phoneNumber_shipping = $request->phoneNumberShipping;
                $newOrder->apply_coupon_code = $request->apply_coupon_code;
                $newOrder->save();
                $products = $newOrder->userCart()->products()->get();
                foreach ($products as $product) {
                    $newOrder->products()->attach(
                        $product->id,
                        [
                            'buy_quanlity' => $product->pivot->buy_quanlity,
                            'color_id' => $product->pivot->color_id,
                            'size_id' => $product->pivot->size_id,
                            'price' =>   str_replace(',', '', $product->price)
                        ]
                    );
                }
                $newOrder->userCart()->products()->detach();
                orderConfirmedEvent::dispatch($newOrder);
                // $productsInYourOrder = DB::table('order_products')
                //     ->join('products', 'order_products.product_id', '=', 'products.id')
                //     ->select('order_products.buy_quanlity', 'products.product_name', 'products.product_image', 'products.price')
                //     ->get();
                // sendMailAppectOrderdEvent::dispatch(auth()->user()->name, auth()->user()->email, $productsInYourOrder);
                $admins = User::whereHas('role', function ($query) {
                    $query->where('role_name','admin');
                })->first();
                if(!empty($admins)){
                    Notification::send($admins, new CreatedOrder($newOrder));
                }
                $response['status'] = 'success';
            }
            return response($response);
        }
    }
    public function thankForOrdering()
    {
        $this->cartDisplayInform(auth()->user()->id);
        return view('user.thanks.list')
            ->with('menus', $this->menus)
            ->with('cart', $this->cartOfUser)
            ->with('totalPrice', $this->totalPriceOfAllProductInCart)
            ->with('countCartProduct', $this->countCartItem);
    }
}
