<?php

namespace Spatie\TaxCalculator\Test\Results;

use PHPUnit_Framework_TestCase;
use Spatie\TaxCalculator\Results\CollectionCalculation;
use Spatie\TaxCalculator\Results\ItemCalculation;

class CollectionCalculationTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    function it_can_calculate_the_base_price()
    {
        $taxedItemCollection = new CollectionCalculation(
            new ItemCalculation(10.00, 0.21),
            new ItemCalculation(20.00, 0.06)
        );

        $this->assertEquals(30.00, $taxedItemCollection->basePrice());
    }

    /** @test */
    function it_can_calculate_the_tax_price()
    {
        $taxedItemCollection = new CollectionCalculation(
            new ItemCalculation(10.00, 0.21),
            new ItemCalculation(20.00, 0.06)
        );

        $this->assertEquals(3.30, $taxedItemCollection->taxPrice());
    }

    /** @test */
    function it_can_calculate_the_taxed_price()
    {
        $taxedItemCollection = new CollectionCalculation(
            new ItemCalculation(10.00, 0.21),
            new ItemCalculation(20.00, 0.06)
        );

        $this->assertEquals(33.30, $taxedItemCollection->taxedPrice());
    }

    function it_can_calculate_a_price_after_recieving_extra_items()
    {
        $taxedItemCollection = new CollectionCalculation(new ItemCalculation(10.00, 0.21));
        $taxedItemCollection = $taxedItemCollection->add(new ItemCalculation(20.00, 0.06));

        $this->assertEquals(33.30, $taxedItemCollection->taxedPrice());
    }
}
