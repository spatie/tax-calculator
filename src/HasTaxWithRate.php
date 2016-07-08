<?php

namespace Spatie\TaxCalculator;

interface HasTaxWithRate extends HasTax
{
    public function taxRate(): float;
}
