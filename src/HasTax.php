<?php

namespace Spatie\TaxCalculator;

interface HasTax
{
    public function basePrice(): float;
    public function taxedPrice(): float;
    public function taxPrice(): float;
}
