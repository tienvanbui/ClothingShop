<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Color;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;
use App\Models\Product;

class ClientProductController extends Controller
{

    public function __construct()
    {
        $this->setModel(Product::class);
        $this->resourceName = 'products';
        $this->modelName = 'Product';
        $this->getAppMenu();
    }
    /**
     *  Display a listing of the product with paginate.
     *
     * @return \Illuminate\Http\Response
     */
    public function listProduct()
    {
        if (auth()->check()) {
            $this->cartDisplayInform(auth()->user()->id);
        }
        $colors = Color::all();
        return view('user.product.index', [
            'colors' => $colors,
            'menus' => $this->menus,
            'cart' => $this->cartOfUser,
            'totalPrice' => $this->totalPriceOfAllProductInCart,
            'countCartProduct' => $this->countCartItem
        ]);
    }
    /**
     * Display detail  of the specified product.
     */
    public function showDetail(Product $product)
    {
        $product->increment("viewed_number_count");
        if (auth()->check()) {
            $this->cartDisplayInform(auth()->user()->id);
        }
        $productComments = $product->comments()->paginate($this->itemInPerPgae);
        $relatedToProducts = Product::where('category_id', $product->category_id)->whereNotIn('id', [$product->id])->latest()->take(10)->get();
        return view(
            'user.product.detail',
            [
                'productImgs' => $product->productImages,
                'relatedToProducts' => $relatedToProducts,
                'menus' => $this->menus,
                'product' => $product,
                'cart' => $this->cartOfUser,
                'totalPrice' => $this->totalPriceOfAllProductInCart,
                'countCartProduct' => $this->countCartItem,
                'productComments' => $productComments
            ]
        );
    }
    /**
     * Display a listing of the product by category.
     **/
    public function showProductByCategory($id)
    {
        if (auth()->check()) {
            $this->cartDisplayInform(auth()->user()->id);
        }
        $colors = Color::all();
        $category_id = (Category::where('id', $id)->first())->id;
        $products = Product::where('category_id', $category_id)->latest()->paginate(config('appConst.appConst.ITEM_IN_PER_PAGE'));
        return view('user.product.index', [
            'colors' => $colors,
            'products' => $products,
            'menus' => $this->menus,
            'cart' => $this->cartOfUser,
            'category_id' => $category_id,
            'totalPrice' => $this->totalPriceOfAllProductInCart,
            'countCartProduct' => $this->countCartItem
        ]);
    }
    /**
     * Display a listing of the product with paginate.
     **/
    public function loadMoreProduct(Request $request)
    {
        if ($request->ajax()) {
            if ($request->id > 0) {
                if (!empty($request->category_name)) {
                    $data = DB::table('products')
                        ->join('categories', "categories.id", "=", "products.category_id")
                        ->select("products.*")
                        ->where('categories.name', "=",  Str::ucfirst($request->category_name))
                        ->where('products.id', '<', $request->id)
                        ->orderBy('products.id', 'DESC')
                        ->limit(config('appConst.appConst.ITEM_IN_PER_PAGE'))
                        ->get();
                } else {
                    $data = DB::table('products')
                        ->where('id', '<', $request->id)
                        ->orderBy('id', 'DESC')
                        ->limit(config('appConst.appConst.ITEM_IN_PER_PAGE'))
                        ->get();
                }
            } else {
                if (!empty($request->category_name)) {
                    $data = DB::table('products')
                        ->join('categories', "categories.id", "=", "products.category_id")
                        ->select("products.*")
                        ->where('categories.name', "=", Str::ucfirst($request->category_name))
                        ->orderBy('products.id', 'DESC')
                        ->limit(config('appConst.appConst.ITEM_IN_PER_PAGE'))
                        ->get();
                } else {
                    $data = DB::table('products')
                        ->orderBy('id', 'DESC')
                        ->limit(config('appConst.appConst.ITEM_IN_PER_PAGE'))
                        ->get();
                }
            }
            $output = "";
            $lastId = "";
            if (!$data->isEmpty()) {
                foreach ($data as $row) {
                    $output .= '<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                    <div class="block2">
                        <div class="block2-pic hov-img0">
                            <img src="' . asset($row->product_image) . '" alt="' . $row->product_image_name . '">
                            <form method="POST">
                            ' . csrf_field() . '
                            <button
                                class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1 qickView-product" data-product_id="' . $row->id . '">
                                Xem nhanh
                            </button>
                            </form>
                        </div>
                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l ">
                                <a href="' . route('shop.show', ['product' => $row->id]) . '"
                                    class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                    ' . $row->product_name . '
                                </a>

                                <span class="stext-105 cl3">
                                    ' .  number_format($row->price) .'VNĐ'. '
                                </span>
                            </div>
                                <button type="button" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                        <img class="icon-heart1 dis-block trans-04"
                                            src="' . asset('/images/user/icons/icon-heart-01.png') . '" alt="ICON">
                                        <img class="icon-heart2 dis-block trans-04 ab-t-l"
                                            src="' . asset('/images/user/icons/icon-heart-02.png') . '" alt="ICON">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>';
                    $lastId = $row->id;
                }
                $output .= '<div class="flex-c-m flex-w w-full p-t-45">
                    <button class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04 loadMoreButton-product_user" data-id="' . $lastId . '">
                        Xem nhiều hơn
                    </button>
                </div>';
            } else {
                $output .= ' 
                <div class="flex-c-m flex-w w-full">
                    <button class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                        Không có dữ liệu
                    </button>
                </div>';
            }
            echo $output;
        }
    }
    /**
     * Qick View the secipied the product
     **/
    public function qickViewSpecifiedProduct(Request $request)
    {
        if ($request->ajax()) {
            $product_id = $request->id;
            $product = Product::find($product_id);
            $output['product_id'] = $product->id;
            $output['product_name'] = $product->product_name;
            $output['product_price'] =  $product->price;
            $output['product_image'] = $product->product_image;
            $output['product_image_name'] = $product->product_image_name;
            $output['seo_product'] = $product->seo_product;
            $output['colors'] = '<option>Chọn màu sắc</option>';
            $output['sizes'] = '<option>Chọn kích thước</option>';
            foreach ($product->colors as $color) {
                $output['colors'] .= "<option value=" . $color->id . ">" . $color->color_name . "</option>";
            }
            foreach ($product->sizes as $size) {
                $output['sizes'] .= "<option value=" . $size->id . ">" . $size->size_name . "</option>";
            }
            return response($output);
        }
    }
    protected function filterCondition(Request $request)
    {
        //if not type in the search text field 
        if (empty($request->search_keyword)) {
            //if not view product with category 
            if (empty($request->category_name)) {
                if (empty($request->color) && empty($request->price) && empty($request->sort_by)) {
                    $products = DB::table('products')
                        ->latest()
                        ->paginate(config('appConst.appConst.ITEM_IN_PER_PAGE'));
                }
                if (!empty($request->price) && !empty($request->color) && !empty($request->sort_by)) {
                    $minPrice = explode('-', $request->price)[1];
                    $maxPrice = explode('-', $request->price)[3];
                    $sort_type = $request->sort_by;
                    $color_filter = $request->color;
                    if ($sort_type == 'price-low-to-high') {
                        $products = DB::table('products')
                            ->join('color_products', 'products.id', '=', 'color_products.product_id')
                            ->join('colors', 'color_products.color_id', '=', 'colors.id')
                            ->whereBetween('price', [$minPrice, $maxPrice])
                            ->where('color_name', '=', $color_filter)
                            ->orderBy('price', 'ASC')
                            ->paginate(config('appConst.appConst.ITEM_IN_PER_PAGE'));
                    }
                    if ($sort_type == 'price-high-to-low') {
                        $products = DB::table('products')
                            ->join('color_products', 'products.id', '=', 'color_products.product_id')
                            ->join('colors', 'color_products.color_id', '=', 'colors.id')
                            ->whereBetween('price', [$minPrice, $maxPrice])
                            ->where('color_name', '=', $color_filter)
                            ->orderByDesc('price')
                            ->paginate(config('appConst.appConst.ITEM_IN_PER_PAGE'));
                    }
                }
                if (!empty($request->price)) {
                    $minPrice = explode('-', $request->price)[1];
                    $maxPrice = explode('-', $request->price)[3];
                    $products = DB::table('products')
                        ->whereBetween('price', [$minPrice, $maxPrice])
                        ->limit(config('appConst.appConst.ITEM_IN_PER_PAGE'))
                        ->paginate(config('appConst.appConst.ITEM_IN_PER_PAGE'));
                }
                if (!empty($request->color)) {
                    $color_filter = $request->color;
                    $products = DB::table('products')
                        ->join('color_products', 'products.id', '=', 'color_products.product_id')
                        ->join('colors', 'color_products.color_id', '=', 'colors.id')
                        ->select('products.*')
                        ->where('color_name', '=', $color_filter)
                        ->paginate(config('appConst.appConst.ITEM_IN_PER_PAGE'));
                }
                if (!empty($request->sort_by)) {
                    $sort_type = $request->sort_by;
                    if ($sort_type == 'price-low-to-high') {
                        $products = DB::table('products')
                            ->orderBy('price', 'ASC')
                            ->paginate(config('appConst.appConst.ITEM_IN_PER_PAGE'));
                    }
                    if ($sort_type == 'price-high-to-low') {
                        $products = DB::table('products')
                            ->orderByDesc('price')
                            ->paginate(config('appConst.appConst.ITEM_IN_PER_PAGE'));
                    }
                }
                if (empty($request->sort_by) && !empty($request->price) && !empty($request->color)) {
                    $minPrice = explode('-', $request->price)[1];
                    $maxPrice = explode('-', $request->price)[3];
                    $color_filter = $request->color;
                    $products = DB::table('products')
                        ->join('color_products', 'products.id', '=', 'color_products.product_id')
                        ->join('colors', 'color_products.color_id', '=', 'colors.id')
                        ->select('products.*')
                        ->whereBetween('price', [$minPrice, $maxPrice])
                        ->where('color_name', '=', $color_filter)
                        ->paginate(config('appConst.appConst.ITEM_IN_PER_PAGE'));
                }
                if (!empty($request->sort_by) && empty($request->price) && !empty($request->color)) {
                    $sort_type = $request->sort_by;
                    $color_filter = $request->color;
                    if ($sort_type == 'price-low-to-high') {
                        $products = DB::table('products')
                            ->join('color_products', 'products.id', '=', 'color_products.product_id')
                            ->join('colors', 'color_products.color_id', '=', 'colors.id')
                            ->select('products.*')
                            ->where('color_name', '=', $color_filter)
                            ->orderBy('price', 'ASC')
                            ->paginate(config('appConst.appConst.ITEM_IN_PER_PAGE'));
                    }
                    if ($sort_type == 'price-high-to-low') {
                        $products = DB::table('products')
                            ->join('color_products', 'products.id', '=', 'color_products.product_id')
                            ->select('products.*')
                            ->join('colors', 'color_products.color_id', '=', 'colors.id')
                            ->where('color_name', '=', $color_filter)
                            ->orderByDesc('price')
                            ->paginate(config('appConst.appConst.ITEM_IN_PER_PAGE'));
                    }
                }
                if (!empty($request->sort_by) && !empty($request->price) && empty($request->color)) {
                    $sort_type = $request->sort_by;
                    $minPrice = explode('-', $request->price)[1];
                    $maxPrice = explode('-', $request->price)[3];
                    if ($sort_type == 'price-low-to-high') {
                        $products = DB::table('products')
                            ->whereBetween('price', [$minPrice, $maxPrice])
                            ->orderBy('price', 'ASC')
                            ->paginate(config('appConst.appConst.ITEM_IN_PER_PAGE'));
                    }
                    if ($sort_type == 'price-high-to-low') {
                        $products = DB::table('products')
                            ->whereBetween('price', [$minPrice, $maxPrice])
                            ->orderBy('price', 'DESC')
                            ->paginate(config('appConst.appConst.ITEM_IN_PER_PAGE'));
                    }
                }
            }
            //this code to describe the case when user not type text in the search field but user or client want to view list of products by category
            else {
                if (empty($request->color) && empty($request->price) && empty($request->sort_by)) {
                    $products = DB::table('products')
                        ->join('categories', 'categories.id', "=", 'products.category_id')
                        ->where('categories.name', "=", Str::ucfirst($request->category_name))
                        ->paginate(config('appConst.appConst.ITEM_IN_PER_PAGE'));
                }
                if (!empty($request->price) && !empty($request->color) && !empty($request->sort_by)) {
                    $minPrice = explode('-', $request->price)[1];
                    $maxPrice = explode('-', $request->price)[3];
                    $sort_type = $request->sort_by;
                    $color_filter = $request->color;
                    if ($sort_type == 'price-low-to-high') {
                        $products = DB::table('products')
                            ->join('color_products', 'products.id', '=', 'color_products.product_id')
                            ->join('colors', 'color_products.color_id', '=', 'colors.id')
                            ->join('categories', 'categories.id', "=", 'products.category_id')
                            ->where('categories.name', "=", Str::ucfirst($request->category_name))
                            ->whereBetween('price', [$minPrice, $maxPrice])
                            ->where('color_name', '=', $color_filter)
                            ->orderBy('price', 'ASC')
                            ->paginate(config('appConst.appConst.ITEM_IN_PER_PAGE'));
                    }
                    if ($sort_type == 'price-high-to-low') {
                        $products = DB::table('products')
                            ->join('color_products', 'products.id', '=', 'color_products.product_id')
                            ->join('colors', 'color_products.color_id', '=', 'colors.id')
                            ->join('categories', 'categories.id', "=", 'products.category_id')
                            ->where('categories.name', "=", Str::ucfirst($request->category_name))
                            ->whereBetween('price', [$minPrice, $maxPrice])
                            ->where('color_name', '=', $color_filter)
                            ->orderByDesc('price')
                            ->paginate(config('appConst.appConst.ITEM_IN_PER_PAGE'));
                    }
                }
                if (!empty($request->price)) {
                    $minPrice = explode('-', $request->price)[1];
                    $maxPrice = explode('-', $request->price)[3];
                    $products = DB::table('products')
                        ->join('categories', 'categories.id', "=", 'products.category_id')
                        ->where('categories.name', "=", Str::ucfirst($request->category_name))
                        ->whereBetween('price', [$minPrice, $maxPrice])
                        ->limit(config('appConst.appConst.ITEM_IN_PER_PAGE'))
                        ->paginate(config('appConst.appConst.ITEM_IN_PER_PAGE'));
                }
                if (!empty($request->color)) {
                    $color_filter = $request->color;
                    $products = DB::table('products')
                        ->join('color_products', 'products.id', '=', 'color_products.product_id')
                        ->join('colors', 'color_products.color_id', '=', 'colors.id')
                        ->join('categories', 'categories.id', "=", 'products.category_id')
                        ->select('products.*')
                        ->where('color_name', '=', $color_filter)
                        ->where('categories.name', "=", Str::ucfirst($request->category_name))
                        ->paginate(config('appConst.appConst.ITEM_IN_PER_PAGE'));
                }
                if (!empty($request->sort_by)) {
                    $sort_type = $request->sort_by;
                    if ($sort_type == 'price-low-to-high') {
                        $products = DB::table('products')
                            ->join('categories', 'categories.id', "=", 'products.category_id')
                            ->where('categories.name', "=", Str::ucfirst($request->category_name))
                            ->orderBy('price', 'ASC')
                            ->paginate(config('appConst.appConst.ITEM_IN_PER_PAGE'));
                    }
                    if ($sort_type == 'price-high-to-low') {
                        $products = DB::table('products')
                            ->join('categories', 'categories.id', "=", 'products.category_id')
                            ->where('categories.name', "=", Str::ucfirst($request->category_name))
                            ->orderByDesc('price')
                            ->paginate(config('appConst.appConst.ITEM_IN_PER_PAGE'));
                    }
                }
                if (empty($request->sort_by) && !empty($request->price) && !empty($request->color)) {
                    $minPrice = explode('-', $request->price)[1];
                    $maxPrice = explode('-', $request->price)[3];
                    $color_filter = $request->color;
                    $products = DB::table('products')
                        ->join('color_products', 'products.id', '=', 'color_products.product_id')
                        ->join('colors', 'color_products.color_id', '=', 'colors.id')
                        ->join('categories', 'categories.id', "=", 'products.category_id')
                        ->select('products.*')
                        ->whereBetween('price', [$minPrice, $maxPrice])
                        ->where('color_name', '=', $color_filter)
                        ->where('categories.name', "=", Str::ucfirst($request->category_name))
                        ->paginate(config('appConst.appConst.ITEM_IN_PER_PAGE'));
                }
                if (!empty($request->sort_by) && empty($request->price) && !empty($request->color)) {
                    $sort_type = $request->sort_by;
                    $color_filter = $request->color;
                    if ($sort_type == 'price-low-to-high') {
                        $products = DB::table('products')
                            ->join('color_products', 'products.id', '=', 'color_products.product_id')
                            ->join('colors', 'color_products.color_id', '=', 'colors.id')
                            ->join('categories', 'categories.id', "=", 'products.category_id')
                            ->select('products.*')
                            ->where('color_name', '=', $color_filter)
                            ->where('categories.name', "=", Str::ucfirst($request->category_name))
                            ->orderBy('price', 'ASC')
                            ->paginate(config('appConst.appConst.ITEM_IN_PER_PAGE'));
                    }
                    if ($sort_type == 'price-high-to-low') {
                        $products = DB::table('products')
                            ->join('color_products', 'products.id', '=', 'color_products.product_id')
                            ->join('colors', 'color_products.color_id', '=', 'colors.id')
                            ->join('categories', 'categories.id', "=", 'products.category_id')
                            ->select('products.*')
                            ->where('color_name', '=', $color_filter)
                            ->where('categories.name', "=", Str::ucfirst($request->category_name))
                            ->orderByDesc('price')
                            ->paginate(config('appConst.appConst.ITEM_IN_PER_PAGE'));
                    }
                }
                if (!empty($request->sort_by) && !empty($request->price) && empty($request->color)) {
                    $sort_type = $request->sort_by;
                    $minPrice = explode('-', $request->price)[1];
                    $maxPrice = explode('-', $request->price)[3];
                    if ($sort_type == 'price-low-to-high') {
                        $products = DB::table('products')
                            ->join('categories', 'categories.id', "=", 'products.category_id')
                            ->where('categories.name', "=", Str::ucfirst($request->category_name))
                            ->whereBetween('price', [$minPrice, $maxPrice])
                            ->orderBy('price', 'ASC')
                            ->paginate(config('appConst.appConst.ITEM_IN_PER_PAGE'));
                    }
                    if ($sort_type == 'price-high-to-low') {
                        $products = DB::table('products')
                            ->join('categories', 'categories.id', "=", 'products.category_id')
                            ->where('categories.name', "=", Str::ucfirst($request->category_name))
                            ->whereBetween('price', [$minPrice, $maxPrice])
                            ->orderBy('price', 'DESC')
                            ->paginate(config('appConst.appConst.ITEM_IN_PER_PAGE'));
                    }
                }
            }
        }
        return $products;
    }
    /**
     * Filter  product by condition
     **/
    public function showProductByFilter(Request $request)
    {
        if ($request->ajax()) {
            $products = $this->filterCondition($request);
            return view('user.product.filter-list_products', ['products' => $products]);
        }
    }
    /**
     * Display a filter listing of the product with paginate.
     **/
    public function loadMoreWhenFilter(Request $request)
    {
        if ($request->ajax()) {
            if (!empty($request->search_keyword) && empty($request->color) && empty($request->price) && empty($request->sort_by) && !empty($request->category_name)) {
                $products = DB::table('products')
                    ->join('categories', 'categories.id', "=", "products.category_id")
                    ->where('categories.name', '=', Str::ucfirst($request->category_name))
                    ->where('product_name', 'LIKE', '%' . $request->search_keyword . '%')
                    ->paginate(config('appConst.appConst.ITEM_IN_PER_PAGE'));
            } else if (!empty($request->search_keyword) && empty($request->color) && empty($request->price) && empty($request->sort_by) && empty($request->category_name)) {
                $products = DB::table('products')
                    ->where('product_name', 'LIKE', '%' . $request->search_keyword . '%')
                    ->paginate(config('appConst.appConst.ITEM_IN_PER_PAGE'));
            } else {
                $products = $this->filterCondition($request);
            }
            return view('user.product.filter-list_products', ['products' => $products]);
        }
    }
    /**
     * Display a  listing of the product when typing the search input.
     **/
    public function searchingProduct(Request $request)
    {
        if ($request->ajax()) {
            if (empty($request->category_name)) {
                if (empty($request->search_keyword)) {
                    $products = DB::table('products')
                        ->latest()
                        ->paginate(config('appConst.appConst.ITEM_IN_PER_PAGE'));
                } else {
                    $products = DB::table('products')
                        ->where('products.product_name', 'LIKE', '%' . $request->search_keyword . '%')
                        ->paginate(config('appConst.appConst.ITEM_IN_PER_PAGE'));
                }
            } else {
                if ($request->search_keyword == null) {
                    $products = DB::table('products')
                        ->join('categories', 'categories.id', "=", "products.category_id")
                        ->where('categories.name', '=', Str::ucfirst($request->category_name))
                        ->orderBy('products.id', 'DESC')
                        ->paginate(config('appConst.appConst.ITEM_IN_PER_PAGE'));
                } else {
                    $products = DB::table('products')
                        ->join('categories', 'categories.id', "=", "products.category_id")
                        ->where('categories.name', '=', Str::ucfirst($request->category_name))
                        ->where('products.product_name', 'LIKE', '%' . $request->search_keyword . '%')
                        ->orderBy('products.id', 'DESC')
                        ->paginate(config('appConst.appConst.ITEM_IN_PER_PAGE'));
                }
            }
            return view('user.product.filter-list_products', ['products' => $products]);
        }
    }
    /**
     * Rating for the specifield product
     **/
    public function ratingProduct(Request $request)
    {
        if ($request->ajax()) {
            $product = Product::find($request->product_id);
            $comment = new Comment();
            $comment->user_id = $request->user_id;
            $comment->comment_content = $request->review;
            $comment->rated = $request->rated_num;
            $product->comments()->save($comment);
            $user = $comment->user;
            $showStar = '';
            for ($i = 1; $i <= 5; $i++) {
                if ($i <= $comment->rated) {
                    $showStar .= ' <i class="zmdi zmdi-star"></i>';
                } else {
                    $showStar .= '<i class="zmdi zmdi-star-outline"></i>';
                }
            }
            $output = '';
            $output .= '
            <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                <img src="' . asset($user->avatar) . '" alt="AVATAR">
            </div>
            <div class="size-207 mb-5">
                <div class="flex-w flex-sb-m p-b-17">
                    <span class="mtext-107 cl2 p-r-20">
                        ' . $user->name . '
                    </span>

                    <span class="fs-18 cl11">
                        ' . $showStar . '
                    </span>
                </div>

                <p class="stext-102 cl6">
                ' . $comment->comment_content . '
                </p>
            </div>';
            return response($output);
        }
    }
    /**
     * Display a listing of the comments for the specifield product 
     **/
    public function loadMoreRatingProduct(Request $request)
    {
        if ($request->ajax()) {
            if ($request->id > 0) {
                $data = DB::table('comments')
                    ->where('id', '<', $request->id)
                    ->where('commentable_type', '=', Product::class)
                    ->where('commentable_id', '=', $request->product_id)
                    ->orderBy('id', 'DESC')
                    ->limit(1)
                    ->get();
            } else {
                $data = DB::table('comments')
                    ->where('commentable_type', '=', Product::class)
                    ->where('commentable_id', '=', $request->product_id)
                    ->orderBy('id', 'DESC')
                    ->limit(1)
                    ->get();
            }
            $output = '';
            $lastId = '';
            if (!$data->isEmpty()) {
                foreach ($data as $row) {
                    $user = DB::table('users')->whereId($row->user_id)->first();
                    $showStar = '';
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $row->rated) {
                            $showStar .= ' <i class="zmdi zmdi-star"></i>';
                        } else {
                            $showStar .= '<i class="zmdi zmdi-star-outline"></i>';
                        }
                    }
                    $output .= '
                    <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                    <img src="' . asset($user->avatar) . '" alt="AVATAR">
                </div>
                <div class="size-207 mb-5">
                    <div class="flex-w flex-sb-m p-b-17">
                        <span class="mtext-107 cl2 p-r-20">
                            ' . $user->name . '
                        </span>
    
                        <span class="fs-18 cl11">
                            ' . $showStar . '
                        </span>
                    </div>
    
                    <p class="stext-102 cl6">
                    ' . $row->comment_content . '
                    </p>
                </div>';
                    $lastId = $row->id;
                }
                $output .= '
            <div class="text-center" style="width: 100%">
                <button class="buton-product_comment_loadmore stext-101 size-125  bor2 hov-btn3 mt-5" data-id ="' . $lastId . '">
                    + Xem nhiều đánh giá hơn
                </button>
            </div>';
            } else {
                $output .= '
            <div class="text-center" style="width: 100%">
                <button class=" stext-101 size-125  bor2 hov-btn3 mt-5 ">
                    Không có dữ liệu
                </button>
            </div>';
            }
            return response($output);
        }
    }
}
