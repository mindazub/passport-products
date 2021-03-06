<?php
declare(strict_types = 1);

namespace App\Helpers;


/**
 * Class PriceHelper
 * @package App\Helpers
 */
class PriceHelper
{
    /**
     * @param float $price
     * @param float $discount
     * @return float
     */
    public function discountedPrice(float $price, float $discount = 0): float
    {
        return (float)number_format((($price * (100 - $discount))/100), 2
    );
    }

    public function convertToCents(float $price): int
    {
        return (int)$priceInCents = $price * 100;
    }

    public function convertToCurrency(float $price, string $currency)
    {
        $currencies = ['USD' => 0.987, 'GBP' => 1.012, 'RUB' => 0.05];

        $currencyKey = array_get( $currencies, $currency);

        return $priceNew = $price * $currencyKey;
    }

}
