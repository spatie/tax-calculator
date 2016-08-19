<?php

namespace Spatie\TaxCalculator\Results;

use Spatie\TaxCalculator\HasTax;

class Calculation implements HasTax
{
    /** @var float */
    protected $basePrice;

    /** @var float */
    protected $taxPrice;

    public function __construct(float $basePrice, float $taxPrice)
    {
        $this->basePrice = $basePrice;
        $this->taxPrice = $taxPrice;
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
        return $this->basePrice + $this->taxPrice;
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

    public function add(float $basePrice, float $taxPrice)
    {
        $calculation = clone $this;

        $calculation->basePrice = $this->basePrice + $basePrice;
        $calculation->taxPrice = $this->taxPrice + $taxPrice;

        return $calculation;
    }

    public function subtract(float $basePrice, float $taxPrice)
    {
        $calculation = clone $this;

        $calculation->basePrice = $this->basePrice - $basePrice;
        $calculation->taxPrice = $this->taxPrice - $taxPrice;

        return $calculation;
    }
}
