<?php

namespace Spatie\TaxCalculator\Results;

use Spatie\TaxCalculator\HasTaxWithRate;
use Spatie\TaxCalculator\Traits\HasTaxWithRate as HasTaxWithRateTrait;

class ItemCalculation implements HasTaxWithRate
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
}
