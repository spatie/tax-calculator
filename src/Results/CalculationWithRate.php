<?php

namespace Spatie\TaxCalculator\Results;

use Spatie\TaxCalculator\HasTaxWithRate;
use Spatie\TaxCalculator\Traits\HasTaxWithRate as HasTaxWithRateTrait;

class CalculationWithRate implements HasTaxWithRate
{
    use HasTaxWithRateTrait;

    public function __construct(protected float $basePrice, protected float $taxRate)
    {
    }

    public function basePrice(): float
    {
        return $this->basePrice;
    }

    public function taxRate(): float
    {
        return $this->taxRate;
    }

    public function multiply(float $factor): static
    {
        return new static($this->basePrice * $factor, $this->taxRate);
    }

    public function divide(float $dividor): static
    {
        return new static($this->basePrice / $dividor, $this->taxRate);
    }

    public function add(float $amount): static
    {
        return new static($this->basePrice + $amount, $this->taxRate);
    }

    public function subtract(float $amount): static
    {
        return new static($this->basePrice - $amount, $this->taxRate);
    }
}
