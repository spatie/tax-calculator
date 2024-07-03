<?php

namespace Spatie\TaxCalculator\Test;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Spatie\TaxCalculator\HasTax;
use Spatie\TaxCalculator\HasTaxWithRate;
use Spatie\TaxCalculator\Results\Calculation;
use Spatie\TaxCalculator\Results\CalculationWithRate;
use Spatie\TaxCalculator\TaxCalculation;

class TaxCalculationTest extends TestCase
{
    /** @test */
    public function it_can_create_a_calculation_from_a_base_price(): void
    {
        $calculation = TaxCalculation::fromBasePrice(10.00, 0.21);

        $this->assertInstanceOf(HasTaxWithRate::class, $calculation);
        $this->assertSame(10.00, $calculation->basePrice());
        $this->assertSame(0.21, $calculation->taxRate());
        $this->assertSame(2.10, $calculation->taxPrice());
        $this->assertSame(12.10, $calculation->taxedPrice());
    }

    /** @test */
    public function it_can_create_a_calculation_from_item(): void
    {
        $calculation = TaxCalculation::fromItem(new Calculation(10.1, 21.1));

        $this->assertInstanceOf(HasTax::class, $calculation);
        $this->assertSame(10.1, $calculation->basePrice());
        $this->assertSame(21.1, $calculation->taxPrice());
        $this->assertSame(31.20, $calculation->taxedPrice());
    }

    /** @test */
    public function it_can_create_a_calculation_from_item_with_rate(): void
    {
        $calculation = TaxCalculation::fromItemWithRate(new CalculationWithRate(10.1, 21.1));

        $this->assertInstanceOf(HasTaxWithRate::class, $calculation);
        $this->assertSame(10.1, $calculation->basePrice());
        $this->assertSame(21.1, $calculation->taxRate());
        $this->assertSame(213.11, $calculation->taxPrice());
        $this->assertSame(223.21, $calculation->taxedPrice());
    }

    /** @test */
    public function it_can_create_a_calculation_from_collection_with_traversable(): void
    {
        $calculation = TaxCalculation::fromCollection(new \ArrayIterator([
            new CalculationWithRate(10.00, 0.21),
            new CalculationWithRate(20.00, 0.06),
        ]));

        $this->assertInstanceOf(Calculation::class, $calculation);
        $this->assertSame(30.0, $calculation->basePrice());
        $this->assertSame(3.3, $calculation->taxPrice());
        $this->assertSame(33.3, $calculation->taxedPrice());
    }

    /** @test */
    public function it_can_create_a_calculation_from_a_taxed_price(): void
    {
        $calculation = TaxCalculation::fromTaxedPrice(12.10, 0.21);

        $this->assertInstanceOf(HasTaxWithRate::class, $calculation);
        $this->assertSame(10.00, $calculation->basePrice());
        $this->assertSame(0.21, $calculation->taxRate());
        $this->assertSame(2.10, $calculation->taxPrice());
        $this->assertSame(12.10, $calculation->taxedPrice());
    }

    /** @test */
    public function it_can_create_a_calculation_from_a_collection_of_items_with_tax(): void
    {
        $calculation = TaxCalculation::fromCollection([
            new CalculationWithRate(10.00, 0.21),
            new CalculationWithRate(20.00, 0.06),
        ]);

        $this->assertInstanceOf(HasTax::class, $calculation);
        $this->assertSame(30.00, $calculation->basePrice());
        $this->assertSame(3.30, $calculation->taxPrice());
        $this->assertSame(33.30, $calculation->taxedPrice());
    }

    /** @test */
    public function it_only_accepts_arrays_and_traversables_for_collection_calculations(): void
    {
        $this->expectException(InvalidArgumentException::class);

        TaxCalculation::fromCollection('foo');
    }
}
