<?php

namespace Spatie\TaxCalculator\Traits;

trait HasTaxWithRate
{
    public function taxPrice(): float
    {
        return $this->basePrice() * $this->taxRate();
    }

    public function taxedPrice(): float
    {
        return $this->basePrice() + $this->taxPrice();
    }
}
