<?php

namespace Spatie\TaxCalculator\Results;

use Spatie\TaxCalculator\HasTax;

class CollectionCalculation implements HasTax
{
    /** @var float */
    protected $basePrice;

    /** @var float */
    protected $taxPrice;

    public function __construct(HasTax ...$items)
    {
        $this->basePrice = array_reduce($items, function (float $total, HasTax $item): float {
            return $total + $item->basePrice();
        }, 0);

        $this->taxPrice = array_reduce($items, function (float $total, HasTax $item): float {
            return $total + $item->taxPrice();
        }, 0);
    }

    public function basePrice(): float
    {
        return $this->basePrice;
    }

    public function taxPrice(): float
    {
        return $this->taxPrice;
    }

    public function taxedPrice(): float
    {
        return $this->basePrice() + $this->taxPrice();
    }

    public function addItem(HasTax $item, int $amount = 1): HasTax
    {
        $calculation = clone $this;

        $calculation->basePrice += $item->basePrice() * $amount;
        $calculation->taxPrice += $item->taxPrice() * $amount;

        return $calculation;
    }

    public function multiply(float $factor)
    {
        $calculation = clone $this;

        $calculation->basePrice = $this->basePrice * $factor;
        $calculation->taxPrice = $this->taxPrice * $factor;

        return $calculation;
    }

    public function divide(float $dividor)
    {
        $calculation = clone $this;

        $calculation->basePrice = $this->basePrice / $dividor;
        $calculation->taxPrice = $this->taxPrice / $dividor;

        return $calculation;
    }

    public function add(float $amount)
    {
        $calculation = clone $this;

        $calculation->basePrice = $this->basePrice + $amount;
        $calculation->taxPrice = $this->taxPrice + $amount;

        return $calculation;
    }

    public function subtract(float $amount)
    {
        $calculation = clone $this;

        $calculation->basePrice = $this->basePrice - $amount;
        $calculation->taxPrice = $this->taxPrice - $amount;

        return $calculation;
    }
}
