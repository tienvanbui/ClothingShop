<?php

namespace App\Providers;

use App\Events\Admin\tenLatestItemShowEvent;
use App\Events\CachedListingDisplayedEvent;
use App\Events\checkProductIsEmptyEvent;
use App\Events\contactMessageSubmit;
use App\Events\orderConfirmedEvent;
use App\Events\sendMailAppectOrderdEvent;
use App\Listeners\Admin\BlogCached;
use App\Listeners\Admin\listBlogCachedListener;
use App\Listeners\displayedListingListener;
use App\Listeners\IsEnoughConditionToCartLisnter;
use App\Listeners\SendContactMessageToAdmin;
use App\Listeners\sendMailToConfirmOrder;
use App\Listeners\updateQuanlitiesProductListner;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        contactMessageSubmit::class => [
            SendContactMessageToAdmin::class,
        ],
        sendMailAppectOrderdEvent::class => [
            sendMailToConfirmOrder::class,
        ],
        tenLatestItemShowEvent::class => [
            listBlogCachedListener::class,
        ],
        //check product number is enough condition to add to cart
        checkProductIsEmptyEvent::class => [
            IsEnoughConditionToCartLisnter::class,
        ],
        // orderConfirmed 
        orderConfirmedEvent::class => [
            updateQuanlitiesProductListner::class,
        ],
        CachedListingDisplayedEvent::class => [
            displayedListingListener::class,
        ],
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            // ... other providers
            \SocialiteProviders\Facebook\FacebookExtendSocialite::class . '@handle',
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
