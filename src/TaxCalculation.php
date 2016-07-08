<?php

namespace Spatie\TaxCalculator;

use Spatie\TaxCalculator\Results\CollectionCalculation;
use Spatie\TaxCalculator\Results\ItemCalculation;

class TaxCalculation
{
    public static function fromBasePrice(float $basePrice, float $taxRate): HasTax
    {
        return new ItemCalculation($basePrice, $taxRate);
    }

    public static function fromTaxedPrice(float $taxedPrice, float $taxRate): HasTax
    {
        return new ItemCalculation($taxedPrice / (1 + $taxRate), $taxRate);
    }

    public static function fromCollection($items): HasTax
    {
        if ($items instanceof \Traversable) {
            $items = iterator_to_array($items);
        }

        return new CollectionCalculation(...$items);
    }
}
