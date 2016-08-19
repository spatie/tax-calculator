<?php

namespace Spatie\TaxCalculator\Results;

use Spatie\TaxCalculator\HasTaxWithRate;
use Spatie\TaxCalculator\Traits\HasTaxWithRate as HasTaxWithRateTrait;

class CalculationWithRate implements HasTaxWithRate
{
    use HasTaxWithRateTrait;

    /** @var float */
    protected $basePrice;

    /** @var float */
    protected $taxRate;

    public function __construct(float $basePrice, float $taxRate)
    {
        $this->basePrice = $basePrice;
        $this->taxRate = $taxRate;
    }

    public function basePrice(): float
    {
        return $this->basePrice;
    }

    public function taxRate(): float
    {
        return $this->taxRate;
    }

    public function multiply(float $factor)
    {
        return new static($this->basePrice * $factor, $this->taxRate);
    }

    public function divide(float $dividor)
    {
        return new static($this->basePrice / $dividor, $this->taxRate);
    }

    public function add(float $amount)
    {
        return new static($this->basePrice + $amount, $this->taxRate);
    }

    public function subtract(float $amount)
    {
        return new static($this->basePrice - $amount, $this->taxRate);
    }
}
