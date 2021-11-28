<?php

namespace Spatie\TaxCalculator;

use Spatie\TaxCalculator\Results\Calculation;
use Spatie\TaxCalculator\Results\CalculationWithRate;

class TaxCalculation
{
    public static function fromItem(HasTax $item): Calculation
    {
        return new Calculation($item->basePrice(), $item->taxPrice());
    }

    public static function fromItemWithRate(HasTaxWithRate $item): CalculationWithRate
    {
        return new CalculationWithRate($item->basePrice(), $item->taxRate());
    }

    public static function fromBasePrice(float $basePrice, float $taxRate): CalculationWithRate
    {
        return new CalculationWithRate($basePrice, $taxRate);
    }

    public static function fromTaxedPrice(float $taxedPrice, float $taxRate): CalculationWithRate
    {
        return new CalculationWithRate($taxedPrice / (1 + $taxRate), $taxRate);
    }

    public static function fromCollection($items): Calculation
    {
        if ($items instanceof \Traversable) {
            $items = iterator_to_array($items);
        }

        if (! is_array($items)) {
            throw new \InvalidArgumentException('`$items` must be an array or implement `\Traversable`');
        }

        $basePrice = array_reduce($items, function (float $total, HasTax $item): float {
            return $total + $item->basePrice();
        }, 0);

        $taxPrice = array_reduce($items, function (float $total, HasTax $item): float {
            return $total + $item->taxPrice();
        }, 0);

        return new Calculation($basePrice, $taxPrice);
    }
}
