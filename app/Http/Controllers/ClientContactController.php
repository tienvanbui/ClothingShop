<?php

namespace App\Http\Controllers;

use App\Events\contactMessageSubmit;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;

class ClientContactController extends Controller
{

    public function __construct()
    {
        $this->setModel(Cart::class);
        $this->getAppMenu();
    }
    public function index()
    {
        if (auth()->check()) {
            $this->cartDisplayInform(auth()->user()->id);
        }
        $settings = Contact::latest()->first();
        $toMail = (DB::table('users')->join('roles', 'users.role_id', '=', 'roles.id')
            ->where('role_name', 'Admin')
            ->orWhere('role_name', 'admin')
            ->first())->email;
        return view('user.contact.index', [
            'menus' => $this->menus,
            'contact' => $settings,
            'cart' => $this->cartOfUser,
            'totalPrice' => $this->totalPriceOfAllProductInCart,
            'countCartProduct' => $this->countCartItem,
            'adminMail' => $toMail,
        ]);
    }
    public function sendMailContact(Request $request)
    {
        $message = $request->msg;
        $fromEmail = $request->email;
        $toMail = (DB::table('users')->join('roles', 'users.role_id', '=', 'roles.id')
            ->where('role_name', 'Admin')
            ->orWhere('role_name', 'admin')
            ->first())->email;
        // //fire event send message contact to admin 
        contactMessageSubmit::dispatch($message, $fromEmail, $toMail);
        return redirect()->route('contact-user')->with('message-success', 'Gửi câu hỏi thành công!');
    }
}
