<?php 

declare(strict_types=1);

use App\Enums\OrderStatus;

return [
    OrderStatus::class => [
      OrderStatus::PENDING => 'chờ xử lý',
      OrderStatus::SHIPPING => 'đang xử lý',
      OrderStatus::SHIPPED => 'đã xử lý'
    ]
];