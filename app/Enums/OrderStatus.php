<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static PENDING()
 * @method static static SHIPPING()
 * @method static static SHIPPED()
 */
final class OrderStatus extends Enum implements LocalizedEnum 
{
    public const PENDING =   0;
    public const SHIPPING =   1;
    public const SHIPPED = 2;
}
