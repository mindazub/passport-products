<?php
declare(strict_types = 1);

namespace App\Facades;


use App\Helpers\PriceHelper;
use Illuminate\Support\Facades\Facade;
use phpDocumentor\Reflection\Types\Static_;

/**
 * Class PriceConvert
 * @method static float discountedPrice(float $price, float  $discount = 0)
 * @package App\Facades
 */
class PriceConvert extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        //sitam kintamajam bind helperi padarysim
        //
        return 'price.convert';
    }
}
