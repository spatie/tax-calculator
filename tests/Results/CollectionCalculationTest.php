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

    /** @test */
    function items_can_be_added_to_an_existing_instance()
    {
        $taxedItemCollection = new CollectionCalculation(new ItemCalculation(10.00, 0.21));
        $taxedItemCollection = $taxedItemCollection->addItem(new ItemCalculation(20.00, 0.06));

        $this->assertEquals(33.30, $taxedItemCollection->taxedPrice());
    }

    /** @test */
    function items_can_be_added_to_an_existing_instance_with_an_amount()
    {
        $taxedItemCollection = new CollectionCalculation(new ItemCalculation(10.00, 0.21));
        $taxedItemCollection = $taxedItemCollection->addItem(new ItemCalculation(20.00, 0.06), 2);

        $this->assertEquals(54.5, $taxedItemCollection->taxedPrice());
    }
}
