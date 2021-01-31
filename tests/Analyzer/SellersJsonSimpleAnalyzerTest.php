<?php

declare(strict_types=1);

namespace App\Tests\Analyzer;

use App\Entity\Seller;
use App\Analyzer\SellersJsonSimpleAnalyzer;

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

/**
 * SellersJsonSimpleAnalyzerTest.
 *
 * @coversDefaultClass \App\Analyzer\SellersJsonSimpleAnalyzer
 */
class SellersJsonSimpleAnalyzerTest extends KernelTestCase
{
    use RefreshDatabaseTrait;

    /**
     * Test that an exception is thrown when a not valid version is stored in the provided sellers.json.
     *
     * @covers ::analyze
     */
    public function testAnalyzeWhenNotValidVersion(): void
    {
        $this->expectExceptionMessage('sellers.json not valid.');

        self::bootKernel();
        $analyzer = self::$container->get(SellersJsonSimpleAnalyzer::class);
    
        $data = json_decode(file_get_contents(__DIR__.'/invalid_version_sellers.json'), true);
        $analyzer->analyze($data);
    }

    /**
     * Test that an exception is thrown when a not valid type is stored in a seller in the provided sellers.json.
     *
     * @covers ::analyze
     */
    public function testAnalyzeWhenSellerHasNotValidType(): void
    {
        $this->expectExceptionMessage('sellers.json not valid.');

        self::bootKernel();
        $analyzer = self::$container->get(SellersJsonSimpleAnalyzer::class);
    
        $data = json_decode(file_get_contents(__DIR__.'/invalid_sellers.json'), true);
        $analyzer->analyze($data);
    }

    /**
     * Test that Seller entities are correctly created based on the provided sellers.json.
     *
     * @covers ::analyze
     */
    public function testAnalyze(): void
    {
        self::bootKernel();
        $em = self::$container->get('doctrine')->getManager();
        $analyzer = self::$container->get(SellersJsonSimpleAnalyzer::class);

        $data = json_decode(file_get_contents(__DIR__.'/valid_sellers.json'), true);
        $analyzer->analyze($data);
        $sellers = $em->getRepository(Seller::class)->findAll();

        // Assert that number of sellers in json equals number of sellers put into the db
        $this->assertEquals(count($data["sellers"]), count($sellers));
    }
}
