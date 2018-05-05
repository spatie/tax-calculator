<?php

namespace Spatie\TaxCalculator\Test\Results;

use PHPUnit\Framework\TestCase;
use Spatie\TaxCalculator\Results\Calculation;
use Spatie\TaxCalculator\Results\CalculationWithRate;

class CalculationTest extends TestCase
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

    /** @test */
    function it_can_get_multiply_price()
    {
        $taxedItemCalculation = new Calculation(10.00, 2.10);

        $this->assertEquals(20.00, $taxedItemCalculation->multiply(2)->basePrice());
    }

    /** @test */
    function it_can_get_divide_price()
    {
        $taxedItemCalculation = new Calculation(10.00, 2.10);

        $this->assertEquals(5.00, $taxedItemCalculation->divide(2)->basePrice());
    }

    /** @test */
    function it_can_get_add_price()
    {
        $taxedItemCalculation = new Calculation(10.00, 2.10);

        $this->assertEquals(12.00, $taxedItemCalculation->add(2, 0.0)->basePrice());
    }

    /** @test */
    function it_can_get_subtract_price()
    {
        $taxedItemCalculation = new Calculation(10.00, 2.10);

        $this->assertEquals(8.00, $taxedItemCalculation->subtract(2, 0.0)->basePrice());
    }
}
