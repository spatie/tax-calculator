<?php

namespace Spatie\TaxCalculator\Results;

use Spatie\TaxCalculator\HasTax;

class CollectionCalculation implements HasTax
{
    /** @var \Spatie\TaxCalculator\HasTax[] */
    protected $items;

    public function __construct(HasTax ...$items)
    {
        $this->items = $items;
    }

    public function add(HasTax $item, int $amount = 1): HasTax
    {
        $items = array_merge($this->items, array_fill(0, $amount, $item));

        return new static(...$items);
    }

    public function basePrice(): float
    {
        return array_reduce($this->items, function (float $total, HasTax $item): float {
            return $total + $item->basePrice();
        }, 0);
    }

    public function taxedPrice(): float
    {
        return array_reduce($this->items, function (float $total, HasTax $item): float {
            return $total + $item->taxedPrice();
        }, 0);
    }

    public function taxPrice(): float
    {
        return array_reduce($this->items, function (float $total, HasTax $item): float {
            return $total + $item->taxPrice();
        }, 0);
    }
}
