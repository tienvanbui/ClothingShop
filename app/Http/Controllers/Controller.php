<?php

namespace App\Http\Controllers;

use App\Events\Admin\tenLatestItemShowEvent;
use App\Events\CachedListingDisplayedEvent;
use App\Models\Cart;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Models\Category;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $model = '';
    protected $resourceName = '';
    protected $modelName = '';
    protected $views = [];
    protected $menus;
    protected $cartOfUser;
    protected $totalPriceOfAllProductInCart = null;
    protected $countCartItem = 0;
    protected $itemInPerPgae = 5;
    protected $getEventValueName = null;
    protected $messageValidate = null;
    protected function setModel($model)
    {
        $this->model = $model;
    }
    protected function cartDisplayInform($id)
    {
        $this->getCartOfUser($id);
        $this->getSumTotalPriceCartProduct();
        $this->getCountCartProduct();
    }

    protected function getCartOfUser($id)
    {
        $cart = null;
        if (auth()->check()) {
            $cart = Cart::where('user_id', $id)->first();
        } else {
            if (Session::has('cart')) {
                $cart = Session::get('cart');
            }
        }
        return $this->cartOfUser =  $cart;
    }
    /**
     * Caculating the total of all product in cart when authenticated
     */
    protected function getSumTotalPriceCartProduct()
    {
        $totalPrice = 0;
        if (!empty($this->cartOfUser->products)) {
            $totalPrice = $this->cartOfUser->products()->sum('total_price');
        }
        if (!auth()->check()) {
            if (Session::has('cart')) {
                $price = 0;
                foreach (Session::get('cart') as $cartItem) {
                    $price += $cartItem['total_price'];
                }
                $totalPrice = $price;
            } else {
                $totalPrice = 0;
            }
            
        }
        return $this->totalPriceOfAllProductInCart = $totalPrice;
    }
    /**
     * Counting the number of product in cart when authenticated
     */
    protected function getCountCartProduct()
    {
        $count = 0;
        if (!empty($this->cartOfUser->products)) {
            $count = $this->cartOfUser->products()->count();
        }
        if (!auth()->check()) {
            if (Session::has('cart')) {
                $count = count(Session::get('cart'));
            } else {
                $count = 0;
            }
        }

        return $this->countCartItem = $count;
    }
    protected $validateRule = [];
    /**
     * Display a listing
     */
    public function index()
    {
        $list = $this->model::whereNull("$this->resourceName.deleted_at")->latest()->paginate($this->itemInPerPgae);
        return view($this->views['index'])->with(
            $this->resourceName,
            $list
        );
    }
    /**
     * Display a listing when change the show on per page and search 
     * 
     */
    protected function displayListing(Request $request)
    {
        if ($request->ajax()) {
            if (!empty($request->showOnPerPgae) && !empty($request->table)) {
                $list = CachedListingDisplayedEvent::dispatch($request->table, $request->showOnPerPgae, $request->page,  $request->searchKey, $request->collum);
            }
            return view("$request->view", ["$request->table" => $list["0"]]);
        }
    }
    /**
     * Show the form for creating .
     */
    public  function create()
    {
        return view($this->views['create']);
    }
    public function showChangeView($id)
    {
        $data = $this->model::FindOrFail($id);
        return view($this->views['edit'])->with(Str::singular($this->resourceName), $data);
    }
    /**
     * Storing the item  .
     */
    public function store(Request $request)
    {
        if ($this->startValidationProcess($request,$this->messageValidate)) {
            $object = new $this->model();
            $object->fill($request->all());
            $object->save();
            return redirect()->route(str_replace('admin.', '', $this->views['index']))->with('message-success', " $this->modelName Created Successfully!");
        }
    }
    /**
     * Deleting the specifield product item.
     */
    public function delete($id)
    {
        $data = $this->model::FindOrFail($id);
        $data->delete();
        return redirect()->route(str_replace('admin.', '', $this->views['index']))->with('message-success', " $this->modelName Deleted Successfully!");
    }
    /**
     * Validating the input request 
     */
    protected function startValidationProcess($request)
    {
        return  $request->validate($this->validateRule,$this->messageValidate);
    }
    /**
     * showing menu app in the user page
     */
    protected function getAppMenu()
    {
        $menus = Category::all();
        return $this->menus = $menus;
    }
    /**
     * Displaying the listing view  .
     */
    protected function list()
    {
        return view($this->views['list']);
    }
     /**
     * Summary of sendSuccessResponse
     * @param mixed $data
     * @param mixed $message
     * @param mixed $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendSuccessResponse($data, $message = '', $code = 200)
    {
        return response()->json([
            'status_code' => $code,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    /**
     * Summary of sendErrorResponse
     * @param mixed $message
     * @param mixed $errors
     * @param mixed $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendErrorResponse($message, $errors = null, $code = 500)
    {
        return response()->json([
            'status_code' => $code,
            'message' => $message,
            'errors' => $errors,
        ], $code);
    }
}
