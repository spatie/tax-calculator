<?php

namespace Spatie\TaxCalculator\Test\Results;

use PHPUnit_Framework_TestCase;
use Spatie\TaxCalculator\Results\CalculationWithRate;

class CalculationWithRateTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    function it_can_get_the_base_price()
    {
        $taxedItem = new CalculationWithRate(10.00, 0.00);

        $this->assertEquals(10.00, $taxedItem->basePrice());
    }

    /** @test */
    function it_can_get_the_tax_rate()
    {
        $taxedItem = new CalculationWithRate(10.00, 0.21);

        $this->assertEquals(0.21, $taxedItem->taxRate());
    }

    /** @test */
    function it_can_calculate_the_tax_price()
    {
        $taxedItem = new CalculationWithRate(10.00, 0.21);

        $this->assertEquals(2.10, $taxedItem->taxPrice());
    }

    /** @test */
    function it_can_calculate_the_taxed_price()
    {
        $taxedItem = new CalculationWithRate(10.00, 0.21);

        $this->assertEquals(12.10, $taxedItem->taxedPrice());
    }
}
