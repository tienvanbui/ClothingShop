<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Color;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->setModel(Blog::class);
        $this->getAppMenu();
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->check()) {
            $this->cartDisplayInform(auth()->user()->id);
        }
        $colors = Color::all();
        $sliders = Slider::latest()->take(3)->get();
        $banners = Banner::latest()->take(3)->get();
        return view('home', [
            'colors' => $colors,
            'sliders' => $sliders,
            'banners' => $banners,
            'menus' => $this->menus,
            'cart' => $this->cartOfUser,
            'totalPrice' => $this->totalPriceOfAllProductInCart,
            'countCartProduct' => $this->countCartItem
        ]);
    }
    public function qickViewSpecifiedProduct(Request $request)
    {
        if ($request->ajax()) {
            $product = Product::find($request->id);
            $output['product_id'] = $product->id;
            $output['product_name'] = $product->product_name;
            $output['product_price'] = '$' . $product->price;
            $output['product_image'] = $product->product_image;
            $output['product_image_name'] = $product->product_image_name;
            $output['seo_product'] = $product->seo_product;
            $output['colors'] = '<option>Choose an option</option>';
            $output['sizes'] = '<option>Choose an option</option>';
            foreach ($product->colors as $color) {
                $output['colors'] .= "<option value=" . $color->id . ">" . $color->color_name . "</option>";
            }
            foreach ($product->sizes as $size) {
                $output['sizes'] .= "<option value=" . $size->id . ">" . $size->size_name . "</option>";
            }
            return response($output);
        }
    }
}
