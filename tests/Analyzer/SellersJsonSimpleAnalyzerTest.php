<?php

declare(strict_types=1);

namespace App\Tests\Analyzer;

use PHPUnit\Framework\TestCase;

/**
 * SellersJsonSimpleAnalyzerTest.
 *
 * @coversDefaultClass \App\Analyzer\SellersJsonSimpleAnalyzer
 */
class SellersJsonSimpleAnalyzerTest extends TestCase
{
    /**
     * Test that an exception is thrown when a not valid version is stored in the provided sellers.json.
     *
     * @covers ::analyze
     */
    public function testAnalyzeWhenNotValidVersion(): void
    {

    }

    /**
     * Test that an exception is thrown when a not valid type is stored in a seller in the provided sellers.json.
     *
     * @covers ::analyze
     */
    public function testAnalyzeWhenSellerHasNotValidType(): void
    {

    }

    /**
     * Test that Seller entities are correctly created based on the provided sellers.json.
     *
     * @covers ::analyze
     */
    public function testAnalyze(): void
    {

    }
}