<?php

namespace Spatie\TaxCalculator\Test\Results;

use PHPUnit_Framework_TestCase;
use Spatie\TaxCalculator\Results\Calculation;
use Spatie\TaxCalculator\Results\CalculationWithRate;

class CalculationTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    function items_can_be_added_to_an_existing_instance()
    {
        $taxedItemCalculation = new Calculation(10.00, 2.10);
        $taxedItemCalculation = $taxedItemCalculation->addItem(new CalculationWithRate(20.00, 0.06));

        $this->assertEquals(33.30, $taxedItemCalculation->taxedPrice());
    }

    /** @test */
    function items_can_be_added_to_an_existing_instance_with_an_amount()
    {
        $taxedItemCalculation = new Calculation(10.00, 2.10);
        $taxedItemCalculation = $taxedItemCalculation->addItem(new CalculationWithRate(20.00, 0.06), 2);

        $this->assertEquals(54.5, $taxedItemCalculation->taxedPrice());
    }
}
