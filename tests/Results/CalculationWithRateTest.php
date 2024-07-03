<?php

namespace Spatie\TaxCalculator\Test\Results;

use PHPUnit\Framework\TestCase;
use Spatie\TaxCalculator\Results\CalculationWithRate;

class CalculationWithRateTest extends TestCase
{
    /** @test */
    public function it_can_get_the_base_price(): void
    {
        $taxedItem = new CalculationWithRate(10.00, 0.00);

        $this->assertEquals(10.00, $taxedItem->basePrice());
    }

    /** @test */
    public function it_can_get_the_multiply_price(): void
    {
        $taxedItem = new CalculationWithRate(10.00, 0.00);

        $this->assertEquals(20.00, $taxedItem->multiply(2)->basePrice());
    }

    /** @test */
    public function it_can_get_the_divide_price(): void
    {
        $taxedItem = new CalculationWithRate(10.00, 0.00);

        $this->assertEquals(5.00, $taxedItem->divide(2)->basePrice());
    }

    /** @test */
    public function it_can_get_the_add_price(): void
    {
        $taxedItem = new CalculationWithRate(10.00, 0.00);

        $this->assertEquals(12.00, $taxedItem->add(2)->basePrice());
    }

    /** @test */
    public function it_can_get_the_subtract_price(): void
    {
        $taxedItem = new CalculationWithRate(10.00, 0.00);

        $this->assertEquals(8.00, $taxedItem->subtract(2)->basePrice());
    }

    /** @test */
    public function it_can_get_the_tax_rate(): void
    {
        $taxedItem = new CalculationWithRate(10.00, 0.21);

        $this->assertEquals(0.21, $taxedItem->taxRate());
    }

    /** @test */
    public function it_can_calculate_the_tax_price(): void
    {
        $taxedItem = new CalculationWithRate(10.00, 0.21);

        $this->assertEquals(2.10, $taxedItem->taxPrice());
    }

    /** @test */
    public function it_can_calculate_the_taxed_price(): void
    {
        $taxedItem = new CalculationWithRate(10.00, 0.21);

        $this->assertEquals(12.10, $taxedItem->taxedPrice());
    }
}
