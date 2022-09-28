<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashBoardController extends Controller
{
    public function list()
    {
        $usersCount = (User::all())->count();
        $orderCount = (Order::where('status', '=', 0)->get())->count();
        $earnings = DB::table('earnings')->sum('earnings');
        $listProductMostViewed = DB::table('products')->where('viewed_number_count', '>', 0)->orderByDesc('viewed_number_count')->take(10)->get();
        $listBlogMostViewed = DB::table('blogs')->where('viewed_number_count', '>', 0)->orderByDesc('viewed_number_count')->take(10)->get();
        $orders = DB::table('orders')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->join('payments', 'payments.id', '=', 'orders.payment_id')
            ->whereNull('orders.deleted_at')
            ->select('payments.payment_method', 'users.username', 'orders.*')
            ->take(10)
            ->get();
        $userOnline = User::all();
        return view('admin.dashboard.dashboard')
            ->with('usersCount', $usersCount)
            ->with('orderCount', $orderCount)
            ->with('earnings', $earnings)
            ->with('listProductMostViewed', $listProductMostViewed)
            ->with('listBlogMostViewed', $listBlogMostViewed)
            ->with('orders', $orders)
            ->with('userOnlines', $userOnline);
    }
    public function statisticEarningsFilterByDate(Request $request)
    {
        if ($request->ajax()) {
            $fromDate = $request->from_date;
            $toDate = $request->to_date;
            $data = DB::table('earnings')->whereBetween('order_date', [$fromDate, $toDate])->orderBy('order_date', 'ASC')->get();
            foreach ($data as  $value) {
                $char_set[] = array(
                    'period' => Carbon::parse($value->order_date)->format('d/m/Y'),
                    'orders' => $value->quanlities_orders,
                    'sales' => $value->earnings,
                    'products_in_orders' => $value->quanlities_products_in_order
                );
            }
            echo $response = json_encode($char_set);
        }
    }
    public function statisticEarningsFilterByOption(Request $request)
    {
        if ($request->ajax()) {
            $option = $request->filTypeOption;
            $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $sub7Days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
            $subMonth = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->toDateString();
            $startOfMonth = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
            $endOfMonth = Carbon::now('Asia/Ho_Chi_Minh')->endOfMonth()->toDateString();
            if ($option == '7Days') {
                $response = DB::table('earnings')->whereBetween('order_date', [$sub7Days, $now])->orderBy('order_date', 'ASC')->get();
            } else if ($option == 'prevMonth') {
                $response = DB::table('earnings')->whereBetween('order_date', [$subMonth, $now])->orderBy('order_date', 'ASC')->get();
            } else if ($option == 'thisMonth') {
                $response = DB::table('earnings')->whereBetween('order_date', [$startOfMonth, $endOfMonth])->orderBy('order_date', 'ASC')->get();
            }
            foreach ($response as  $data) {
                $char_set[] = array(
                    'period' => Carbon::parse($data->order_date)->format('d/m/Y'),
                    'orders' => $data->quanlities_orders,
                    'sales' => $data->earnings,
                    'products_in_orders' => $data->quanlities_products_in_order
                );
            }
            return json_encode($char_set);
        }
    }
    public function defaultStatistic30Days(Request $request)
    {
        if ($request->ajax()) {
            $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $sub30Days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(30)->toDateString();
            $response = DB::table('earnings')->whereBetween('order_date', [$sub30Days, $now])->orderBy('order_date', 'ASC')->get();
            foreach ($response as  $data) {
                $char_set[] = array(
                    'period' => Carbon::parse($data->order_date)->format('d/m/Y'),
                    'orders' => $data->quanlities_orders,
                    'sales' => $data->earnings,
                    'products_in_orders' => $data->quanlities_products_in_order
                );
            }
            return json_encode($char_set);
        }
    }
}
