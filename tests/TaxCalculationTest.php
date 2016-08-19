<?php

namespace Spatie\TaxCalculator\Test;

use InvalidArgumentException;
use PHPUnit_Framework_TestCase;
use Spatie\TaxCalculator\HasTax;
use Spatie\TaxCalculator\HasTaxWithRate;
use Spatie\TaxCalculator\Results\CalculationWithRate;
use Spatie\TaxCalculator\TaxCalculation;

class TaxCalculationTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    function it_can_create_a_calculation_from_a_base_price()
    {
        $calculation = TaxCalculation::fromBasePrice(10.00, 0.21);

        $this->assertInstanceOf(HasTaxWithRate::class, $calculation);
        $this->assertEquals(10.00, $calculation->basePrice());
        $this->assertEquals(0.21, $calculation->taxRate());
        $this->assertEquals(2.10, $calculation->taxPrice());
        $this->assertEquals(12.10, $calculation->taxedPrice());
    }

    /** @test */
    function it_can_create_a_calculation_from_a_taxed_price()
    {
        $calculation = TaxCalculation::fromTaxedPrice(12.10, 0.21);

        $this->assertInstanceOf(HasTaxWithRate::class, $calculation);
        $this->assertEquals(10.00, $calculation->basePrice());
        $this->assertEquals(0.21, $calculation->taxRate());
        $this->assertEquals(2.10, $calculation->taxPrice());
        $this->assertEquals(12.10, $calculation->taxedPrice());
    }

    /** @test */
    function it_can_create_a_calculation_from_a_collection_of_items_with_tax()
    {
        $calculation = TaxCalculation::fromCollection([
            new CalculationWithRate(10.00, 0.21),
            new CalculationWithRate(20.00, 0.06)
        ]);

        $this->assertInstanceOf(HasTax::class, $calculation);
        $this->assertEquals(30.00, $calculation->basePrice());
        $this->assertEquals(3.30, $calculation->taxPrice());
        $this->assertEquals(33.30, $calculation->taxedPrice());
    }

    /** @test */
    function it_only_accepts_arrays_and_traversables_for_collection_calculations()
    {
        $this->expectException(InvalidArgumentException::class);

        TaxCalculation::fromCollection('foo');
    }
}
