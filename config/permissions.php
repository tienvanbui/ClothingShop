<?php 

    return [
        'modul'=>[
            'Blog',//Blog::class
            'Banner', //Banner::class
            'Product',
            'Color',
            'Size',
            'User',
            'Order',
            'Payment Method',
            'Category', //Category::class
            'Tag',
            'Slider', //Slider::class
            'Setting', //Setting::class
            'About',
            'Role', //Role::class
            'Coupon',
            // 'Users',
            'Contact',
        ],
        'modul_features' =>[
            'list',// list objects of model
            'create',// create a specified object of model
            'show', // view detail specified object of model
            'update',//update a specified object of model
            'delete',//delete a specified object of model
        ]
        
    ];
?>