<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Tên đăng nhập không được bỏ trống',
            'password.required' => 'Mật khẩu không được bỏ trống',
        ]);
    }
    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {

        $nameRoleOfUser = $user->role->role_name;
        if ($nameRoleOfUser == 'User') {
            if (Session::has('cart')) {
                $sessionCart = Session::get('cart');
                $cart = Cart::firstOrCreate([
                    'user_id' => auth()->user()->id
                ]);
                foreach ($sessionCart as $item) {
                    $product = $cart->products()
                        ->wherePivot('product_id', $item['product_id'])
                        ->wherePivot('color_id', $item['color_id'])
                        ->wherePivot('size_id', $item['size_id'])
                        ->first();
                    if (empty($product)) {
                        $cart->products()->attach(
                            $item['product_id'],
                            [
                                'buy_quanlity' => $item['buy_quanlity'],
                                'total_price' => $item['total_price'],
                                'color_id' => $item['color_id'],
                                'size_id' => $item['size_id']
                            ]
                        );
                    } else {
                        $cart->products()
                            ->wherePivot('product_id', $item['product_id'])
                            ->wherePivot('color_id', $item['color_id'])
                            ->wherePivot('size_id', $item['size_id'])
                            ->update([
                                'buy_quanlity' => $product->pivot->buy_quanlity + $item['buy_quanlity'],
                                'total_price' => $item['total_price'],
                                'color_id' => $item['color_id'],
                                'size_id' => $item['size_id']
                            ]);
                    }
                }
                Session::forget('cart');
            }
            return redirect('/home');
        } else if ($nameRoleOfUser == 'Admin') {
            return redirect('/admin/dashboard');
        } else {
            return redirect('/admin/dashboard');
        }
    }
    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        $users = User::all();;
        foreach ($users as  $user) {
            if (Cache::has('user-is-online-' . $user->id)) {
                Cache::forget('user-is-online-' . $user->id);
            }
        }
        return redirect()->route('home-user');
    }
    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function adminLoginForm()
    {
        return view('auth.login');
    }
}
