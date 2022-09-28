<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Cart;

class AboutController extends Controller
{
    public function __construct()
    {
        $this->setModel(About::class);
        $this->getAppMenu();
    }
    public function index()
    {
        if (auth()->check()) {
            $this->cartDisplayInform(auth()->user()->id);
        }
        $abouts = About::all();
        return view('user.about.index', [
            'menus' => $this->menus,
            'abouts' => $abouts,
            'cart' => $this->cartOfUser,
            'totalPrice' => $this->totalPriceOfAllProductInCart,
            'countCartProduct' => $this->countCartItem
        ]);
    }
}
