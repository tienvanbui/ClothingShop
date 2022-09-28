<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class displayedListingListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $table = $event->table;
        $showPerPage = $event->showPerPage;
        $searchKey = $event->searchKey;
        $collum = $event->collum;
        if (empty($searchKey) &&  $table != "products" && $table != 'orders') {
            $list =  DB::table("$table")->whereNull("$table.deleted_at")->latest()->paginate($showPerPage);
        } else if ($table == "products") {
            if (empty($searchKey)) {
                $list =  DB::table("$table")
                    ->join('categories', 'categories.id', '=', "$table.category_id")
                    ->whereNull("$table.deleted_at")
                    ->select('categories.name', "$table.*")
                    ->latest("$table.created_at")
                    ->paginate($showPerPage);
            } else {
                $list = DB::table("$table")
                    ->join('categories', 'categories.id', '=', "$table.category_id")
                    ->where("$table.$collum", 'LIKE', '%' . $searchKey . '%')
                    ->whereNull("$table.deleted_at")
                    ->select("$table.*", "categories.name")
                    ->latest("$table.created_at")
                    ->paginate($showPerPage);
            }
        } else if ($table == "orders") {
            if (empty($searchKey)) {
                $list =  DB::table("$table")
                    ->join('users', 'users.id', '=', "$table.user_id")
                    ->join('payments', 'payments.id', '=', "$table.payment_id")
                    ->whereNull("$table.deleted_at")
                    ->select('users.name', "$table.*", 'payments.payment_method')
                    ->latest("$table.created_at")
                    ->paginate($showPerPage);
            } else {
                $list = DB::table("$table")
                    ->join('users', 'users.id', '=', "$table.user_id")
                    ->join('payments', 'payments.id', '=', "$table.payment_id")
                    ->where("users.name", 'LIKE', '%' . $searchKey . '%')
                    ->whereNull("$table.deleted_at")
                    ->select('users.name', "$table.*", 'payments.payment_method')
                    ->latest("$table.created_at")
                    ->paginate($showPerPage);
            }
        } else {
            $list = DB::table("$table")->where("$table.$collum", 'LIKE', '%' . $searchKey . '%')->whereNull("$table.deleted_at")->latest()->paginate($showPerPage);
        }
        return  $list;
    }
}
