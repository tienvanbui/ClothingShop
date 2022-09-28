<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class IsEnoughConditionToCartLisnter
{


    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $productCheck = DB::table('product_color_sizes')
            ->where('product_color_sizes.product_id', '=', $event->productId)
            ->where('product_color_sizes.color_id', '=', $event->colorId)
            ->where('product_color_sizes.size_id', '=', $event->sizeId)->first();
        if ($productCheck->quanlities == 0) {
            $isEmpty = 1;
        } else {
            $isEmpty = 0;
        }
        return $isEmpty;
    }
}
