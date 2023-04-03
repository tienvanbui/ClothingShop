<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Menu;
use App\Observers\MenuObserver;
use App\Models\About;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Color;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Tag;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Menu::observe(MenuObserver::class);
        view()->composer('admin.*', function ($view) {
            $product_count = Product::all()->count();
            $blog_count = Blog::all()->count();
            $banner_count = Banner::all()->count();
            $slider_count = Slider::all()->count();
            $tag_count = Tag::all()->count();
            $coupon_count = Coupon::all()->count();
            $about_count = About::all()->count();
            $color_count = Color::all()->count();
            $category_count = Category::all()->count();
            $view->with('product_count',$product_count)->with('blog_count',$blog_count)->with('banner_count',$banner_count)->with('tag_count',$tag_count)->with('slider_count',$slider_count)->with('coupon_count',$coupon_count)->with('about_count',$about_count)->with('color_count',$color_count)->with('category_count',$category_count);
        });
    
    }
}
