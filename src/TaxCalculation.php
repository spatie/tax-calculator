<?php

namespace Spatie\TaxCalculator;

use Spatie\TaxCalculator\Results\CollectionCalculation;
use Spatie\TaxCalculator\Results\ItemCalculation;

class TaxCalculation
{
    public static function create(): HasTax
    {
        return new CollectionCalculation();
    }

    public static function fromBasePrice(float $basePrice, float $taxRate): HasTaxWithRate
    {
        return new ItemCalculation($basePrice, $taxRate);
    }

    public static function fromTaxedPrice(float $taxedPrice, float $taxRate): HasTaxWithRate
    {
        return new ItemCalculation($taxedPrice / (1 + $taxRate), $taxRate);
    }

    public static function fromCollection($items): HasTax
    {
        if ($items instanceof \Traversable) {
            $items = iterator_to_array($items);
        }

        if (!is_array($items)) {
            throw new \InvalidArgumentException('`$items` must be an array or implement `\Traversable`');
        }

        return new CollectionCalculation(...$items);
    }
}
